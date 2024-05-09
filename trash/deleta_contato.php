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

	//echo "deleta contato";

	$codigo_contato = $_POST['cod_contato'];
       
                   
		   $sql = "UPDATE contato set contato_deletado = '1' where cod_contato= $codigo_contato";
		   
                       
            $db->doAutoCommit(false);
			$ok1 = $db->updateQuery($sql);         

			$op2 = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
				VALUES (NULL, 'Deletou um contato ', $codigo_contato, '$_SESSION[nome]', CURRENT_TIMESTAMP)";
			$ok2 = $db->insertQuery($op2);
			
			if ($ok1 && $ok2) {
            $db->doCommit();
            $db->endConnection();
           // echo "Operação realizada com sucesso!";
			} else {
				$db->doRollback();
				$db->endConnection();
				echo "<br><br><b>Problema ao excluir informações, transação cancelada!</b>";
				die('<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php>');
			}

			echo "Operação realizada com sucesso!";
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=dash+menu'>";


    //<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?acao=paciente+buscar">
}
//mysql_close($con);
?>