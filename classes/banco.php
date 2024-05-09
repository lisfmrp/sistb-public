<?php
namespace Uteis;

class banco {

    private $address;
    private $user;
    private $password;
    private $database;
    private $porta;
    private $connection;

    public function __construct($address, $user, $password, $database, $porta) {
        if ((!is_string($address)) || (!is_string($user)) || (!is_string($password)) || (!is_string($database))) {
            echo 'Os parametros digitados devem ser strings.';
        } else {
            $this->address = $address;
            $this->user = $user;
            $this->password = $password;
            $this->database = $database;
			$this->porta = $porta;
        }
    }
	
    public function connect() {
        $this->connection = new \mysqli($this->address, $this->user, $this->password, $this->database, $this->porta);

        if ($this->connection->connect_error) {
            throw new \Exception('Năo foi possível realizar a conexăo. 
                                  Erro (' . $this->connection->connect_errno
            . ') : ' . $this->connection->connect_error);
        } else {
            $this->connection->set_charset("iso-8859-1");
        }
    }

    public static function connectToTB() {
		$address = "";
        $user = "";
        $password = "";
        $database = "";

        $connection = new banco($address, $user, $password, $database, 3000);

        try {
            $connection->connect();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return $connection;
    }
	
	public static function connectToAzure() {
		$address = "";
        $user = "";
        $password = "";
        $database = "";

        $connection = new banco($address, $user, $password, $database, 3306);

        try {
            $connection->connect();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        return $connection;
    }

    public function selectDB($dbName) {
        $this->database = $dbName;
        $this->connection->select_db($this->database);
    }

    public function selectQuery($selectSql) {
        $select = $this->connection->query($selectSql);
        if ($this->connection->error) {
            echo "Erro ao realizar a consulta: " . $this->connection->error . "<br>";
        } else {
            /*$result = array();
            $count = 0;
            while ($row = $select->fetch_assoc()) {
                $result[$count] = $row;
                $count++;
            }
            $select->free();
            return ($result);*/
			return $select->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function insertQuery($insertSql) {
        $this->connection->query($insertSql);
        if ($this->connection->error) {
            echo "Erro ao inserir: " . $this->connection->error . "<br>";
            return false;
        }
        return true;
    }

    public function updateQuery($updateSql) {
        $this->connection->query($updateSql);
        if ($this->connection->error) {
            echo "Erro ao realizar um update(editar): " . $this->connection->error;
            return false;
        }
        return true;
    }
    
    public function deleteQuery($deleteSql) {
        $this->connection->query($deleteSql);
        if ($this->connection->error) {
            echo "Erro ao realizar uma deleçăo: " . $this->connection->error;
            return false;
        }
        return true;
    }

    public function lastInsertedId() {
        return $this->connection->insert_id;
    }

    public function endConnection() {
        $this->connection->close();
    }

    public function doAutoCommit($bool) {
        $this->connection->autocommit($bool);
    }

    public function doCommit() {
        $this->connection->commit();
    }

    public function doRollback() {
        $this->connection->rollback();
    }

    public function affectedRows() {
        return $this->connection->affected_rows;
    }
	
	public function error() {
		return $this->connection->error;
	}
}
?>