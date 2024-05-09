<?php
@session_start();
date_default_timezone_set('America/Sao_Paulo');

use Uteis\banco as banco;
require_once 'classes/banco.php';
//require_once 'classes/banco_azure.php';
require_once 'classes/Security.php';
require_once 'functions.php';

$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
$db = banco::connectToTB();
$dbAzure = banco::connectToAzure();

if(isset($_POST["cod_unidade_origem"])) {
	$sql = "SELECT nome FROM unidade WHERE cod_unidade = '$_POST[cod_unidade_origem]';";
	$result = $db->selectQuery($sql);
	
	$_SESSION["nome_unidade"] = $result[0]['nome'];
	$_SESSION["cod_unidade"] = $_POST["cod_unidade_origem"];
	$_SESSION["leitura"] = 1;
	if($_SESSION["admin"] == 1) {
		$_SESSION["escrita"] = 1;
	} else {
		$sql = "SELECT escrita FROM profissional_permissoes WHERE cod_unidade = $_POST[cod_unidade_origem] AND cod_profissional = $_SESSION[cod_profissional];";
		$result = $db->selectQuery($sql);
		$_SESSION["escrita"] = intval($result[0]['escrita']);
	}
} else if(!isset($_SESSION["cod_unidade"])) {
	header("Location: logout.php");
}

if (!isset($_SESSION["cod_profissional"]) || empty($_SESSION["cod_profissional"]) || !isset($_SESSION["cod_unidade"]) || empty($_SESSION["cod_unidade"])) {	
    //if(isset($_GET["token"])) {	
	if(false) {
		set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');
		include('Crypt/RSA.php');
		$rsa = new Crypt_RSA();

		$tokenBase64 = str_replace(" ","+",$_GET["token"]);		
		$encryptedToken = base64_decode($tokenBase64);
				
		//descriptografar token
		$pubkey = file_get_contents("keys/sistb_api.pub");
		$rsa->loadKey($pubkey); 

		$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
		$token = $rsa->decrypt($encryptedToken);
		
		//validar token no banco e marcar como utilizado			    		
		$sql = "SELECT projetos_tuberculose.token FROM token WHERE token = '$token' AND utilizado = 0;";
		$result = $dbAzure->query($sql);

		if(!empty($result)) {
			$data_utilizacao = date("Y-m-d H:i:s");
			$sql = "UPDATE projetos_tuberculose.token SET utilizado = 1, data_utilizacao = '$data_utilizacao' WHERE token = '$token';";
			$dbAzure->query($sql);
		} else {
			session_unset();
			session_destroy();
			header("Location: index.html");			
		}			
	} else {	
		session_unset();
		session_destroy();
		header("Location: index.html");
	}
}

// Se o tempo passado desde o último acesso for maior que 60 minutos
if(session_status() == PHP_SESSION_ACTIVE) {
	if (time() - $_SESSION["timeout"] > 60 * 60) {
		// Desaloca as variáveis alocadas
		session_unset();
		// Destrói a sessăo
		session_destroy();
		die("<script> alert('Sessăo expirada. Por favor, faça login novamente!');
			window.location.href = 'index.html';
		  </script>");
	} else {
		// Se năo, reincia o valor de timeout
		$_SESSION["timeout"] = time();
	}
}
?>
