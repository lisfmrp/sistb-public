<?php
require("autenticacao.php");
require_once('header.php');
?>
<div id="wrapper">
    <div id="page-body">
        <div class="container">
            <div id="content">
				<div class="smallpanel">
					<div class="pcont-1">
						<div class="pcont-2">
							<div class="pcont-3">
								<ul id="nav">
									<!--<li class=""><a href="index.php">Menu Principal</a></li>-->
								</ul>
								<div id="adminbar">
									Seja bem-vindo(a), <span style="margin-right:10px;"><?=$_SESSION["nome"]?>.</span> 
									Local: <span><?=($_SESSION["nome_unidade"])?></span>
									<a href="index.php?acao=ajuda" class="logout">Ajuda</a>
									<a href="logout.php" class="logout" onclick="return confirm('Tem certeza que deseja sair do SISTB?');">Sair</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearingfix"></div>			
                <?php				
					require_once("menu.php");
					
					if(isset($_GET["acao"]))
						require_once($_GET["acao"].'.php');
					else if(isset($_POST["acao"]))
						require_once($_POST["acao"].'.php');

				
				/*if ($alvo == "tratamento") {
                    if ($tarefa == "cadastrar") {
                        include('novo_tratamento.php');
                    }
                    if ($tarefa == "consultar") {
                        include('buscar_tratamento.php');
                    }
                    if ($tarefa == "listar") {
                        include('listar_tratamento.php');
                    }
                    if ($tarefa == "mostrar") {
                        include('ficha_tratamento.php');
                    }
                    
                    if ($tarefa == "relatorio1") {
                        include('buscar_ano.php');
                    }
                    if ($tarefa == "ano") {
                        include('resumo_ano.php');
                    }
                    
                    if ($tarefa == "relatorio2") {
                        include('relatorio2_tratamento.php');
                    }
                    if ($tarefa == "listaacompanhamento") {
                        include('buscar_acompanhamento.php');
                    }
                    
                     if ($tarefa == "acompanhamento") {
                        include('ficha_acompanhamento.php');
                    }
                    if ($tarefa == "relexame") {
                        include('resumo_exame.php');
                    }
                    
                    
                    if ($tarefa == "consultarc") {
                        include('buscar_completa.php');
                    }
                    if ($tarefa == "listarc") {
                        include('listar_completa.php');
                    }
                    if ($tarefa == "mostrarc") {
                        include('ficha_completa.php');
                    }
					
                }*/
                ?>                
            </div>
        </div>
       
        <div class="clearingfix"></div>
    </div>
</div>
<?php 
require_once('footer.php'); 
?>
