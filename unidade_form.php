<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Unidade ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
			<?php if($_SESSION["admin"] == 1) { ?>
				<div class="box box-gradient">    
					<div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
					<div class="box-1">
					<?php if (isset($_GET["cod_unidade"]) && $_GET["cod_unidade"] != "" && is_numeric($_GET["cod_unidade"])) {  ?>
						<div class="box-2">
							<div class="box-3 header-on">
							<?php																
								$cod = $_GET["cod_unidade"];
								$sql = "SELECT * FROM unidade WHERE cod_unidade = $cod";
								$infos = $db->selectQuery($sql);
								if(sizeof($infos) == 0) {
							?>
									<script type="text/javascript">window.location.replace("index.php");</script>
							<?php	
									exit();
								}				
								$nome = ($infos[0]['nome']);
								$cidade = ($infos[0]['cidade']);
								$estado = $infos[0]['estado'];
								$endereco = ($infos[0]['endereco']);
								$telefone = $infos[0]['telefone'];
								$atencao = $infos[0]['atencao'];
							   
								$at = "";
								if ($atencao == "0") {
									$at = "Atenção Básica";
								} else if ($atencao == "1"){
									$at = "Atenção Hospitalar";
								} else if ($atencao == "2"){
									$at = "Atenção Especializada";
								}
							?>
								<h2 class="title">Informações</h2> 
								<b>Nome da unidade: </b><?=$nome;?><br/>
								<b>Endereco: </b><?=$endereco;?><br/>
								<b>Cidade: </b><?=$cidade;?><br/>
								<b>Estado: </b><?=$estado;?><br/>
								<b>Telefone: </b><?=$telefone;?><br/>
								<b>Tipo de Atenção: </b><?=$at;?><br/>
							</div>
						</div>
					<?php } ?>
					</div>
					<div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
				</div>			

                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <form method="POST" class="validar" action="unidade_post.php">                            
                                    <?php if (isset($cod)) { ?>
                                        <input type="hidden" name="cod_unidade" value="<?=$cod?>"/>
									<?php } ?>
									<p>
                                        <label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
										<button class="classy" type="submit"><span>Salvar</span></button>
                                    </p> 
                                    <p>
                                        <label for="nome">Nome:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small required" name="nome" id="nome" value="<?php echo (isset($nome)) ?  $nome : ""; ?>"/> 
                                    </p>                                    
                                    <p>
                                        <label for="endereco">Endereço:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small required" name="endereco" id="endereco" value="<?php echo (isset($endereco)) ?  $endereco : ""; ?>"/> 
                                    </p>                                  
                                    <p>
                                        <label for="cidade">Cidade:<span style="color:red;">*</span></label><br/>
                                        <input  type="text" class="text small required" name="cidade" id="cidade" value="<?php echo (isset($cidade)) ?  $cidade : ""; ?>"/>
                                    </p>                                    
                                    <p>
                                        <label for="estado">Estado:<span style="color:red;">*</span></label><br/>
                                        <select name="estado" id="estado" class="required">
											<option value=""></option>
                                            <option <?php if (isset($estado) && $estado == "AC") echo "selected"; ?> value="AC">AC</option>
											<option <?php if (isset($estado) && $estado == "AL") echo "selected"; ?> value="AL">AL</option> 
											<option <?php if (isset($estado) && $estado == "AM") echo "selected"; ?> value="AM">AM</option>
											<option <?php if (isset($estado) && $estado == "AP") echo "selected"; ?> value="AP">AP</option> 
											<option <?php if (isset($estado) && $estado == "BA") echo "selected"; ?> value="BA">BA</option> 
											<option <?php if (isset($estado) && $estado == "CE") echo "selected"; ?> value="CE">CE</option> 
											<option <?php if (isset($estado) && $estado == "DF") echo "selected"; ?> value="DF">DF</option> 
											<option <?php if (isset($estado) && $estado == "ES") echo "selected"; ?> value="ES">ES</option> 
											<option <?php if (isset($estado) && $estado == "GO") echo "selected"; ?> value="GO">GO</option> 
											<option <?php if (isset($estado) && $estado == "MA") echo "selected"; ?> value="MA">MA</option> 
											<option <?php if (isset($estado) && $estado == "MG") echo "selected"; ?> value="MG">MG</option>
											<option <?php if (isset($estado) && $estado == "MS") echo "selected"; ?> value="MS">MS</option> 
											<option <?php if (isset($estado) && $estado == "MT") echo "selected"; ?> value="MT">MT</option>
											<option <?php if (isset($estado) && $estado == "PA") echo "selected"; ?> value="PA">PA</option>
											<option <?php if (isset($estado) && $estado == "PB") echo "selected"; ?> value="PB">PB</option>
											<option <?php if (isset($estado) && $estado == "PI") echo "selected"; ?> value="PI">PI</option>
											<option <?php if (isset($estado) && $estado == "PR") echo "selected"; ?> value="PB">PR</option> 
											<option <?php if (isset($estado) && $estado == "PE") echo "selected"; ?> value="PE">PE</option>
											<option <?php if (isset($estado) && $estado == "RJ") echo "selected"; ?> value="RJ">RJ</option> 
											<option <?php if (isset($estado) && $estado == "RN") echo "selected"; ?> value="RN">RN</option> 
											<option <?php if (isset($estado) && $estado == "RS") echo "selected"; ?> value="RS">RS</option> 
											<option <?php if (isset($estado) && $estado == "RO") echo "selected"; ?> value="RO">RO</option>  
											<option <?php if (isset($estado) && $estado == "RR") echo "selected"; ?> value="RR">RR</option> 
											<option <?php if (isset($estado) && $estado == "SC") echo "selected"; ?> value="SC">SC</option> 
											<option <?php if (isset($estado) && $estado == "SE") echo "selected"; ?> value="SE">SE</option>
											<option <?php if (isset($estado) && $estado == "SP") echo "selected"; ?> value="SP">SP</option> 
											<option <?php if (isset($estado) && $estado == "TO") echo "selected"; ?> value="TO">TO</option> 
                                        </select>				
                                    </p>	
                                    <p>
                                        <label for="telefone">Telefone:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small telefone required" name="telefone" id="telefone" value="<?php echo (isset($telefone)) ?  $telefone : ""; ?>"/> 
                                    </p>                                   
                                    <p>
                                        <label for="atencao">Nível de Atenção:<span style="color:red;">*</span></label><br/>
                                        <select name="atencao" id="atencao" class="required"> 
                                            <option value=""></option>
                                            <option <?php if (isset($atencao) && $atencao == "0") echo "selected"; ?> value="0">Atenção Básica</option>
                                            <option <?php if (isset($atencao) && $atencao == "1") echo "selected"; ?> value="1">Atenção Hospitalar</option> 
                                            <option <?php if (isset($atencao) && $atencao == "2") echo "selected"; ?> value="2">Atenção Especializada</option>                                          
                                        </select>				
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
			<?php } ?>
            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>