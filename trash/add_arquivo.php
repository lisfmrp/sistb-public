<?php
/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);

define('GW_UPLOADPATH', 'amb/simioni');
if (isset($_POST['enviar'])) {

	$paciente = $_FILES['paciente']['name'];
	$supervisao = $_FILES['supervisao']['name'];

	if (!empty($paciente) && !empty($supervisao)){
		//move arquivo para pasta alvo
		$target = GW_UPLOADPATH . $paciente;
		if (move_uploaded_file($_FILES['paciente']['tmp_name'], $target)) {
		//confirma exito
			echo "enviado com sucesso!";	
				//ler arquivo para passar
		}
	}
}
?>