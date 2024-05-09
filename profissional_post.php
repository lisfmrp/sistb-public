<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["admin"] == 1) {
	$ocupacao = $_POST["ocupacao"];
	if($_POST["admin"] == "1") {
		$ocupacao = "Administrador";
	}
	
	if (!isset($_POST["cod_profissional"])) { //INSERIR
		$sql = "SELECT login FROM profissional WHERE login = '$_POST[login]'";
		$result = $db->selectQuery($sql);
		if (sizeof($result) > 0) {
			header("Location: index.php?acao=msg&t=erro&m=".base64_encode("O login já existe! Por favor, escolha outro."));
			exit();
		}
		
		if ($_POST["senha1"] !== $_POST["senha2"]) {
			header("Location: index.php?acao=msg&t=erro&m=".base64_encode("As senhas não conferem!"));
			exit();
		}
		
		$tipoLog = 10;
		$sql = "INSERT INTO `profissional` (`nome`, `login`, `senha`, `email`, `numero_conselho`,`ocupacao`,`admin`)
			VALUES ('$_POST[nome]','$_POST[login]', SHA('$_POST[senha1]'), '$_POST[email]', '$_POST[nro_conselho]','$ocupacao',$_POST[admin])";
		//echo $sql."<br/><br/><br/><br/>";
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		if($_POST["cod_profissional"] == $_SESSION["cod_profissional"])
			$tipoLog = 38;
		else
			$tipoLog = 21;
		
		$sqlSenha = "";
		if (isset($_POST["senha1"]) && $_POST["senha1"] != "") {
			if ($_POST["senha1"] !== $_POST["senha2"]) {
				header("Location: index.php?acao=msg&t=erro&m=".base64_encode("As senhas não conferem!"));
				exit();
			} else {
				$sqlSenha = ",`senha` = SHA('$_POST[senha1]')";
			}
		}
				
		$cod = $_POST["cod_profissional"];
		$sql = "UPDATE `profissional` SET 
							`nome` = '$_POST[nome]', 
							`email` = '$_POST[email]',
							`numero_conselho`  = '$_POST[nro_conselho]',
							`ativo`  = '$_POST[ativo]',
							`admin` = '$_POST[admin]',
							`ocupacao` = '$ocupacao'
							$sqlSenha
							WHERE `profissional`.`cod_profissional` =  $cod";

		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=profissional_form&cod_profissional=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Profissional")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>