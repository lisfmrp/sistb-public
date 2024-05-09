<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
    $data_comparecimento = "NULL";    
    if (isset($_POST["data_comparecimento"])) {
        $data_comparecimento = "'".implode("-", array_reverse(explode("/", $_POST["data_comparecimento"])))."'";
    }
	$comp = $_POST["comparecimento"];
	$pac = $_POST['cod_paciente'];
       
	$sql = "SELECT cod_supervisionamento FROM supervisionamento WHERE cod_paciente = $pac AND data_supervisionamento = $data_comparecimento AND comparecimento = '$comp'";
	//echo $sql."<br/><br/><br/><br/>";
	$infos = $db->selectQuery($sql);
	$cod_supervisionamento = $infos[0]['cod_supervisionamento'];

	if (sizeof($infos) > 0) {					                                    
		$sql = "DELETE FROM supervisionamento WHERE cod_supervisionamento = $cod_supervisionamento";
		//echo $sql."<br/><br/><br/><br/>";
		$result = $db->insertQuery(utf8_decode($sql));
	} 	

	$redirectTo = "acao=supervisionamento_excluir";
	if (isset($result) && $result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES (28,$_SESSION[cod_profissional],$cod_supervisionamento);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar Supervisão")."&r=".base64_encode($redirectTo));
	} 	
}
?>