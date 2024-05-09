<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {	
	if(sizeof($_POST["comparecimento"]) == sizeof($_POST["data_comparecimento"])) {		
		$observacoes = "NULL";
		if ($_POST["observacoes"] != "") {
			$observacoes = "'".$_POST["observacoes"]."'";
		}
		$i = 0;
		foreach($_POST["comparecimento"] as $comparecimento) {
			$data_comparecimento = "NULL";
			if ($_POST["data_comparecimento"][$i] != "") {
				//$data_comparecimento = "'".implode("-", array_reverse(explode("/", $_POST["data_comparecimento"][$i])))."'";
				$data_comparecimento = "'".$_POST["data_comparecimento"][$i]."'";
			}
			$codAux = explode("|",$_POST["paciente_tratamento"]);
			$codPaciente = $codAux[0];
			$codTratamento = $codAux[1];
			$sql = "INSERT INTO `supervisionamento`
						(`cod_paciente`,
						`cod_profissional`,
						`cod_unidade`,
						`cod_tratamento`,
						`data_supervisionamento`,
						`comparecimento`,
						`observacoes`)
					VALUES 
						($codPaciente,
						$_POST[cod_profissional],
						$_POST[cod_unidade],
						$codTratamento,
						$data_comparecimento,
						'$comparecimento',
						$observacoes);";
			//echo $sql."<br/><br/><br/><br/>";
			$result = $db->insertQuery(utf8_decode($sql));
			$i++;
		}
	}
	$redirectTo = "acao=supervisionamento_ficha&cod_tratamento=$codTratamento";
	if (isset($result) && $result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES (6,$_SESSION[cod_profissional],$codTratamento);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar Supervisão")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>