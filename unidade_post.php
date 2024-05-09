<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["admin"] == 1) {
	if (!isset($_POST["cod_unidade"])) { //INSERIR
		$tipoLog = 11;
		$sql = "INSERT INTO `unidade` (`nome`, `cidade`, `estado`, `endereco`, `telefone`,`atencao`)
					VALUES ('$_POST[nome]', '$_POST[cidade]','$_POST[estado]', '$_POST[endereco]', '$_POST[telefone]', '$_POST[atencao]')";
		//echo $sql."<br/><br/><br/><br/>";
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		$tipoLog = 22;
		$cod = $_POST["cod_unidade"];
		$sql = "UPDATE `tuberculose`.`unidade` SET
					`nome` = '$_POST[nome]', 
					`cidade` =  '$_POST[cidade]', 
					`estado` = '$_POST[estado]',
					`endereco` = '$_POST[endereco]',
					`telefone`  = '$_POST[telefone]',
					`atencao`  = '$_POST[atencao]'			
				  WHERE `unidade`.`cod_unidade` =  $cod";
		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=unidade_form&cod_unidade=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar a Unidade")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>