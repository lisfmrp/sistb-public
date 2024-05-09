<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Internação ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
								<?php
									$codUnidade = "";
									$codPaciente = "";
									$codMotivoInternacao = "";
									$codProfissional = "";
									$codTipoAlta = "";
									$somenteLeitura = false;
									$disabledAttr = "";
									if (isset($_GET["cod_internacao"]) && $_GET["cod_internacao"] != "" && is_numeric($_GET["cod_internacao"])) { 								
										$cod = $_GET["cod_internacao"];
										$sql = "SELECT cod_paciente, cod_unidade, cod_profissional, cod_motivo_internacao, data_internacao, observacoes, profissional_alta, data_alta, cod_tipo_alta FROM internacao WHERE cod_internacao = $cod";
										$infos = $db->selectQuery($sql);
										if(sizeof($infos) == 0) {
								?>
											<script type="text/javascript">window.location.replace("index.php");</script>
								<?php	
											exit();
										}
										
										$codUnidade = $infos[0]['cod_unidade'];
										if($codUnidade != $_SESSION["cod_unidade"] && $_SESSION["admin"] == 0) {
											$somenteLeitura = true;
											$disabledAttr = "disabled";
										}
										
										$codPaciente = $infos[0]['cod_paciente'];										
										$codProfissional = $infos[0]['cod_profissional'];
										$codMotivoInternacao = $infos[0]['cod_motivo_internacao'];
										$dataInternacao = $infos[0]['data_internacao'];
										$codTipoAlta = $infos[0]['cod_tipo_alta'];
										$dataAlta = $infos[0]['data_alta'];
										$profissionalAlta = ($infos[0]['profissional_alta']);
										$observacoes = ($infos[0]['observacoes']);
										
										if ($dataInternacao != NULL) {
											$dataInternacao1 = implode("/", array_reverse(explode("-", $dataInternacao)));
										} else if ($dataInternacao == "0000-00-00" || $dataInternacao == NULL) {
											$dataInternacao1 = "";
										}
										
										if ($dataAlta != NULL) {
											$dataAlta1 = implode("/", array_reverse(explode("-", $dataAlta)));
										} else if ($dataAlta == "0000-00-00" || $dataAlta == NULL) {
											$dataAlta1 = "";
										}
									}		
								?>
                                <form method="POST" class="validar" action="internacao_post.php">
                                    <?php if (isset($cod) && !$somenteLeitura) { ?>
                                        <input type="hidden" name="cod_internacao" value="<?=$cod?>"/>
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
									<div style="width:100%; height:100px;"> 
										<div  style="width:50%; float:left;">
											<p>
												<label for="cod_paciente">Nome do Paciente:<span style="color:red;">*</span></label><br/>
											<?php
												$sql = "SELECT cod_paciente, nome FROM paciente ORDER BY nome";
												$queryPacientes = $db->selectQuery($sql);
												if ($queryPacientes) {
													$disabled = "";
													if($codPaciente != "") $disabled = "disabled";
													echo "<select name='cod_paciente' id='cod_paciente' class='required js-example-basic-single' style='width: 590px;' $disabled>";
													echo "<option value=''></option>";
													foreach ($queryPacientes as $paciente) {
														$selected = "";
														if ($paciente["cod_paciente"] == $codPaciente) $selected = "selected";
														echo "<option $selected value='$paciente[cod_paciente]'>".(ucwords($paciente['nome']))."</option>";
													}
													echo "</select>";
												}
											?>
											</p>
											<p>
												<label for="cod_unidade">Local de internação:<span style="color:red;">*</span></label><br/>
											<?php
												$select3 = "SELECT cod_unidade, nome, cidade FROM unidade WHERE atencao = 1 ORDER BY nome";
												$queryH = $db->selectQuery($select3);
												if ($queryH) {
													echo "<select name='cod_unidade' id='cod_unidade' class='required js-example-basic-single' style='width: 590px;' $disabledAttr>";
													echo "<option value=''></option>";
													foreach ($queryH as $hospital) {
														$selected = "";
														if ($hospital["cod_unidade"] == $codUnidade) $selected = "selected";
														echo "<option $selected value='$hospital[cod_unidade]'>".(ucwords($hospital['nome']))." ".(ucwords($hospital['cidade']))."</option>";
													}
													echo "</select>";
												}
											?>
											</p>
											<p>
												<label for="data_internacao">Data da internação (dd/mm/aaaa):<span style="color:red;">*</span></label><br/>
												<input type="text" class="text small data required" name="data_internacao" id="data_internacao" value="<?php echo (isset($dataInternacao1)) ?  $dataInternacao1 : ""; ?>" <?=$disabledAttr?>/>
											</p>  
											<p>
												<label for="cod_motivo_internacao">Motivo principal da internação:<span style="color:red;">*</span></label><br/>
												<select name="cod_motivo_internacao" id="cod_motivo_internacao" class="required" style='width: 590px;' <?=$disabledAttr?>> 
													<option value="" ></option>
													<?php
														$sql = "SELECT * FROM internacao_motivo;";
														$motivos = $db->selectQuery($sql);
														foreach($motivos as $m) {
															$selected = "";
															if($codMotivoInternacao == $m["cod_motivo_internacao"]) $selected = "selected";
															echo "<option $selected value='".$m["cod_motivo_internacao"]."'>".($m["motivo"])."</option>";
														}
													?>
												</select>				
											</p>
										</div>
										<div  style="width:50%;float:right;">
											<p>
												<label for="data_alta">Data da alta (dd/mm/aaaa):</label><br/>
												<input type="text" class="text small data" name="data_alta" id="data_alta" value="<?php echo (isset($dataAlta1)) ?  $dataAlta1 : ""; ?>" <?=$disabledAttr?>/> 
											</p>
											<p>
												<label for="cod_tipo_alta">Tipo da alta:</label><br/>
												<select name="cod_tipo_alta" id="cod_tipo_alta" <?=$disabledAttr?>> 
													<option value="" ></option>
													<?php
														$sql = "SELECT * FROM internacao_tipo_alta;";
														$tiposAlta = $db->selectQuery($sql);
														foreach($tiposAlta as $ta) {
															$selected = "";
															if($codTipoAlta == $ta["cod_tipo_alta"]) $selected = "selected";
															echo "<option $selected value='".$ta["cod_tipo_alta"]."'>".($ta["tipo_alta"])."</option>";
														}
													?>
												</select>
											</p>
											<p>
												<label for="profissional_alta">Profissional responsável pela alta:</label><br/>
												<input type="text" class="text small" name="profissional_alta" id="profissional_alta" value="<?php echo (isset($profissionalAlta)) ?  $profissionalAlta : ""; ?>" <?=$disabledAttr?>/> 
											</p> 
										</div>
									</div>
									<p>
										<label for="observacoes">Observações:</label><br/>
										<textarea class="text small" rows="10" cols="150" name="observacoes" id="observacoes" <?=$disabledAttr?>><?php echo (isset($observacoes)) ?  $observacoes : ""; ?></textarea> 
									</p>   
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