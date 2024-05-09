<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Sistema da Tuberculose - SISTB - v1.5</title>
	<link rel="icon" href="images/favicon.ico" sizes="16x16" />
	<style>
		#local { 
			margin:0 auto; 
			text-align:center;		
			padding: 15px;
			width: 40%;
			background-color: white !important;
			-webkit-box-shadow: -4px 6px 11px 0px rgba(201,197,201,1);
			-moz-box-shadow: -4px 6px 11px 0px rgba(201,197,201,1);
			box-shadow: -4px 6px 11px 0px rgba(201,197,201,1);
		}		
		#local select { 
			padding:10px;
		}		
		#local button {
			padding:7px;
		}
	</style>
</head>
<body>
<?php
/* Form necessário para envio ao index.php do cod_unidade da unidade 
  selecionada no acesso do usuário */
echo "<div id='local'><form method='post' class='validar' action='index.php'>";

 /* Importa-se o namespace (caminho do arquivo) da clase banco e 
    * cria-se um aliase (apelido) para ele */
    use Uteis\banco as banco;

    /* Importa-se a classe banco */
    require_once 'classes/banco.php';
    /* Importa-se a classe Security */
    require_once 'classes/Security.php';
    $_GET = Security::filter($_GET);
    $_POST = Security::filter($_POST);

    /* Se foi digitado um login e uma senha, realize as operações abaixo */
    if (isset($_POST['senha']) && isset($_POST['login']) && $_POST['senha'] != "" && $_POST['login'] != "" ) {
    
        /* Inicia-se a sessão e atribui-se o valor de tempo atual para a 
        * variável $_SESSION["timeout"] que será utilizada para 
        * cálculo posterior do timeout */
        session_start();
        date_default_timezone_set('America/Sao_Paulo');
        $_SESSION["timeout"] = time();

        /* Cria um objeto da classe DbInteractions, voltado para o sisam 
        * e realiza a conexão */
        $db = banco::connectToTB();

        /* Busca o usuário que possui o login e a senha digitados */
        $sql = "SELECT cod_profissional, nome, login, senha, email, numero_conselho, admin FROM profissional WHERE login='$_POST[login]' AND senha=SHA('$_POST[senha]') AND ativo = 1";
        $usuario = $db->selectQuery($sql);

        /* Se não foi encontrado nenhum usuário com o login e senha procurados
        * exiba a mensagem abaixo */
        if (!$usuario) {
            die("<script> alert('Login ou senha incorreto(s)! Tente novamente!');
                            window.location.href = 'index.html';
				</script>");
        } else {
			$usuario = $usuario[0];
			$_SESSION["cod_profissional"] = $usuario['cod_profissional'];
			$_SESSION["nome"] = $usuario['nome'];               
			$_SESSION["login"] = $usuario['login'];
			$_SESSION["email"] = $usuario['email'];
			$_SESSION["conselho"] = $usuario['numero_conselho'];
			$_SESSION["admin"] = $usuario['admin'];
        }
		echo "<label for=''><strong>Local de atendimento:</strong></label><br/><br/>";
		
		if ($usuario['admin'] == 0)
			$sql = "SELECT profissional_permissoes.cod_unidade, unidade.nome, unidade.cidade FROM unidade, profissional_permissoes WHERE unidade.ativo = 1 AND profissional_permissoes.cod_unidade = unidade.cod_unidade AND profissional_permissoes.cod_profissional = '$_SESSION[cod_profissional]' AND profissional_permissoes.leitura = 1 ORDER BY unidade.cidade, unidade.nome";	   
		else
			$sql = "SELECT cod_unidade, nome, cidade FROM unidade ORDER BY cidade, nome";
		
		$unidades = $db->selectQuery($sql);
		if ($unidades) {
			echo "<select id='cod_unidade_origem' name='cod_unidade_origem' required><option value=''>Selecione...</option>";		
			foreach ($unidades as $unidade) {
				echo "<option value='".$unidade['cod_unidade']."'>".utf8_decode(ucwords($unidade['nome']))."</option>";
			}            			
			echo "</select>";		   
		}  		
		$sql = "INSERT INTO `log` (`cod_log_tipo`, `cod_profissional`) VALUES (1,$_SESSION[cod_profissional]);";
		$db->insertQuery($sql);
		$db->endConnection();
    }    
	echo "<p><button type='submit' class='classy right'><span>Prosseguir >></span></button></p>";
	echo "<p><a href='logout.php' style='text-decoration:none;' onclick=\"return confirm('Tem certeza que deseja sair do SISTB?');\">Sair</a></p>";
echo "</form></div>";                                 
?>
</body>
</html>