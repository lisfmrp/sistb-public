<?php
require_once("autenticacao.php");
if (isset($_POST) && $_SESSION["escrita"] == 1) {
	$data_bac_escarro = "NULL";
	if (isset($_POST["data_bac_escarro"]) && !empty($_POST["data_bac_escarro"])) {
		$data_bac_escarro = "'".implode("-", array_reverse(explode("/", $_POST["data_bac_escarro"])))."'";
    }
	
	$data_bac_outro = "NULL";
    if (isset($_POST["data_bac_outro"]) && !empty($_POST["data_bac_outro"])) {
        $data_bac_outro = "'".implode("-", array_reverse(explode("/", $_POST["data_bac_outro"])))."'";
    }

	$data_cultura_escarro = "NULL";
    if (isset($_POST["data_cultura_escarro"]) && !empty($_POST["data_cultura_escarro"])) {
        $data_cultura_escarro = "'".implode("-", array_reverse(explode("/", $_POST["data_cultura_escarro"])))."'";
    }

	$data_cultura_outro = "NULL";
    if (isset($_POST["data_cultura_outro"]) && !empty($_POST["data_cultura_outro"])) {
        $data_cultura_outro = "'".implode("-", array_reverse(explode("/", $_POST["data_cultura_outro"])))."'";
    }
	
	$data_rx_torax = "NULL";
    if (isset($_POST["data_rx_torax"]) && !empty($_POST["data_rx_torax"])) {
        $data_rx_torax = "'".implode("-", array_reverse(explode("/", $_POST["data_rx_torax"])))."'";
    }

    $data_rx_outro = "NULL";
    if (isset($_POST["data_rx_outro"]) && !empty($_POST["data_rx_outro"])) {
        $data_rx_outro = "'".implode("-", array_reverse(explode("/", $_POST["data_rx_outro"])))."'";
    }

    $data_histopatologico = "NULL";
    if (isset($_POST["data_histopatologico"]) && !empty($_POST["data_histopatologico"])) {
        $data_histopatologico = "'".implode("-", array_reverse(explode("/", $_POST["data_histopatologico"])))."'";
    }

	$data_necropsia = "NULL";
    if (isset($_POST["data_necropsia"]) && !empty($_POST["data_necropsia"])) {
        $data_necropsia = "'".implode("-", array_reverse(explode("/", $_POST["data_necropsia"])))."'";
    }

    $data_outros = "NULL";
    if (isset($_POST["data_outros"]) && !empty($_POST["data_outros"])) {
        $data_outros = "'".implode("-", array_reverse(explode("/", $_POST["data_outros"])))."'";
    }

    $data_trat_atual = "NULL";
    if (isset($_POST["data_trat_atual"]) && !empty($_POST["data_trat_atual"])) {
        $data_trat_atual = "'".implode("-", array_reverse(explode("/", $_POST["data_trat_atual"])))."'";
    }

    $data_alta = "NULL";
    if (isset($_POST["data_alta"]) && !empty($_POST["data_alta"])) {
        $data_alta = "'".implode("-", array_reverse(explode("/", $_POST["data_alta"])))."'";
    }

    $data_notificacao = "NULL";
    if (isset($_POST["data_notificacao"]) && !empty($_POST["data_notificacao"])) {
        $data_notificacao = "'".implode("-", array_reverse(explode("/", $_POST["data_notificacao"])))."'";
    }

	$data_tmrtb = "NULL";
    if (isset($_POST["data_tmrtb"]) && !empty($_POST["data_tmrtb"])) {
        $data_tmrtb = "'".implode("-", array_reverse(explode("/", $_POST["data_tmrtb"])))."'";
    }
	
	foreach($_POST as $key => $value) {
		//echo $key." - ".$value."<br/>";
		if (isset($_POST[$key]) && empty($_POST[$key]) && $_POST[$key] != "0" && $_POST[$key] != "1") {
			$_POST[$key] = "NULL";
		} else  if($key != "cod_tratamento") {
			$_POST[$key] = "'".$_POST[$key]."'";
		}
	}
	
	if($_POST["cod_profissional"] == "'Outro'") {
		$_POST["cod_profissional"] = "NULL";
	}
	
	if (!isset($_POST["cod_tratamento"])) { //INSERIR
		$tipoLog = 5;
		$sql = "INSERT INTO `tratamento` (`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
						`forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `unidade_recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
						`resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
						`data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
						`resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
						`tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
						`etambutol`, `etionamida`, `observacoes`, `cod_profissional`, `cod_paciente`, `data_outro`, `resultado_outro`, 
						`data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
						`servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_notificante`, `un_atendimento`, `data_notificacao`,
						`outra_unidade_recebe`, `rifambutina`, `resultado_tmrtb`, `data_tmrtb`, `un_supervisao`,`levofloxacina`,`ofloxacina`
						)
					VALUES ($_POST[trat_anterior],$_POST[tempo_tratamento],$_POST[fc1],$_POST[fc2],$_POST[fc3],$_POST[descoberta],
						$_POST[unidade_recebido], $_POST[tempo_decorrido], $data_bac_escarro ,$_POST[resultado_bac_escarro], $_POST[outros], 
						$data_rx_torax, $_POST[resultado_rx_torax], $data_rx_outro, $_POST[resultado_rx_outro], $data_histopatologico, 
						$_POST[resultado_histopatologico], $data_necropsia, $_POST[resultado_necropsia], $data_outros, $_POST[resultado_outros],
						$_POST[da1],$_POST[da2], $_POST[da3], $_POST[anti_hiv], $data_trat_atual, $_POST[tipo_trat], $_POST[droga],
						$_POST[rifampicina], $_POST[izoniazida], $_POST[estreptomicina], $_POST[pirazinamida], $_POST[etambutol], 
						$_POST[etionamida], $_POST[observacoes], $_POST[cod_profissional], $_POST[cod_paciente], $data_bac_outro, 
						$_POST[resultado_bac_outro], $data_cultura_escarro, $_POST[resultado_cultura_escarro], $data_cultura_outro, 
						$_POST[resultado_cultura_outro], $_POST[servico],  $data_alta, $_POST[alta], $_POST[un_notificante], 
						$_POST[un_atendimento], $data_notificacao, $_POST[outra_unidade_recebe], $_POST[rifambutina], $_POST[resultado_tmrtb], 
						$data_tmrtb, $_POST[un_supervisao],$_POST[levofloxacina],$_POST[ofloxacina])";
		
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->insertQuery(utf8_decode($sql));
		$cod = $db->lastInsertedId();
	} else { //ATUALIZAR
		$tipoLog = 16;
		$cod = $_POST["cod_tratamento"];
		$sql = "UPDATE `tratamento` SET 
					`tratamento_anterior` = $_POST[trat_anterior], 
					`tempo_tratamento_anterior` = $_POST[tempo_tratamento],
					`forma_clinica1` = $_POST[fc1],
					`forma_clinica2` = $_POST[fc2],
					`forma_clinica3` = $_POST[fc3],
					`tipo_descoberta` = $_POST[descoberta],
					`unidade_recebido` = $_POST[unidade_recebido],
					`tempo_inicio_sintomas` = $_POST[tempo_decorrido],
					`data_escarro` = $data_bac_escarro,
					`resultado_escarro` = $_POST[resultado_bac_escarro],
					`data_rx_torax` = $data_rx_torax,
					`outros` = $_POST[outros],
					`resultado_rx_torax` = $_POST[resultado_rx_torax],
					`data_rx_outro` = $data_rx_outro,
					`resultado_rx_outro` = $_POST[resultado_rx_outro],
					`data_histopatologico` = $data_histopatologico,
					`resultado_histopatologico` = $_POST[resultado_histopatologico],
					`data_necropsia`  = $data_necropsia,
					`resultado_necropsia` = $_POST[resultado_necropsia],
					`data_outros` = $data_outros,
					`resultado_outros` = $_POST[resultado_outros],
					`doenca_associada1` = $_POST[da1],
					`doenca_associada2` = $_POST[da2],
					`doenca_associada3` = $_POST[da3],
					`anti_hiv` = $_POST[anti_hiv],
					`data_tratamento_atual` = $data_trat_atual, 
					`tipo_tratamento_atual` = $_POST[tipo_trat],
					`droga_tratamento` = $_POST[droga],					
					`rifampicina`= $_POST[rifampicina], 
					`izoniazida`= $_POST[izoniazida], 
					`estreptomicina`= $_POST[estreptomicina], 
					`pirazinamida`= $_POST[pirazinamida], 
					`etambutol`= $_POST[etambutol], 
					`etionamida`= $_POST[etionamida],		
					`observacoes` = $_POST[observacoes],
					`data_outro` = $data_bac_outro,
					`resultado_outro` = $_POST[resultado_bac_outro],
					`data_cultura_escarro` = $data_cultura_escarro,
					`resultado_cultura_escarro` = $_POST[resultado_cultura_escarro],
					`data_cultura_outro` = $data_cultura_outro,
					`resultado_cultura_outro` = $_POST[resultado_cultura_outro],
					`servico_descobriu` = $_POST[servico],
					`data_alta_tratamento` = $data_alta,
					`motivo_alta` = $_POST[alta],
					`un_atendimento` = $_POST[un_atendimento],
					`data_notificacao` = $data_notificacao,
					`encerrado` = $_POST[encerrado],
					`outra_unidade` = $_POST[outra_unidade_notificante],
					`outro_profissional` = $_POST[outro_profissional],
					`cod_profissional` = $_POST[cod_profissional],
					`outra_unidade_recebe` = $_POST[outra_unidade_recebe],
					`un_notificante` = $_POST[un_notificante],
					`rifambutina` = $_POST[rifambutina],
					`resultado_tmrtb` = $_POST[resultado_tmrtb],
					`data_tmrtb` = $data_tmrtb,
					`un_supervisao` = $_POST[un_supervisao],
					`levofloxacina` = $_POST[levofloxacina],
					`ofloxacina` = $_POST[ofloxacina]
				WHERE cod_tratamento = $cod";
		//echo $sql."<br/><br/><br/><br/>";
		//exit();
		$result = $db->updateQuery(utf8_decode($sql));
	}        	
	$redirectTo = "acao=tratamento_form&cod_tratamento=$cod";
	if ($result && $db->error() == "") {
		$sql = "INSERT INTO `log` (`cod_log_tipo`,`cod_profissional`,`cod_item`) VALUES ($tipoLog,$_SESSION[cod_profissional],$cod);";
		$db->insertQuery($sql);	
		header("Location: index.php?acao=msg&t=ok&m=".base64_encode("Operação realizada com sucesso!")."&r=".base64_encode($redirectTo));
	} else {
		$r = "";
		if($cod > 0) $r = "&r=".base64_encode($redirectTo);
		header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Erro ao registrar/editar o Tratamento").$r);
	} 
} else {
	header("Location: index.php?acao=msg&t=erro&m=".base64_encode("Acesso negado!"));
}
?>