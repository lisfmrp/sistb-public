<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["admin"] == 1) {
	if (isset($_POST["cod_profissional"])) {
		$tipoLog = 37;
		
		$cod = $_POST["cod_profissional"];
		$escrita = $_POST["escrita"];
		$leitura = array_diff($_POST["leitura"],$escrita);
		
		$sql = "DELETE FROM profissional_permissoes WHERE cod_profissional = $cod;";
		$db->deleteQuery($sql);
		
		foreach ($leitura as $unidade_l) {
			$sql = "INSERT INTO profissional_permissoes (cod_unidade, cod_profissional, leitura, escrita) VALUES ($unidade_l,$cod,1,0);";
			$db->insertQuery($sql);
		}
		
		foreach ($escrita as $unidade_e) {
			$sql = "INSERT INTO profissional_permissoes (cod_unidade, cod_profissional, leitura, escrita) VALUES ($unidade_e,$cod,1,1);";
			$db->insertQuery($sql);
		}
		
		if ($db->error() == "") {
			$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
			$db->insertQuery($sql);	
			header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!"));
		} else {
			header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Profissional"));
		} 
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
	}
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>