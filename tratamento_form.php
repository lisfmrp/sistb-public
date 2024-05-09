<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Tratamento ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
			<?php 
				$cod_paciente = "";
				$unidade_recebido = "";
				$un_atendimento = "";
				$un_supervisao = "";
				$un_notificante = "";
				$somenteLeitura = false;
				$disabledAttr = "";
				if (isset($_GET["cod_tratamento"]) && $_GET["cod_tratamento"] != "" && is_numeric($_GET["cod_tratamento"])) { 					
			?>
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
					<div class="box-1">
                        <div class="box-2">						
                            <div class="box-3">
								<h2 class="title">Informaçőes do Tratamento</h2> 
                            <?php																						
								$cod_tratamento = $_GET["cod_tratamento"];																																																				
								$sql = "SELECT P.*, T.*, 
											PTO.tipo_ocupacao, 
											U1.nome AS nome_un_not, U2.nome AS nome_un_at, U3.nome AS nome_un_sup,
											PROF.nome AS nome_profissional
										FROM tratamento T
												INNER JOIN paciente P ON P.cod_paciente = T.cod_paciente
												INNER JOIN paciente_tipo_ocupacao PTO ON PTO.cod_tipo_ocupacao = P.cod_tipo_ocupacao
												INNER JOIN unidade U1 ON U1.cod_unidade = T.un_notificante
												INNER JOIN unidade U2 ON U2.cod_unidade = T.un_atendimento
												INNER JOIN unidade U3 ON U3.cod_unidade = T.un_supervisao
												LEFT JOIN profissional PROF ON PROF.cod_profissional = T.cod_profissional
										WHERE T.cod_tratamento = '$cod_tratamento' AND T.excluido = 0";
								$consultas = $db->selectQuery($sql);
								
								if(sizeof($consultas) == 0) {
								?> <script type="text/javascript">window.location.replace("index.php");</script> <?php	
									exit();
								}
								
								if($_SESSION["admin"] == 0) {
									$sql = "SELECT un_supervisao, un_atendimento FROM tratamento WHERE cod_tratamento = '$cod_tratamento' AND (un_supervisao = '$_SESSION[cod_unidade]' OR un_atendimento = '$_SESSION[cod_unidade]')";
									$unidades = $db->selectQuery($sql);
									$cod_un_supervisao = $unidades[0]['un_supervisao'];
									$cod_un_atendimento = $unidades[0]['un_atendimento'];
									if($cod_un_supervisao != $_SESSION["cod_unidade"] && $cod_un_atendimento != $_SESSION["cod_unidade"]) {
										$somenteLeitura = true;
										$disabledAttr = "disabled";
									}
								}
							
								$trat_anterior = ($consultas[0]['tratamento_anterior']);			 
								$tempo_tratamento = $consultas[0]['tempo_tratamento_anterior'];
								$fc1 = ($consultas[0]['forma_clinica1']);
								$fc2 = ($consultas[0]['forma_clinica2']);
								$fc3 = ($consultas[0]['forma_clinica3']);
								$descoberta = ($consultas[0]['tipo_descoberta']);
								$unidade_recebido = ($consultas[0]['unidade_recebido']);
								$tempo_decorrido = $consultas[0]['tempo_inicio_sintomas'];
								$data_bac_escarro = $consultas[0]['data_escarro'];
								$resultado_bac_escarro = ($consultas[0]['resultado_escarro']);
								$outros = ($consultas[0]['outros']);
								$data_rx_torax = $consultas[0]['data_rx_torax'];
								$resultado_rx_torax = ($consultas[0]['resultado_rx_torax']);
								$data_rx_outro = $consultas[0]['data_rx_outro'];
								$resultado_rx_outro = ($consultas[0]['resultado_rx_outro']);
								$data_histopatologico = $consultas[0]['data_histopatologico'];
								$resultado_histopatologico = ($consultas[0]['resultado_histopatologico']);
								$data_necropsia = $consultas[0]['data_necropsia'];
								$resultado_necropsia = ($consultas[0]['resultado_necropsia']);
								$data_outros = $consultas[0]['data_outros'];
								$resultado_outros = ($consultas[0]['resultado_outros']);
								$da1 = ($consultas[0]['doenca_associada1']);
								$da2 = ($consultas[0]['doenca_associada2']);
								$da3 = ($consultas[0]['doenca_associada3']);
								$anti_hiv = ($consultas[0]['anti_hiv']);
								$data_trat_atual = $consultas[0]['data_tratamento_atual'];
								$tipo_trat = ($consultas[0]['tipo_tratamento_atual']);
								$droga = $consultas[0]['droga_tratamento'];
								$rifampicina = $consultas[0]['rifampicina'];
								$izoniazida = $consultas[0]['izoniazida'];
								$estreptomicina = $consultas[0]['estreptomicina'];
								$pirazinamida = $consultas[0]['pirazinamida'];
								$etambutol = $consultas[0]['etambutol'];
								$etionamida = $consultas[0]['etionamida'];
								$observacoes = ($consultas[0]['observacoes']);
								$cod_profissional = $consultas[0]['cod_profissional'];
								$cod_paciente = $consultas[0]['cod_paciente'];
								$data_bac_outro = $consultas[0]['data_outro'];
								$resultado_bac_outro = ($consultas[0]['resultado_outro']);
								$data_cultura_escarro = $consultas[0]['data_cultura_escarro'];
								$resultado_cultura_escarro = ($consultas[0]['resultado_cultura_escarro']);
								$data_cultura_outro = $consultas[0]['data_cultura_outro'];
								$resultado_cultura_outro = ($consultas[0]['resultado_cultura_outro']);
								$servico = ($consultas[0]['servico_descobriu']);
								$data_alta = $consultas[0]['data_alta_tratamento'];
								$alta = ($consultas[0]['motivo_alta']);
								$un_notificante = $consultas[0]['un_notificante'];
								$un_atendimento = $consultas[0]['un_atendimento'];
								$data_notificacao = $consultas[0]['data_notificacao'];
								$encerrado = $consultas[0]['encerrado'];
								$outro_profissional = ($consultas[0]['outro_profissional']);
								$outra_unidade_notificante = ($consultas[0]['outra_unidade']);
								$outra_unidade_recebe = ($consultas[0]['outra_unidade_recebe']);
								$rifambutina = $consultas[0]['rifambutina'];
								$resultado_tmrtb = ($consultas[0]['resultado_tmrtb']);
								$data_tmrtb = $consultas[0]['data_tmrtb'];
								$un_supervisao = $consultas[0]['un_supervisao'];
								$levofloxacina = $consultas[0]['levofloxacina'];
								$ofloxacina = $consultas[0]['ofloxacina'];
								
								$nome_un_not = ($consultas[0]['nome_un_not']);
								$nome_un_at = ($consultas[0]['nome_un_at']);
								$nome_un_sup = ($consultas[0]['nome_un_sup']);
								$nome_profissional = ($consultas[0]['nome_profissional']);
								
								$cpf = $consultas[0]['cpf'];
								$cns = $consultas[0]['cns'];
								$gestante = $consultas[0]['gestante'];
								$nome = $consultas[0]['nome'];
								$data_nasc = $consultas[0]['data_nascimento'];
								$idade = $consultas[0]['idade'];
								$sexo = $consultas[0]['sexo'];
								$mae = $consultas[0]['mae'];
								$endereco = $consultas[0]['endereco'];
								$telefone = $consultas[0]['telefone'];
								$cidade = $consultas[0]['cidade'];
								$estado = $consultas[0]['estado'];
								$escolaridade = $consultas[0]['escolaridade'];
								$tipo_ocupacao = $consultas[0]['tipo_ocupacao'];
								$ocupacao = $consultas[0]['ocupacao'];
								$obs = $consultas[0]['observacoesp'];
								$nro_prontuario = $consultas[0]['nro_prontuario'];
								$un_not = $consultas[0]['un_notificante'];
								$un_at = $consultas[0]['un_atendimento'];
								$naturalidade = $consultas[0]['naturalidade'];
								$etnia = $consultas[0]['etnia'];
								$sinan = $consultas[0]['sinan'];
								$nro_hygia = $consultas[0]['nro_hygia'];
									
								if($encerrado == "0") {
									$encerrado = "Năo";
								} else if ($encerrado == "1") {
									$encerrado = "Sim";
								} else {
									$encerrado = "";
								}

								$droga1 = "";
								if ($droga == "N") {
									$droga1 = "Năo";
								} else if ($droga == "S") {
									$droga1 = "Sim";
								}

								$rifampicina1 = "";
								if ($rifampicina == "N") {
									$rifampicina1 = "Năo";
								} else if ($rifampicina == "R") {
									$rifampicina1 = "Sim";
								}

								$izoniazida1 = "";
								if ($izoniazida == "N") {
									$izoniazida1 = "Năo";
								} else if ($izoniazida == "H") {
									$izoniazida1 = "Sim";
								}

								$estreptomicina1 = "";
								if ($estreptomicina == "N") {
									$estreptomicina1 = "Năo";
								} else if ($estreptomicina == "S") {
									$estreptomicina1 = "Sim";
								}

								$pirazinamida1 = "";
								if ($pirazinamida == "N") {
									$pirazinamida1 = "Năo";
								} else if ($pirazinamida == "Z") {
									$pirazinamida1 = "Sim";
								}

								$etambutol1 = "";
								if ($etambutol == "N") {
									$etambutol1 = "Năo";
								} else if ($etambutol == "E") {
									$etambutol1 = "Sim";
								}

								$etionamida1 = "";
								if ($etionamida == "N") {
									$etionamida1 = "Năo";
								} else if ($etionamida == "ET") {
									$etionamida1 = "Sim";
								}
								
								$rifambutina1 = "";
								if ($rifambutina == "N") {
									$rifambutina1 = "Năo";
								} else if ($rifambutina == "RB") {
									$rifambutina1 = "Sim";
								}
								
								$ofloxacina1 = "";
								if ($ofloxacina == "N") {
									$ofloxacina1 = "Năo";
								} else if ($ofloxacina == "OF") {
									$ofloxacina1 = "Sim";
								}
								
								$levofloxacina1 = "";
								if ($levofloxacina == "N") {
									$levofloxacina1 = "Năo";
								} else if ($levofloxacina == "LV") {
									$levofloxacina1 = "Sim";
								}                                
								
								if ($data_bac_escarro != NULL && $data_bac_escarro != "0000-00-00") {
									$data_bac_escarro1 = implode("/", array_reverse(explode("-", $data_bac_escarro)));
								} else if ($data_bac_escarro == "0000-00-00" || $data_bac_escarro == NULL) {
									$data_bac_escarro1 = "";
								}

								if ($data_rx_torax != NULL && $data_rx_torax != "0000-00-00") {
									$data_rx_torax1 = implode("/", array_reverse(explode("-", $data_rx_torax)));
								} else if ($data_rx_torax == "0000-00-00" || $data_rx_torax == NULL) {
									$data_rx_torax1 = "";
								}
								
								if ($data_rx_outro != NULL && $data_rx_outro != "0000-00-00") {
									$data_rx_outro1 = implode("/", array_reverse(explode("-", $data_rx_outro)));
								} else if ($data_rx_outro == "0000-00-00" || $data_rx_outro == NULL) {
									$data_rx_outro1 = "";
								}
								
								if ($data_histopatologico != NULL && $data_histopatologico != "0000-00-00") {
									$data_histopatologico1 = implode("/", array_reverse(explode("-", $data_histopatologico)));
								} else if ($data_histopatologico == "0000-00-00" || $data_histopatologico == NULL) {
									$data_histopatologico1 = "";
								}
							
								if ($data_necropsia != NULL && $data_necropsia != "0000-00-00") {
									$data_necropsia1 = implode("/", array_reverse(explode("-", $data_necropsia)));
								} else if ($data_necropsia == "0000-00-00" || $data_necropsia == NULL) {
									$data_necropsia1 = "";
								}
								
								if ($data_outros != NULL && $data_outros != "0000-00-00") {
									$data_outros1 = implode("/", array_reverse(explode("-", $data_outros)));
								} else if ($data_outros == "0000-00-00" || $data_outros == NULL) {
									$data_outros1 = "";
								}
								
								if ($data_trat_atual != NULL && $data_trat_atual != "0000-00-00") {
									$data_trat_atual1 = implode("/", array_reverse(explode("-", $data_trat_atual)));
								} else if ($data_trat_atual == "0000-00-00" || $data_trat_atual == NULL) {
									$data_trat_atual1 = "";
								}
								
								if ($data_bac_outro != NULL && $data_bac_outro != "0000-00-00") {
									$data_bac_outro1 = implode("/", array_reverse(explode("-", $data_bac_outro)));
								} else if ($data_bac_outro == "0000-00-00" || $data_bac_outro == NULL) {
									$data_bac_outro1 = "";
								}
								
								if ($data_cultura_escarro != NULL && $data_cultura_escarro != "0000-00-00") {
									$data_cultura_escarro1 = implode("/", array_reverse(explode("-", $data_cultura_escarro)));
								} else if ($data_cultura_escarro == "0000-00-00" || $data_cultura_escarro == NULL) {
									$data_cultura_escarro1 = "";
								}
								
								if ($data_cultura_outro != NULL && $data_cultura_outro != "0000-00-00") {
									$data_cultura_outro1 = implode("/", array_reverse(explode("-", $data_cultura_outro)));
								} else if ($data_cultura_outro == "0000-00-00" || $data_cultura_outro == NULL) {
									$data_cultura_outro1 = "";
								}
								
								if ($data_alta != NULL && $data_alta != "0000-00-00") {
									$data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
								} else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
									$data_alta1 = "";
								}
								
								if ($data_notificacao != NULL && $data_notificacao != "0000-00-00") {
									$data_notificacao1 = implode("/", array_reverse(explode("-", $data_notificacao)));
								} else if ($data_notificacao == "0000-00-00" || $data_notificacao == NULL) {
									$data_notificacao1 = "";
								}
								
								if ($data_tmrtb != NULL && $data_tmrtb != "0000-00-00") {
									$data_tmrtb1 = implode("/", array_reverse(explode("-", $data_tmrtb)));
								} else if ($data_tmrtb == "0000-00-00" || $data_tmrtb == NULL) {
									$data_tmrtb1 = "";
								}
							?>
								<!--<div style="display:none;">
									<div itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/paciente">
										<b>Nome do Paciente: </b><span itemprop="nome"><?= $nome; ?></span><br/>                                
										<b>Nro Hygia: </b><span itemprop="nro_hygia"><?= $nro_hygia; ?></span><br/>
										<b>Nro Sinan: </b><span itemprop="nro_sinan"><?= $sinan; ?></span><br/>
									</div>
									
									<br/>
									<b>Profissional responsável pelo tratamento: </b><?= $nome_profissional; ?><?= $outro_profissional; ?><br/>
									<br/>
									
									<div itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/Tratamento">
										<b>Data de notificaçăo: </b><span itemprop="data_notificacao"><?= $data_notificacao1; ?></span><br/>
										<b>Data de início do tratamento: </b><span itemprop="data_inicio_tratamento"><?= $data_trat_atual1; ?></span><br/>
										<b>Tipo de tratamento: </b><span itemprop="tipo_tratamento"><?= $tipo_trat; ?></span><br/>
										<b>Unidade notificante: </b><span itemprop="unidade_notificante"><?= $nome_un_not; ?></span> <span itemprop="unidade_notificante"><?= $outra_unidade_notificante; ?></span><br/>
										<b>Unidade de atendimento: </b><span itemprop="unidade_atendimento"><?= $nome_un_at; ?></span><br/>
										<b>Unidade de supervisăo: </b><span itemprop="unidade_supervisao"><?= $nome_un_sup; ?></span><br/>
										<b>Tratamento anterior: </b><span itemprop="tratamento_anterior"><?= $trat_anterior; ?></span><br/>
										<b>Se sim, tratou a quanto tempo: </b><span itemprop="tempo_tratamento_anterior"><?= $tempo_tratamento; ?></span><br/>
										
										<br/>									
										<b>Forma clinica: </b><span itemprop="forma_clinica"><?= $fc1; ?></span><br/><span itemprop="forma_clinica"><?= $fc2; ?></span><br/><span itemprop="forma_clinica"><?= $fc3; ?></span><br/>
										<b>Tipo de descoberta: </b><span itemprop="tipo_descoberta"><?= $descoberta; ?></span><br/>
										<b>Se encaminhado, foi recebido de unidade e/ou município: </b><span itemprop="recebido_unidade"><?= $unidade_recebido; ?></span> / <?= $outra_unidade_recebe; ?><br/>
										<b>Serviço que descobriu o caso: </b><span itemprop="servico_descoberta"><?= $servico; ?></span><br/>
										<b>Tempo decorrido do início dos sintomas ao tratamento: </b><span itemprop="tempo_inicio_sintomas"><?= $tempo_decorrido; ?></span><br/>
										<?php if ($encerrado == "Năo") { ?>
											<b>Status do tratamento: </b><b><font color="red"><span itemprop="estado_tratamento">Em andamento</span></font></b><br/>
										<?php } else if ($encerrado == "Sim") { ?>
											<b>Status do tratamento: </b><b><font color="green"><span itemprop="estado_tratamento">Encerrado</span></font></b><br/>
										<?php } else { ?>
											<b>Status do tratamento: </b><?= $encerrado; ?><br/>
										<?php } ?>
										<br/>

										<h2 class="title">Exames complementares:</h2>

										<b>Baciloscopia de escarro: </b>
										<?php if ($resultado_bac_escarro == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_baciloscopia_escarro"><?= $resultado_bac_escarro; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_baciloscopia_escarro"><?= $resultado_bac_escarro; ?></span>
											<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_baciloscopia_escarro"><?= $data_bac_escarro1; ?></span><br/>
										<b>Baciloscopia de outro material: </b>
										<?php if ($resultado_bac_outro == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_baciloscopia_outro_material"><?= $resultado_bac_outro; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_baciloscopia_outro_material"><?= $resultado_bac_outro; ?></span>
											<?php } ?>

										<b>Data do resultado: </b><span itemprop="data_baciloscopia_outro_material"><?= $data_bac_outro1; ?></span><br/>
										<b>Cultura de escarro: </b>
										<?php if ($resultado_cultura_escarro == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_cultura_escarro"><?= $resultado_cultura_escarro; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_cultura_escarro"><?= $resultado_cultura_escarro; ?></span>
											<?php } ?>

										<b>Data do resultado: </b><span itemprop="data_cultura_escarro"><?= $data_cultura_escarro1; ?></span><br/>
										<b>Cultura de outro material: </b>
										<?php if ($resultado_cultura_outro == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_cultura_outro_material"><?= $resultado_cultura_outro; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_cultura_outro_material"><?= $resultado_cultura_outro; ?></span>
											<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_cultura_outro_material"><?= $data_cultura_outro1; ?></span><br/>
										<b>RX de tórax: </b>
										<?php if ($resultado_rx_torax == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_rx_torax"><?= $resultado_rx_torax; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_rx_torax"><?= $resultado_rx_torax; ?></span>
											<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_rx_torax"><?= $data_rx_torax1; ?></span><br/>
										<b>RX outro: </b>
										<?php if ($resultado_rx_outro == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_rx_outro"><?= $resultado_rx_outro; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_rx_outro"><?= $resultado_rx_outro; ?></span>
											<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_rx_outro"><?= $data_rx_outro1; ?></span><br/>
										<b>Histopatológco: </b>
										<?php if ($resultado_histopatologico == "Em andamento") { ?>
											<font color="red"><span itemprop="resultado_histopatologico"><?= $resultado_histopatologico; ?></span></font><br/>
										<?php } else { ?>
											<span itemprop="resultado_histopatologico"><?= $resultado_histopatologico; ?></span>
										<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_histopatologico"><?= $data_histopatologico1; ?></span><br/>
										<b>Necrópsia: </b>
										<?php if ($resultado_necropsia == "Em andamento") { ?>
											<font color="red"><span itemprop="resultado_necropsia"><?= $resultado_necropsia; ?></span></font><br/>
										<?php } else { ?>
											<span itemprop="resultado_necropsia"><?= $resultado_necropsia; ?></span>
										<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_necropsia"><?= $data_necropsia1; ?></span><br/>
										<b>Outros exames: </b><span itemprop="outros_exames"><?= $outros; ?></span>
										<b>Resultado de outros exames: </b>
										<?php if ($resultado_outros == "Em andamento") { ?>
											<b><font color="red"><span itemprop="resultado_outro_exame"><?= $resultado_outros; ?></span></font></b><br/>
										<?php } else { ?>
												<span itemprop="resultado_outro_exame"><?= $resultado_outros; ?></span>
											<?php } ?>
										<b>Data do resultado: </b><span itemprop="data_outro_exame"><?= $data_outros1; ?></span><br/>
										<b>Teste molecular rápido: </b><span itemprop="resultado_teste_molecular_rapido"><?= $resultado_tmrtb; ?></span><br/>
																		
										<b>Doenças Associadas: </b><span itemprop="doenca_associada"><?= $da1; ?></span>, <span itemprop="doenca_associada"><?= $da2; ?></span>, <span itemprop="doenca_associada"><?= $da3; ?></span><br/>
										<b>Anti HIV: </b><span itemprop="anti_hiv"><?= $anti_hiv; ?></span><br/>
																	
										<br/>						
										<h2 class="title">Drogas do início do tratamento:</h2>
										<b>Drogas no início do tratamento: </b><span itemprop="droga_tratamento"><?= $droga1; ?></span><br/>
										<b>Rifampicina: </b><span itemprop="rifampicina"><?= $rifampicina1; ?></span><br/>
										<b>Izoniazida: </b><span itemprop="izoniazida"><?= $izoniazida1; ?></span><br/>
										<b>Estreptomicina: </b><span itemprop="estreptomicina"><?= $estreptomicina1; ?></span><br/>
										<b>Pirazinamida: </b><span itemprop="pirazinamida"><?= $pirazinamida1; ?></span><br/>
										<b>Etambutol: </b><span itemprop="etambutol"><?= $etambutol1; ?></span><br/>
										<b>Etionamida: </b><span itemprop="etionamida"><?= $etionamida1; ?></span><br/>
										<b>Rifambutina: </b><span itemprop="rifambutina"><?= $rifambutina1; ?></span><br/>
										<b>Levofloxacina: </b><span itemprop="levofloxacina"><?= $levofloxacina1; ?></span><br/>
										<b>Ofloxacina: </b><span itemprop="ofloxacina"><?= $ofloxacina1; ?></span><br/>
																		
										<br/>
										<h2 class="title">Alta do tratamento:</h2>
										<b>Tipo de Alta: </b><span itemprop="motivo_alta_tratamento"><?= $alta; ?></span><br/>
										<b>Data da alta: </b><span itemprop="data_alta_tratamento"><?= $data_alta1; ?></span><br/>
										<b>Observaçőes: </b><span itemprop="tratamento_observacoes"><?= $observacoes; ?></span><br/>
									</div>
								</div>-->						
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
                            <div class="box-3">
                                <form method="POST" class="validar" action="tratamento_post.php">
									<?php if (isset($cod_tratamento) && !$somenteLeitura) { ?>
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
																	
                                    <div style="width: 100%; height:100px;"> 
										<label for="cod_paciente">Paciente<span style="color:red;">*</span></label><br/>												
										<?php									
											$sql = "SELECT cod_paciente, nome, data_nascimento FROM paciente ORDER BY nome";
											$queryPacientes = $db->selectQuery($sql);
											if ($queryPacientes) {
												$disabled = "";
												if($cod_paciente != "") $disabled = "disabled";
												echo "<select name='cod_paciente' class='required js-example-basic-single' id='cod_paciente' style='width:650px;' $disabled>";
												echo "<option value=''></option>";
												foreach ($queryPacientes as $paciente) {
													$selected = "";
													if ($paciente["cod_paciente"] == $cod_paciente) $selected = "selected";
													$data_nascimento = implode("-", array_reverse(explode("-", $paciente['data_nascimento'])));
													echo "<option $selected value='$paciente[cod_paciente]'>".(strtoupper($paciente["nome"]))." / DN: $data_nascimento</option>";
												}
												echo "</select>";
											}
										?>																		
                                    </div>
                                    <div>
									<div  style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="cod_profissional">Médico responsável pelo tratamento<span style="color:red;">*</span></label><br/>
											<?php
											$select2 = "SELECT cod_profissional, nome FROM profissional WHERE ocupacao = 'Medico' ORDER BY nome";
											$query2 = $db->selectQuery($select2);
											if ($query2) {
												echo "<select name='cod_profissional' id='cod_profissional' onChange='visibilidadeCampos(this.value,\"outro_profissional_div\")' class='required' $disabledAttr>";
												echo "<option value=''></option>";
												foreach ($query2 as $prof) {
													$selected = "";
													if ($prof["cod_profissional"] == $cod_profissional) $selected = "selected";													
													echo "<option $selected value='".$prof['cod_profissional']."'>".(ucwords($prof['nome']))."</option>";
												}
												$selected = "";
												if ($outro_profissional != "") $selected = "selected";	
												echo "<option $selected value='Outro'>Outro</option>";
												echo "</select>";
											}
											?>
										 </div>
										 <div style="width: 30%; float:left; display:none;" id="outro_profissional_div">
											<label for="outro_profissional">Outro profissional<span style="color:red;">*</span></label><br/>
											<input id="outro_profissional" type="text" class="text small" name="outro_profissional" value="<?php echo (isset($outro_profissional)) ?  $outro_profissional : ""; ?>" <?=$disabledAttr?>/> 
										 </div>
									</div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="data_notificacao">Data de notificação (dd/mm/aaaa)<span style="color:red;">*</span></label><br/>
											<input type="text" class="text small data required" name="data_notificacao" id="data_notificacao" value="<?php echo (isset($data_notificacao1)) ?  $data_notificacao1 : ""; ?>" <?=$disabledAttr?>/> 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_trat_atual">Data de início do tratamento atual (dd/mm/aaaa)<span style="color:red;">*</span></label><br/>
											<input type="text" class="text small data required" name="data_trat_atual" id="data_trat_atual" value="<?php echo (isset($data_trat_atual1)) ?  $data_trat_atual1 : ""; ?>" <?=$disabledAttr?>/> 
										</div>
										<div style="width: 30%; float:left">
											<label for="tipo_trat">Tipo de tratamento</label><br/>
											<select name="tipo_trat" id="tipo_trat"> 
												<option value=""></option>
												<option <?php if (isset($tipo_trat) && $tipo_trat == "Auto administrado") echo "selected"; ?> value="Auto administrado">Auto administrado</option>
												<option <?php if (isset($tipo_trat) && $tipo_trat == "Supervisionado") echo "selected"; ?> value="Supervisionado">Supervisionado</option>
												<option <?php if (isset($tipo_trat) && $tipo_trat == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                     
											</select>	 
										</div>
                                    </div>                                    
									<div style="width: 100%; height:100px;">     
										<div style="width: 30%; float:left">
											<label for="un_notificante">Unidade notificante</label><br/>
											<?php     
												$selectUn = "SELECT cod_unidade, nome, cidade FROM unidade ORDER BY cidade, nome";
												$queryUn = $db->selectQuery($selectUn);
												if ($queryUn) {
													echo "<select name='un_notificante' id='un_notificante' onChange=\"visibilidadeCampos(this.value,'outra_unidade_div')\">";
													echo "<option value=''></option>";
													 foreach ($queryUn as $un) {
														$selected = "";
														if ($un["cod_unidade"] == $un_notificante) $selected = "selected";
														echo "<option $selected value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper($un['nome']))."</option>";
													}
													echo "</select>";
												}
											?>
										</div>
										<div style="width: 30%; float:left; display:none;" id="outra_unidade_div">
											<label for="outra_unidade_notificante">Unidade notificante - outra<span style="color:red;">*</span></label><br/>
											<input type="text" class="text small" name="outra_unidade_notificante" id="outra_unidade_notificante" value="<?php echo (isset($outra_unidade_notificante)) ?  $outra_unidade_notificante : ""; ?>" <?=$disabledAttr?>/> 
										</div>
									</div>
								    <div style="width: 100%; height:100px;">     
										<div  style="width: 30%; float:left">
											<label for="un_supervisao">Unidade de Supervisão<span style="color:red;">*</span>:</label><br/>
											<?php
												if ($queryUn) {
													echo "<select name='un_supervisao' id='un_supervisao' class='required'>";
													echo "<option value=''></option>";
													 foreach ($queryUn as $un) {
														$selected = "";
														if ($un["cod_unidade"] == $un_supervisao) $selected = "selected";
														echo "<option $selected value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper($un['nome']))."</option>";
													}
													echo "</select>";
												}
											?>
										</div>
										<div  style="width: 30%; float:left">
											<label for="un_atendimento">Unidade de atendimento<span style="color:red;">*</span></label><br/>
											<?php
												if ($queryUn) {
													echo "<select name='un_atendimento' id='un_atendimento'class='required'>";
													echo "<option value=''></option>";
													 foreach ($queryUn as $un) {
														$selected = "";
														if ($un["cod_unidade"] == $un_atendimento) $selected = "selected";
														echo "<option $selected value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper($un['nome']))."</option>";
													}
													echo "</select>";
												}
											?>
										</div>
									</div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="trat_anterior">Tratamento anterior</label><br/>
											<select name="trat_anterior" onChange="visibilidadeCampos(this.value,'tempo_tratamento_div')" id="trat_anterior"> 
												<option value=""></option>
												<option <?php if (isset($trat_anterior) && $trat_anterior == "Não Tratou") echo "selected"; ?> value="Não Tratou">Não Tratou</option>
												<option <?php if (isset($trat_anterior) && $trat_anterior == "Sim, alta cura") echo "selected"; ?> value="Sim, alta cura">Sim, alta cura</option>
												<option <?php if (isset($trat_anterior) && $trat_anterior == "Sim, alta abandono") echo "selected"; ?> value="Sim, alta abandono">Sim, alta abandono</option>
												<option <?php if (isset($trat_anterior) && $trat_anterior == "Não sabe") echo "selected"; ?> value="Não sabe">Não sabe</option> 
												<option <?php if (isset($trat_anterior) && $trat_anterior == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>
											</select>				
										</div>
										<div style="width: 30%; float:left; display:none;" id="tempo_tratamento_div">
											<label for="tempo_tratamento">Tratou há quanto tempo?<span style="color:red;">*</span></label><br/>
											<input type="text" class="text small" name="tempo_tratamento" id="tempo_tratamento" value="<?php echo (isset($tempo_tratamento)) ?  $tempo_tratamento : ""; ?>" <?=$disabledAttr?>/> 
										</div>
										<div style="width: 30%; float:left;">
											<label for="tempo_decorrido">Tempo decorrido do início dos sintomas ao tratamento, em semanas<span style="color:red;">*</span></label><br/>
											<input type="number" class="text small" name="tempo_decorrido" id="tempo_decorrido" class="required" value="<?php echo (isset($tempo_decorrido)) ?  $tempo_decorrido : ""; ?>" <?=$disabledAttr?>/> 
										</div>
									</div>	
									
									<h2 class="title">Descoberta</h2>
									<div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="descoberta">Tipo de Descoberta</label><br/>
											<select name="descoberta" id="descoberta" onChange="visibilidadeCampos(this.value,'recebido_div')"> 
												<option value=""></option>
												<option <?php if (isset($descoberta) && $descoberta == "Apres. espontânea com sintomas respiratórios") echo "selected"; ?> value="Apres. espontânea com sintomas respiratórios">Apres. espontânea com sintomas respiratórios</option>
												<option <?php if (isset($descoberta) && $descoberta == "Apres. espontânea por outros motivos") echo "selected"; ?> value="Apres. espontânea por outros motivos">Apres. espontânea por outros motivos</option>
												<option <?php if (isset($descoberta) && $descoberta == "Encaminhado com suspeita ou diagnóstico de TB") echo "selected"; ?> value="Encaminhado com suspeita ou diagnóstico de TB">Encaminhado com suspeita ou diagnóstico de TB</option>
												<option <?php if (isset($descoberta) && $descoberta == "Controle de comunicantes") echo "selected"; ?> value="Controle de comunicantes">Controle de comunicantes</option> 
												<option <?php if (isset($descoberta) && $descoberta == "Descoberto após óbito") echo "selected"; ?> value="Descoberto após óbito">Descoberto após óbito</option>   
											</select>				
										</div>
										<div style="width: 30%; float:left">
											<label for="servico">Serviço que descobriu o caso:</label><br/>
											<select name="servico" id="servico" class="required"> 
												<option value=""></option>
												<option <?php if (isset($servico) && $servico == "Ambulatório de referência") echo "selected"; ?> value="Ambulatório de referência">Ambulatório de referência</option>
												<option <?php if (isset($servico) && $servico == "Pronto atendimento") echo "selected"; ?> value="Pronto atendimento">Pronto atendimento</option>
												<option <?php if (isset($servico) && $servico == "Ambulatório privado") echo "selected"; ?> value="Ambulatório privado">Ambulatório privado</option>
												<option <?php if (isset($servico) && $servico == "Hospital público") echo "selected"; ?> value="Hospital público">Hospital público</option> 
												<option <?php if (isset($servico) && $servico == "Hospital privado") echo "selected"; ?> value="Hospital privado">Hospital privado</option>
												<option <?php if (isset($servico) && $servico == "Atenção básica") echo "selected"; ?> value="Atenção básica">Atenção básica</option> 
												<option <?php if (isset($servico) && $servico == "Outro") echo "selected"; ?> value="Outro">Outro</option>   
												<option <?php if (isset($servico) && $servico == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>     
											</select>				
										</div>
									</div>
									<div style="width: 100%; height:100px; display:none;" id="recebido_div">   
										<div style="width: 30%; float:left">
											<label for="unidade_recebido">Paciente proveniente de:</label><br/>
											<?php
												if ($queryUn) {
													echo "<select name='unidade_recebido' id='unidade_recebido' onChange=\"visibilidadeCampos(this.value,'outra_unidade_recebe_div')\">";
													echo "<option value=''></option>";
													 foreach ($queryUn as $un) {
														$selected = "";
														if ($un["cod_unidade"] == $unidade_recebido) $selected = "selected"; 
														echo "<option $selected  value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper($un['nome']))."</option>";
													}
													echo "</select>";
												}
											?>
										</div>
										<div style="width: 30%; float:left; display:none;" id="outra_unidade_recebe_div">
											<label for="outra_unidade_recebe">Outra unidade e/ou município</label><br/>
											<input type="text" class="text small" name="outra_unidade_recebe" id="outra_unidade_recebe" value="<?php echo (isset($outra_unidade_recebe)) ?  $outra_unidade_recebe : ""; ?>" <?=$disabledAttr?>/>
										</div>    
                                    </div>
									
									<h2 class="title">Forma Clínica</h2>
									<div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="fc1">Forma Clínica</label><br/>
											<select name="fc1" id="fc1"> 
												<option value=""></option>
												<option <?php if (isset($fc1) && $fc1 == "Pulmonar") echo "selected"; ?> value="Pulmonar">Pulmonar</option>
												<option <?php if (isset($fc1) && $fc1 == "Meningite") echo "selected"; ?> value="Meningite">Meningite</option>
												<option <?php if (isset($fc1) && $fc1 == "Sistema Nervoso Central") echo "selected"; ?> value="Sistema Nervoso Central">Sistema Nervoso Central</option>
												<option <?php if (isset($fc1) && $fc1 == "Pericárdia") echo "selected"; ?> value="Pericárdia">Pericardia</option>
												<option <?php if (isset($fc1) && $fc1 == "Genitourinária") echo "selected"; ?> value="Genitourinária">Genitourinária</option>
												<option <?php if (isset($fc1) && $fc1 == "Ocular") echo "selected"; ?> value="Ocular">Ocular</option>
												<option <?php if (isset($fc1) && $fc1 == "Otorrinolaringológica") echo "selected"; ?> value="Otorrinolaringológica">Otorrinolaringológica</option>
												<option <?php if (isset($fc1) && $fc1 == "Mamária") echo "selected"; ?> value="Mamária">Mamária</option>
												<option <?php if (isset($fc1) && $fc1 == "Nasal") echo "selected"; ?> value="Nasal">Nasal</option>
												<option <?php if (isset($fc1) && $fc1 == "Laríngea") echo "selected"; ?> value="Laríngea">Laríngea</option>
												<option <?php if (isset($fc1) && $fc1 == "Pleural") echo "selected"; ?> value="Pleural">Pleural</option>
												<option <?php if (isset($fc1) && $fc1 == "Glang. Periférica") echo "selected"; ?> value="Glang. Periférica">Glang. Periférica</option> 
												<option <?php if (isset($fc1) && $fc1 == "Óssea") echo "selected"; ?> value="Óssea">Óssea</option>                                            
												<option <?php if (isset($fc1) && $fc1 == "Vias Urinárias") echo "selected"; ?> value="Vias Urinárias">Vias Urinárias</option>
												<option <?php if (isset($fc1) && $fc1 == "Genital") echo "selected"; ?> value="Genital">Genital</option>
												<option <?php if (isset($fc1) && $fc1 == "Intestinal") echo "selected"; ?> value="Intestinal">Intestinal</option>
												<option <?php if (isset($fc1) && $fc1 == "Oftalmica") echo "selected"; ?> value="Oftalmica">Oftálmica</option> 
												<option <?php if (isset($fc1) && $fc1 == "Pele") echo "selected"; ?> value="Pele">Pele</option>                      
												<option <?php if (isset($fc1) && $fc1 == "Laringe") echo "selected"; ?> value="Laringe">Laringe</option>
												<option <?php if (isset($fc1) && $fc1 == "Miliar") echo "selected"; ?> value="Miliar">Miliar</option>
												<option <?php if (isset($fc1) && $fc1 == "Outras") echo "selected"; ?> value="Outras">Outras</option>
												<option <?php if (isset($fc1) && $fc1 == "Disseminada") echo "selected"; ?> value="Disseminada">Disseminada</option> 
												<option <?php if (isset($fc1) && $fc1 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>
											</select>				
										</div>
										<div style="width: 30%; float:left">
											<label for="fc2">Forma Clínica 2</label><br/>
											<select name="fc2" id="fc2"> 
												<option value="" ></option>
												<option <?php if (isset($fc2) && $fc2 == "Pulmonar") echo "selected"; ?> value="Pulmonar">Pulmonar</option>
												<option <?php if (isset($fc2) && $fc2 == "Meningite") echo "selected"; ?> value="Meningite">Meningite</option>
												<option <?php if (isset($fc2) && $fc2 == "Sistema Nervoso Central") echo "selected"; ?> value="Sistema Nervoso Central">Sistema Nervoso Central</option>
												<option <?php if (isset($fc2) && $fc2 == "Pericárdia") echo "selected"; ?> value="Pericárdia">Pericardia</option>
												<option <?php if (isset($fc2) && $fc2 == "Genitourinária") echo "selected"; ?> value="Genitourinária">Genitourinária</option>
												<option <?php if (isset($fc2) && $fc2 == "Ocular") echo "selected"; ?> value="Ocular">Ocular</option>
												<option <?php if (isset($fc2) && $fc2 == "Otorrinolaringológica") echo "selected"; ?> value="Otorrinolaringológica">Otorrinolaringológica</option>
												<option <?php if (isset($fc2) && $fc2 == "Mamária") echo "selected"; ?> value="Mamária">Mamária</option>
												<option <?php if (isset($fc2) && $fc2 == "Nasal") echo "selected"; ?> value="Nasal">Nasal</option>
												<option <?php if (isset($fc2) && $fc2 == "Laríngea") echo "selected"; ?> value="Laríngea">Laríngea</option>
												<option <?php if (isset($fc2) && $fc2 == "Pleural") echo "selected"; ?> value="Pleural">Pleural</option>
												<option <?php if (isset($fc2) && $fc2 == "Glang. Periférica") echo "selected"; ?> value="Glang. Periférica">Glang. Periférica</option> 
												<option <?php if (isset($fc2) && $fc2 == "Óssea") echo "selected"; ?> value="Óssea">Óssea</option>                                            
												<option <?php if (isset($fc2) && $fc2 == "Vias Urinárias") echo "selected"; ?> value="Vias Urinárias">Vias Urinárias</option>
												<option <?php if (isset($fc2) && $fc2 == "Genital") echo "selected"; ?> value="Genital">Genital</option>
												<option <?php if (isset($fc2) && $fc2 == "Intestinal") echo "selected"; ?> value="Intestinal">Intestinal</option>
												<option <?php if (isset($fc2) && $fc2 == "Oftalmica") echo "selected"; ?> value="Oftalmica">Oftálmica</option> 
												<option <?php if (isset($fc2) && $fc2 == "Pele") echo "selected"; ?> value="Pele">Pele</option>                      
												<option <?php if (isset($fc2) && $fc2 == "Laringe") echo "selected"; ?> value="Laringe">Laringe</option>
												<option <?php if (isset($fc2) && $fc2 == "Miliar") echo "selected"; ?> value="Miliar">Miliar</option>
												<option <?php if (isset($fc2) && $fc2 == "Outras") echo "selected"; ?> value="Outras">Outras</option>
												<option <?php if (isset($fc2) && $fc2 == "Disseminada") echo "selected"; ?> value="Disseminada">Disseminada</option> 
												<option <?php if (isset($fc2) && $fc2 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>
											</select>				
										</div>
										<div style="width: 30%; float:left">
											<label for="fc3">Forma Clínica 3</label><br/>
											<select name="fc3" id="fc3"> 
												<option value="" ></option>
												<option <?php if (isset($fc3) && $fc3 == "Pulmonar") echo "selected"; ?> value="Pulmonar">Pulmonar</option>
												<option <?php if (isset($fc3) && $fc3 == "Meningite") echo "selected"; ?> value="Meningite">Meningite</option>
												<option <?php if (isset($fc3) && $fc3 == "Sistema Nervoso Central") echo "selected"; ?> value="Sistema Nervoso Central">Sistema Nervoso Central</option>
												<option <?php if (isset($fc3) && $fc3 == "Pericárdia") echo "selected"; ?> value="Pericárdia">Pericardia</option>
												<option <?php if (isset($fc3) && $fc3 == "Genitourinária") echo "selected"; ?> value="Genitourinária">Genitourinária</option>
												<option <?php if (isset($fc3) && $fc3 == "Ocular") echo "selected"; ?> value="Ocular">Ocular</option>
												<option <?php if (isset($fc3) && $fc3 == "Otorrinolaringológica") echo "selected"; ?> value="Otorrinolaringológica">Otorrinolaringológica</option>
												<option <?php if (isset($fc3) && $fc3 == "Mamária") echo "selected"; ?> value="Mamária">Mamária</option>
												<option <?php if (isset($fc3) && $fc3 == "Nasal") echo "selected"; ?> value="Nasal">Nasal</option>
												<option <?php if (isset($fc3) && $fc3 == "Laríngea") echo "selected"; ?> value="Laríngea">Laríngea</option>
												<option <?php if (isset($fc3) && $fc3 == "Pleural") echo "selected"; ?> value="Pleural">Pleural</option>
												<option <?php if (isset($fc3) && $fc3 == "Glang. Periférica") echo "selected"; ?> value="Glang. Periférica">Glang. Periférica</option> 
												<option <?php if (isset($fc3) && $fc3 == "Óssea") echo "selected"; ?> value="Óssea">Óssea</option>                                            
												<option <?php if (isset($fc3) && $fc3 == "Vias Urinárias") echo "selected"; ?> value="Vias Urinárias">Vias Urinárias</option>
												<option <?php if (isset($fc3) && $fc3 == "Genital") echo "selected"; ?> value="Genital">Genital</option>
												<option <?php if (isset($fc3) && $fc3 == "Intestinal") echo "selected"; ?> value="Intestinal">Intestinal</option>
												<option <?php if (isset($fc3) && $fc3 == "Oftalmica") echo "selected"; ?> value="Oftalmica">Oftálmica</option> 
												<option <?php if (isset($fc3) && $fc3 == "Pele") echo "selected"; ?> value="Pele">Pele</option>                      
												<option <?php if (isset($fc3) && $fc3 == "Laringe") echo "selected"; ?> value="Laringe">Laringe</option>
												<option <?php if (isset($fc3) && $fc3 == "Miliar") echo "selected"; ?> value="Miliar">Miliar</option>
												<option <?php if (isset($fc3) && $fc3 == "Outras") echo "selected"; ?> value="Outras">Outras</option>
												<option <?php if (isset($fc3) && $fc3 == "Disseminada") echo "selected"; ?> value="Disseminada">Disseminada</option> 
												<option <?php if (isset($fc3) && $fc3 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>
											</select>				
										</div>  
									</div>
									
									<h2 class="title">Exames complementares</h2>
                                    <div style="width: 100%; height:100px;">
                                        <div style="width: 30%; float:left">
											<label for="resultado_bac_escarro">Baciloscopia de escarro:</label><br/>
											<select name="resultado_bac_escarro" id="resultado_bac_escarro"> 
												<option value=""></option>
												<option <?php if (isset($resultado_bac_escarro) && $resultado_bac_escarro == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($resultado_bac_escarro) && $resultado_bac_escarro == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($resultado_bac_escarro) && $resultado_bac_escarro == "Em andamento") echo "selected"; ?> value="Em andamento">Em andamento</option>
												<option <?php if (isset($resultado_bac_escarro) && $resultado_bac_escarro == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option> 
												<option <?php if (isset($resultado_bac_escarro) && $resultado_bac_escarro == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                          
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_bac_escarro">Data do Resultado - bac. escarro (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_bac_escarro" id="data_bac_escarro" value="<?php echo (isset($data_bac_escarro1)) ?  $data_bac_escarro1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="resultado_bac_outro">Baciloscopia - outro material</label><br/>
											<select name="resultado_bac_outro" id="resultado_bac_outro"> 
												<option value=""></option>
												<option <?php if (isset($resultado_bac_outro) && $resultado_bac_outro == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($resultado_bac_outro) && $resultado_bac_outro == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($resultado_bac_outro) && $resultado_bac_outro == "Em andamento") echo "selected"; ?> value="Em andamento">Em andamento</option>
												<option <?php if (isset($resultado_bac_outro) && $resultado_bac_outro == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option> 
												<option <?php if (isset($resultado_bac_outro) && $resultado_bac_outro == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                             
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_bac_outro">Data do Resultado - bac. outro material (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_bac_outro" id="data_bac_outro" value="<?php echo (isset($data_bac_outro1)) ?  $data_bac_outro1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div  style="width: 30%; float:left">
                                        <label for="resultado_cultura_escarro">Cultura de escarro</label><br/>
											<select name="resultado_cultura_escarro" id="resultado_cultura_escarro"> 
												<option value=""></option>
												<option <?php if (isset($resultado_cultura_escarro) && $resultado_cultura_escarro == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($resultado_cultura_escarro) && $resultado_cultura_escarro == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($resultado_cultura_escarro) && $resultado_cultura_escarro == "Em andamento") echo "selected"; ?> value="Em andamento">Em andamento</option>
												<option <?php if (isset($resultado_cultura_escarro) && $resultado_cultura_escarro == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option> 
												<option <?php if (isset($resultado_cultura_escarro) && $resultado_cultura_escarro == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                            
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_cultura_escarro">Data do Resultado - cultura de escarro (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_cultura_escarro" id="data_cultura_escarro" value="<?php echo (isset($data_cultura_escarro)) ?  $data_cultura_escarro : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="resultado_cultura_outro">Cultura outro material</label><br/>
											<select name="resultado_cultura_outro" id="resultado_cultura_outro"> 
												<option value=""></option>
												<option <?php if (isset($resultado_cultura_outro) && $resultado_cultura_outro == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($resultado_cultura_outro) && $resultado_cultura_outro == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($resultado_cultura_outro) && $resultado_cultura_outro == "Em andamento") echo "selected"; ?> value="Em andamento">Em andamento</option>
												<option <?php if (isset($resultado_cultura_outro) && $resultado_cultura_outro == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option> 
												<option <?php if (isset($resultado_cultura_outro) && $resultado_cultura_outro == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                           
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_cultura_outro">Data do Resultado - cult. outro(dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_cultura_outro" id="data_cultura_outro" value="<?php echo (isset($data_cultura_outro1)) ?  $data_cultura_outro1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div  style="width: 30%; float:left">
											<label for="resultado_rx_torax">RX de tórax</label><br/>
											<select name="resultado_rx_torax" id="resultado_rx_torax"> 
												<option value=""></option>
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Normal") echo "selected"; ?> value="Normal">Normal</option>
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Suspeita de TB") echo "selected"; ?> value="Suspeita de TB">Suspeita de TB</option>
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Suspeita de TB com caverna") echo "selected"; ?> value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Outras afecções") echo "selected"; ?> value="Outras afecções">Outras afecções</option> 
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option>         
												<option <?php if (isset($resultado_rx_torax) && $resultado_rx_torax == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option> 
											</select>	 
										</div>                                   
										<div style="width: 30%; float:left">
											<label for="data_rx_torax">Data do Resultado - rx. tórax (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_rx_torax" id="data_rx_torax" value="<?php echo (isset($data_rx_torax1)) ?  $data_rx_torax1 : ""; ?>" <?=$disabledAttr?>/>
										</div>   
                                   </div>
                                   <div style="width: 100%; height:100px;">
                                     <div style="width: 30%; float:left">
                                        <label for="resultado_rx_outro">RX - outro</label><br/>
                                        <select name="resultado_rx_outro" id="resultado_rx_outro"> 
                                            <option value=""></option>
                                            <option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Normal") echo "selected"; ?> value="Normal">Normal</option>
											<option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Suspeita de TB") echo "selected"; ?> value="Suspeita de TB">Suspeita de TB</option>
											<option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Suspeita de TB com caverna") echo "selected"; ?> value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
											<option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Outras afecções") echo "selected"; ?> value="Outras afecções">Outras afecções</option> 
											<option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option>         
											<option <?php if (isset($resultado_rx_outro) && $resultado_rx_outro == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                          
                                        </select>	 
                                     </div>
                                     <div style="width: 30%; float:left">
                                        <label for="data_rx_outro">Data do Resultado - rx. outro (dd/mm/aaaa)</label><br/>
                                        <input type="text" class="text small data" name="data_rx_outro" id="data_rx_outro" value="<?php echo (isset($data_rx_outro1)) ?  $data_rx_outro1 : ""; ?>" <?=$disabledAttr?>/>
                                     </div>
                                   </div>
                                   <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="resultado_histopatologico">Histopatológico</label><br/>
											<select name="resultado_histopatologico" id="resultado_histopatologico"> 
												<option value=""></option>
												<option <?php if (isset($resultado_histopatologico) && $resultado_histopatologico == "Sugestivo de TB") echo "selected"; ?> value="Sugestivo de TB">Sugestivo de TB</option>
												<option <?php if (isset($resultado_histopatologico) && $resultado_histopatologico == "Não sugestivo TB") echo "selected"; ?> value="Não sugestivo TB">Não sugestivo TB</option>
												<option <?php if (isset($resultado_histopatologico) && $resultado_histopatologico == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option>
												<option <?php if (isset($resultado_histopatologico) && $resultado_histopatologico == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                          
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_histopatologico">Data do Resultado - hist. (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_histopatologico" id="data_histopatologico" value="<?php echo (isset($data_histopatologico1)) ?  $data_histopatologico1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                   </div>
                                   <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="resultado_necropsia">Necrópsia</label><br/>
											<select name="resultado_necropsia" id="resultado_necropsia"> 
												<option value=""></option>
												<option <?php if (isset($resultado_necropsia) && $resultado_necropsia == "Sugestivo de TB") echo "selected"; ?> value="Sugestivo de TB">Sugestivo de TB</option>
												<option <?php if (isset($resultado_necropsia) && $resultado_necropsia == "Não sugestivo TB") echo "selected"; ?> value="Não sugestivo TB">Não sugestivo TB</option>
												<option <?php if (isset($resultado_necropsia) && $resultado_necropsia == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option>
												<option <?php if (isset($resultado_necropsia) && $resultado_necropsia == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                          
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_necropsia">Data do Resultado - necropsia (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_necropsia" id="data_necropsia" value="<?php echo (isset($data_necropsia1)) ?  $data_necropsia1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
									</div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="outros">Outros Exames - Especificar</label><br/>
											<input type="text" class="text small" name="outros" id="outros" value="<?php echo (isset($outros)) ?  $outros : ""; ?>" <?=$disabledAttr?>/> 
										</div>
										<div  style="width: 30%; float:left">
											<label for="resultado_outros">Outros Exames - Resultado</label><br/>
											<input type="text" class="text small" name="resultado_outros" id="resultado_outros" value="<?php echo (isset($resultado_outros)) ?  $resultado_outros : ""; ?>" <?=$disabledAttr?>/> 
										</div>
										<div  style="width: 30%; float:left">
											<label for="data_outros">Data do Resultado - Outros Exames (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_outros" id="data_outros" value="<?php echo (isset($data_outros1)) ?  $data_outros1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="resultado_tmrtb">Teste molecular rápido para TB (TMR-TB)</label><br/>
											<select name="resultado_tmrtb" id="resultado_tmrtb"> 
												<option value=""></option>
												<option <?php if (isset($resultado_tmrtb) && $resultado_tmrtb == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($resultado_tmrtb) && $resultado_tmrtb == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($resultado_tmrtb) && $resultado_tmrtb == "Indeterminado") echo "selected"; ?> value="Indeterminado">Indeterminado</option>       
												<option <?php if (isset($resultado_tmrtb) && $resultado_tmrtb == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option>
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="data_tmrtb">Data do Resultado - TMR-TB (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_tmrtb" id="data_tmrtb" value="<?php echo (isset($data_tmrtb1)) ?  $data_tmrtb1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
                                     </div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="da1">Doenças associadas</label><br/>
											<select name="da1" id="da1"> 
												<option value=""></option>
												<option <?php if (isset($da1) && $da1 == "AIDS") echo "selected"; ?> value="AIDS">AIDS</option>
												<option <?php if (isset($da1) && $da1 == "Diabetes") echo "selected"; ?> value="Diabetes">Diabetes</option>
												<option <?php if (isset($da1) && $da1 == "Alcoolismo") echo "selected"; ?> value="Alcoolismo">Alcoolismo</option>
												<option <?php if (isset($da1) && $da1 == "Tabagismo") echo "selected"; ?> value="Tabagismo">Tabagismo</option>
												<option <?php if (isset($da1) && $da1 == "Hipertensão") echo "selected"; ?> value="Hipertensão">Hipertensão</option>
												<option <?php if (isset($da1) && $da1 == "Câncer") echo "selected"; ?> value="Câncer">Câncer</option>
												<option <?php if (isset($da1) && $da1 == "Doença Mental") echo "selected"; ?> value="Doença Mental">Doença Mental</option>   
												<option <?php if (isset($da1) && $da1 == "Drogadição") echo "selected"; ?> value="Drogadição">Drogadição</option> 
												<option <?php if (isset($da1) && $da1 == "Outra Imunossupressão") echo "selected"; ?> value="Outra Imunossupressão">Outra Imunossupressão</option> 
												<option <?php if (isset($da1) && $da1 == "Outra") echo "selected"; ?> value="Outra">Outra</option>
												<option <?php if (isset($da1) && $da1 == "Nenhuma") echo "selected"; ?> value="Nenhuma">Nenhuma</option>
												<option <?php if (isset($da1) && $da1 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                     
											</select>	 
										</div>
										<div style="width: 30%; float:left">
											<label for="da2">Doenças associadas 2</label><br/>
											<select name="da2" id="da2"> 
												<option value=""></option>
												<option <?php if (isset($da2) && $da2 == "AIDS") echo "selected"; ?> value="AIDS">AIDS</option>
												<option <?php if (isset($da2) && $da2 == "Diabetes") echo "selected"; ?> value="Diabetes">Diabetes</option>
												<option <?php if (isset($da2) && $da2 == "Alcoolismo") echo "selected"; ?> value="Alcoolismo">Alcoolismo</option>
												<option <?php if (isset($da2) && $da2 == "Tabagismo") echo "selected"; ?> value="Tabagismo">Tabagismo</option>
												<option <?php if (isset($da2) && $da2 == "Hipertensão") echo "selected"; ?> value="Hipertensão">Hipertensão</option>
												<option <?php if (isset($da2) && $da2 == "Câncer") echo "selected"; ?> value="Câncer">Câncer</option>
												<option <?php if (isset($da2) && $da2 == "Doença Mental") echo "selected"; ?> value="Doença Mental">Doença Mental</option>   
												<option <?php if (isset($da2) && $da2 == "Drogadição") echo "selected"; ?> value="Drogadição">Drogadição</option> 
												<option <?php if (isset($da2) && $da2 == "Outra Imunossupressão") echo "selected"; ?> value="Outra Imunossupressão">Outra Imunossupressão</option> 
												<option <?php if (isset($da2) && $da2 == "Outra") echo "selected"; ?> value="Outra">Outra</option>
												<option <?php if (isset($da2) && $da2 == "Nenhuma") echo "selected"; ?> value="Nenhuma">Nenhuma</option>
												<option <?php if (isset($da2) && $da2 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>  												                    
											</select>		 
										</div>
										<div style="width: 30%; float:left">
											<label for="da3">Doenças associadas 3</label><br/>
											<select name="da3" id="da3"> 
												<option value=""></option>
												<option <?php if (isset($da3) && $da3 == "AIDS") echo "selected"; ?> value="AIDS">AIDS</option>
												<option <?php if (isset($da3) && $da3 == "Diabetes") echo "selected"; ?> value="Diabetes">Diabetes</option>
												<option <?php if (isset($da3) && $da3 == "Alcoolismo") echo "selected"; ?> value="Alcoolismo">Alcoolismo</option>
												<option <?php if (isset($da3) && $da3 == "Tabagismo") echo "selected"; ?> value="Tabagismo">Tabagismo</option>
												<option <?php if (isset($da3) && $da3 == "Hipertensão") echo "selected"; ?> value="Hipertensão">Hipertensão</option>
												<option <?php if (isset($da3) && $da3 == "Câncer") echo "selected"; ?> value="Câncer">Câncer</option>
												<option <?php if (isset($da3) && $da3 == "Doença Mental") echo "selected"; ?> value="Doença Mental">Doença Mental</option>   
												<option <?php if (isset($da3) && $da3 == "Drogadição") echo "selected"; ?> value="Drogadição">Drogadição</option> 
												<option <?php if (isset($da3) && $da3 == "Outra Imunossupressão") echo "selected"; ?> value="Outra Imunossupressão">Outra Imunossupressão</option> 
												<option <?php if (isset($da3) && $da3 == "Outra") echo "selected"; ?> value="Outra">Outra</option>
												<option <?php if (isset($da3) && $da3 == "Nenhuma") echo "selected"; ?> value="Nenhuma">Nenhuma</option>
												<option <?php if (isset($da3) && $da3 == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                   
											</select>	 
										</div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="anti_hiv">Anti HIV</label><br/>
											<select name="anti_hiv" id="anti_hiv"> 
												<option value=""></option>
												<option <?php if (isset($anti_hiv) && $anti_hiv == "Positivo") echo "selected"; ?> value="Positivo">Positivo</option>
												<option <?php if (isset($anti_hiv) && $anti_hiv == "Negativo") echo "selected"; ?> value="Negativo">Negativo</option>
												<option <?php if (isset($anti_hiv) && $anti_hiv == "Em andamento") echo "selected"; ?> value="Em andamento">Em andamento</option>
												<option <?php if (isset($anti_hiv) && $anti_hiv == "Não realizado") echo "selected"; ?> value="Não realizado">Não realizado</option> 
												<option <?php if (isset($anti_hiv) && $anti_hiv == "Sem informação") echo "selected"; ?> value="Sem informação">Sem informação</option>                     
											</select>	 
										</div>
                                    </div>

									<h2 class="title">Drogas</h2>
									<div style="width: 100%; height:100px;">
										<label for="droga">Drogas no início do tratamento?<span style="color:red;">*</span></label><br/>
										<select name="droga" id="droga" onChange="visibilidadeCampos(this.value,'drogas_div')"> 
											<option value=""></option>
											<option <?php if (isset($droga) && $droga == "S") echo "selected"; ?> value="S">Sim</option>
											<option <?php if (isset($droga) && $droga == "N") echo "selected"; ?> value="N">Não</option>                 
										</select>
									</div>
									<div id="drogas_div" style="display:none;">
										<div style="width: 100%; height:100px;" id="drogas_div1">
											<div style="width: 30%; float:left">
												<label for="rifampicina">Rifampicina</label><br/>
												<select id="rifampicina" name="rifampicina"> 
													<option value=""></option>
													<option <?php if (isset($rifampicina) && $rifampicina == "R") echo "selected"; ?> value="R">Sim</option>
													<option <?php if (isset($rifampicina) && $rifampicina == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="izoniazida">Izoniazida</label><br/>
												<select id="izoniazida" name="izoniazida"> 
													<option value=""></option>
													<option <?php if (isset($izoniazida) && $izoniazida == "H") echo "selected"; ?> value="H">Sim</option>
													<option <?php if (isset($izoniazida) && $izoniazida == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="estreptomicina">Estreptomicina</label><br/>
												<select id="estreptomicina"  name="estreptomicina"> 
													<option value=""></option>
													<option <?php if (isset($estreptomicina) && $estreptomicina == "S") echo "selected"; ?> value="S">Sim</option>
													<option <?php if (isset($estreptomicina) && $estreptomicina == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
										</div>
										<div style="width: 100%; height:100px;" id="drogas_div2">
											<div style="width: 30%; float:left">
												<label for="pirazinamida">Pirazinamida</label><br/>
												<select id="pirazinamida" name="pirazinamida"> 
													<option value=""></option>
													<option <?php if (isset($pirazinamida) && $pirazinamida == "Z") echo "selected"; ?> value="Z">Sim</option>
													<option <?php if (isset($pirazinamida) && $pirazinamida == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="etambutol">Etambutol</label><br/>
												<select id="etambutol" name="etambutol"> 
													<option value=""></option>
													<option <?php if (isset($etambutol) && $etambutol == "E") echo "selected"; ?> value="E">Sim</option>
													<option <?php if (isset($etambutol) && $etambutol == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="etionamida">Etionamida</label><br/>
												<select id="etionamida" name="etionamida"> 
													<option value=""></option>
													<option <?php if (isset($etionamida) && $etionamida == "ET") echo "selected"; ?> value="ET">Sim</option>
													<option <?php if (isset($etionamida) && $etionamida == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
										</div>
										<div style="width: 100%; height:100px;" id="drogas_div3">
											<div style="width: 30%; float:left">
												<label for="levofloxacina">Levofloxacina</label><br/>
												<select id="levofloxacina" name="levofloxacina"> 
													<option value=""></option>
													<option <?php if (isset($levofloxacina) && $levofloxacina == "LV") echo "selected"; ?> value="LV">Sim</option>
													<option <?php if (isset($levofloxacina) && $levofloxacina == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="ofloxacina">Ofloxacina</label><br/>
												<select id="ofloxacina" name="ofloxacina"> 
													<option value=""></option>
													<option <?php if (isset($ofloxacina) && $ofloxacina == "OF") echo "selected"; ?> value="OF">Sim</option>
													<option <?php if (isset($ofloxacina) && $ofloxacina == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
											<div style="width: 30%; float:left">
												<label for="rifambutina">Rifambutina</label><br/>
												<select id="rifambutina" name="rifambutina"> 
													<option value=""></option>
													<option <?php if (isset($rifambutina) && $rifambutina == "RB") echo "selected"; ?> value="RB">Sim</option>
													<option <?php if (isset($rifambutina) && $rifambutina == "N") echo "selected"; ?> value="N">Não</option>                 
												</select>
											</div>
										</div>
									</div>
									
									<h2 class="title">Alta</h2>
									<div style="width: 100%; height:100px;">
										<div style="width: 30%; float:left">
											<label for="alta">Alta</label><br/>
											<select name="alta" id="alta" onChange="visibilidadeCampos(this.value,'data_alta_div')"> 
												<option value=""></option>
												<option <?php if (isset($alta) && $alta == "Cura") echo "selected"; ?> value="Cura">Cura</option>                 
												<option <?php if (isset($alta) && $alta == "Abandono") echo "selected"; ?> value="Abandono">Abandono</option>
												<option <?php if (isset($alta) && $alta == "Óbito por TB") echo "selected"; ?> value="Óbito por TB">Óbito por TB</option>  
												<option <?php if (isset($alta) && $alta == "Óbito por outras causas") echo "selected"; ?> value="Óbito por outras causas">Óbito por outras causas</option>                 
												<option <?php if (isset($alta) && $alta == "Transferência") echo "selected"; ?> value="Transferência">Transferência</option>
												<option <?php if (isset($alta) && $alta == "Mudança de diagnóstico") echo "selected"; ?> value="Mudança de diagnóstico">Mudança de diagnóstico</option>  
											</select>
										</div>
										<div style="width: 30%; float:left; display:none;" id="data_alta_div">
											<label for="labelalta1">Data da alta (dd/mm/aaaa)</label><br/>
											<input type="text" class="text small data" name="data_alta" id="data_alta" value="<?php echo (isset($data_alta1)) ?  $data_alta1 : ""; ?>" <?=$disabledAttr?>/>
										</div>
										<div style="width: 30%; float:left">
											<label for="encerrado">Tratamento encerrado?<span style="color:red;">*</span></label><br/>
											<select id="encerrado" name="encerrado" class="required"> 
												<option value=""></option>
												<option <?php if (isset($encerrado) && $encerrado == 1) echo "selected"; ?> value="1">Sim</option>
												<option <?php if (isset($encerrado) && $encerrado == 0) echo "selected"; ?> value="0">Não</option>                 
											</select>
										</div>
                                    </div>
									
									<div style="width: 100%; height:100px;">
										<label for="observacoes">Observações:</label><br/>
										<textarea name="observacoes" id="observacoes" rows="5" cols="100" <?=$disabledAttr?>><?php echo (isset($observacoes)) ?  $observacoes : ""; ?></textarea> 
									</div>
									<?php if (!$somenteLeitura) { ?>
										<div style="width: 100%; height:100px;">
											<button class="classy" type="submit" style="margin-top:25px;"><span>Salvar</span></button>
										</div>
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
	
	$( document ).ready(function() {
		var divsValuesArray =  { 
								"outro_profissional_div": "cod_profissional",
								"outra_unidade_div": "un_notificante",
								"tempo_tratamento_div": "trat_anterior",
								"drogas_div": "droga",
								"data_alta_div": "alta",
								"recebido_div": "descoberta",
								"outra_unidade_recebe_div": "unidade_recebido" 
						       };
							
		var elements = Object.keys(divsValuesArray).map(function(k) {
			visibilidadeCampos($("#"+divsValuesArray[k]).val(),k,0);
		})
	});

	function visibilidadeCampos(value,div,limpar=1){
		document.getElementById(div).style.display = "none";
		if(limpar == 1) {
			$("#"+div+" input").val("");
			$("#"+div+" select").val("");
		}
		if(value == null) {
			value = document.getElementById(div).value;
		}
		switch(div) {
			case "outro_profissional_div":
				if(value == "Outro"){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "outra_unidade_div":
				if(value == "0"){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "tempo_tratamento_div":
				if(value == "Sim, alta cura" || value == "Sim, alta abandono"){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "drogas_div":
				if(value == "S"){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "data_alta_div":
				if(value != ""){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "recebido_div":
				document.getElementById("outra_unidade_recebe_div").style.display = "none";
				if(value == "Encaminhado com suspeita ou diagnóstico de TB"){
					document.getElementById(div).style.display = "block";
				}
				break;
			case "outra_unidade_recebe_div":
				if(value == "0"){
					document.getElementById(div).style.display = "block";
				}
				break;
			default:
		}
		
		if(document.getElementById(div).style.display == "block") {
			$("#"+div+" input").attr("required","required");		
			$("#"+div+" select").attr("required","required");
		} else {
			$("#"+div+" input").removeAttr("required");		
			$("#"+div+" select").removeAttr("required");
		}
	} 
</script>