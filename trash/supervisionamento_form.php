<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Supervisão do paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">

                <!-- box with gradient [begin] -->
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">

                                <div style="width:100%; height: 100%; overflow-x: auto; overflow-y:hidden">
                                <?php
															
								$cod_tratamento = $conteudo[2];	
								
                                $select = "SELECT *  FROM tratamento WHERE tratamento.cod_tratamento = $cod_tratamento";
                                //$query = @mysql_query($select) or die(mysql_error());
                                //$l = mysql_fetch_array($query);
								$consultas = $db->selectQuery($select);

								/*
                                $trat_anterior = ucfirst($l[1]);
                                $tempo_tratamento = ucfirst($l[2]);
                                $fc1 = ucfirst($l[3]);
                                $fc2 = ucfirst($l[4]);
                                $fc3 = ucfirst($l[5]);
                                $descoberta = ucfirst($l[6]);
                                $recebido = ucfirst($l[7]);
                                $tempo_decorrido = ucfirst($l[8]);

                                $da1 = ucfirst($l[22]);
                                $da2 = ucfirst($l[23]);
                                $da3 = ucfirst($l[24]);
                                $anti_hiv = ucfirst($l[25]);
                                $data_trat_atual = ucfirst($l[26]);
                                $tipo_trat = ucfirst($l[27]);
                                $droga = ucfirst($l[28]);
                                $rifampicina = ucfirst($l[29]);
                                $izoniazida = ucfirst($l[30]);
                                $estreptomicina = ucfirst($l[31]);
                                $pirazinamida = ucfirst($l[32]);
                                $etambutol = ucfirst($l[33]);
                                $etionamida = ucfirst($l[34]);
                                $observacoes = ucfirst($l[35]);
                                $cod_profissional = ucfirst($l[36]);
                                $cod_paciente = ucfirst($l[37]);

                                $servico = ucfirst($l[44]);
                                $data_alta = ucfirst($l[45]);
                                $alta = ucfirst($l[46]);
                                $un_notificante = ucfirst($l[47]);
                                $un_atendimento = ucfirst($l[48]);
                                $data_notificacao = ucfirst($l[49]);

                                $encerrado = ucfirst($l[50]);
								*/
								$trat_anterior = $consultas[0]['tratamento_anterior'];        
								$tempo_tratamento = $consultas[0]['tempo_tratamento_anterior'];
								$fc1 = $consultas[0]['forma_clinica1'];
								$fc2 = $consultas[0]['forma_clinica2'];
								$fc3 = $consultas[0]['forma_clinica3'];
								$descoberta = $consultas[0]['tipo_descoberta'];
								$recebido = $consultas[0]['recebido'];
								$tempo_decorrido = $consultas[0]['tempo_inicio_sintomas'];
								$data_bac_escarro = $consultas[0]['data_escarro'];
								$resultado_bac_escarro = $consultas[0]['resultado_escarro'];
								$outros = $consultas[0]['outros'];
								$data_rx_torax = $consultas[0]['data_rx_torax'];
								$resultado_rx_torax = $consultas[0]['resultado_rx_torax'];
								$data_rx_outro = $consultas[0]['data_rx_outro'];
								$resultado_rx_outro = $consultas[0]['resultado_rx_outro'];
								$data_histopatologico = $consultas[0]['data_histopatologico'];
								$resultado_histopatologico = $consultas[0]['resultado_histopatologico'];
								$data_necropsia = $consultas[0]['data_necropsia'];
								$resultado_necropsia = $consultas[0]['resultado_necropsia'];
								$data_outros = $consultas[0]['data_outros'];
								$resultado_outros = $consultas[0]['resultado_outros'];
								$da1 = $consultas[0]['doenca_associada1'];
								$da2 = $consultas[0]['doenca_associada2'];
								$da3 = $consultas[0]['doenca_associada3'];
								$anti_hiv = $consultas[0]['anti_hiv'];
								$data_trat_atual = $consultas[0]['data_tratamento_atual'];
								$tipo_trat = $consultas[0]['tipo_tratamento_atual'];
								$droga = $consultas[0]['droga_tratamento'];
								$rifampicina = $consultas[0]['rifampicina'];
								$izoniazida = $consultas[0]['izoniazida'];
								$estreptomicina = $consultas[0]['estreptomicina'];
								$pirazinamida = $consultas[0]['pirazinamida'];
								$etambutol = $consultas[0]['etambutol'];
								$etionamida = $consultas[0]['etionamida'];
								$observacoes = $consultas[0]['observacoes'];
								$cod_profissional = $consultas[0]['cod_profissional'];
								$cod_paciente = $consultas[0]['cod_paciente'];
								$data_bac_outro = $consultas[0]['data_outro'];
								$resultado_bac_outro = $consultas[0]['resultado_outro'];
								$data_cultura_escarro = $consultas[0]['data_cultura_escarro'];
								$resultado_cultura_escarro = $consultas[0]['resultado_cultura_escarro'];
								$data_cultura_outro = $consultas[0]['data_cultura_outro'];
								$resultado_cultura_outro = $consultas[0]['resultado_cultura_outro'];
								$servico = $consultas[0]['servico_descobriu'];
								$data_alta = $consultas[0]['data_alta_tratamento'];
								$alta = $consultas[0]['motivo_alta'];
								$un_notificante = $consultas[0]['un_notificante'];
								$un_atendimento = $consultas[0]['un_atendimento'];
								$data_notificacao = $consultas[0]['data_notificacao'];
								$encerrado= $consultas[0]['encerrado'];
								$rifambutina= $consultas[0]['rifambutina'];
								$resultado_tmrtb= $consultas[0]['resultado_tmrtb'];
								$data_tmrtb= $consultas[0]['data_tmrtb'];
								$un_supervisao= $consultas[0]['un_supervisao'];

                                
								$selectu1 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_notificante'";
                                $consultan = $db->selectQuery($selectu1);
								if (empty($consultan[0])){
									$nome_un_not = " ";
								 }else {
                               $nome_un_not = $consultan[0]['nome'];}
							

                                $selectu2 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_atendimento'";
                                 $consultaa = $db->selectQuery($selectu2);
								if (empty($consultaa[0])){
									$nome_un_at = " ";
								 } else {
                                $nome_un_at = $consultaa[0]['nome'];}
							   
								
								$selectu3 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_supervisao'";
                                 $consultas = $db->selectQuery($selectu3);
								 if (empty($consultas[0])){
									$nome_un_sup = " ";
								} else {
                                $nome_un_sup = $consultas[0]['nome'];}

                                $selectpac = "SELECT nome, idade, nro_hygia  FROM paciente WHERE cod_paciente = '$cod_paciente'";
                                /*$querypac = @mysql_query($selectpac) or die(mysql_error());
                                $lpac = mysql_fetch_array($querypac);
                                $nome_paciente = ucfirst($lpac[0]);
                                $idade = ucfirst($lpac[1]);
                                $hygia = ucfirst($lpac[2]);*/
								$consultap = $db->selectQuery($selectpac);
								$nome_paciente = $consultap[0]['nome'];
								$idade = $consultap[0]['idade'];
								$hygia = $consultap[0]['nro_hygia'];


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

                                <br/>
                                <h2 class="title">Informações do Tratamento:</h2> 
                                <b>Nome do Paciente: </b><?= $nome_paciente; ?><br/>
                                <b>Número Hygia: </b><?= $hygia; ?><br/>
                                <b>Idade: </b><?= $idade; ?><br/>
                                <b>Data de notificação: </b><?= $data_notificacao1; ?><br/>
                                <b>Data de início do tratamento: </b><?= $data_trat_atual1; ?><br/>
                                <b>Tipo de tratamento: </b><?= $tipo_trat; ?><br/>
                                <b>Unidade notificante: </b><?= $nome_un_not ?><br/>
                                <b>Unidade de atendimento: </b><?= $nome_un_at; ?><br/>
                                <b>Tratamento anterior: </b><?= $trat_anterior; ?><br/>
                                <b>Se sim, tratou a quantos anos completos: </b><?= $tempo_tratamento; ?><br/>
                                <b>Forma clinica: </b><?= $fc1; ?><br/><?= $fc2; ?><br/><?= $fc3; ?><br/>
                                <b>Tipo de descoberta: </b><?= $descoberta; ?><br/>

                                <b>Doenças Associadas: </b><?= $da1; ?><br/><?= $da2; ?><br/><?= $da3; ?><br/>
                                <b>Anti HIV: </b><?= $anti_hiv; ?><br/>

                                <b>Drogas no início do tratamento: </b><?= $droga1; ?><br/>
                                <b>Rifampicina: </b><?= $rifampicina1; ?><br/>
                                <b>Izoniazida: </b><?= $izoniazida1; ?><br/>
                                <b>Estreptomicina: </b><?= $estreptomicina1; ?><br/>
                                <b>Pirazinamida: </b><?= $pirazinamida1; ?><br/>
                                <b>Etambutol: </b><?= $etambutol1; ?><br/>
                                <b>Etionamida: </b><?= $etionamida1; ?><br/>


                                <b>Motivo da Alta: </b><?= $alta; ?><br/>
                                <b>Data da alta: </b><?= $data_alta1; ?><br/>
                                <b>Observações: </b><?= $observacoes; ?><br/>



                                <?php
//query para pegar o tipo de comparecimento

                                $totalaa = 0;
                                $totalsvd = 0;
                                $totalsu = 0;
                                $totaln = 0;
                                $totalo = 0;

                                $selectC = "SELECT comparecimento, data_supervisionamento, observacoes FROM supervisionamento WHERE cod_tratamento = $cod_tratamento ORDER BY data_supervisionamento ASC";
                                //$queryC = @mysql_query($selectC) or die(mysql_error());
								$consultac = $db->selectQuery($selectC);
								

                                $ant = 0;
                                ?> 
                                

                                
                                    <?php
                                    
                                    
                                             $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                            $o=0;
                                    //while ($lC = mysql_fetch_array($queryC)) {
									foreach ($consultac as $consultacp) {

                                        //$comp = ucfirst($lC[0]);   //pegamos o tipo de comparecimento do banco
                                        //$data = ucfirst($lC[1]);   // pegamos a data do supervisinamento
										$comp = $consultacp['comparecimento'];
										$data = $consultacp['data_supervisionamento'];

                                        $d1 = explode("-", $data);
                                        $data = $d1[2] . "/" . $d1[1] . "/" . $d1[0];  //aqui fazemos um split na data para dividirmos em dia, mês e ano

                                        if ($ant != $d1[1]) {
                                            if ($ant !=0){


                                               // $totalaa = $totalaa + $aa;
                                                //$totalsvd = $totalsvd + $svd;
                                                //$totalsu = $totalsu + $su;
                                                //$totaln = $totaln + $n;
                                                //$totalo = $totalo + $o;

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
                                            $o=0;
                                            $ant = $d1[1];
                                            ?>
                                    

											<table align="center">
												<?php if ($d1[1] == 1) { ?>
													<tr>
														<td>
															<b>
															   <br/><font size="3"> Janeiro <?= $d1[0]; ?></font>
															</b>
														</td>
													</tr>
											 </table>
                                      
                                            
                                                
                                            <?php } else if ($d1[1] == 2) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3"> Fevereiro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr> 
                                            </table>
                                         
                                            <?php } else if ($d1[1] == 3) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3"> Março <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
											
                                            <?php } else if ($d1[1] == 4) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Abril <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>

                                            <?php } else if ($d1[1] == 5) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Maio <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                   
                                            <?php } else if ($d1[1] == 6) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Junho <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr> 
                                            </table>
                                 
                                            <?php } else if ($d1[1] == 7) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Julho <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>  
                                                </tr>
                                            </table>
                                    
                                            <?php } else if ($d1[1] == 8) {   ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Agosto <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                             
                                            <?php } else if ($d1[1] == 9) {   ?> 
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Setembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td> 
                                                </tr>
                                            </table>
                                   
                                            <?php } else if ($d1[1] == 10) {  ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Outubro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                  
                                            <?php } else if ($d1[1] == 11) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Novembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                          
                                            <?php } else if ($d1[1] == 12) { ?>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            <br/><font size="3">Dezembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td> 
                                                </tr>
                                            </table>
                                        <?php } ?>
                                  
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
                                                <?php
                                                
                                                 } else if ($comp == "O") { $o++; $totalo++; ?>  
                                                <td bgcolor="yellow"><b><font size="2"> <?= $d1[2]; ?> (O)</font></b> </td>
                                                <?php
                                                
                                            }
                                        } else {
                                            if ($comp == "SU") { $su++; $totalsu++; 
                                                ?>  
                                                <td bgcolor="orange"><b><font size="2"> <?= $d1[2]; ?> (SU)</font> </b></td>
                                            <?php } else if ($comp == "AA") { $aa++; $totalaa++;?>  
                                                <td bgcolor="#3299CC"><b><font size="2">  <?= $d1[2]; ?> (AA)</font> </b></td>
                                            <?php } else if ($comp == "SVD") { $svd++; $totalsvd++; ?> 
                                                <td bgcolor="green"><b><font size="2">  <?= $d1[2]; ?> (SVD)</font>  </b></td>
                                            <?php } else if ($comp == "N") { $n++; $totaln++; ?>  
                                                <td bgcolor="red"><b> <font size="2"><?= $d1[2]; ?> (N)</font> </b> </td>
                                                <?php
                                                
                                                 } else if ($comp == "O") { $o++; $totalo++; ?>  
                                                <td bgcolor="yellow"><b><font size="2"> <?= $d1[2]; ?> (O)</font></b> </td>
                                                <?php
                                            }
                                        } ?>
                                    
                                   <?php } ?>
                                               <p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n / <b><font color='yellow'>(O):</font></b> $o"); ?> </p>
                                        
											</tr>
										</table>          
                                            
                                        <br/><br/>
                                         <font size="3"><p align="center"> <?php echo ("<b>Total do tratamento: <font color='orange'>(SU):</font></b> $totalsu / <b><font color='green'>(SVD):</font></b> $totalsvd / <b><font color='#3299CC'>(AA):</font></b> $totalaa / <b><font color='red'>(N):</font></b> $totaln / <b><font color='yellow'>(O):</font></b> $totalo"); ?></p></font>

                                    <table  align="center">
                                        <br/>
                                        <tr ><th><b><font size="4">Legenda</font></b></th></tr>
                                    </table>
                                    <br/>

                                    <table  align="center">
                                        <tr>  <td bgcolor="orange"><b><font size="2"> Supervisionado na Unidade (SU)</font></b></td></tr>
                                        <tr>  <td bgcolor="#3299CC"><b><font size="2"> Autoadministrado (AA)</font></b></td></tr>
                                        <tr>  <td bgcolor="green"><b><font size="2"> Supervisionado em Visita Domiciliar (SVD)</font></b></td></tr>
                                        <tr>  <td bgcolor="red"><b><font size="2"> Não Tomou (N)</font></b></td></tr>
                                        <tr>  <td bgcolor="yellow"><b><font size="2"> Outro (O)</font></b></td></tr>
                                    </table>
                                    <br/>
                                    <br/>  
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with gradient [end] --> 


            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>	
</div>
<!-- box with default header [end] -->


