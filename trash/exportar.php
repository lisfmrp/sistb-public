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
 
 
 
//session_start(); //iniciamos a sessão
//date_default_timezone_set('America/Sao_Paulo');
//$data = date("dmY");



$con = mysql_connect("localhost", "tuberculose", "senha");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("tuberculose", $con);
 
 
//mysql_connect('localhost', 'root', 'sua_senha') or die ('Erro ao conectar');
//mysql_select_db('newsletter') or die ('Erro ao conectar com o banco de dados');
//$rs = mysql_query("SELECT idcontato, nome, email FROM contato ORDER BY idcontato");




$rs = "SELECT nome, data_nascimento, idade, mae FROM paciente";
			$querysql = @mysql_query($rs) or die(mysql_error());
			//$lsql = mysql_fetch_array($querysql);
			//$cod_tratamento = ucfirst($lsql[0]);
               //echo $querysql;
                        
                        $lsql = mysql_fetch_array($querysql);
                        $lala = ucfirst($lsql[0]);
                        echo $lala;
 
$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";//cabeçalho do arquivo
       //$xml .= "<Newsletter> n";
 
       while($reg = mysql_fetch_object($querysql)){
           $xml .= "<paciente>\n";
           $xml .= "    <nome>$reg->nome</nome>\n";
           $xml .= "    <mae>$reg->mae</mae>\n";
           $xml .= "    <idade>$reg->idade</idade> \n";
           $xml .= "    <nascimento>$reg->data_nascimento</nascimento> \n";
           $xml .= "</paciente>\n";
       }
       //$xml .= "</Newsletter>";
 
       //var_dump($reg);
       
       $ponteiro = fopen('backup.xml', 'w'); //cria um arquivo com o nome backup.xml
       fwrite($ponteiro, $xml); // salva conteúdo da variável $xml dentro do arquivo backup.xml
 
       $ponteiro = fclose($ponteiro); //fecha o arquivo

?>
