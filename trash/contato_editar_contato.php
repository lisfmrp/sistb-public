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

    
    /* Cria um objeto da classe DbInteractions, voltado para o sisam 
        * e realiza a conexão */
        $db = banco::connectToTB();

if (isset($_POST)) {


    $data = $_POST["data_nascimento"];
    $data = implode("-", array_reverse(explode("/", $data)));
    
    $data_baciloscopia = $_POST["data_baciloscopia"];
    $data_baciloscopia = implode("-", array_reverse(explode("/", $data_baciloscopia)));
    
    $data_rx_pulmao = $_POST["data_rx_pulmao"];
    $data_rx_pulmao = implode("-", array_reverse(explode("/", $data_rx_pulmao)));
    
    $data_ppd = $_POST["data_ppd"];
    $data_ppd = implode("-", array_reverse(explode("/", $data_ppd)));
    
    
    $data_quimio = $_POST["data_quimio"];
    $data_quimio = implode("-", array_reverse(explode("/", $data_quimio)));
    
    $retorno = $_POST["retorno"];
    $retorno = implode("-", array_reverse(explode("/", $retorno)));
    
    $data_saida = $_POST["data_saida"];
    $data_saida = implode("-", array_reverse(explode("/", $data_saida)));


   $update = "UPDATE `tuberculose`.`contato` SET 
    
    
    `nome` = '$_POST[nome]', 
    `idade` = '$_POST[idade]', 
    `grau_parentesco` = '$_POST[parentesco]',
    `data_baciloscopia` = '$data_baciloscopia',
    `resultado_baciloscopia`  = '$_POST[resultado_baciloscopia]',
    `data_rx_pulmao` = '$data_rx_pulmao', 
    `resultado_rx_pulmao` = '$_POST[resultado_rx_pulmao]',
    `data_ppd` = '$data_ppd', 
    `resultado_ppd` = '$_POST[resultado_ppd]',
    `quimioprofilaxia` = '$_POST[quimio]',
    `data_quimioprofilaxia` =  '$data_quimio',
    `retorno` = '$retorno',
    `data_nascimento` =   '$data',
    `alta` = '$_POST[alta]',
    `coinfeccao` = '$_POST[coinfeccao]',
    `data_saida` =  '$data_saida', 
    `observacao_contato` =  '$_POST[observacao_contato]'
        
       WHERE `contato`.`cod_contato` =  '$_POST[cod_cont]'";

    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);


    $atualiza = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Editou contato ','$_POST[cod_cont]' , '$_SESSION[nome]', CURRENT_TIMESTAMP)";

    $ok2 = $db->insertQuery($atualiza);
  
    
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
    $cod_cont = $_POST["cod_cont"];
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=contato+mostrar+$cod_cont'>";
    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>
