<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Ficha de acompanhamento::</span></span></span></h3>
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
                                // Maximo de registros por pagina
                                $maximo = 15;
                                if (!isset($_REQUEST['pagina'])) {
                                    $pagina = "1";
                                } else {
                                    $pagina = $_REQUEST['pagina'];
                                }
                                // Calculando o registro inicial
                                $inicio = $pagina - 1;
                                $inicio = $maximo * $inicio;
                                $cod_paciente = 1;
                                $cont = ($pagina * 10) - 9;
								                                   
                                $mes_atual = date("m");
                                $ano_atual = date("Y");

                                if ($mes_atual == '01'){
                                    $mes_anterior = 12;
                                    $ano_anterior = $ano_atual - 1; }
                                else
                                    $mes_anterior = $mes_atual - 1;
                                                                                              
                                $atual = date("d/m/Y");
                              
                                if (isset($_REQUEST)) {
                                    $tipo = $_REQUEST["busca"];
                                    $unidade = $_REQUEST["busca2"];									
									if ($tipo == "1"){
										$select = "SELECT paciente.cod_paciente, paciente.sinan, paciente.nome, paciente.nro_hygia, tratamento.data_tratamento_atual, tratamento.data_escarro, tratamento.resultado_escarro, tratamento.resultado_cultura_escarro, tratamento.anti_hiv, tratamento.cod_tratamento, tratamento.motivo_alta, tratamento.data_alta_tratamento, tratamento.cod_paciente
												FROM paciente INNER JOIN tratamento ON tratamento.cod_paciente = paciente.cod_paciente
												WHERE tratamento.un_atendimento = $unidade AND (tratamento.encerrado = '0'  
												OR ( MONTH(tratamento.data_alta_tratamento) = $mes_atual AND YEAR(tratamento.data_alta_tratamento)= $ano_atual )
												OR  ( MONTH(tratamento.data_alta_tratamento) = $mes_anterior  AND YEAR(tratamento.data_alta_tratamento)=$ano_atual ) )
												ORDER BY paciente.nome
												LIMIT $inicio,$maximo";
										$infos = $db->selectQuery($select);
										$total = sizeof($db->selectQuery("SELECT paciente.cod_paciente
												FROM paciente INNER JOIN tratamento ON tratamento.cod_paciente = paciente.cod_paciente
												WHERE tratamento.un_atendimento = $unidade AND (tratamento.encerrado = '0' 
												OR (MONTH(tratamento.data_alta_tratamento) = $mes_atual AND YEAR (tratamento.data_alta_tratamento)= $ano_atual)
												OR (MONTH(tratamento.data_alta_tratamento) = $mes_anterior  AND YEAR(tratamento.data_alta_tratamento)= $ano_atual))
												ORDER BY paciente.nome
												 "));
                                    } else if($tipo == "2"){
										$select = "SELECT paciente.cod_paciente, paciente.sinan, paciente.nome, paciente.nro_hygia, tratamento.data_tratamento_atual, tratamento.data_escarro, tratamento.data_escarro, tratamento.resultado_escarro, tratamento.resultado_cultura_escarro, tratamento.anti_hiv, tratamento.cod_tratamento, tratamento.motivo_alta, tratamento.data_alta_tratamento, tratamento.cod_paciente
												FROM paciente INNER JOIN tratamento ON tratamento.cod_paciente = paciente.cod_paciente
												WHERE tratamento.un_supervisao = $unidade AND (tratamento.encerrado = '0'  
												OR ( MONTH(tratamento.data_alta_tratamento) = $mes_atual AND YEAR(tratamento.data_alta_tratamento)= $ano_atual )
												OR  ( MONTH(tratamento.data_alta_tratamento) = $mes_anterior  AND YEAR(tratamento.data_alta_tratamento)=$ano_atual ) )
												ORDER BY paciente.nome
												LIMIT $inicio,$maximo";
										$infos = $db->selectQuery($select);
										$total = sizeof($db->selectQuery("SELECT paciente.cod_paciente
												FROM paciente INNER JOIN tratamento ON tratamento.cod_paciente = paciente.cod_paciente
												WHERE tratamento.un_supervisao = $unidade AND (tratamento.encerrado = '0' 
												OR (MONTH(tratamento.data_alta_tratamento) = $mes_atual AND YEAR (tratamento.data_alta_tratamento)= $ano_atual)
												OR (MONTH(tratamento.data_alta_tratamento) = $mes_anterior  AND YEAR(tratamento.data_alta_tratamento)= $ano_atual))
												ORDER BY paciente.nome
												 ")); 
                                    }
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>SINAN</th>
                                                <th>Nome</th>
                                                <th>Hygia</th>
                                                <th>Início</th>
                                                <th>Bac. Esc.</th>
                                                <th>Cult. Esc.</th>
                                                <th>HIV</th>
                                                <th>Esquema</th>
                                                <th>Última Bac. Ctrl.</th>
                                                <th>NºDias Superv 1Fase</th>
                                                <th>NºDias Superv 2Fase</th>
                                                <th>Situação</th>
                                                <th>NºCont.</th>
                                                <th>NºCont. Ex.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($infos as $info) {
												$cod_p = $info["cod_paciente"];
												$sinan = $info["sinan"];
												$nome = (strtoupper($info["nome"]));
												$hygia = $info["nro_hygia"];
												$inicio_t = $info["data_tratamento_atual"];
												$data_baciloscopia = $info["data_escarro"];
												$baciloscopia = (strtoupper($info["resultado_escarro"]));
												$cultura = (strtoupper($info["resultado_cultura_escarro"]));
												$hiv = (strtoupper($info["anti_hiv"]));
												$cod_t = $info["cod_tratamento"];
												$alta = $info["motivo_alta"];
												$data_alta = $info["data_alta_tratamento"];
												
												$selectM = "SELECT rifampicina, izoniazida, estreptomicina, pirazinamida, etambutol, etionamida, MAX(data) 
													FROM medicamento 
													WHERE cod_tratamento = $cod_t";
											  
												$infosM = $db->selectQuery($selectM);
											   
												$rifam = $infosM[0]['rifampicina'];
												$izo = $infosM[0]['izoniazida'];
												$estrep = $infosM[0]['estreptomicina'];
												$pira = $infosM[0]['pirazinamida'];
												$etam = $infosM[0]['etambutol'];
												$etio = $infosM[0]['etionamida'];
											   
												$rifa = "";
												$levo = "";
												$oflo = "";
												
												$med=0;
												if($rifam ==NULL or $rifam == ' '){$med++;}; 
												if($izo ==NULL or $izo  == ' '){$med++;}; 
												if(($estrep == NULL) or ($estrep == ' ')) {$med++;}; 
												if($pira ==NULL or $pira == ' '){$med++;}; 
												if($etam ==NULL or $etam == ' '){$med++;}; 
												if($etio ==NULL or $etio == ' '){$med++;}; 
														
												if ($med=='6'){                                          
														$selectM2 = "SELECT rifampicina, izoniazida, estreptomicina, pirazinamida, etambutol, etionamida, rifambutina, levofloxacina, ofloxacina 
														FROM tratamento 
														WHERE cod_tratamento = $cod_t";
														$infosM2 = $db->selectQuery($selectM2);
														//print_r($infosM2);
														$rifam = $infosM2[0]['rifampicina'];
														$izo = $infosM2[0]['izoniazida'];
														$estrep = $infosM2[0]['estreptomicina'];
														$pira = $infosM2[0]['pirazinamida'];
														$etam = $infosM2[0]['etambutol'];
														$etio = $infosM2[0]['etionamida'];
														$rifa = $infosM2[0]['rifambutina'];
														$levo = $infosM2[0]['levofloxacina'];
												}                                                 
												
												$selectCM = "SELECT resultado_controle, data_controle 
													FROM controle_mensal 
													WHERE  cod_tratamento= $cod_t order by data_controle desc LIMIT 1";

												$infosCM = $db->selectQuery($selectCM);
												$totalCM = sizeof($db->selectQuery("SELECT resultado_controle, data_controle 
													FROM controle_mensal 
													WHERE  cod_tratamento= $cod_t order by data_controle desc LIMIT 1")); 
												if ($totalCM!=0){
													$resultadocm =  $infosCM[0]['resultado_controle'];
													$datacm =  $infosCM[0]['data_controle'];
												}else{
													$resultadocm = '';
													$datacm = '' ;
												}
												//arrumar contagem dos contatos examinados****
												$selectC = "SELECT count(cod_contato)
													FROM contato 
													WHERE cod_paciente=$cod_p ";
												$infosC = $db->selectQuery($selectC);

												$contatos = $infosC[0]['count(cod_contato)'];
												
												$selectEx = "SELECT cod_contato, resultado_baciloscopia, resultado_ppd, resultado_rx_pulmao 
												FROM contato 
												WHERE cod_paciente=$cod_p and (resultado_baciloscopia != ' ' or resultado_ppd != ' ' or resultado_rx_pulmao != ' ')";

												$infosEx = $db->selectQuery($selectEx);
												$totalEx = sizeof($db->selectQuery( "SELECT cod_contato, resultado_baciloscopia, resultado_ppd, resultado_rx_pulmao 
															FROM contato 
															WHERE cod_paciente=$cod_p and (resultado_baciloscopia != ' ' or resultado_ppd != ' ' or resultado_rx_pulmao != ' ')"));
												
											     $fpf = date('Y-m-d', strtotime("+61 days",strtotime($inicio_t)));
											     $csf = date('Y-m-d', strtotime("+62 days",strtotime($inicio_t)));
											   
											     $nro_p_f = 0;
											     $nro_s_f = 0;
											     $aa=0;
												
											     $totalpf = (("SELECT supervisionamento.data_supervisionamento, supervisionamento.comparecimento
													FROM supervisionamento
													WHERE  (data_supervisionamento BETWEEN '$inicio_t' and '$fpf') and cod_tratamento = '$cod_t'"));
											   
											     $infospf = $db->selectQuery($totalpf);

											     foreach($infospf as $infopf){
													if (($infopf["comparecimento"] == "SU") || ($infopf["comparecimento"] == "SVD")){
														$nro_p_f++;
													} else if (($infopf["comparecimento"]) == "AA" ){
														$aa++;
													}    
											     } 
												 
											     $totalsf = (("SELECT supervisionamento.data_supervisionamento, supervisionamento.comparecimento
													FROM supervisionamento
													WHERE  (data_supervisionamento > '$fpf') and cod_tratamento = '$cod_t'"));
											     $infossf = $db->selectQuery($totalsf);

											     foreach($infossf as $infosf){
													 if (($infosf["comparecimento"] == "SU") || ($infosf["comparecimento"] == "SVD")){
														 $nro_s_f++;
													 }                                                
											     }
                                               
												  if ($inicio_t != NULL) {
                                                     $data = implode("/",array_reverse(explode("-",$inicio_t)));
                                                     $fpfase = implode("/",array_reverse(explode("-",$fpf)));
                                                     $csfase = implode("/",array_reverse(explode("-",$csf)));
                                                     
                                                  } else { 
													$data = 0;
												  }
                                                
												  if ($data_alta != NULL) {
													 $dataA = implode("/",array_reverse(explode("-",$data_alta)));
													 if ($dataA == "00/00/0000") {
														 $dataA = "Tratamento";
													 }
												  } else { 
													$dataA = 0;
												  }
												
												  if ($data_baciloscopia != NULL) {
													 $dataB = implode("/",array_reverse(explode("-",$data_baciloscopia)));
												  } else {
													  $dataB = 0;
												  }
												
												  if ($datacm != NULL) {
													 $dataCM = implode("/",array_reverse(explode("-",$datacm)));
												  } else { 
													  $dataCM = 0;
												  }												
                                                ?>
                                                <tr>
                                                    <td><?=$sinan?></td>
                                                    <td><?=$nome?></td>
                                                    <td><?=$hygia?></td>
                                                    <td><?=$data?></td>                                                    
													<td><?php echo "$baciloscopia <br>"; echo $dataB; ?></td>
                                                    <td><?=$cultura?></td>
                                                    <td><?=$hiv?></td>
                                                    <td><?php 
                                                            if($rifam!='N' and $rifam !=NULL and $rifam != ' '){echo $rifam, " ";}; 
                                                            if($izo !='N' and $izo  !=NULL and $izo  != ' '){echo $izo, " ";}; 
                                                            if(($estrep !='N') and ($estrep != NULL) and ($estrep != ' ')) echo $estrep, " "; 
                                                            if($pira !='N' and $pira !=NULL and $pira != ' '){echo $pira, " ";}; 
                                                            if($etam !='N' and $etam !=NULL and $etam != ' '){echo $etam, " ";}; 
                                                            if($etio !='N' and $etio !=NULL and $etio != ' '){echo $etio, " ";}; 
                                                            if($rifa !='N' and $rifa !=NULL and $rifa != ' '){echo $rifa, " ";}; 
                                                            if($levo !='N' and $levo !=NULL and $levo != ' '){echo $levo, " ";}; 
                                                            if($oflo !='N' and $oflo !=NULL and $oflo != ' '){echo $oflo, " ";}; 
                                                        ?></td>
                                                    <td><?php echo "$resultadocm <br>";  echo $dataCM; ?></td>                                                   
                                                    <td><?php echo "até $fpfase: $nro_p_f"; ?></td>
                                                    <td><?php echo "$csfase até $atual: $nro_s_f "; ?></td>                                                   
                                                    <td><?php echo "$alta <br>"; echo $dataA; ?></td>
                                                    <td><?=$contatos;?></td>
                                                    <td><?=$totalEx;?></td>                                                 
                                                </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                    <div class="pagination floatright">
                                    <?php
                                        $menos = $pagina - 1;
                                        $mais = $pagina + 1;
                                        $tab = 1;
                                        $pgs = ceil($total / $maximo);
                                        if ($pgs > 1) {
                                            // Mostragem de pagina
                                            if ($menos > 0) {
												echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=tratamento_listar_boletim_acompanhamento&pagina=$menos&busca=$tipo&busca2=$unidade><span> << </span></a> ";												
											}
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
													echo "<a href=index.php?acao=tratamento_listar_boletim_acompanhamento&pagina=$i&busca=$tipo&busca2=$unidade><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=tratamento_listar_boletim_acompanhamento&pagina=$mais&busca=$tipo&busca2=$unidade><span> >> </span></a> ";
                                            }
										}
                                    ?>
                                    </div>
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