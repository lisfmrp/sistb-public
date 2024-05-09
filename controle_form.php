<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Exame de controle mensal ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
			<?php 
				$cod_paciente = "";
				$somenteLeitura = false;
				$disabledAttr = "";
				if (isset($_GET["cod_controle"]) && $_GET["cod_controle"] != "" && is_numeric($_GET["cod_controle"])) { 					
			?>
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
					<div class="box-1">
                        <div class="box-2">						
                            <div class="box-3">
                            <?php														
								$cod_controle = $_GET["cod_controle"];
								/*$codUnidade = $infos[0]['cod_unidade'];
								if($codUnidade != $_SESSION["cod_unidade"] && $_SESSION["admin"] == 0) {
									$somenteLeitura = true;
									$disabledAttr = "disabled";
								}*/
								
								$sql = "SELECT * FROM controle_mensal WHERE cod_controle = '$cod_controle'";
								$infos = $db->selectQuery($sql);
								if(sizeof($infos) == 0) {
							?>
									<script type="text/javascript">window.location.replace("index.php");</script>
							<?php	
									exit();
								}
								
								$cod_paciente = $infos[0]['cod_paciente'];
								$cod_tratamento = $infos[0]['cod_tratamento'];
								$resultado_controle = $infos[0]['resultado_controle'];
								$data = $infos[0]['data_controle'];
								$tipo_exame = $infos[0]['tipo_exame'];
								$material_controle = $infos[0]['material_controle'];

								$sql = "SELECT nome, data_nascimento  FROM paciente WHERE cod_paciente = '$cod_paciente'";
								$infos2 = $db->selectQuery($sql);
							   
								$nome = ($infos2[0]['nome']);
								$data_nasc = $infos2[0]['data_nascimento'];

								if ($data_nasc != NULL) {
									$data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
								} else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
									$data_nasc1 = "";
								}

								if ($data != NULL) {
									$data1 = implode("/", array_reverse(explode("-", $data)));
								} else if ($data == "0000-00-00" || $data == NULL) {
									$data1 = "";
								}
							?>
								<h2 class="title">Controle Mensal - Informações</h2> 
								<b>Nome do paciente: </b><?=$nome;?><br/>
								<b>Data de nascimento: </b><?=$data_nasc1;?><br/><br/>
								<b>Tipo de Exame: </b><?=$tipo_exame;?><br/>
								<b>Tipo de material: </b><?=$material_controle;?><br/>
								<b>Resultado: </b><?=$resultado_controle;?><br/>
								<b>Data do resultado: </b><?=$data1;?><br/>
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
								<form method="POST" class="validar" action="controle_post.php">
									<?php if (isset($cod_controle) && !$somenteLeitura) { ?>
										<input type="hidden" name="cod_controle" value="<?=$cod_controle?>"/>
										<input type="hidden" name="cod_tratamento" value="<?=$cod_tratamento?>"/>
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
										<label for="paciente_tratamento">Paciente em tratamento [data do início do tratamento]<span style="color:red;">*</span></label><br/>												
									<?php
										$filter = "";
										if($_SESSION["admin"] == 0)
											$filter = " AND (tratamento.un_supervisao = '$_SESSION[cod_unidade]' OR tratamento.un_atendimento = '$_SESSION[cod_unidade]')";
									
										if (!isset($cod_controle))
											$filter .= " AND tratamento.encerrado = 0";
										
										$sql = "SELECT paciente.cod_paciente, paciente.nome,
													tratamento.data_tratamento_atual, tratamento.cod_tratamento
												   FROM tratamento, paciente 
												   WHERE tratamento.cod_paciente = paciente.cod_paciente 												       
												   $filter
												   ORDER BY paciente.nome";
										$queryPacientes = $db->selectQuery($sql);
										if ($queryPacientes) {
											$disabled = "";
											if($cod_paciente != "") $disabled = "disabled";
											echo "<select name='paciente_tratamento' class='required js-example-basic-single' id='paciente_tratamento' style='width:650px;' $disabled>";
											echo "<option value=''></option>";
											foreach ($queryPacientes as $paciente) {
												$selected = "";
												if ($paciente["cod_paciente"] == $cod_paciente) $selected = "selected";
												$data_tratamento = implode("/", array_reverse(explode("-", $paciente['data_tratamento_atual'])));
												echo "<option $selected value='$paciente[cod_paciente]|$paciente[cod_tratamento]'>".(strtoupper($paciente["nome"]))." [$data_tratamento]</option>";
											}
											echo "</select>";
										}
									?>												
									</p>
									<p>
										<label for="tipo_exame">Tipo de Exame:<span style="color:red;">*</span></label><br/>												 
										<select name="tipo_exame" id="tipo_exame" class="required"> 
											<option value=""></option>
											<option <?php if (isset($tipo_exame) && $tipo_exame == "Baciloscopia") echo "selected"; ?> value="Baciloscopia">Baciloscopia</option>
											<option <?php if (isset($tipo_exame) && $tipo_exame == "Cultura") echo "selected"; ?> value="Cultura">Cultura</option>                         
										</select>
									</p>    
									<p>
										<label for="material_controle">Material:<span style="color:red;">*</span></label><br/>
										<input type="text" class="text small required" name="material_controle" id="material_controle" value="<?php echo (isset($material_controle)) ?  $material_controle : ""; ?>" <?=$disabledAttr?>/>
									</p>    												
									<p>
										<label for="data_controle">Data do resultado (dd/mm/aaaa)<span style="color:red;">*</span>: </label><br/>
										<input type="text" class="text small data required" name="data_controle" id="data_controle" value="<?php echo (isset($data1)) ?  $data1 : ""; ?>" <?=$disabledAttr?>/>
									</p> 
									<p>
										<label for="resultado_controle">Resultado:<span style="color:red;">*</span></label><br/>												 
										<select name="resultado_controle" id="resultado_controle" class="required"> 
											<option value="" ></option>
											<option <?php if (isset($resultado_controle) && $resultado_controle == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
											<option <?php if (isset($resultado_controle) && $resultado_controle == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
											<option <?php if (isset($resultado_controle) && $resultado_controle == "Contaminado") echo "selected"; ?> value="Contaminado">Contaminado</option>
											<option <?php if (isset($resultado_controle) && $resultado_controle == "") echo "Em andamento"; ?> value="Em andamento">Em andamento</option>
											<option <?php if (isset($resultado_controle) && $resultado_controle == "") echo "Não realizado"; ?> value="Não realizado">Não realizado</option> 
											<option <?php if (isset($resultado_controle) && $resultado_controle == "") echo "Sem informação"; ?> value="Sem informação">Sem informação</option>                          
										</select>
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