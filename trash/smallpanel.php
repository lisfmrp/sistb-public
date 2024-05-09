<?php
$select2 = "SELECT nome FROM unidade WHERE cod_unidade = '$_SESSION[cod_unidade]'";
$consultas2 = $db->selectQuery($select2);
$nome_unidade = $consultas2[0]['nome'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="smallpanel">
    <div class="pcont-1">
		<div class="pcont-2">
			<div class="pcont-3">
				<ul id="nav">
					<li class=""><a href="index.php">Menu Principal</a></li>        
				</ul>
				<div id="adminbar">
					Seja bem-vindo(a), <span style="margin-right:10px;"><?= $_SESSION["nome"] ?>.</span> 
					Local: <span><?= $nome_unidade ?></span>
					<a href="index.php?acao=dash+ajuda" class="logout">Ajuda</a>
					<a href="logout.php" class="logout" onclick="return confirm('Tem certeza que deseja sair do SISTB?');">Sair</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearingfix"></div>