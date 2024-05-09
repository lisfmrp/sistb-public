<?php
/* Verifica se o usuário está logado 
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}
*/
/* Importa-se a classe Security 
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);*/

define('GW_UPLOADPATH', 'amb/');

if (isset($_POST['submit'])) {

	$paciente = $_FILES['paciente']['name'];
	$supervisao = $_FILES['supervisao']['name'];
	

	if (!empty($paciente) && !empty($supervisao)){
		
		//move arquivo para pasta alvo
		$targetp = GW_UPLOADPATH . $paciente;
		$targets = GW_UPLOADPATH . $supervisao;
		if ((move_uploaded_file($_FILES['paciente']['tmp_name'], $targetp)) && (move_uploaded_file($_FILES['supervisao']['tmp_name'], $targets))) {
		//confirma exito
			echo "enviado com sucesso!";	
				//ler arquivo para passar
				//echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=paciente+importarS'>";
		}
		else
		print_r(error_get_last());
	} else {
		echo "Por favor, insira os dois arquivos, para submeter as informações.";
		
	}
}

?>

<html>
	<form enctype="multipart/form-data" method="post" action="abrir.php">
	<input type="hidden">

		<label for="ambulatorio">Arquivo de paciente a ser enviado (pactratamt.json):</label>
		<input type="file" id="paciente" name="paciente" />
		<br />
		<br />
		<label for="ambulatorio">Arquivo de supervisão a ser enviado (supervisaot.json):</label>
		<input type="file" id="supervisao" name="supervisao" />
		<br />
		<br />
		<input type="submit" value="Enviar" name="submit">
	</form>
</html>
