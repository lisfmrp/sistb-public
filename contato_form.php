<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Contato ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
			<?php 
				$cod_paciente = "";
				$somenteLeitura = false;
				$disabledAttr = "";
				if (isset($_GET["cod_contato"]) && $_GET["cod_contato"] != "" && is_numeric($_GET["cod_contato"])) { 					
			?>
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
					<div class="box-1">
                        <div class="box-2">						
                            <div class="box-3">
                            <?php														
								$cod_contato = $_GET["cod_contato"];
								
								$sql = "SELECT * FROM contato WHERE cod_contato = '$cod_contato' AND excluido = 0";
								$infos = $db->selectQuery($sql);
								
								if(sizeof($infos) == 0) {
							?>
									<script type="text/javascript">window.location.replace("index.php");</script>
							<?php	
									exit();
								}
								
								$cod_paciente = $infos[0]['cod_paciente'];
								
								if($_SESSION["admin"] == 0) {
									$sql = "SELECT un_supervisao FROM tratamento WHERE cod_paciente = '$cod_paciente' AND un_supervisao = '$_SESSION[cod_unidade]'";
									$unidade = $db->selectQuery($sql);
									$cod_unidade = $unidade[0]['un_supervisao'];
									if($cod_unidade != $_SESSION["cod_unidade"]) {
										$somenteLeitura = true;
										$disabledAttr = "disabled";
									}
								}
																
								$nome = (strtoupper($infos[0]['nome']));
								$idade = $infos[0]['idade'];
								$grau_parentesco = $resultado_baciloscopia = (strtoupper($infos[0]['grau_parentesco']));
								$data_baciloscopia = $infos[0]['data_baciloscopia'];
								$resultado_baciloscopia = ($infos[0]['resultado_baciloscopia']);
								$data_rx_pulmao = $infos[0]['data_rx_pulmao'];
								$resultado_rx_pulmao = ($infos[0]['resultado_rx_pulmao']);
								$data_ppd = $infos[0]['data_ppd'];
								$resultado_ppd = ($infos[0]['resultado_ppd']);
								$quimioprofilaxia = $infos[0]['quimioprofilaxia'];
								$data_quimioprofilaxia = $infos[0]['data_quimioprofilaxia'];
								$data_retorno = $infos[0]['data_retorno'];
								$data_nasc = $infos[0]['data_nascimento'];
								$tipo_saida = $infos[0]['tipo_saida'];
								$coinfeccao = $infos[0]['coinfeccao'];
								$data_saida = $infos[0]['data_saida'];
								$observacao_contato = ($infos[0]['observacao_contato']);
							   								
								$coinfec1 = "";
								if ($coinfeccao == "N") {
									$coinfec1 = "Não";
								} else if ($coinfeccao == "S"){
									$coinfec1 = "Sim";
								}                                 

								$quimio1 = "";
								if ($quimioprofilaxia == "N") {
									$quimio1 = "Não";
								} else if ($quimioprofilaxia == "S"){
									$quimio1 = "Sim";
								} else if ($quimioprofilaxia == "A"){
									$quimio1 = "Em andamento";
								}

								if ($data_nasc != NULL) {
									$data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
								} else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
									$data_nasc1 = "";
								}

								if ($data_baciloscopia != NULL) {
									$data_baciloscopia1 = implode("/", array_reverse(explode("-", $data_baciloscopia)));
								} else if ($data_baciloscopia == "0000-00-00" || $data_baciloscopia == NULL) {
									$data_baciloscopia1 = "";
								}

								if ($data_rx_pulmao != NULL) {
									$data_rx_pulmao1 = implode("/", array_reverse(explode("-", $data_rx_pulmao)));
								} else if ($data_rx_pulmao == "0000-00-00" || $data_rx_pulmao == NULL) {
									$data_rx_pulmao1 = "";
								}

								if ($data_ppd != NULL) {
									$data_ppd1 = implode("/", array_reverse(explode("-", $data_ppd)));
								} else if ($data_ppd == "0000-00-00" || $data_ppd == NULL) {
									$data_ppd1 = "";
								}

								if ($data_quimioprofilaxia != NULL) {
									$data_quimioprofilaxia1 = implode("/", array_reverse(explode("-", $data_quimioprofilaxia)));
								} else if ($data_quimioprofilaxia == "0000-00-00" || $data_quimioprofilaxia == NULL) {
									$data_quimioprofilaxia1 = "";
								}

								if ($data_retorno != NULL) {
									$data_retorno1 = implode("/", array_reverse(explode("-", $data_retorno)));
								} else if ($data_retorno == "0000-00-00" || $data_retorno == NULL) {
									$data_retorno1 = "";
								}
								
								if ($data_saida != NULL) {
									$data_saida1 = implode("/", array_reverse(explode("-", $data_saida)));
								} else if ($data_saida == "0000-00-00" || $data_saida == NULL) {
									$data_saida1 = "";
								}
							?>
								<h2 class="title">Informações Gerais</h2> 
								<b>Nome do Contato: </b><?=$nome;?><br/>
								<b>Data de nascimento: </b><?=$data_nasc1;?><br/>
								<b>Idade: </b><?=$idade;?><br/>								
								<b>Parentesco: </b><?=$grau_parentesco;?><br/><br/>
								
								<b>Coinfecção HIV/AIDS: </b><?=$coinfec1;?><br/><br/>
								
								<b>Resultado da baciloscopia: </b>
								<?php if ($resultado_baciloscopia == "3- Em andamento") { ?>
									<b><font color="red"><?= $resultado_baciloscopia; ?></font></b><br/>
								<?php } else { ?>
									<?=$resultado_baciloscopia;?><br/>
								<?php } ?>								
								<b>Data da baciloscopia: </b><?=$data_baciloscopia1;?><br/><br/>
								
								<b>Resultado do RX pulmão: </b><?=$resultado_rx_pulmao;?><br/>
								<b>Data do resultado RX pulmão: </b><?=$data_rx_pulmao1;?><br/>
								
								<b>Resultado PPD: </b><?=$resultado_ppd;?><br/>
								<b>Data do resultado PPD: </b><?=$data_ppd1;?><br/><br/>
								
								<b>Quimioprofilaxia: </b>
								<?php if ($quimio1 == "Em andamento") { ?>
									<b><font color="red"><?=$quimio1;?></font></b><br/>
								<?php } else { ?>
									<?=$quimio1;?><br/>
								<?php } ?>								
								<b>Data da quimioprofilaxia: </b><?=$data_quimioprofilaxia1;?><br/><br/>
								
								<b>Data do retorno: </b><?=$data_retorno;?><br/>
								<b>Saída: </b><?=$tipo_saida;?><br/>
								<b>Data da saída: </b><?=$data_saida1;?><br/>
								<b>Observações: </b><?=$observacao_contato;?><br/>	
							</div>						
						</div>
					</div>	
					<div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
				</div>
		<?php } ?>
				<div class="box box-gradient">    
					<div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
					<div class="box-1">
						<div class="box-2">
							<div class="box-3 header-on">							
								<form method="POST" class="validar" action="contato_post.php">
									<?php if (isset($cod_contato) && !$somenteLeitura) { ?>
										<input type="hidden" name="cod_contato" value="<?=$cod_contato?>"/>
										<input type="hidden" name="cod_unidade" value="<?=$cod_unidade?>"/>
									<?php } ?>
									<?php if (!$somenteLeitura) { ?>
										<p>
											<label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
											<button class="classy" type="submit"><span>Salvar</span></button>
										</p>
									<?php } else { ?>
										<p>
											<label><span style="color:red;">ATENÇÃO:</span> não é possível alterar dados de internação de outra Unidade!</label>
										</p>
									<?php } ?>																																	
									<p>
										<label for="cod_paciente">Paciente<span style="color:red;">*</span></label><br/>												
									<?php									
										$sql = "SELECT cod_paciente, nome FROM paciente ORDER BY nome";
										$queryPacientes = $db->selectQuery($sql);
										if ($queryPacientes) {
											$disabled = "";
											if($cod_paciente != "") $disabled = "disabled";
											echo "<select name='cod_paciente' class='required js-example-basic-single' id='cod_paciente' style='width:650px;' $disabled>";
											echo "<option value=''></option>";
											foreach ($queryPacientes as $paciente) {
												$selected = "";
												if ($paciente["cod_paciente"] == $cod_paciente) $selected = "selected";
												echo "<option $selected value='$paciente[cod_paciente]'>".(strtoupper($paciente["nome"]))."</option>";
											}
											echo "</select>";
										}
									?>												
									</p>
									<p>
                                        <label for="nome">Nome do Contato:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small required" name="nome" id="nome" style="width: 637px;" value="<?php echo (isset($nome)) ?  $nome : ""; ?>" <?=$disabledAttr?>> 
                                    </p>
									<p>
                                        <label for="data_nascimento">Data de Nascimento (dd/mm/aaaa):<span style="color:red;">*</span></label><br/>
                                        <input id="id8" type="text" class="text small data required" name="data_nascimento" id="data_nascimento" value="<?php echo (isset($data_nasc1)) ?  $data_nasc1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>
                                    <p>
                                        <label for="idade">Idade:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small required" name="idade" id="idade" value="<?php echo (isset($idade)) ?  $idade : ""; ?>" <?=$disabledAttr?>/> 
                                    </p>
                                    <p>
                                        <label for="parentesco">Parentesco:<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small required" name="parentesco" id="parentesco" value="<?php echo (isset($grau_parentesco)) ?  $grau_parentesco : ""; ?>" <?=$disabledAttr?>/> 
                                    </p>									
									<p>
                                        <label for="coinfeccao">Coinfecção HIV/AIDS:</label><br/>
                                        <select name="coinfeccao" id="<?php if (isset($tipo_exame) && $tipo_exame == "Baciloscopia") echo "selected"; ?>"> 
                                            <option value=""></option>
                                            <option <?php if (isset($coinfeccao) && $coinfeccao == "N") echo "selected"; ?> value="N">Não</option> 
                                            <option <?php if (isset($coinfeccao) && $coinfeccao == "S") echo "selected"; ?> value="S">Sim</option>
                                        </select>				
                                    </p>									
                                    <p style="margin-top:25px;">
                                        <label for="resultado_baciloscopia">Resultado da baciloscopia:</label><br/>                                        
                                        <select name="resultado_baciloscopia" id="resultado_baciloscopia"> 
                                            <option value=""></option>
                                            <option <?php if (isset($resultado_baciloscopia) && $resultado_baciloscopia == "1- Positivo") echo "selected"; ?> value="1- Positivo">1- Positivo</option>
                                            <option <?php if (isset($resultado_baciloscopia) && $resultado_baciloscopia == "2- Negativo") echo "selected"; ?> value="2- Negativo">2- Negativo</option>
                                            <option <?php if (isset($resultado_baciloscopia) && $resultado_baciloscopia == "3- Em andamento") echo "selected"; ?> value="3- Em andamento">3- Em andamento</option>
                                            <option <?php if (isset($resultado_baciloscopia) && $resultado_baciloscopia == "8- Não realizado") echo "selected"; ?> value="8- Não realizado">8- Não realizado</option> 
                                            <option <?php if (isset($resultado_baciloscopia) && $resultado_baciloscopia == "9- Sem informação") echo "selected"; ?> value="9- Sem informação">9- Sem informação</option>                          
                                        </select>
                                    </p>
                                    <p>
                                        <label for="data_baciloscopia">Data do Resultado (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_baciloscopia" id="data_baciloscopia" value="<?php echo (isset($data_baciloscopia1)) ?  $data_baciloscopia1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>  
                                    <p style="margin-top:25px;">
                                        <label for="resultado_rx_pulmao">Resultado do RX pulmão:</label><br/>                                        
                                        <select name="resultado_rx_pulmao" id="resultado_rx_pulmao"> 
                                            <option value=""></option>
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "1- Normal") echo "selected"; ?> value="1- Normal">1- Normal</option>
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "2- Suspeita de TB") echo "selected"; ?> value="2- Suspeita de TB">2- Suspeita de TB</option>
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "3- Suspeita de TB com caverna") echo "selected"; ?> value="3- Suspeita de TB com caverna">3- Suspeita de TB com caverna</option>
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "4- Outras afecções") echo "selected"; ?> value="4- Outras afecções">4- Outras afecções</option> 
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "8- Não realizado") echo "selected"; ?> value="8- Não realizado">8- Não realizado</option>         
                                            <option <?php if (isset($resultado_rx_pulmao) && $resultado_rx_pulmao == "9- Sem informação") echo "selected"; ?> value="9- Sem informação">9- Sem informação</option> 
                                        </select>
                                    </p>
                                    <p>
                                        <label for="data_rx_pulmao">Data do Resultado (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_rx_pulmao" id="data_rx_pulmao" value="<?php echo (isset($data_rx_pulmao1)) ?  $data_rx_pulmao1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>
                                    <p style="margin-top:25px;">
                                        <label for="resultado_ppd">Resultado PPD (em mm):</label><br/>
                                        <input type="text" class="text small ppd" name="resultado_ppd" id="resultado_ppd" value="<?php echo (isset($resultado_ppd)) ?  $resultado_ppd : ""; ?>" <?=$disabledAttr?>/>                                        
                                    </p>
                                    <p>
                                        <label for="data_ppd">Data do Resultado (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_ppd" id="data_ppd" value="<?php echo (isset($data_ppd1)) ?  $data_ppd1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>
                                    <p style="margin-top:25px;">
                                        <label for="quimio">Quimioprofilaxia:</label><br/>
                                        <select name="quimio" id="quimio" onChange="verificaOpcao(this.value)"> 
                                            <option value=""></option>
                                            <option <?php if (isset($quimioprofilaxia) && $quimioprofilaxia == "N") echo "selected"; ?> value="N">Não</option> 
                                            <option <?php if (isset($quimioprofilaxia) && $quimioprofilaxia == "S") echo "selected"; ?> value="S">Sim</option>
                                            <option <?php if (isset($quimioprofilaxia) && $quimioprofilaxia == "A") echo "selected"; ?> value="A">Em andamento</option>
                                        </select>				
                                    </p> 
                                    <p style="display:none;" id="campoDataInicioQuimio">
                                        <label for="data_quimio">Data de início (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_quimio" id="data_quimio" value="<?php echo (isset($data_quimioprofilaxia1)) ?  $data_quimioprofilaxia1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>
                                    <p>
                                        <label for="data_retorno">Data do retorno (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_retorno" id="data_retorno" value="<?php echo (isset($data_retorno1)) ?  $data_retorno1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p> 
                                    <p>
                                        <label for="tipo_saida">Tipo de Saída:</label><br/>
                                        <select name="tipo_saida" id="tipo_saida"> 
                                            <option value=""></option> 
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Encerramento da investigação") echo "selected"; ?> value="Encerramento da investigação">Encerramento da investigação</option>
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Encaminhado para tratamento de TB") echo "selected"; ?> value="Encaminhado para tratamento de TB">Encaminhado para tratamento de TB</option>
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Abandono") echo "selected"; ?> value="Abandono">Abandono</option>
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Óbito por outras causas") echo "selected"; ?> value="Óbito por outras causas">Óbito por outras causas</option>                 
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Transferência") echo "selected"; ?> value="Transferência">Transferência</option>
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Mudança de diagnóstico") echo "selected"; ?> value="Mudança de diagnóstico">Mudança de diagnóstico</option> 
                                            <option <?php if (isset($tipo_saida) && $tipo_saida == "Encaminhado para investigação") echo "selected"; ?> value="Encaminhado para investigação">Encaminhado para investigação</option>  
                                        </select>                                        
                                    </p>
                                    <p style="display:none;" id="campoDataSaida">
                                        <label for="data_saida">Data de saída (dd/mm/aaaa):</label><br/>
                                        <input type="text" class="text small data" name="data_saida" id="data_saida" value="<?php echo (isset($data_saida1)) ?  $data_saida1 : ""; ?>" <?=$disabledAttr?>/>
                                    </p>
                                    <p style="margin-top:25px;">
                                      <label for="observacao_contato">Observações:</label><br/>
                                      <textarea class="" rows="10" cols="70" name="observacao_contato" id="observacao_contato" <?=$disabledAttr?>><?php echo (isset($observacao_contato)) ?  $observacao_contato : ""; ?></textarea> 
                                    </p>
									
									<?php if (!$somenteLeitura && isset($cod_contato)) { ?>
									<p style="margin-top:25px;">
                                        <label for="excluido" style="color:red;">Excluir contato?</label><br/>
                                        <select name="excluido" id="excluido" class="required"> 
                                            <option selected value="0">Não</option> 
                                            <option value="1">Sim</option>
                                        </select>				
                                    </p>
									<?php } ?>									
									<?php if (!$somenteLeitura) { ?>
										<p>
											<button class="classy" type="submit"><span>Salvar</span></button>
										</p>
									<?php } ?>
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
<script type="text/javascript">
	function verificaOpcao(value){
		document.getElementById("campoDataInicioQuimio").style.display = "none";
		document.getElementById("campoDataSaida").style.display = "none";
		if( value == "S" || value == "A"){
			document.getElementById("campoDataInicioQuimio").style.display = "";
			document.getElementById("campoDataSaida").style.display = "";
		}
	 }	  
</script>