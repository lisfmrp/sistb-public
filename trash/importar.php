 <?php
/*
session_start(); //iniciamos a sessão
date_default_timezone_set('America/Sao_Paulo');
$data = date("dmY");



$con = mysql_connect("localhost", "tuberculose", "senha");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("tuberculose", $con);



if (isset($_POST)) {


    if (isset($_POST["data_comparecimento"])) {
        $data_comparecimento = $_POST["data_comparecimento"];
        $data_comparecimento = implode("-", array_reverse(explode("/", $data_comparecimento))); //revertemos a data para inserção no banco
    }

	$pac = $_POST[cod_paciente];
	
	$checkn = "SELECT cod_paciente FROM supervisionamento WHERE cod_paciente = '$pac' and data_comparecimento = '$_POST[data_comparecimento]'";
	$sqlcheckn = mysql_query($checkn);
	$rowsn = mysql_num_rows($sqlcheckn);

	if ($rowsn == 0) {
	
			
			//pegar o codigo da tela anterior

			$sql = "SELECT cod_tratamento FROM tratamento WHERE cod_paciente = '$_POST[cod_paciente]' AND tratamento.encerrado = 0";
			$querysql = @mysql_query($sql) or die(mysql_error());
			$lsql = mysql_fetch_array($querysql);
			$cod_tratamento = ucfirst($lsql[0]);


			if ($_POST["cod_unidade"] != "" && $_POST["cod_unidade"] != NULL) {

				$select = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_unidade`, `cod_tratamento`, 
						`data_supervisionamento`, `comparecimento`, `observacoes`)
			VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]', '$_POST[cod_unidade]','$cod_tratamento', '$data_comparecimento', '$_POST[comparecimento]', '$_POST[observacoes]')";
			} else {
				$select = "INSERT INTO `supervisionamento` (`cod_paciente`, `cod_profissional`, `cod_tratamento`, 
						`data_supervisionamento`, `comparecimento`, `observacoes`)
			VALUES ('$_POST[cod_paciente]', '$_POST[cod_profissional]','$cod_tratamento', '$data_comparecimento', '$_POST[comparecimento]', '$_POST[observacoes]')";
			}



			if (!mysql_query($select, $con)) {
				die('Error: ' . mysql_error());
			}

			$op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
				VALUES (NULL, ' Cadastrou uma supervisionamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";


			if (!mysql_query($op2, $con)) {
				die('Error: ' . mysql_error());
			}

			echo "Operação realizada com sucesso!";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";

	
	}//if não existe 
	else //ver se quer dar update
	{
			echo "Já existe supervisão deste dia para o paciente.  "; // redireciona pra página de erro
	}		


    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}
mysql_close($con);
 
 ********************************************************************************/
 
$xml = simplexml_load_file('backup.xml'); /* Lê o arquivo XML e recebe um objeto com as informações */


foreach ($xml as $paciente){
    $a = "nome: " . $paciente->nome . "<br>";
    $a .= "mae: " . $paciente->mae . "<br>";
    $a .= "idade: " . $paciente->idade. "<br>";
    $a .= "nascimento: " . $paciente->nascimento . "<br><br>";
    
    echo $a;
        
}

 //print_r($xml);
    

 
/* Percorre o objeto e imprime na tela as informações de cada contato 
foreach ($xml as $paciente){
    $a = "Id: " . $paciente->_id . "<br>";
    $a .= "Nome: " . $paciente->nome . "<br>";
    $a .= "cpf: " . $paciente->cpf. "<br>";
    $a .= "cns: " . $paciente->cns . "<br>";
    $a .= "pront: " . $paciente->nro_prontuario . "<br>";
    $a .= "un not: " . $paciente->un_notificante. "<br>";
    $a .= "un at: " . $paciente->un_atendimento . "<br>";
    $a .= "data not: " . $paciente->data_notificacao. "<br>";
    $a .= "nasc: " . $paciente->data_nascimento . "<br>";
    $a .= "idade: " . $paciente->idade . "<br>";
    $a .= "sexo: " . $paciente->sexo. "<br>";
    $a .= "gestante: " . $paciente->gestante . "<br>";
    $a .= "mae: " . $paciente->mae . "<br>";
    $a .= "etnia: " . $paciente->etnia. "<br>";
    $a .= "endereco: " . $paciente->endereco . "<br>";
    $a .= "telefone: " . $paciente->telefone . "<br>";
    $a .= "cidade: " . $paciente->cidade. "<br>";
    $a .= "estado: " . $paciente->estado . "<br>";
    $a .= "escolaridade: " . $paciente->escolaridade. "<br>";
    $a .= "tipo_ocupacao " . $paciente->tipo_ocupacao . "<br>";
    $a .= "ocupacao: " . $paciente->ocupacao . "<br>";
    $a .= "observacoes: " . $paciente->observacoes. "<br>";
    $a .= "nro_fie: " . $paciente->nro_fie. "<br><br>";
    
    
    
    echo $a;
    
    
}

 print_r($xml);
 echo $xml->paciente->nome;
 * 
 * 
 */

?>
