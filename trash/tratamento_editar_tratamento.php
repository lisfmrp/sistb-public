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
    
    if (isset($_POST["data_mudanca"])) {
        $data_mudanca = $_POST["data_mudanca"];
        $data_mudanca = implode("-", array_reverse(explode("/", $data_mudanca))); //revertemos a data para inserção no banco
    }
   
    
    if (isset($_POST["data_tmrtb"])) {
        $data_tmrtb = $_POST["data_tmrtb"];
        $data_tmrtb = implode("-", array_reverse(explode("/", $data_tmrtb))); //revertemos a data para inserção no banco
    }
    
    if ($_POST["cod_profissional"] != NULL && $_POST["un_notificante"] != "Outros") {
    //echo "entrou primeiro";
    $update = "UPDATE `tuberculose`.`tratamento` SET 
    
    
    `tratamento_anterior` = '$_POST[trat_anterior]', 
    `tempo_tratamento_anterior` = '$_POST[tempo_tratamento]',
    `forma_clinica1` = '$_POST[fc1]',
    `forma_clinica2` = '$_POST[fc2]',
    `forma_clinica3` = '$_POST[fc3]',
    `tipo_descoberta` = '$_POST[descoberta]',
    `recebido` = '$_POST[recebido]',
    `tempo_inicio_sintomas` = '$_POST[tempo_decorrido]',
    `data_escarro` = '$data_bac_escarro',
    `resultado_escarro` = '$_POST[resultado_bac_escarro]',
    `data_rx_torax` = '$data_rx_torax',
    `outros` = '$_POST[outros]',
    `resultado_rx_torax` = '$_POST[resultado_rx_torax]',
    `data_rx_outro` = '$data_rx_outro',
    `resultado_rx_outro` = '$_POST[resultado_rx_outro]',
    `data_histopatologico` = '$data_histopatologico',
    `resultado_histopatologico` = '$_POST[resultado_histopatologico]',
    `data_necropsia`  = '$data_necropsia',
    `resultado_necropsia` = '$_POST[resultado_necropsia]',
    `data_outros` ='$data_outros',
    `resultado_outros` = '$_POST[resultado_outros]',
    `doenca_associada1` = '$_POST[da1]',
    `doenca_associada2` = '$_POST[da2]',
    `doenca_associada3` = '$_POST[da3]',
    `anti_hiv` = '$_POST[anti_hiv]',
    `data_tratamento_atual` = '$data_trat_atual', 
    `tipo_tratamento_atual` = '$_POST[tipo_trat]',
    `droga_tratamento` = '$_POST[droga]',
        
        `rifampicina`= '$_POST[rifampicina]', 
        `izoniazida`= '$_POST[izoniazida]', 
        `estreptomicina`= '$_POST[estreptomicina]', 
        `pirazinamida`= '$_POST[pirazinamida]', 
        `etambutol`= '$_POST[etambutol]', 
        `etionamida`= '$_POST[etionamida]',
    
    `observacoes` = '$_POST[observacoes]',
    `data_outro` = '$data_bac_outro',
    `resultado_outro` = '$_POST[resultado_bac_outro]',
    `data_cultura_escarro` = '$data_cultura_escarro',
    `resultado_cultura_escarro` = '$_POST[resultado_cultura_escarro]',
    `data_cultura_outro` = '$data_cultura_outro',
    `resultado_cultura_outro` = '$_POST[resultado_cultura_outro]',
    `servico_descobriu` = '$_POST[servico]',
    `data_alta_tratamento` = '$data_alta',
    `motivo_alta` = '$_POST[alta]',
    
    `un_atendimento` = '$_POST[un_atendimento]',
    `data_notificacao` = '$data_notificacao',
    `encerrado` = '$_POST[encerrado]',
    `outra_unidade` = '$_POST[outra_unidade]' ,
    `outro_profissional` = '$_POST[outro_profissional]',
    `cod_profissional` = '$_POST[cod_profissional]',
    `outra_unidade_recebe` = '$_POST[outra_unidade_recebe]',
    `un_notificante` = '$_POST[un_notificante]',
        
     `rifambutina` = '$_POST[rifambutina]',
     `resultado_tmrtb` = '$_POST[resultado_tmrtb]',
     `data_tmrtb` = '$_POST[data_tmrtb]',
	`un_supervisao` = '$_POST[un_supervisao]',
	`levofloxacina` = '$_POST[levofloxacina]',
	`ofloxacina` = '$_POST[ofloxacina]'
        
       
    WHERE `tratamento`.`cod_tratamento` =  '$_POST[cod_trat]'";
    
    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
   
    } else if($_POST["cod_profissional"] == NULL && $_POST["un_notificante"] != "Outros") {
        //echo "entrou segundo";
        $update = "UPDATE `tuberculose`.`tratamento` SET 
    
    
    `tratamento_anterior` = '$_POST[trat_anterior]', 
    `tempo_tratamento_anterior` = '$_POST[tempo_tratamento]',
    `forma_clinica1` = '$_POST[fc1]',
    `forma_clinica2` = '$_POST[fc2]',
    `forma_clinica3` = '$_POST[fc3]',
    `tipo_descoberta` = '$_POST[descoberta]',
    `recebido` = '$_POST[recebido]',
    `tempo_inicio_sintomas` = '$_POST[tempo_decorrido]',
    `data_escarro` = '$data_bac_escarro',
    `resultado_escarro` = '$_POST[resultado_bac_escarro]',
    `data_rx_torax` = '$data_rx_torax',
    `outros` = '$_POST[outros]',
    `resultado_rx_torax` = '$_POST[resultado_rx_torax]',
    `data_rx_outro` = '$data_rx_outro',
    `resultado_rx_outro` = '$_POST[resultado_rx_outro]',
    `data_histopatologico` = '$data_histopatologico',
    `resultado_histopatologico` = '$_POST[resultado_histopatologico]',
    `data_necropsia`  = '$data_necropsia',
    `resultado_necropsia` = '$_POST[resultado_necropsia]',
    `data_outros` ='$data_outros',
    `resultado_outros` = '$_POST[resultado_outros]',
    `doenca_associada1` = '$_POST[da1]',
    `doenca_associada2` = '$_POST[da2]',
    `doenca_associada3` = '$_POST[da3]',
    `anti_hiv` = '$_POST[anti_hiv]',
    `data_tratamento_atual` = '$data_trat_atual', 
    `tipo_tratamento_atual` = '$_POST[tipo_trat]',
    `droga_tratamento` = '$_POST[droga]',
        `rifampicina`= '$_POST[rifampicina]', 
        `izoniazida`= '$_POST[izoniazida]', 
        `estreptomicina`= '$_POST[estreptomicina]', 
        `pirazinamida`= '$_POST[pirazinamida]', 
        `etambutol`= '$_POST[etambutol]', 
        `etionamida`= '$_POST[etionamida]',
    
    `observacoes` = '$_POST[observacoes]',
    `data_outro` = '$data_bac_outro',
    `resultado_outro` = '$_POST[resultado_bac_outro]',
    `data_cultura_escarro` = '$data_cultura_escarro',
    `resultado_cultura_escarro` = '$_POST[resultado_cultura_escarro]',
    `data_cultura_outro` = '$data_cultura_outro',
    `resultado_cultura_outro` = '$_POST[resultado_cultura_outro]',
    `servico_descobriu` = '$_POST[servico]',
    `data_alta_tratamento` = '$data_alta',
    `motivo_alta` = '$_POST[alta]',
    `un_atendimento` = '$_POST[un_atendimento]',
    `data_notificacao` = '$data_notificacao',
    `encerrado` = '$_POST[encerrado]',
    `outro_profissional` = '$_POST[outro_profissional]',
        `outra_unidade_recebe` = '$_POST[outra_unidade_recebe]',
        
     `rifambutina` = '$_POST[rifambutina]',
     `resultado_tmrtb` = '$_POST[resultado_tmrtb]',
     `data_tmrtb` = '$_POST[data_tmrtb]',
	`un_supervisao` = '$_POST[un_supervisao]',
	`levofloxacina` = '$_POST[levofloxacina]',
	`ofloxacina` = '$_POST[ofloxacina]'
       
    WHERE `tratamento`.`cod_tratamento` =  '$_POST[cod_trat]'";
        
    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
        
    } else if($_POST["cod_profissional"] != NULL && $_POST["un_notificante"] == "Outros") {
        //echo "entrou terceiro";
        $update = "UPDATE `tuberculose`.`tratamento` SET 
    
    
    `tratamento_anterior` = '$_POST[trat_anterior]', 
    `tempo_tratamento_anterior` = '$_POST[tempo_tratamento]',
    `forma_clinica1` = '$_POST[fc1]',
    `forma_clinica2` = '$_POST[fc2]',
    `forma_clinica3` = '$_POST[fc3]',
    `tipo_descoberta` = '$_POST[descoberta]',
    `recebido` = '$_POST[recebido]',
    `tempo_inicio_sintomas` = '$_POST[tempo_decorrido]',
    `data_escarro` = '$data_bac_escarro',
    `resultado_escarro` = '$_POST[resultado_bac_escarro]',
    `data_rx_torax` = '$data_rx_torax',
    `outros` = '$_POST[outros]',
    `resultado_rx_torax` = '$_POST[resultado_rx_torax]',
    `data_rx_outro` = '$data_rx_outro',
    `resultado_rx_outro` = '$_POST[resultado_rx_outro]',
    `data_histopatologico` = '$data_histopatologico',
    `resultado_histopatologico` = '$_POST[resultado_histopatologico]',
    `data_necropsia`  = '$data_necropsia',
    `resultado_necropsia` = '$_POST[resultado_necropsia]',
    `data_outros` ='$data_outros',
    `resultado_outros` = '$_POST[resultado_outros]',
    `doenca_associada1` = '$_POST[da1]',
    `doenca_associada2` = '$_POST[da2]',
    `doenca_associada3` = '$_POST[da3]',
    `anti_hiv` = '$_POST[anti_hiv]',
    `data_tratamento_atual` = '$data_trat_atual', 
    `tipo_tratamento_atual` = '$_POST[tipo_trat]',
    `droga_tratamento` = '$_POST[droga]',
        `rifampicina`= '$_POST[rifampicina]', 
        `izoniazida`= '$_POST[izoniazida]', 
        `estreptomicina`= '$_POST[estreptomicina]', 
        `pirazinamida`= '$_POST[pirazinamida]', 
        `etambutol`= '$_POST[etambutol]', 
        `etionamida`= '$_POST[etionamida]',
    
    `observacoes` = '$_POST[observacoes]',
    `data_outro` = '$data_bac_outro',
    `resultado_outro` = '$_POST[resultado_bac_outro]',
    `data_cultura_escarro` = '$data_cultura_escarro',
    `resultado_cultura_escarro` = '$_POST[resultado_cultura_escarro]',
    `data_cultura_outro` = '$data_cultura_outro',
    `resultado_cultura_outro` = '$_POST[resultado_cultura_outro]',
    `servico_descobriu` = '$_POST[servico]',
    `data_alta_tratamento` = '$data_alta',
    `motivo_alta` = '$_POST[alta]',
    `un_atendimento` = '$_POST[un_atendimento]',
    `data_notificacao` = '$data_notificacao',
    `encerrado` = '$_POST[encerrado]',
    `cod_profissional` = '$_POST[cod_profissional]',
    `outra_unidade` = '$_POST[outra_unidade]',
        `outra_unidade_recebe` = '$_POST[outra_unidade_recebe]',
        
     `rifambutina` = '$_POST[rifambutina]',
     `resultado_tmrtb` = '$_POST[resultado_tmrtb]',
     `data_tmrtb` = '$_POST[data_tmrtb]',
	`un_supervisao` = '$_POST[un_supervisao]',
	`levofloxacina` = '$_POST[levofloxacina]',
	`ofloxacina` = '$_POST[ofloxacina]'
       
    WHERE `tratamento`.`cod_tratamento` =  '$_POST[cod_trat]'";
        
     $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
        
    } else if($_POST["cod_profissional"] == NULL && $_POST["un_notificante"] == "Outros") {
        
        $update = "UPDATE `tuberculose`.`tratamento` SET 
    
    
    `tratamento_anterior` = '$_POST[trat_anterior]', 
    `tempo_tratamento_anterior` = '$_POST[tempo_tratamento]',
    `forma_clinica1` = '$_POST[fc1]',
    `forma_clinica2` = '$_POST[fc2]',
    `forma_clinica3` = '$_POST[fc3]',
    `tipo_descoberta` = '$_POST[descoberta]',
    `recebido` = '$_POST[recebido]',
    `tempo_inicio_sintomas` = '$_POST[tempo_decorrido]',
    `data_escarro` = '$data_bac_escarro',
    `resultado_escarro` = '$_POST[resultado_bac_escarro]',
    `data_rx_torax` = '$data_rx_torax',
    `outros` = '$_POST[outros]',
    `resultado_rx_torax` = '$_POST[resultado_rx_torax]',
    `data_rx_outro` = '$data_rx_outro',
    `resultado_rx_outro` = '$_POST[resultado_rx_outro]',
    `data_histopatologico` = '$data_histopatologico',
    `resultado_histopatologico` = '$_POST[resultado_histopatologico]',
    `data_necropsia`  = '$data_necropsia',
    `resultado_necropsia` = '$_POST[resultado_necropsia]',
    `data_outros` ='$data_outros',
    `resultado_outros` = '$_POST[resultado_outros]',
    `doenca_associada1` = '$_POST[da1]',
    `doenca_associada2` = '$_POST[da2]',
    `doenca_associada3` = '$_POST[da3]',
    `anti_hiv` = '$_POST[anti_hiv]',
    `data_tratamento_atual` = '$data_trat_atual', 
    `tipo_tratamento_atual` = '$_POST[tipo_trat]',
    `droga_tratamento` = '$_POST[droga]',
        `rifampicina`= '$_POST[rifampicina]', 
        `izoniazida`= '$_POST[izoniazida]', 
        `estreptomicina`= '$_POST[estreptomicina]', 
        `pirazinamida`= '$_POST[pirazinamida]', 
        `etambutol`= '$_POST[etambutol]', 
        `etionamida`= '$_POST[etionamida]',
    
    `observacoes` = '$_POST[observacoes]',
    `data_outro` = '$data_bac_outro',
    `resultado_outro` = '$_POST[resultado_bac_outro]',
    `data_cultura_escarro` = '$data_cultura_escarro',
    `resultado_cultura_escarro` = '$_POST[resultado_cultura_escarro]',
    `data_cultura_outro` = '$data_cultura_outro',
    `resultado_cultura_outro` = '$_POST[resultado_cultura_outro]',
    `servico_descobriu` = '$_POST[servico]',
    `data_alta_tratamento` = '$data_alta',
    `motivo_alta` = '$_POST[alta]',
    `un_atendimento` = '$_POST[un_atendimento]',
    `data_notificacao` = '$data_notificacao',
    `encerrado` = '$_POST[encerrado]',
    `outra_unidade` = '$_POST[outra_unidade]' ,
    `outro_profissional` = '$_POST[outro_profissional]',
        `outra_unidade_recebe` = '$_POST[outra_unidade_recebe]',
        
     `rifambutina` = '$_POST[rifambutina]',
     `resultado_tmrtb` = '$_POST[resultado_tmrtb]',
     `data_tmrtb` = '$_POST[data_tmrtb]',
	`un_supervisao` = '$_POST[un_supervisao]',
	`levofloxacina` = '$_POST[levofloxacina]',
	`ofloxacina` = '$_POST[ofloxacina]'
       
    WHERE `tratamento`.`cod_tratamento` =  '$_POST[cod_trat]'";
     $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
        
    }

    $med=false;
    if($_POST["droga_decorrer"] == "S") {
    $insertmed = "INSERT INTO `medicamento`(`rifampicina`, `izoniazida`, `estreptomicina`, `pirazinamida`, 
        `etambutol`, `etionamida`,`data`,`cod_tratamento`)
    VALUES ('$_POST[rifampicinaT]', '$_POST[izoniazidaT]', '$_POST[estreptomicinaT]', '$_POST[pirazinamidaT]', '$_POST[etambutolT]', 
        '$_POST[etionamidaT]', '$data_mudanca', '$_POST[cod_trat]')";
     
    $ok2 = $db->insertQuery($insertmed);
    $med=true;
    }
    
    $atualiza = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Editou tratamento ', '$_POST[cod_trat]', '$_SESSION[nome]', CURRENT_TIMESTAMP)";

    $ok3 = $db->updateQuery($atualiza);
     
    if($med == false){
        if ($ok1 && $ok3) {
        $db->doCommit();
        $db->endConnection();
        }
        else {
        $db->doRollback();
        $db->endConnection();
        echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
        die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
        } 
        }
     else if ($med == true){
         if ($ok1 && $ok2 && $ok3) {
        $db->doCommit();
        $db->endConnection();
    }else {
        $db->doRollback();
        $db->endConnection();
        echo "<br><br><b>Problema ao inserir informações, transação cancelada!</b>";
        die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
        } 
     }
          
    echo "Operação realizada com sucesso!";
    $cod_trat = $_POST["cod_trat"];
    $cod = $_POST["cod"];
    
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=tratamento+mostrar+$cod_trat+$cod'>";
    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>
