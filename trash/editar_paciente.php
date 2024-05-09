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


    $data = $_POST["data_nascimento"];
    $data = implode("-", array_reverse(explode("/", $data)));


    $update = "UPDATE `tuberculose`.`paciente` SET 
    
    `nome` = '$_POST[nome]',
    `cpf` = '$_POST[cpf]',
    `cns` = '$_POST[cns]', 
    `nro_prontuario` =  '$_POST[nro_prontuario]', 
    
    `data_nascimento` = '$data',
    `idade` = '$_POST[idade]', 
    `sexo` = '$_POST[sexo]',
    `gestante` = '$_POST[gestante]',
    `mae` = '$_POST[mae]',
    `etnia` =  '$_POST[etnia]',
    `endereco` =  '$_POST[endereco]',
    `telefone` = '$_POST[telefone]',
    `cidade` = '$_POST[cidade]',
    `estado` =  '$_POST[estado]',
    `escolaridade` =  '$_POST[escolaridade]',
    `tipo_ocupacao` = '$_POST[tipo_ocupacao]',
    `ocupacao` = '$_POST[ocupacao]',  
    `observacoesp` = '$_POST[observacoes]',
    `nro_fie` = '$_POST[nro_fie]', 
    `naturalidade` = '$_POST[naturalidade]',
    `nro_hygia` = '$_POST[nro_hygia]'
          
     WHERE `paciente`.`cod_paciente` =  '$_POST[cod]'";
     
    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
   
    $atualiza = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Editou paciente ', '$_POST[cod]', '$_SESSION[nome]', CURRENT_TIMESTAMP)";

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
    $cod = $_POST["cod"];
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=paciente+mostrar+$cod'>";
    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>
