<?php 
require_once("autenticacao.php"); 
if ($_SESSION["admin"] == 1 || (isset($_GET["cod_profissional"]) && $_GET["cod_profissional"] == $_SESSION["cod_profissional"])) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Unidades vinculadas ::</span></span></span></h3>
	<div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
						<?php 
							if (isset($_GET["cod_profissional"]) && $_GET["cod_profissional"] != "" && is_numeric($_GET["cod_profissional"])) { 
									$cod = $_GET["cod_profissional"];
									$sql = "SELECT nome, ocupacao, admin FROM profissional WHERE profissional.cod_profissional = $cod";
									$result = $db->selectQuery($sql);
									$nome = ($result[0]['nome']);
									$ocupacao = ($result[0]['ocupacao']);
									$admin = ($result[0]['admin']);
									
									$sql = "SELECT cod_unidade, nome FROM unidade WHERE ativo = 1";
									$unidades = $db->selectQuery($sql);	
									
									$sql = "SELECT GROUP_CONCAT(unidade.cod_unidade) AS unidades FROM profissional_permissoes, unidade WHERE profissional_permissoes.cod_profissional = $cod AND profissional_permissoes.cod_unidade = unidade.cod_unidade AND leitura = 1";
									$unidadesProfLeitura = explode(",",$db->selectQuery($sql)[0]["unidades"]);					  
									
									$sql = "SELECT GROUP_CONCAT(unidade.cod_unidade) AS unidades FROM profissional_permissoes, unidade WHERE profissional_permissoes.cod_profissional = $cod AND profissional_permissoes.cod_unidade = unidade.cod_unidade AND escrita = 1";
									$unidadesProfEscrita = explode(",",$db->selectQuery($sql)[0]["unidades"]);
						?>
                            <div class="box-3">
                                <form method="POST" class="validar" action="profissional_unidade_post.php">                                                                    
                                    <?php if (isset($cod)) { ?>
                                        <input type="hidden" name="cod_profissional" value="<?=$cod?>"/>
									<?php } ?>
									<h3 class="title"><strong>Profissional:</strong> <?=$nome?> <?php if($_SESSION["admin"] == 1) echo "($ocupacao)" ?></h3>
									<table class="infotable">
										<tr>
											<th>Unidade</th>
											<th>Leitura</th>
											<th>Escrita</th>
										</tr>
									<?php
										foreach($unidades as $u) {
											$leituraChecked = "";
											$escritaChecked = "";
											if(in_array($u["cod_unidade"],$unidadesProfLeitura) || $admin == 1) $leituraChecked = "checked";
											if(in_array($u["cod_unidade"],$unidadesProfEscrita) || $admin == 1) $escritaChecked = "checked";
											echo "<tr>";
											echo 	"<td>".($u["nome"])."</td>";
											echo 	"<td style='text-align:center;'><input type='checkbox' $leituraChecked value='$u[cod_unidade]' name='leitura[]' id='leitura-$u[cod_unidade]' onclick='controlarCheckbox(this)'/></td>";
											echo 	"<td style='text-align:center;'><input type='checkbox' $escritaChecked value='$u[cod_unidade]' name='escrita[]' id='escrita-$u[cod_unidade]' onclick='controlarCheckbox(this)'/></td>";
											echo "</tr>";
										}
									?>
									</table>																											
									<?php if ($admin == 0) { ?>
									<p>
										<button class="classy" type="submit"><span>Salvar</span></button>
									</p>
									<?php } ?>
                                </form>
                            </div>
						<?php } ?>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<?php } else { ?>
		<p>
			<img src='images/icons/splashyIcons/error.png' alt='Acesso restrito'/>                                    
			<strong>Acesso restrito</strong>
		</p>
<?php } ?>
<script type="text/javascript">
	function controlarCheckbox(e) {
		if(e.name == "escrita[]" && e.checked) {
			document.getElementById("leitura-"+e.value).checked = true;
		} else if(e.name == "leitura[]" && !e.checked) {
			document.getElementById("escrita-"+e.value).checked = false;
		}
	}
</script>