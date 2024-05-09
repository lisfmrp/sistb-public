<?php 
require_once("autenticacao.php");
if ($_SESSION["admin"] == 1 || (isset($_GET["cod_profissional"]) && $_GET["cod_profissional"] == $_SESSION["cod_profissional"])) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Profissional ::</span></span></span></h3>
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
								$sql = "SELECT nome, email, numero_conselho, login, ocupacao, ativo, admin FROM profissional WHERE profissional.cod_profissional = $cod";
								$result = $db->selectQuery($sql);
								if(sizeof($result) == 0) {
						?>
									<script type="text/javascript">window.location.replace("index.php");</script>
						<?php	
									exit();
								}
								
								$nome = ($result[0]['nome']);   
								$email = $result[0]['email'];   
								$nro_conselho = $result[0]['numero_conselho'];   
								$login = $result[0]['login'];   
								$ocupacao = ($result[0]['ocupacao']);
								$ativo = $result[0]['ativo'];   
								$admin = $result[0]['admin'];   

								$sql = "SELECT cod_unidade, nome FROM unidade WHERE ativo = 1";
								$unidades = $db->selectQuery($sql);	
								
								$sql = "SELECT unidade.cod_unidade, unidade.nome FROM profissional_permissoes, unidade WHERE profissional_permissoes.cod_profissional = $cod AND profissional_permissoes.cod_unidade = unidade.cod_unidade";
								$unidadesProf = $db->selectQuery($sql);					  
							} 
						?>
                            <div class="box-3">
                                <form method="POST" class="validar" action="profissional_post.php">                                                                    
                                    <?php if (isset($cod)) { ?>
                                        <input type="hidden" name="cod_profissional" value="<?=$cod?>"/>
									<?php } ?>
									<p>
                                        <label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
										<button class="classy" type="submit"><span>Salvar</span></button>
                                    </p> 									
									<p>
										<label for="nome">Nome:<span style="color:red;">*</span></label><br/>
										<input type="text" style="width:500px;" class="text small required" name="nome" id="nome" value="<?php echo (isset($nome)) ?  $nome : ""; ?>"/> 
									</p>										
									<p>
										<label for="nro_conselho">Número do conselho: </label><br/>
										<input type="text" class="text small" name="nro_conselho" id="nro_conselho" value="<?php echo (isset($nro_conselho)) ?  $nro_conselho : ""; ?>"/> 
									</p>
									<?php if ($_SESSION["admin"] == 1) { ?>
									<p>
										<label for="ocupacao">Ocupação:<span style="color:red;">*</span></label><br/>
										<select name="ocupacao" class="required" id="ocupacao"> 
											<option value="" ></option>
											<option <?php if (isset($ocupacao) && $ocupacao == "Médico") echo "selected"; ?> value="Médico">Médico</option>
											<option <?php if (isset($ocupacao) && $ocupacao == "Não Médico") echo "selected"; ?> value="Não Médico">Não Médico</option>
											<option <?php if (isset($ocupacao) && $ocupacao == "Administrador") echo "selected"; ?> value="Administrador">Administrador</option>
										</select>
									</p>   
									<?php } ?>
									<p>
										<label for="email">E-mail:<span style="color:red;">*</span></label><br/>
										<input type="email" class="text small required" name="email" id="email" value="<?php echo (isset($email)) ?  $email : ""; ?>"/> 
									</p>									
									<p>
										<label for="login">Login:<span style="color:red;">*</span></label><br/>
										<input type="text" class="text small required" id="login" <?php echo (isset($login)) ?  'disabled' : 'name="login"'; ?> value="<?php echo (isset($login)) ?  $login : ""; ?>"/> 
									</p>		
									<p>
										<label for="ativo">Ativo:<span style="color:red;">*</span></label><br/>
										<select name="ativo" class="required" id="ativo">
											<option <?php if (isset($ativo) && $ativo == "1") echo "selected"; ?> value="1">Sim</option>
											<option <?php if (isset($ativo) && $ativo == "0") echo "selected"; ?> value="0">Não</option>
										</select>
									</p>
									<p>
										<label for="admin">Administrador:<span style="color:red;">*</span></label><br/>
										<select name="admin" class="required" id="admin">
											<option <?php if (isset($admin) && $admin == "1") echo "selected"; ?> value="1">Sim</option>
											<option <?php if (isset($admin) && $admin == "0") echo "selected"; ?> value="0">Não</option>
										</select>
									</p>
									<?php if (isset($login)) { ?>									  										
									<p style="margin-top:25px; font-weight:bold;">Alterar Senha</p>
									<p>Caso não pretenda alterar a senha, deixe os campos abaixo em branco.</p>
									<?php } ?>
									<p>
										<label for="senha">Senha:<?php if (!isset($login)) { ?><span style="color:red;">*</span><?php } ?></label><br/>
										<input id="senha" class="text small <?php echo (isset($login)) ?  '' : 'required'; ?>" type="password" name="senha1" value=""/>  
									</p>	
									<p>
										<label for="senha2">Confirmar Senha:<?php if (!isset($login)) { ?><span style="color:red;">*</span><?php } ?></label><br/>
										<input id="senha2" class="text small <?php echo (isset($login)) ?  '' : 'required'; ?>" type="password" name="senha2" value=""/>  
									</p>																		
									<p>
										<button class="classy" type="submit"><span>Salvar</span></button>
									</p>
                                </form>
                            </div>
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