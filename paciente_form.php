<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
		<?php 
			$cod_tipo_ocupacao = "";
			if ((isset($_GET["cod_paciente"]) && $_GET["cod_paciente"] != "" && is_numeric($_GET["cod_paciente"])) || (isset($_GET["token"]) && $_GET["token"] != "")) {  
		?>
				<div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
								<h2 class="title">Informações do Paciente</h2>
                            <?php								
								/*if(isset($_GET["token"])) {
									if(!empty($_GET["nroSinan"])) {
										$sql = "SELECT P.*, TOC.tipo_ocupacao FROM paciente P INNER JOIN paciente_tipo_ocupacao TOC ON TOC.cod_tipo_ocupacao = P.cod_tipo_ocupacao WHERE sinan = ".$_GET["nroSinan"];
									} else if(!empty($_GET["cod_paciente"])) {
										$sql = "SELECT P.*, TOC.tipo_ocupacao FROM paciente P INNER JOIN paciente_tipo_ocupacao TOC ON TOC.cod_tipo_ocupacao = P.cod_tipo_ocupacao WHERE cod_paciente = ".$_GET["cod_paciente"];
									} else {
										die("Informe um parâmetro válido");
									}		
								} else {
									$cod = $_GET["cod_paciente"];								
									$sql = "SELECT P.*, TOC.tipo_ocupacao FROM paciente P INNER JOIN paciente_tipo_ocupacao TOC ON TOC.cod_tipo_ocupacao = P.cod_tipo_ocupacao WHERE cod_paciente = $cod";
								}*/
                                
								$cod = $_GET["cod_paciente"];								
								$sql = "SELECT P.*, TOC.tipo_ocupacao FROM paciente P INNER JOIN paciente_tipo_ocupacao TOC ON TOC.cod_tipo_ocupacao = P.cod_tipo_ocupacao WHERE cod_paciente = $cod";
									
								$infos = $db->selectQuery($sql);     
								if(sizeof($infos) == 0) {
							?>		<script type="text/javascript">window.location.replace("index.php");</script>
							<?php	
									exit();
								}
				
                                $cpf = $infos[0]['cpf'];
                                $cns = $infos[0]['cns'];
                                $gestante = $infos[0]['gestante'];
                                $nome = ($infos[0]['nome']);
                                $data_nasc = $infos[0]['data_nascimento'];
                                $idade = $infos[0]['idade'];
                                $sexo = $infos[0]['sexo'];
                                $mae = ($infos[0]['mae']);
                                $endereco = ($infos[0]['endereco']);
                                $telefone = $infos[0]['telefone'];
                                $cidade = ($infos[0]['cidade']);
                                $estado = $infos[0]['estado'];
                                $escolaridade = $infos[0]['escolaridade'];
                                $cod_tipo_ocupacao = $infos[0]['cod_tipo_ocupacao'];
								$tipo_ocupacao = $infos[0]['tipo_ocupacao'];
                                $ocupacao = ($infos[0]['ocupacao']);
                                $obs = ($infos[0]['observacoesp']);
                                $nro_prontuario = $infos[0]['nro_prontuario'];                             
                                $naturalidade = ($infos[0]['naturalidade']);
                                $etnia = $infos[0]['etnia'];
                                $sinan = $infos[0]['sinan'];
                                $nro_hygia = $infos[0]['nro_hygia'];

                                if ($data_nasc != NULL) {
                                    $data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
                                } else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
                                    $data_nasc1 = "";
                                }
								
								if(false) {
								//if(!isset($_GET["token"])) {
									$ts = $infos[0]['atualizado_em'];
									
									$sql = "SELECT timestamp,data_hash,iota_root_mam FROM iota_mam WHERE cod = $cod AND tabela = 'paciente';";
									$dataCheck = $db->selectQuery($sql);
									$iotaRoot = "";
									if(sizeof($dataCheck) > 0) {
										$iotaRoot = $dataCheck[0]['iota_root_mam'];
										$dataHash = hash("sha256",$cod.$ts);
									}
									
									if($iotaRoot != "") {
							?>	
									<p>
										<b>Carimbo data/hora:</b> <?=$ts?><br/>
										<b>Hash dos dados (SHA-256):</b> <?=$dataHash?> <br/><br/>
										
										<b>IOTA/Tangle MAM Explorer:</b> <a href="https://mam-explorer.firebaseapp.com/" target="_blank">https://mam-explorer.firebaseapp.com/</a> <br/>
										<b>ROOT:</b> <?=$iotaRoot?> <br/>
										<b>KEY:</b> QV9VMPFVTWSGNFGLKDCHNLRNGJOUCWCCWYUTK9LGDB9IUUGPOIFWRD9YLOAFACPBBLEXWQPFHQLPWYBYP
									</p>	
									<hr/>
							<?php		
									}								
								}                                
                            ?>
                                <!--<div itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/Paciente">
									<b>Nome paciente: </b><span itemprop="nome"><?=$nome?></span><br/>
									<b>CPF: </b><span itemprop="cpf"><?=$cpf?></span><br/>
									<b>Cartão Nacional de Saúde: </b><span itemprop="cartao_nacional_saude"><?=$cns?></span><br/>
									<b>Número do Prontuário: </b><span itemprop="nro_prontuario"><?=$nro_prontuario?></span><br/>
									<b>Número Hygia: </b><span itemprop="nro_hygia"><?=$nro_hygia?></span><br/>
									<b>Data de Nascimento: </b><span itemprop="data_nascimento"><?=$data_nasc1?></span><br/>
									<b>Idade: </b><span itemprop="idade"><?=$idade?></span><br/>
									<b>Sexo: </b><span itemprop="sexo"><?=$sexo?></span><br/>
									<b>Gestante: </b><span itemprop="gestante"><?=$gestante?></span><br/>
									<b>Nome da Mãe: </b><span itemprop="nome_mae"><?=$mae?></span><br/>
									<b>Etnia: </b><span itemprop="etnia"><?=$etnia?></span><br/>
									<b>Naturalidade: </b><span itemprop="naturalidade"><?=$naturalidade?></span><br/>
									<b>Escolaridade: </b><span itemprop="escolaridade"><?=$escolaridade?> ano(s) concluído(s)</span><br/>
									<b>Tipo de Ocupação: </b><span itemprop="tipo_ocupacao"><?=$tipo_ocupacao?></span><br/>
									<b>Outro tipo de ocupação: </b><span itemprop="ocupacao"><?=$ocupacao?></span><br/>
									<b>Observações: </b><span itemprop="paciente_observacoes"><?=$obs?></span><br/>									
									<b>Número SINAN: </b><span itemprop="nro_sinan"><?=$sinan?></span><br/>

									<br/>
									<h2 class="title">Contato</h2>  																	
									<b>Endereço: </b><span itemprop="endereco"><?=$endereco?></span><br/>
									<b>Cidade: </b><span itemprop="naturalidade"><?=$cidade?></span><br/>
									<b>UF: </b><span itemprop="estado"><?=$estado?></span><br/>										
									<b>Telefone: </b><span itemprop="telefone"><?=$telefone?></span><br/>									
								</div>-->
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
			<?php } ?>
			
			<?php if(!isset($_GET["token"]) && $_SESSION["escrita"] == 1) { ?>
                <div class="box box-gradient">    
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3 header-on">                         
                                <form method="POST" class="validar" action="paciente_post.php">
                                    <?php if (isset($cod)) { ?>
                                        <input type="hidden" name="cod_paciente" value="<?=$cod?>"/>
									<?php } ?>
									<p>
                                        <label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
										<button class="classy" type="submit"><span>Salvar</span></button>
                                    </p>    
									<div style="width:100%; height:100px;"> 
										<div  style="width:50%; float:left;">
											<p>
												<span style="font-weight:bold;font-size:14px;">Preenche o CPF ou CNS para obter os dados do paciente</span>												
											</p>
											<p>
												<label for="cpf">CPF:</label><br/>
												<input type="text" class="text small cpf" name="cpf" id="cpf" onchange="cadsus(this.value)" value="<?php echo (isset($cpf)) ?  $cpf : ""; ?>"/>
												<span><img src="images/loader.gif" id="loaderCPF" style="display:none;"/></span>
											</p>                                    
											<p>
												<label for="cns">Cartão Nacional de Saúde:</label><br/>
												<input type="text" class="text small cns" name="cns" id="cns" onchange="cadsus(this.value)" value="<?php echo (isset($cns)) ?  $cns : ""; ?>"/> 
												<span><img src="images/loader.gif" id="loaderCNS" style="display:none;"/></span>
											</p>  
											<p>
												<label for="nome">Nome do Paciente:<span style="color:red;">*</span></label><br/>
												<input style='text-transform:uppercase; width:450px;' size="70" type="text" value="<?php echo (isset($nome)) ?  $nome : ""; ?>" class="text small required" name="nome" id="nome"/> 
											</p> 
											<p>
												<label for="mae">Nome da mãe:<span style="color:red;">*</span> </label><br/>
												<input type="text" style='text-transform:uppercase; width:450px;' class="text small required" name="mae" id="mae" value="<?php echo (isset($mae)) ?  $mae : ""; ?>"/>
											</p>                                   
											<p>
												<label for="nro_prontuario">Número do Prontuário:</label><br/>
												<input type="text" class="text small" name="nro_prontuario" id="nro_prontuario" value="<?php echo (isset($nro_prontuario)) ?  $nro_prontuario : ""; ?>"/> 
											</p>                                   
											<p>
												<label for="nro_hygia">Número Hygia:</label><br/>
												<input type="text" class="text small" name="nro_hygia" id="nro_hygia" value="<?php echo (isset($nro_hygia)) ?  $nro_hygia : ""; ?>"/> 
											</p>       
											<p>
												<label for="sinan">Número SINAN:</label><br/>
												<input type="text" class="text small" name="sinan" id="sinan" value="<?php echo (isset($sinan)) ?  $sinan : ""; ?>"/> 
											</p>											
											<p>
												<label for="data_nascimento">Data de Nascimento (dd/mm/aaaa):<span style="color:red;">*</span></label><br/>
												<input type="text" class="text small data required" name="data_nascimento" id="data_nascimento" value="<?php echo (isset($data_nasc1)) ?  $data_nasc1 : ""; ?>"/> 
											</p>                                    
											<p>
												<label for="idade">Idade:<span style="color:red;">*</span></label><br/>
												<input type="text" class="text small required" name="idade" id="idade" value="<?php echo (isset($idade)) ?  $idade : ""; ?>"/> 
											</p>
											<p>
												<label for="sexo">Sexo:<span style="color:red;">*</span></label><br/>
												<select name="sexo" id="sexo" class="required" onChange="verificaSexo(this.value)"> 
													<option value=""></option>
													<option <?php if (isset($sexo) && $sexo == "M") echo "selected"; ?> value="M">Masculino</option> 
													<option <?php if (isset($sexo) && $sexo == "F") echo "selected"; ?> value="F">Feminino</option> 
												</select>				
											</p>                                       
											<p style="display:none" id="pGestante">                                       
												<label for="gestante">Gestante:</label><br/>
												<select id="gestante" name="gestante"> 
													<option value=""></option>
													<option <?php if (isset($gestante) && $gestante == "N") echo "selected"; ?> value="N">Não</option> 
													<option <?php if (isset($gestante) && $gestante == "S") echo "selected"; ?> value="S">Sim</option> 
												</select>				
											</p>                                     											 
											<p>
												<label for="etnia">Etnia:</label><br/>
												<select name="etnia" id="etnia"> 
													<option value=""></option>
													<option <?php if (isset($etnia) && $etnia == "Amarelo") echo "selected"; ?> value="Amarelo">Amarelo</option>
													<option <?php if (isset($etnia) && $etnia == "Branco") echo "selected"; ?> value="Branco">Branco</option>                                                         
													<option <?php if (isset($etnia) && $etnia == "Indígena") echo "selected"; ?> value="Indigena">Indígena</option>
													<option <?php if (isset($etnia) && $etnia == "Negro") echo "selected"; ?> value="Negro">Negro</option> 
													<option <?php if (isset($etnia) && $etnia == "Pardo") echo "selected"; ?> value="Pardo">Pardo</option>
												</select>				
											</p>
										</div>
										<div  style="width:50%;float:right;">
											<p>
												<label for="telefone">Telefone:</label><br/> 
												<input type="text"  class="text small" name="telefone" id="telefone" value="<?php echo (isset($telefone)) ?  $telefone : ""; ?>"/> 
											</p>   
											<p>
												<label for="naturalidade">Naturalidade:</label><br/>
												<input type="text" class="text small" name="naturalidade" id="naturalidade" value="<?php echo (isset($naturalidade)) ?  $naturalidade : ""; ?>"/> 
											</p>                                    
											<p>
												<label for="endereco">Endereço:</label><br/>
												<input type="text" style='text-transform:uppercase;' class="text small" name="endereco" id="endereco" value="<?php echo (isset($endereco)) ?  $endereco : ""; ?>"/> 
											</p>                                    
											<p>
												<label for="cep">CEP: </label><br/>
												<input type="text" class="text small" name="cep" id="cep" value="<?php echo (isset($cep)) ?  $cep : ""; ?>"/>
											</p>                                                                     
											<p>
												<label for="cidade">Cidade:<span style="color:red;">*</span></label><br/>
												<input type="text" style='text-transform:uppercase;' class="text small required" value="<?php echo (isset($cidade)) ?  $cidade : ""; ?>" name="cidade" id="cidade"/> 
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
												<label for="escolaridade">Escolaridade (anos concluídos):</label><br/>
												<input type="text" class="text small" name="escolaridade" id="escolaridade" value="<?php echo (isset($escolaridade)) ?  $escolaridade : ""; ?>"/> 
											</p>                                                                                                                                              
											<p>
												<label for="tipo_ocupacao">Tipo de Ocupação:</label><br/>
												<select name="tipo_ocupacao" id="tipo_ocupacao" onChange="verificaOpcao(this.value)"> 
													<option value=""></option>
											<?php
												$sql = "SELECT * FROM paciente_tipo_ocupacao;";
												$ocupacoes = $db->selectQuery($sql);
												foreach($ocupacoes as $ocup) {
													$selected = "";
													if($cod_tipo_ocupacao == $ocup["cod_tipo_ocupacao"]) $selected = "selected";
													echo "<option $selected value='".$ocup["cod_tipo_ocupacao"]."'>".($ocup["tipo_ocupacao"])."</option>";
												}
											?>
												</select>				
											</p>
											<p id="pOutraOcupacao" style="display:none;">
												<label for="ocupacao">Outra Ocupação:</label><br/>
												<input id="ocupacao" style='text-transform:uppercase;' type="text" class="text small" name="ocupacao" value="<?php echo (isset($ocupacao)) ?  $ocupacao : ""; ?>"/> 
											</p>
											<p>
												<label for="observacoes">Observações:</label><br/>
												<textarea class="text small" rows="10" cols="80" name="observacoes" id="observacoes"><?php echo (isset($observacoes)) ?  $observacoes : ""; ?></textarea> 
											</p>                               											
										</div>
									</div>
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
<script type="text/javascript">
	function verificaOpcao(value){
		if(value == "7"){
			document.getElementById("pOutraOcupacao").style.display = "";
		} else if(value != "7") {
			document.getElementById("pOutraOcupacao").style.display = "none";          
		}	   
	}   
	
	function verificaSexo(value){
		if(value == "F"){
			document.getElementById("pGestante").style.display = "";
		} else if(value == "M") {
			document.getElementById("pGestante").style.display = "none";
		 }     
	}	
	
	function cadsus(livingSubjectId) {
		livingSubjectId = livingSubjectId.replaceAll(".","").replace("-","");
		$("#loaderCPF").show();
		$("#loaderCNS").show();
		$.post(
			"https://ciis.fmrp.usp.br/cadsus/cadsus.php",
			{ 
				'livingSubjectId': livingSubjectId,
				'key': 'vrtXi2V202LXjkxLPHDNMVvKfNVYBBNSYsHsPpQKh8aDTyS5H2miF78NDK5nbibGKv5YL3Td9sVITGuHoOrnlGWnN9nNHY4WL797cUJiB7znngmKM9NROpOhagKM0FWK'
			},
			function (data) {
				if(data.status == "ok" && data.msg == "") {
					$("#nome").val(data.patientData.nomePaciente);
					$("#mae").val(data.patientData.nomeMae);
					(data.patientData.sexo) ? $("#sexo").val(data.patientData.sexo) : '';
					(data.patientData.localNascimento.cidade) ? $("#naturalidade").val(data.patientData.localNascimento.cidade + ' - ' + data.patientData.localNascimento.estado) : '';
					(data.patientData.endereco.logradouro) ? $("#endereco").val(data.patientData.endereco.logradouro) : '';
					(data.patientData.endereco.cep) ? $("#cep").val(data.patientData.endereco.cep) : '';
					(data.patientData.endereco.cidade) ? $("#cidade").val(data.patientData.endereco.cidade) : '';
					(data.patientData.endereco.estado) ? $("#estado").val(data.patientData.endereco.estado) : '';
					(data.patientData.telefone) ? $("#telefone").val(data.patientData.telefone[0]) : '';
					(data.patientData.cns) ? $("#cns").val(data.patientData.cns[0]) : '';
					(data.patientData.idade) ? $("#idade").val(data.patientData.idade) : '';
					
					if(data.patientData.dataNasc) {
						let dataNascArray = data.patientData.dataNasc.split("-");
						let dataNascAux = dataNascArray[2] + '/' + dataNascArray[1] + '/' + dataNascArray[0];
						$("#data_nascimento").val(dataNascAux);
					}
					
					if(data.patientData.raca) {
						(data.patientData.raca == "BRANCA") ? $("#etnia").val("Branco") : ''; 
						(data.patientData.raca == "PRETA") ? $("#etnia").val("Negro") : ''; 
						(data.patientData.raca == "PARDA") ? $("#etnia").val("Pardo") : ''; 
						(data.patientData.raca == "AMARELA") ? $("#etnia").val("Amarelo") : ''; 
						(data.patientData.raca == "INDIGENA") ? $("#etnia").val("Indigena") : ''; 
					}
				} else {
					alert(data.msg);
				}
				$("#loaderCPF").hide();
				$("#loaderCNS").hide();
			},
			'json'
		);
	}
</script>