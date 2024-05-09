<?php
if (isset($_POST)) {

    $login = $_POST['login'];  
	$valida = false;
    $sql = "SELECT login FROM profissional WHERE login = '$login'";
	$db->selectQuery($sql);
	if ((sizeof($db)) == 0)
		$valida = true;
	
    if ($valida === false) {
        echo "<p class='msg erro'>
                    <img src='images/icons/splashyIcons/error.png' alt='Erro' />
                    <b>&nbsp; Login já cadastrado no sistema. Por favor escolha outro login!</b>
              </p>";       
    } else {
        if ($_POST["senha1"] == $_POST["senha2"]) {

            /* Atualiza os dados do usuário - Inicia uma transação */

            $db->doAutoCommit(false);

            $updateUsuarios = "UPDATE `tuberculose`.`profissional` SET 
                `nome` = '$_POST[nome]', 
                `email` = '$_POST[email]',
                `login` = '$_POST[login]',
                `senha` = SHA('$_POST[senha1]'),        
                `numero_conselho`  = '$_POST[nro_conselho]'

                WHERE `profissional`.`cod_profissional` =  '$_POST[cod_prof]'";

            $ok1 = $db->updateQuery($updateUsuarios);
			
			$selectUsuario = "SELECT cod_profissional, login, senha FROM profissional WHERE login='$_POST[login]' ";
			$usuarios = $db->selectQuery($selectUsuario);
			$senha = $usuarios[0]['senha'];
			
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['senha'] = $senha;

            $verifica = $ok1;

            
           

            /* Insere a atualização relativa a mudança de dados do usuário */
             $insertAtualizacao = "INSERT INTO `tuberculose`.`atualizacao` (`cod_atualizacao`, `tipo_atualizacao`, `numero_atualizacao`, `usuario`, `data_hora`)
             VALUES (NULL, ' Editou seus dados ', NULL, '$_SESSION[nome]', CURRENT_TIMESTAMP)";

            $ok3 = $db->insertQuery($insertAtualizacao);

            $verifica_2 = $verifica * $ok3 *$ok1;

            if ($verifica_2) {
                $db->doCommit();
                $db->endConnection();
               "<img src='images/icons/splashyIcons/thumb_up.png' alt='' /> <b><font color='green'> Operação realizada com sucesso!";
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=index.php?acao=profissional+mostrar+$_POST[cod_prof] '>";
            } else {
                $db->doRollback();
                $db->endConnection();
                echo "<p class='msg erro'>
                    <img src='images/icons/splashyIcons/error.png' alt='Erro' />
                    <b>&nbsp; Problema ao inserir informações, transação cancelada!</b>
                 </p>";         
            }
        } else {
             $db->endConnection();
             echo "<p class='msg erro'>
                    <img src='images/icons/splashyIcons/error.png' alt='Erro' />
                    <b>&nbsp; As senhas não são idênticas! Por favor, digite novamente!</b>
                 </p>"; 
        }
    }
}
?>
