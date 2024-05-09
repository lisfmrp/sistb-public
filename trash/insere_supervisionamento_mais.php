<?php

session_start(); //iniciamos a sessão

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
        $db->doAutoCommit(false);

if (isset($_POST)) {

	$pac = $_POST['cod_paciente'];
	//$cod_tratamento = $_POST['cod_trat'];
	$verifica = 1;
	$selectTrat = "SELECT cod_tratamento FROM tratamento WHERE cod_paciente = '$pac' AND tratamento.encerrado = 0 AND tratamento.un_supervisao = '$_SESSION[cod_unidade]' ";
	$queryTrat = $db->selectQuery($selectTrat);
	$cod_tratamento = $queryTrat[0]['cod_tratamento'] ;
	$existe =0;
	 

	function insertQuerySup($string_nro, $data_comparecimento, $comparecimento, $pac, $cod_tratamento, $db){

	    $ok = 1;
	    
	    if(isset($_POST['hab'.$string_nro])){
	    	
	    		$insertC = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
					`data_supervisionamento`, `comparecimento`)
				VALUES ('$pac', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', 
					'$data_comparecimento', '$comparecimento')";

				$ok = $db->insertQuery($insertC);

				$op = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
					VALUES (NULL, ' Cadastrou um supervisionamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

				$ok = $ok * ($db->insertQuery($op));
	    	
	    }
	    return $ok;
	}

	
	for ($i=1; $i<15; $i++){
		if (isset($_POST['hab'.$i])) {
		        $data_comparecimentop = $_POST['data_comparecimento'.$i];
		        $data_comparecimento = implode("-", array_reverse(explode("/", $data_comparecimentop))); //revertemos a data para inserção no banco

		        $checkn = "SELECT cod_paciente FROM supervisionamento WHERE cod_paciente = '$pac' and data_supervisionamento = '$data_comparecimento'";
				$rowsn = sizeof($db->selectQuery($checkn));

		        if ($rowsn == 0) {

					$verifica = $verifica * insertQuerySup($i, $data_comparecimento, $_POST['comparecimento'.$i], $pac, $cod_tratamento, $db);

		        } else {
		        	$existe = $existe +1;
		            echo "<img src='images/icons/splashyIcons/error.png' alt='' /> <b><font color='red'>Supervisão do dia já existente: $data_comparecimentop <br></font></b>";
		            //die("<META HTTP-EQUIV='REFRESH' CONTENT='5; URL=index.php?acao=judicial+novo_processo'>");
		        }
		}
	}
		    

    /*if (isset($_POST["hab1"])) {
        $data_comparecimento2 = $_POST["data_comparecimento2"];
        $data_comparecimento2 = implode("-", array_reverse(explode("/", $data_comparecimento2))); //revertemos a data para inserção no banco

        $checkn = "SELECT cod_paciente FROM supervisionamento WHERE cod_paciente = '$pac' and data_supervisionamento = '$data_comparecimento2'";
		$rowsn = sizeof($db->selectQuery($checkn));

        if ($rowsn == 0) {

			$insertC2 = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
					`data_supervisionamento`, `comparecimento`)
			VALUES ('$pac', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', 
					'$data_comparecimento2', '$_POST[comparecimento2]')";

            $ok2 = $db->insertQuery($insertC2);
            $verifica = $verifica * $ok2;
        } else {
            echo "<img src='images/icons/splashyIcons/error.png' alt='' /> <b><font color='red'>Supervisão do dia já existente: $data_comparecimento2 <br></font></b>";
            //die("<META HTTP-EQUIV='REFRESH' CONTENT='5; URL=index.php?acao=judicial+novo_processo'>");
        }
    }*/
		
	if ($verifica) {
        $db->doCommit();
        $db->endConnection();
        if ($existe ==0){
        	echo "Operação realizada com sucesso!";
        }else{
        	echo "Operação realizada com sucesso, porém supervisões já existestes não foram cadastradas";
        }
      
	} else {
		$db->doRollback();
		$db->endConnection();
		echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
		die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
	} 

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";

    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>