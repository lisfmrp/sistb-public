<?php

session_start();

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

    
    $data_alta  = $_POST["data_alta"];
    $data_alta = implode("-", array_reverse(explode("/", $data_alta))); //revertemos a data para inserção no banco


   $update = "UPDATE `tuberculose`.`internacao` SET 
    
    
    `cod_profissional_alta` = '$_POST[profissional_alta]', 
    `data_alta` = '$data_alta', 
    `tipo_alta`  = '$_POST[saida]',
    `observacoes` = '$_POST[observacoes]'  
        
       WHERE `internacao`.`cod_internacao` =  '$_POST[cod_internacao]'";

    
    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);   

    $atualiza = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Realizou uma alta ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

    $ok2 = $db->updateQuery($atualiza);
     
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
    $cod_internacao = $_POST["cod_internacao"];
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=internacao+mostrar+$_POST[cod_internacao]+$_POST[cod_paciente]'>";
    
}

?>
