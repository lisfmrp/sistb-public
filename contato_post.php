<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
	$data_nascimento = "NULL";
	if (isset($_POST["data_nascimento"]) && !empty($_POST["data_nascimento"])) {
        $data_nascimento = "'".implode("-", array_reverse(explode("/", $_POST["data_nascimento"])))."'";
    }

	$data_ppd = "NULL";
    if (isset($_POST["data_ppd"]) && !empty($_POST["data_ppd"])) {
        $data_ppd = "'".implode("-", array_reverse(explode("/", $_POST["data_ppd"])))."'";
    }
	
	$data_baciloscopia = "NULL";
    if (isset($_POST["data_baciloscopia"]) && !empty($_POST["data_baciloscopia"])) {
        $data_baciloscopia = "'".implode("-", array_reverse(explode("/", $_POST["data_baciloscopia"])))."'";
    }
	
	$data_rx_pulmao = "NULL";
    if (isset($_POST["data_rx_pulmao"]) && !empty($_POST["data_rx_pulmao"])) {
        $data_rx_pulmao = "'".implode("-", array_reverse(explode("/", $_POST["data_rx_pulmao"])))."'";
    }
	
	$data_quimio = "NULL";
    if (isset($_POST["data_quimio"]) && !empty($_POST["data_quimio"])) {
        $data_quimio = "'".implode("-", array_reverse(explode("/", $_POST["data_quimio"])))."'";
    }
	
	$data_retorno = "NULL";
    if (isset($_POST["data_retorno"]) && !empty($_POST["data_retorno"])) {
        $data_retorno = "'".implode("-", array_reverse(explode("/", $_POST["data_retorno"])))."'";
    }
	
	$data_saida = "NULL";
    if (isset($_POST["data_saida"]) && !empty($_POST["data_saida"])) {
        $data_saida = "'".implode("-", array_reverse(explode("/", $_POST["data_saida"])))."'";
    }
	
	if (!isset($_POST["cod_contato"])) { //INSERIR
		$tipoLog = 12;
		$sql = "INSERT INTO `contato` (`cod_paciente`, `nome`, `idade`, `grau_parentesco`, `data_baciloscopia`, `resultado_baciloscopia`, 
					`data_rx_pulmao`, `resultado_rx_pulmao`, `data_ppd`, `resultado_ppd`, `quimioprofilaxia`, 
					`data_quimioprofilaxia`, `data_retorno`, `data_nascimento`, `tipo_saida`, `coinfeccao`, `data_saida`, `observacao_contato`)
				VALUES($_POST[cod_paciente], '$_POST[nome]', $_POST[idade], '$_POST[parentesco]', $data_baciloscopia, '$_POST[resultado_baciloscopia]', '$data_rx_pulmao', 
				'$_POST[resultado_rx_pulmao]', $data_ppd, '$_POST[resultado_ppd]', '$_POST[quimio]', $data_quimio, $data_retorno, $data_nascimento, 
				'$_POST[tipo_saida]','$_POST[coinfeccao]', $data_saida,'$_POST[observacao_contato]')";
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		if($_POST["cod_unidade"] != $_SESSION["cod_unidade"] && $_SESSION["admin"] == 0) {
			header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
			exit();
		}
		
		$data_exclusao = "NULL";
		if($_POST["excluido"] == "1")
			$data_exclusao = "'".date("Y-m-d H:i:s")."'";
	
		$tipoLog = 23;
		$cod = $_POST["cod_contato"];
		$sql = "UPDATE `contato` SET        
					`nome` = '$_POST[nome]', 
					`idade` = '$_POST[idade]', 
					`grau_parentesco` = '$_POST[parentesco]',
					`data_baciloscopia` = $data_baciloscopia,
					`resultado_baciloscopia`  = '$_POST[resultado_baciloscopia]',
					`data_rx_pulmao` = $data_rx_pulmao, 
					`resultado_rx_pulmao` = '$_POST[resultado_rx_pulmao]',
					`data_ppd` = $data_ppd, 
					`resultado_ppd` = '$_POST[resultado_ppd]',
					`quimioprofilaxia` = '$_POST[quimio]',
					`data_quimioprofilaxia` = $data_quimio,
					`data_retorno` = $data_retorno,
					`data_nascimento` = $data_nascimento,
					`tipo_saida` = '$_POST[tipo_saida]',
					`coinfeccao` = '$_POST[coinfeccao]',
					`data_saida` =  $data_saida, 
					`observacao_contato` =  '$_POST[observacao_contato]',
					`excluido` =  $_POST[excluido],
					`data_exclusao` = $data_exclusao
				WHERE `contato`.`cod_contato` = $cod";
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=contato_form&cod_contato=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Contato")."&r=".base64_encode($redirectTo));
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>