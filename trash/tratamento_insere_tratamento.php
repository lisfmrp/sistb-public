<?php

session_start(); //iniciamos a sessão

/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
 /* Importa-se o namespace (caminho do arquivo) da clase banco e 
    * cria-se um aliase (apelido) para ele */
    use Uteis\banco as banco;

    /* Importa-se a classe banco */
    require_once 'classes/banco.php';
    
    date_default_timezone_set('America/Sao_Paulo');
    //$data=date("dmY"); //aqui pegamos a data pois foi ela quem usamos como valor da sessao logado
    
    /* Cria um objeto da classe banco, voltado para o sistb 
        * e realiza a conexão */
        $db = banco::connectToTB();

if (isset($_POST)) {

    if (isset($_POST["data_bac_escarro"])) {
        $data_bac_escarro = $_POST["data_bac_escarro"];
        $data_bac_escarro = implode("-", array_reverse(explode("/", $data_bac_escarro))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_bac_outro"])) {
        $data_bac_outro = $_POST["data_bac_outro"];
        $data_bac_outro = implode("-", array_reverse(explode("/", $data_bac_outro))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_cultura_escarro"])) {
        $data_cultura_escarro = $_POST["data_cultura_escarro"];
        $data_cultura_escarro = implode("-", array_reverse(explode("/", $data_cultura_escarro))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_cultura_outro"])) {
        $data_cultura_outro = $_POST["data_cultura_outro"];
        $data_cultura_outro = implode("-", array_reverse(explode("/", $data_cultura_outro))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_rx_torax"])) {
        $data_rx_torax = $_POST["data_rx_torax"];
        $data_rx_torax = implode("-", array_reverse(explode("/", $data_rx_torax))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_rx_outro"])) {
        $data_rx_outro = $_POST["data_rx_outro"];
        $data_rx_outro = implode("-", array_reverse(explode("/", $data_rx_outro))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_histopatologico"])) {
        $data_histopatologico = $_POST["data_histopatologico"];
        $data_histopatologico = implode("-", array_reverse(explode("/", $data_histopatologico))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_necropsia"])) {
        $data_necropsia = $_POST["data_necropsia"];
        $data_necropsia = implode("-", array_reverse(explode("/", $data_necropsia))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_outros"])) {
        $data_outros = $_POST["data_outros"];
        $data_outros = implode("-", array_reverse(explode("/", $data_outros))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_trat_atual"])) {
        $data_trat_atual = $_POST["data_trat_atual"];
        $data_trat_atual = implode("-", array_reverse(explode("/", $data_trat_atual))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_alta"])) {
        $data_alta = $_POST["data_alta"];
        $data_alta = implode("-", array_reverse(explode("/", $data_alta))); //revertemos a data para inserção no banco
    }

    if (isset($_POST["data_notificacao"])) {
        $data_notificacao = $_POST["data_notificacao"];
        $data_notificacao = implode("-", array_reverse(explode("/", $data_notificacao))); //revertemos a data para inserção no banco
    }
    
    if (isset($_POST["data_tmrtb"])) {
        $data_tmrtb = $_POST["data_tmrtb"];
        $data_tmrtb = implode("-", array_reverse(explode("/", $data_tmrtb))); //revertemos a data para inserção no banco
    }
    
    
    if ($_POST["cod_profissional"] != "Outros" && $_POST["un_notificante"] != "Outros") {
    
    $select = "INSERT INTO `tratamento`(`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
        `forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
        `resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
        `data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
        `resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
        `tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
        `etambutol`, `etionamida`, `observacoes`, `cod_profissional`, `cod_paciente`, `data_outro`, `resultado_outro`, 
        `data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
        `servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_notificante`, `un_atendimento`, `data_notificacao`,
        `outra_unidade_recebe`, `rifambutina`, `resultado_tmrtb`, `data_tmrtb`, `un_supervisao`,`levofloxacina`,`ofloxacina`
        )
    VALUES ('$_POST[trat_anterior]','$_POST[tempo_tratamento]','$_POST[fc1]','$_POST[fc2]','$_POST[fc3]','$_POST[descoberta]',
        '$_POST[recebido]', '$_POST[tempo_decorrido]', '$data_bac_escarro' ,'$_POST[resultado_bac_escarro]', '$_POST[outros]', 
        '$data_rx_torax', '$_POST[resultado_rx_torax]', '$data_rx_outro', '$_POST[resultado_rx_outro]', '$data_histopatologico', 
        '$_POST[resultado_histopatologico]', '$data_necropsia', '$_POST[resultado_necropsia]', '$data_outros', '$_POST[resultado_outros]',
        '$_POST[da1]','$_POST[da2]', '$_POST[da3]', '$_POST[anti_hiv]', '$data_trat_atual', '$_POST[tipo_trat]', '$_POST[droga]',
        '$_POST[rifampicina]', '$_POST[izoniazida]', '$_POST[estreptomicina]', '$_POST[pirazinamida]', '$_POST[etambutol]', 
        '$_POST[etionamida]', '$_POST[observacoes]', '$_POST[cod_profissional]', '$_POST[cod_paciente]', '$data_bac_outro', 
        '$_POST[resultado_bac_outro]', '$data_cultura_escarro', '$_POST[resultado_cultura_escarro]', '$data_cultura_outro', 
        '$_POST[resultado_cultura_outro]', '$_POST[servico]',  '$data_alta', '$_POST[alta]', '$_POST[un_notificante]', 
        '$_POST[un_atendimento]', '$data_notificacao', '$_POST[outra_unidade_recebe]', '$_POST[rifambutina]', '$_POST[resultado_tmrtb]', 
		'$data_tmrtb', '$_POST[un_supervisao]','$_POST[levofloxacina]','$_POST[ofloxacina]' )";

	

    } else if ($_POST["cod_profissional"] == "Outros" && $_POST["un_notificante"] != "Outros") {
        
        $select = "INSERT INTO `tratamento`(`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
        `forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
        `resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
        `data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
        `resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
        `tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
        `etambutol`, `etionamida`, `observacoes`, `cod_paciente`, `data_outro`, `resultado_outro`, 
        `data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
        `servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_notificante`, `un_atendimento`, `data_notificacao`,
        `outro_profissional`, `outra_unidade_recebe`, `rifambutina`, `resultado_tmrtb`, `data_tmrtb`, `un_supervisao`,`levofloxacina`,`ofloxacina`  )
    VALUES ('$_POST[trat_anterior]','$_POST[tempo_tratamento]','$_POST[fc1]','$_POST[fc2]','$_POST[fc3]','$_POST[descoberta]',
        '$_POST[recebido]', '$_POST[tempo_decorrido]', '$data_bac_escarro' ,'$_POST[resultado_bac_escarro]', '$_POST[outros]', 
        '$data_rx_torax', '$_POST[resultado_rx_torax]', '$data_rx_outro', '$_POST[resultado_rx_outro]', '$data_histopatologico', 
        '$_POST[resultado_histopatologico]', '$data_necropsia', '$_POST[resultado_necropsia]', '$data_outros', '$_POST[resultado_outros]',
        '$_POST[da1]','$_POST[da2]', '$_POST[da3]', '$_POST[anti_hiv]', '$data_trat_atual', '$_POST[tipo_trat]', '$_POST[droga]',
        '$_POST[rifampicina]', '$_POST[izoniazida]', '$_POST[estreptomicina]', '$_POST[pirazinamida]', '$_POST[etambutol]', 
        '$_POST[etionamida]', '$_POST[observacoes]', '$_POST[cod_paciente]', '$data_bac_outro', 
        '$_POST[resultado_bac_outro]', '$data_cultura_escarro', '$_POST[resultado_cultura_escarro]', '$data_cultura_outro', 
        '$_POST[resultado_cultura_outro]', '$_POST[servico]',  '$data_alta', '$_POST[alta]', '$_POST[un_notificante]', 
        '$_POST[un_atendimento]', '$data_notificacao', '$_POST[outro_profissional]', '$_POST[outra_unidade_recebe]', '$_POST[rifambutina]', 
		'$_POST[resultado_tmrtb]', '$data_tmrtb', '$_POST[un_supervisao]','$_POST[levofloxacina]','$_POST[ofloxacina]')";
    
        
    } else if($_POST["cod_profissional"] != "Outros" && $_POST["un_notificante"] == "Outros") {
        
        $select = "INSERT INTO `tratamento`(`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
        `forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
        `resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
        `data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
        `resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
        `tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
        `etambutol`, `etionamida`, `observacoes`, `cod_profissional`, `cod_paciente`, `data_outro`, `resultado_outro`, 
        `data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
        `servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_atendimento`, `data_notificacao`, `outra_unidade`,
        `outra_unidade_recebe`, `rifambutina`, `resultado_tmrtb`, `data_tmrtb`, `un_supervisao`,`levofloxacina`,`ofloxacina`)
    VALUES ('$_POST[trat_anterior]','$_POST[tempo_tratamento]','$_POST[fc1]','$_POST[fc2]','$_POST[fc3]','$_POST[descoberta]',
        '$_POST[recebido]', '$_POST[tempo_decorrido]', '$data_bac_escarro' ,'$_POST[resultado_bac_escarro]', '$_POST[outros]', 
        '$data_rx_torax', '$_POST[resultado_rx_torax]', '$data_rx_outro', '$_POST[resultado_rx_outro]', '$data_histopatologico', 
        '$_POST[resultado_histopatologico]', '$data_necropsia', '$_POST[resultado_necropsia]', '$data_outros', '$_POST[resultado_outros]',
        '$_POST[da1]','$_POST[da2]', '$_POST[da3]', '$_POST[anti_hiv]', '$data_trat_atual', '$_POST[tipo_trat]', '$_POST[droga]',
        '$_POST[rifampicina]', '$_POST[izoniazida]', '$_POST[estreptomicina]', '$_POST[pirazinamida]', '$_POST[etambutol]', 
        '$_POST[etionamida]', '$_POST[observacoes]', '$_POST[cod_profissional]', '$_POST[cod_paciente]', '$data_bac_outro', 
        '$_POST[resultado_bac_outro]', '$data_cultura_escarro', '$_POST[resultado_cultura_escarro]', '$data_cultura_outro', 
        '$_POST[resultado_cultura_outro]', '$_POST[servico]',  '$data_alta', '$_POST[alta]', 
        '$_POST[un_atendimento]', '$data_notificacao','$_POST[outra_unidade]', '$_POST[outra_unidade_recebe]', '$_POST[rifambutina]', 
		'$_POST[resultado_tmrtb]', '$data_tmrtb', '$_POST[un_supervisao]','$_POST[levofloxacina]','$_POST[ofloxacina]')";
    
        
    } else if ($_POST["cod_profissional"] == "Outros" && $_POST["un_notificante"] == "Outros") {
        
        $select = "INSERT INTO `tratamento`(`tratamento_anterior`, `tempo_tratamento_anterior`, `forma_clinica1`, 
        `forma_clinica2`, `forma_clinica3`, `tipo_descoberta`, `recebido`, `tempo_inicio_sintomas`, `data_escarro`, 
        `resultado_escarro`, `outros`, `data_rx_torax`, `resultado_rx_torax`, `data_rx_outro`, `resultado_rx_outro`, 
        `data_histopatologico`, `resultado_histopatologico`, `data_necropsia`, `resultado_necropsia`, `data_outros`, 
        `resultado_outros`, `doenca_associada1`, `doenca_associada2`, `doenca_associada3`, `anti_hiv`, `data_tratamento_atual`, 
        `tipo_tratamento_atual`, `droga_tratamento`, `rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
        `etambutol`, `etionamida`, `observacoes`, `cod_paciente`, `data_outro`, `resultado_outro`, 
        `data_cultura_escarro`, `resultado_cultura_escarro`, `data_cultura_outro`, `resultado_cultura_outro`, 
        `servico_descobriu`, `data_alta_tratamento`, `motivo_alta`, `un_atendimento`, `data_notificacao`,`outro_profissional`,
        `outra_unidade`, `outra_unidade_recebe`, `rifambutina`, `resultado_tmrtb`, `data_tmrtb`, `un_supervisao`,`levofloxacina`,`ofloxacina`
        )
    VALUES ('$_POST[trat_anterior]','$_POST[tempo_tratamento]','$_POST[fc1]','$_POST[fc2]','$_POST[fc3]','$_POST[descoberta]',
        '$_POST[recebido]', '$_POST[tempo_decorrido]', '$data_bac_escarro' ,'$_POST[resultado_bac_escarro]', '$_POST[outros]', 
        '$data_rx_torax', '$_POST[resultado_rx_torax]', '$data_rx_outro', '$_POST[resultado_rx_outro]', '$data_histopatologico', 
        '$_POST[resultado_histopatologico]', '$data_necropsia', '$_POST[resultado_necropsia]', '$data_outros', '$_POST[resultado_outros]',
        '$_POST[da1]','$_POST[da2]', '$_POST[da3]', '$_POST[anti_hiv]', '$data_trat_atual', '$_POST[tipo_trat]', '$_POST[droga]',
        '$_POST[rifampicina]', '$_POST[izoniazida]', '$_POST[estreptomicina]', '$_POST[pirazinamida]', '$_POST[etambutol]', 
        '$_POST[etionamida]', '$_POST[observacoes]', '$_POST[cod_paciente]', '$data_bac_outro', 
        '$_POST[resultado_bac_outro]', '$data_cultura_escarro', '$_POST[resultado_cultura_escarro]', '$data_cultura_outro', 
        '$_POST[resultado_cultura_outro]', '$_POST[servico]',  '$data_alta', '$_POST[alta]', 
        '$_POST[un_atendimento]', '$data_notificacao','$_POST[outro_profissional]','$_POST[outra_unidade]', '$_POST[outra_unidade_recebe]', 
		'$_POST[rifambutina]', '$_POST[resultado_tmrtb]', '$data_tmrtb', '$_POST[un_supervisao]','$_POST[levofloxacina]','$_POST[ofloxacina]')";
        
    }
//ver como vai salvar o codigo do paciente******************************


    $db->doAutoCommit(false);
	$ok1 = $db->insertQuery($select);
    
    $op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Cadastrou um tratamento ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

	$ok2 = $db->insertQuery($op2);
	
	if ($ok1 && $ok2) {
            $db->doCommit();
            $db->endConnection();
           // echo "Operação realizada com sucesso!";
		} else {
			$db->doRollback();
			$db->endConnection();
			echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
			die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
		}
    
    echo "Operação realizada com sucesso!";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";



    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>