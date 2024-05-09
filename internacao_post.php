<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
	$data_internacao = "NULL";
	if (isset($_POST["data_internacao"]) && !empty($_POST["data_internacao"])) {
        $data_internacao = "'".implode("-", array_reverse(explode("/", $_POST["data_internacao"])))."'";
    }

	$data_alta = "NULL";
    if (isset($_POST["data_alta"]) && !empty($_POST["data_alta"])) {
        $data_alta = "'".implode("-", array_reverse(explode("/", $_POST["data_alta"])))."'";
    }
	
	$codTipoAlta = "NULL";
	if (isset($_POST["cod_tipo_alta"]) && !empty($_POST["cod_tipo_alta"])) {
		$codTipoAlta = $_POST["cod_tipo_alta"];
	}
	
	if (!isset($_POST["cod_internacao"])) { //INSERIR
		$tipoLog = 8;
		$sql = "INSERT INTO `internacao` (`cod_unidade`, `data_internacao`, `cod_motivo_internacao`, `observacoes`, `cod_paciente`, `cod_profissional`, 
					`profissional_alta`, `data_alta`, `cod_tipo_alta`)
					VALUES($_POST[cod_unidade], $data_internacao, $_POST[cod_motivo_internacao], '$_POST[observacoes]', $_POST[cod_paciente], 
						$_SESSION[cod_profissional], '$_POST[profissional_alta]', $data_alta, $codTipoAlta);";
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		if($_POST["cod_unidade"] != $_SESSION["cod_unidade"] && $_SESSION["admin"] == 0) {
			header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
			exit();
		}
	
		$tipoLog = 19;
		$cod = $_POST["cod_internacao"];
		$sql = "UPDATE `internacao` SET 
				`profissional_alta` = '$_POST[profissional_alta]', 
				`data_alta` = $data_alta, 
				`cod_tipo_alta`  = $codTipoAlta,
				`cod_motivo_internacao` = '$_POST[cod_motivo_internacao]',
				`cod_unidade` = '$_POST[cod_unidade]',
				`data_internacao` = $data_internacao,
				`observacoes` = '$_POST[observacoes]'    
			  WHERE `internacao`.`cod_internacao` =  $cod";
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=internacao_form&cod_internacao=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar a Internação")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>