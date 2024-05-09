<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
	$data_controle = "NULL";
    if (isset($_POST["data_controle"]) && !empty($_POST["data_controle"])) {
        $data_controle = "'".implode("-", array_reverse(explode("/", $_POST["data_controle"])))."'";
    }    
	if (!isset($_POST["cod_controle"])) { //INSERIR
		$tipoLog = 7;
		$codAux = explode("|",$_POST["paciente_tratamento"]);
		$sql = "INSERT INTO `controle_mensal` (`cod_paciente`, `cod_tratamento`, `resultado_controle`, `data_controle`, `tipo_exame`, `material_controle` )
					VALUES ($codAux[0], $codAux[1], '$_POST[resultado_controle]', $data_controle, '$_POST[tipo_exame]', '$_POST[material_controle]')";
		//echo $sql."<br/><br/><br/><br/>";
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		$tipoLog = 18;
		$cod = $_POST["cod_controle"];
		$sql = "UPDATE `controle_mensal` SET 
					`resultado_controle` = '$_POST[resultado_controle]',
					`data_controle` = $data_controle, 
					`tipo_exame` = '$_POST[tipo_exame]',   
					`material_controle` = '$_POST[material_controle]'   
				 WHERE `cod_controle` =  $cod";
		$result = $db->updateQuery(utf8_decode($sql));
	}        
	//exit();
	$redirectTo = "acao=controle_form&cod_controle=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		$r = "";
		if($cod > 0) $r = "&r=".base64_encode($redirectTo);
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Controle Mensal").$r);
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>