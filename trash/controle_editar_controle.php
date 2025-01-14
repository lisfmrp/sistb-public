<?php
session_start();
/* Verifica se o usu�rio est� logado */
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
        * e realiza a conex�o */
        $db = banco::connectToTB();

if (isset($_POST)) {

    $data = $_POST["data"];
    $data = implode("-", array_reverse(explode("/", $data)));
      
   $update = "UPDATE `tuberculose`.`controlemensal` SET 
    `resultado_controle` = '$_POST[resultado_bac_escarro]',
    `data_controle` = '$data', 
    `tipo_exame` = '$_POST[tipo_exame]'   
    `material_controle` = '$_POST[material_controle]' 
        
     WHERE `controlemensal`.`cod_controle` =  '$_POST[cod_cont]'";

    $db->doAutoCommit(false);

    $ok1 = $db->updateQuery($update);
   
    $atualiza = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
        VALUES (NULL, ' Editou controle mensal ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

    $ok2 = $db->updateQuery($atualiza);
     
    if ($ok1 && $ok2) {
        $db->doCommit();
        $db->endConnection();
        // echo "Opera��o realizada com sucesso!";
    } else {
        $db->doRollback();
        $db->endConnection();
        echo "<br><br><b>Problema ao inserir informa��es, transa��o cancelada!</b>";
        die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
    }  
     
    
    echo "Opera��o realizada com sucesso!";
    $cod_cont = $_POST["cod_cont"];
    $cod = $_POST["cod"];
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=controle+mostrar+$cod_cont+$cod'>";
    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}

?>
