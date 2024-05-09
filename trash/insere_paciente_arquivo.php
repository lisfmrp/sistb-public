<?php
/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
 /* Importa-se o namespace (caminho do arquivo) da clase banco e 
    * cria-se um aliase (apelido) para ele */
    use Uteis\banco as banco;

    /* Importa-se a classe banco */
    require_once 'classes/banco.php';
    
    date_default_timezone_set('America/Sao_Paulo');
    //$data=date("dmY"); //aqui pegamos a data pois foi ela quem usamos como valor da sessao logado
    
    /* Cria um objeto da classe banco, voltado para o sistb 
        * e realiza a conexão */
        $db = banco::connectToTB();

if (isset($_POST)) {
    
    if (isset($_POST["data_inicio"])) {
        $data_inicio = $_POST["data_inicio"];
        $data_inicio = implode("-", array_reverse(explode("/", $data_inicio))); //revertemos a data para inserção no banco
    }
    if (isset($_POST["data_alta"])) {
        $data_alta= $_POST["data_alta"];
        $data_alta= implode("-", array_reverse(explode("/", $data_alta))); //revertemos a data para inserção no banco
    }
    
    
    
   if ($_POST["nome"] == "Outro") {


        if (isset($_POST["data_nascimento"])) {
            $data_nascimento = $_POST["data_nascimento"];
            $data_nascimento = implode("-", array_reverse(explode("/", $data_nascimento))); //revertemos a data para inserção no banco
        }

        $select = "INSERT INTO `paciente` (`nome`, `nro_prontuario`,`data_nascimento`,  `sexo` )
            VALUES ('$_POST[outro_paciente]', '$_POST[nro_prontuario]', '$data_nascimento',  '$_POST[sexo]')";

		$db->doAutoCommit(false);
		$ok1 = $db->insertQuery($select);

        $op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
                VALUES (NULL, 'Cadastrou um paciente', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

        $ok2 = $db->insertQuery($op2);
            
  
        $select2 = "SELECT cod_paciente FROM paciente WHERE nome='$_POST[outro_paciente]' AND data_nascimento='$data_nascimento'";
       
		$infos = $db->selectQuery($select2);
		$cod_p = $infos[0]['cod_paciente'];
		
		
        $select3 = "INSERT INTO `tratamento` ( `forma_clinica1`,`cod_paciente`, `data_tratamento_atual`,  `data_alta_tratamento`, `motivo_alta`, `un_atendimento`, `encerrado` )
            VALUES ('$_POST[fc1]', '$cod_p', '$data_inicio',  '$data_alta', '$_POST[alta]','$_POST[un_atendimento]', '2')";

        $ok3 = $db->insertQuery($select3);

        $op3 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
                VALUES (NULL, 'Cadastrou um tratamento', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

		$ok4 = $db->insertQuery($op3);
		
		
		if ($ok1 && $ok2 && $ok3 && $ok4) {
            $db->doCommit();
            $db->endConnection();
           // echo "Operação realizada com sucesso!";
		} else {
			$db->doRollback();
			$db->endConnection();
			echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
			die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
		} 
     }//if - se precisa cadastrar novo paciente
     else{
            
            $select3 = "INSERT INTO `tratamento` ( `forma_clinica1`,`cod_paciente`, `data_tratamento_atual`,  `data_alta_tratamento`, `motivo_alta`, `un_atendimento`, `encerrado` )
                VALUES ('$_POST[fc1]', '$_POST[nome]', '$data_inicio',  '$data_alta', '$_POST[alta]','$_POST[un_atendimento]', '2')";

            $db->doAutoCommit(false);
			$ok1 = $db->insertQuery($select3);

            $op3 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
                    VALUES (NULL, 'Cadastrou um tratamento', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";
			$ok2 = $db->insertQuery($op3);

     
		if ($ok1 && $ok2) {
            $db->doCommit();
            $db->endConnection();
           // echo "Operação realizada com sucesso!";
		} else {
			$db->doRollback();
			$db->endConnection();
			echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
			die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
		} 
            
     }       
            
    echo "Operação realizada com sucesso!";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";



    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>