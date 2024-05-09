<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Supervisão do Paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <div style="width:100%; height: 100%; overflow-x: auto; overflow-y:hidden">
                                <?php						
									if (isset($_GET["cod_tratamento"]) && $_GET["cod_tratamento"] != "" && is_numeric($_GET["cod_tratamento"])) { 
										$cod_tratamento = $_GET["cod_tratamento"];	
										
										$sql = "SELECT T.*, 
													US.nome AS nome_unidade_supervisao, UN.nome AS nome_unidade_notificante, UA.nome AS nome_unidade_atendimento,
													P.nome AS nome_paciente, P.idade, P.nro_hygia
												FROM tratamento T
														INNER JOIN unidade US ON US.cod_unidade = T.un_supervisao
														INNER JOIN unidade UN ON UN.cod_unidade = T.un_notificante
														INNER JOIN unidade UA ON UA.cod_unidade = T.un_atendimento
														INNER JOIN paciente P ON P.cod_paciente = T.cod_paciente
												WHERE T.cod_tratamento = $cod_tratamento";
										$consultas = $db->selectQuery($sql);

										$trat_anterior = (strtoupper($consultas[0]['tratamento_anterior']));        
										$tempo_tratamento = $consultas[0]['tempo_tratamento_anterior'];
										$fc1 = (strtoupper($consultas[0]['forma_clinica1']));
										$fc2 = (strtoupper($consultas[0]['forma_clinica2']));
										$fc3 = (strtoupper($consultas[0]['forma_clinica3']));
										$descoberta = (strtoupper($consultas[0]['tipo_descoberta']));
										$da1 = (strtoupper($consultas[0]['doenca_associada1']));
										$da2 = (strtoupper($consultas[0]['doenca_associada2']));
										$da3 = (strtoupper($consultas[0]['doenca_associada3']));
										$anti_hiv = $consultas[0]['anti_hiv'];
										$data_trat_atual = $consultas[0]['data_tratamento_atual'];
										$tipo_trat = (strtoupper($consultas[0]['tipo_tratamento_atual']));
										$droga = $consultas[0]['droga_tratamento'];
										$rifampicina = $consultas[0]['rifampicina'];
										$izoniazida = $consultas[0]['izoniazida'];
										$estreptomicina = $consultas[0]['estreptomicina'];
										$pirazinamida = $consultas[0]['pirazinamida'];
										$etambutol = $consultas[0]['etambutol'];
										$etionamida = $consultas[0]['etionamida'];
										$observacoes = (strtoupper($consultas[0]['observacoes']));
										$data_alta = $consultas[0]['data_alta_tratamento'];
										$alta = (strtoupper($consultas[0]['motivo_alta']));
										$data_notificacao = $consultas[0]['data_notificacao'];

										$nome_un_not= (strtoupper($consultas[0]['nome_unidade_notificante']));
										$nome_un_at= (strtoupper($consultas[0]['nome_unidade_atendimento']));
										$nome_un_sup= (strtoupper($consultas[0]['nome_unidade_supervisao']));
										
										$nome_paciente = (strtoupper($consultas[0]['nome_paciente']));
										$idade = $consultas[0]['idade'];
										$hygia = $consultas[0]['nro_hygia'];

										$droga1 = "";
										if ($droga == "N") {
											$droga1 = "Não";
										} else if ($droga == "S") {
											$droga1 = "Sim";
										}

										$rifampicina1 = "";
										if ($rifampicina == "N") {
											$rifampicina1 = "Não";
										} else if ($rifampicina == "R") {
											$rifampicina1 = "1- Sim";
										}

										$izoniazida1 = "";
										if ($izoniazida == "N") {
											$izoniazida1 = "2- Não";
										} else if ($izoniazida == "H") {
											$izoniazida1 = "1- Sim";
										}

										$estreptomicina1 = "";
										if ($estreptomicina == "N") {
											$estreptomicina1 = "2- Não";
										} else if ($estreptomicina == "S") {
											$estreptomicina1 = "1- Sim";
										}

										$pirazinamida1 = "";
										if ($pirazinamida == "N") {
											$pirazinamida1 = "2- Não";
										} else if ($pirazinamida == "Z") {
											$pirazinamida1 = "1- Sim";
										}

										$etambutol1 = "";
										if ($etambutol == "N") {
											$etambutol1 = "2- Não";
										} else if ($etambutol == "E") {
											$etambutol1 = "1- Sim";
										}

										$etionamida1 = "";
										if ($etionamida == "N") {
											$etionamida1 = "2- Não";
										} else if ($etionamida == "ET") {
											$etionamida1 = "1- Sim";
										}

										if ($data_alta != NULL && $data_alta != "0000-00-00") {
											$data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
										} else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
											$data_alta1 = "";
										}

										if ($data_trat_atual != NULL && $data_trat_atual != "0000-00-00") {
											$data_trat_atual1 = implode("/", array_reverse(explode("-", $data_trat_atual)));
										} else if ($data_trat_atual == "0000-00-00" || $data_trat_atual == NULL) {
											$data_trat_atual1 = "";
										}

										if ($data_notificacao != NULL && $data_notificacao != "0000-00-00") {
											$data_notificacao1 = implode("/", array_reverse(explode("-", $data_notificacao)));
										} else if ($data_notificacao == "0000-00-00" || $data_notificacao == NULL) {
											$data_notificacao1 = "";
										}
									?>
										<div style="line-height: 20px;">
											<h2 class="title">Informações do Tratamento:</h2> 
											<b>Nome do Paciente: </b><?=$nome_paciente;?><br/>
											<b>Número Hygia: </b><?=$hygia;?><br/>
											<b>Idade: </b><?=$idade;?><br/>
											<b>Data de notificação: </b><?=$data_notificacao1;?><br/>
											<b>Data de início do tratamento: </b><?=$data_trat_atual1;?><br/>
											<b>Tipo de tratamento: </b><?=$tipo_trat;?><br/>
											<b>Unidade notificante: </b><?=$nome_un_not?><br/>
											<b>Unidade de atendimento: </b><?=$nome_un_at;?><br/>
											<b>Tratamento anterior: </b><?=$trat_anterior;?><br/>
											<b>Se sim, tratou a quantos anos completos: </b><?=$tempo_tratamento;?><br/>
											<b>Forma clinica: </b><?=$fc1.", ".$fc2.",".$fc3;?><br/>
											
											<b>Tipo de descoberta: </b><?=$descoberta;?><br/>
											<b>Doenças Associadas: </b><?=$da1.", ".$da2.",".$da3;?><br/>
											<b>Anti HIV: </b><?=$anti_hiv;?><br/><br/>

											<b>Drogas no início do tratamento: </b><?=$droga1;?><br/>
											<b>Rifampicina: </b><?=$rifampicina1;?><br/>
											<b>Izoniazida: </b><?=$izoniazida1;?><br/>
											<b>Estreptomicina: </b><?=$estreptomicina1;?><br/>
											<b>Pirazinamida: </b><?=$pirazinamida1;?><br/>
											<b>Etambutol: </b><?=$etambutol1;?><br/>
											<b>Etionamida: </b><?=$etionamida1;?><br/><br/>

											<b>Motivo da Alta: </b><?=$alta;?><br/>
											<b>Data da alta: </b><?=$data_alta1;?><br/>
											<b>Observações: </b><?=$observacoes;?><br/>
										</div>
										<table  align="center">
											<tr ><th><b><font size="4">Legenda</font></b></th></tr>
											<tr><td bgcolor="orange"><b><font size="2"> Supervisionado na Unidade (SU)</font></b></td></tr>
											<tr><td bgcolor="#3299CC"><b><font size="2"> Autoadministrado (AA)</font></b></td></tr>
											<tr><td bgcolor="green"><b><font size="2"> Supervisionado em Visita Domiciliar (SVD)</font></b></td></tr>
											<tr><td bgcolor="red"><b><font size="2"> Não Tomou (N)</font></b></td></tr>
											<tr><td bgcolor="yellow"><b><font size="2"> Outro (O)</font></b></td></tr>
										</table>
									<?php
										$totalaa = 0;
										$totalsvd = 0;
										$totalsu = 0;
										$totaln = 0;
										$totalo = 0;
										$ant = 0;
										$su = 0;
										$svd = 0;
										$aa = 0;
										$n = 0;
										$o = 0;
										$meses = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
										
										$sql = "SELECT comparecimento, data_supervisionamento, observacoes FROM supervisionamento WHERE cod_tratamento = $cod_tratamento ORDER BY data_supervisionamento ASC";
										$consultac = $db->selectQuery($sql);

										foreach ($consultac as $consultacp) {
											$comp = $consultacp['comparecimento'];
											$d1 = explode("-", $consultacp['data_supervisionamento']);
											$anoMes = $d1[0]."-".$d1[1];
											if ($ant != $anoMes) {
												if ($ant != 0) {
									?> 
													<p align="center"> 
														<?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n / <b><font color='yellow'>(O):</font></b> $o"); ?> 
													</p>
													</tr></table>
									<?php
												}
												$su = 0;
												$svd = 0;
												$aa = 0;
												$n = 0;
												$o = 0;
												$ant = $d1[0]."-".$d1[1];
									
												echo "<table align='center'><tr><td><b><br/><font size='3'> ".$meses[$d1[1]-1]." ".$d1[0]."</font></b></td></tr></table>";
									?>
												<table align="center">
													<tr>
													<?php if ($comp == "SU") { $su++;  $totalsu++; ?>
														<td bgcolor="orange"><b><font size="2"> <?= $d1[2]; ?> (SU)</font> </b></td>
													<?php } else if ($comp == "AA") { $aa++; $totalaa++; ?>  
														<td bgcolor="#3299CC"><b><font size="2">  <?= $d1[2]; ?> (AA)</font></b></td>
													<?php } else if ($comp == "SVD") { $svd++; $totalsvd++; ?> 
														<td bgcolor="green"><b> <font size="2"> <?= $d1[2]; ?> (SVD)</font> </b></td>
													<?php } else if ($comp == "N") { $n++; $totaln++; ?>  
														<td bgcolor="red"><b><font size="2"> <?= $d1[2]; ?> (N)</font></b> </td>
													<?php } else if ($comp == "O") { $o++; $totalo++; ?>  
														<td bgcolor="yellow"><b><font size="2"> <?= $d1[2]; ?> (O)</font></b> </td>
													<?php }
												} else {
													if ($comp == "SU") { $su++; $totalsu++; ?>  
														<td bgcolor="orange"><b><font size="2"> <?= $d1[2]; ?> (SU)</font> </b></td>
													<?php } else if ($comp == "AA") { $aa++; $totalaa++;?>  
														<td bgcolor="#3299CC"><b><font size="2">  <?= $d1[2]; ?> (AA)</font> </b></td>
													<?php } else if ($comp == "SVD") { $svd++; $totalsvd++; ?> 
														<td bgcolor="green"><b><font size="2">  <?= $d1[2]; ?> (SVD)</font>  </b></td>
													<?php } else if ($comp == "N") { $n++; $totaln++; ?>  
														<td bgcolor="red"><b> <font size="2"><?= $d1[2]; ?> (N)</font> </b> </td>
													<?php } else if ($comp == "O") { $o++; $totalo++; ?>  
														<td bgcolor="yellow"><b><font size="2"> <?= $d1[2]; ?> (O)</font></b> </td>
													<?php }
												} ?>
									<?php } ?>
									<?php if(sizeof($consultac) > 0) { ?>
											<p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n / <b><font color='yellow'>(O):</font></b> $o"); ?> </p>
											</tr></table>          
									<?php } ?>
										<p align="center" style="margin-top:15px;"> <?php echo ("<b>Total do tratamento: <font color='orange'>(SU):</font></b> $totalsu / <b><font color='green'>(SVD):</font></b> $totalsvd / <b><font color='#3299CC'>(AA):</font></b> $totalaa / <b><font color='red'>(N):</font></b> $totaln / <b><font color='yellow'>(O):</font></b> $totalo"); ?></p>
								<?php } ?>
								</div>
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