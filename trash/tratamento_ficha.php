<?php
require("autenticacao.php");
?>

<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Tratamento ::</span></span></span></h3>
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

                                <?php																										
									$maximo = 10;

									if (!isset($_GET['pagina'])) {
										$pagina = "1";
									} else {
										$pagina = $_GET['pagina'];
									}

									// Calculando o registro inicial
									$inicio = $pagina - 1;
									$inicio = $maximo * $inicio;									

									if(isset($_GET["token"])) {			
										if(!empty($_GET["codTratamento"])) {
											$cod_trat = $_GET["codTratamento"];
											$cod = $db->selectQuery("SELECT cod_paciente FROM tratamento WHERE cod_tratamento = '$cod_trat';")[0]['cod_paciente'];
										} else {
											die("Informe um par�metro v�lido");
										}	
									} else {
										$cod_trat = $conteudo[2];
										$cod = $conteudo[3];											
										$aut = "SELECT un_supervisao, un_atendimento FROM tratamento WHERE cod_paciente = '$cod' AND (un_supervisao = '$_SESSION[cod_unidade]' OR un_atendimento = '$_SESSION[cod_unidade]')";
										$auts = $db->selectQuery($aut);
									}
																																											
									if (empty($auts[0]) && !isset($_GET["token"])){
										echo "Acesso restrito. Apenas profissionais da unidade de supervis�o do paciente podem acessar essa �rea.";										
									} else {
									
									$select = "SELECT * FROM tratamento, paciente WHERE tratamento.cod_tratamento = '$cod_trat' AND paciente.cod_paciente = '$cod'";
									$consultas = $db->selectQuery($select);
								
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
									$outro_profissional= $consultas[0]['outro_profissional'];
									$outra_unidade_notificante = $consultas[0]['outra_unidade'];
									$outra_unidade_recebe  = $consultas[0]['outra_unidade_recebe'];
									$rifambutina= $consultas[0]['rifambutina'];
									$resultado_tmrtb= $consultas[0]['resultado_tmrtb'];
									$data_tmrtb= $consultas[0]['data_tmrtb'];
									$un_supervisao= $consultas[0]['un_supervisao'];
									
									$levofloxacina= $consultas[0]['levofloxacina'];
									$ofloxacina= $consultas[0]['ofloxacina'];
									
									
									
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
									$nro_fie = $consultas[0]['nro_fie'];
									$nro_hygia = $consultas[0]['nro_hygia'];
									
									$un_supervisao = $consultas[0]['un_supervisao'];
									

                                if ($encerrado == "0") {
                                    $encerrado = "N�o";
                                } else if ($encerrado == "1") {
                                    $encerrado = "Sim";
                                } else {
                                    $encerrado = "";
                                }

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

                                $selectp1 = "SELECT nome  FROM profissional WHERE cod_profissional = '$cod_profissional'";
                                $consultap = $db->selectQuery($selectp1);
								 if (empty($consultap[0])){
									$nome_profissional = " ";
								} else {
                                $nome_profissional= $consultap[0]['nome'];}


                                $droga1 = "";
                                if ($droga == "N") {
                                    $droga1 = "N�o";
                                } else if ($droga == "S") {
                                    $droga1 = "Sim";
                                }

                                $rifampicina1 = "";
                                if ($rifampicina == "N") {
                                    $rifampicina1 = "N�o";
                                } else if ($rifampicina == "R") {
                                    $rifampicina1 = "Sim";
                                }

                                $izoniazida1 = "";
                                if ($izoniazida == "N") {
                                    $izoniazida1 = "N�o";
                                } else if ($izoniazida == "H") {
                                    $izoniazida1 = "Sim";
                                }

                                $estreptomicina1 = "";
                                if ($estreptomicina == "N") {
                                    $estreptomicina1 = "N�o";
                                } else if ($estreptomicina == "S") {
                                    $estreptomicina1 = "Sim";
                                }

                                $pirazinamida1 = "";
                                if ($pirazinamida == "N") {
                                    $pirazinamida1 = "N�o";
                                } else if ($pirazinamida == "Z") {
                                    $pirazinamida1 = "Sim";
                                }

                                $etambutol1 = "";
                                if ($etambutol == "N") {
                                    $etambutol1 = "N�o";
                                } else if ($etambutol == "E") {
                                    $etambutol1 = "Sim";
                                }

                                $etionamida1 = "";
                                if ($etionamida == "N") {
                                    $etionamida1 = "N�o";
                                } else if ($etionamida == "ET") {
                                    $etionamida1 = "Sim";
                                }
                                
                                $rifambutina1 = "";
                                if ($rifambutina == "N") {
                                    $rifambutina1 = "N�o";
                                } else if ($rifambutina == "RB") {
                                    $rifambutina1 = "Sim";
                                }
								
								 $ofloxacina1 = "";
                                if ($ofloxacina == "N") {
                                    $ofloxacina1 = "N�o";
                                } else if ($ofloxacina == "OF") {
                                    $ofloxacina1 = "Sim";
                                }
								
								 $levofloxacina1 = "";
                                if ($levofloxacina == "N") {
                                    $levofloxacina1 = "N�o";
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

                                <br/>
                                <h2 class="title">Informa��es do Tratamento:</h2> 
								
								<!--<div itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/paciente">-->
									<b>Nome do Paciente: </b><span itemprop="nome"><?= $nome; ?></span><br/>                                
									<b>Nro Hygia: </b><span itemprop="nro_hygia"><?= $nro_hygia; ?></span><br/>
									<b>Nro Sinan: </b><span itemprop="nro_sinan"><?= $nro_fie; ?></span><br/>
								<!--</div>-->
                                
                                <b>Profissional respons�vel pelo tratamento: </b><?= $nome_profissional; ?><?= $outro_profissional; ?><br/>
								
								<div itemscope="" itemtype="http://sistb-dev.ddns.net/d2rq/vocab/Tratamento">
									<b>Data de notifica��o: </b><span itemprop="data_notificacao"><?= $data_notificacao1; ?></span><br/>
									<b>Data de in�cio do tratamento: </b><span itemprop="data_inicio_tratamento"><?= $data_trat_atual1; ?></span><br/>
									<b>Tipo de tratamento: </b><span itemprop="tipo_tratamento"><?= $tipo_trat; ?></span><br/>
									<b>Unidade notificante: </b><span itemprop="unidade_notificante"><?= $nome_un_not; ?></span> <span itemprop="unidade_notificante"><?= $outra_unidade_notificante; ?></span><br/>
									<b>Unidade de atendimento: </b><span itemprop="unidade_atendimento"><?= $nome_un_at; ?></span><br/>
									<b>Unidade de supervis�o: </b><span itemprop="unidade_supervisao"><?= $nome_un_sup; ?></span><br/>
									<b>Tratamento anterior: </b><span itemprop="tratamento_anterior"><?= $trat_anterior; ?></span><br/>
									<b>Se sim, tratou a quanto tempo: </b><span itemprop="tempo_tratamento_anterior"><?= $tempo_tratamento; ?></span><br/>
									
									<b>Forma clinica: </b><span itemprop="forma_clinica"><?= $fc1; ?></span><br/><span itemprop="forma_clinica"><?= $fc2; ?></span><br/><span itemprop="forma_clinica"><?= $fc3; ?></span><br/>
									<b>Tipo de descoberta: </b><span itemprop="tipo_descoberta"><?= $descoberta; ?></span><br/>
									<b>Se encaminhado, foi recebido de unidade e/ou munic�pio: </b><span itemprop="recebido_unidade"><?= $recebido; ?></span> / <?= $outra_unidade_recebe; ?><br/>
									<b>Servi�o que descobriu o caso: </b><span itemprop="servico_descoberta"><?= $servico; ?></span><br/>
									<b>Tempo decorrido do in�cio dos sintomas ao tratamento: </b><span itemprop="tempo_inicio_sintomas"><?= $tempo_decorrido; ?></span><br/>
									<?php if ($encerrado == "N�o") { ?>
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
									<b>RX de t�rax: </b>
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
									<b>Histopatol�gco: </b>
									<?php if ($resultado_histopatologico == "Em andamento") { ?>
										<font color="red"><span itemprop="resultado_histopatologico"><?= $resultado_histopatologico; ?></span></font><br/>
									<?php } else { ?>
										<span itemprop="resultado_histopatologico"><?= $resultado_histopatologico; ?></span>
									<?php } ?>
									<b>Data do resultado: </b><span itemprop="data_histopatologico"><?= $data_histopatologico1; ?></span><br/>
									<b>Necr�psia: </b>
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
									<b>Teste molecular r�pido: </b><span itemprop="resultado_teste_molecular_rapido"><?= $resultado_tmrtb; ?></span><br/>
									
									
									<b>Doen�as Associadas: </b><span itemprop="doenca_associada"><?= $da1; ?></span>, <span itemprop="doenca_associada"><?= $da2; ?></span>, <span itemprop="doenca_associada"><?= $da3; ?></span><br/>
									<b>Anti HIV: </b><span itemprop="anti_hiv"><?= $anti_hiv; ?></span><br/>
																
									<br/>
                                								
									<h2 class="title">Drogas do in�cio do tratamento:</h2>
									<b>Drogas no in�cio do tratamento: </b><span itemprop="droga_tratamento"><?= $droga1; ?></span><br/>
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
									<h2 class="title">Drogas durante o tratamento:</h2>
									<?php
									$selectmed = "SELECT rifampicina, izoniazida, estreptomicina, pirazinamida, etambutol, etionamida, rifabutina, levofloxacina, ofloxacina, data  
												  FROM medicamento
												  WHERE cod_tratamento = '$cod_trat'";
									$consultas2 = $db->selectQuery($selectmed);
									//while($lmed = mysql_fetch_array($querymed)) {
									foreach ($consultas2 as $consulta2) {
										/*$rifa = $consulta2[0]['rifampicina'];
										$izo =  $consulta2[0]['izoniazida'];
										$estre =  $consulta2[0]['estreptomicina'];
										$pira =  $consulta2[0]['pirazinamida'];
										$etam =  $consulta2[0]['etambutol'];
										$etio =  $consulta2[0]['etionamida'];
										$data =  $consulta2[0]['data'];*/
										$rifa = $consulta2["rifampicina"];
										$izo =  $consulta2["izoniazida"];
										$estre =  $consulta2["estreptomicina"];
										$pira =  $consulta2["pirazinamida"];
										$etam =  $consulta2["etambutol"];
										$etio =  $consulta2["etionamida"];
										$rifab =  $consulta2["rifabutina"];
										$levo =  $consulta2["levofloxacina"];
										$oflo =  $consulta2["ofloxacina"];

										$data =  $consulta2["data"];
										
										
										list( $d, $time ) = explode(' ', $data);
												$d1 = explode("-", $d);
												$d = $d1[2] . "/" . $d1[1] . "/" . $d1[0];
										
										$rifa1 = "";
										if ($rifa == "N") {
											$rifa1 = "N�o";
										} else if ($rifa == "R") {
											$rifa1 = "Sim";
										}

										$izo1 = "";
										if ($izo == "N") {
											$izo1 = "N�o";
										} else if ($izo == "H") {
											$izo1 = "Sim";
										}

										$estre1 = "";
										if ($estre == "N") {
											$estre1 = "N�o";
										} else if ($estre == "S") {
											$estre1 = "Sim";
										}

										$pira1 = "";
										if ($pira == "N") {
											$pira1 = "N�o";
										} else if ($pira == "Z") {
											$pira1 = "Sim";
										}

										$etam1 = "";
										if ($etam == "N") {
											$etam1 = "N�o";
										} else if ($etam == "E") {
											$etam1 = "Sim";
										}

										$etio1 = "";
										if ($etio == "N") {
											$etio1 = "N�o";
										} else if ($etio == "ET") {
											$etio1 = "Sim";
										}

										$rifab1 = "";
										if ($rifab == "N") {
											$rifab1 = "N�o";
										} else if ($rifab == "RB") {
											$rifab1 = "Sim";
										}
										$levo1 = "";
										if ($levo == "N") {
											$levo1 = "N�o";
										} else if ($levo == "LV") {
											$levo1 = "Sim";
										}
										$oflo1 = "";
										if ($oflo == "N") {
											$oflo1 = "N�o";
										} else if ($oflo == "OF") {
											$oflo1 = "Sim";
										}
										?>
										- <b><?= $d ?></b> : <br/> 
										<b>Rifampicina: </b><?= $rifa1; ?><br/>
										<b>Izoniazida: </b><?= $izo1; ?><br/>
										<b>Estreptomicina: </b><?= $estre1; ?><br/>
										<b>Pirazinamida: </b><?= $pira1; ?><br/>
										<b>Etambutol: </b><?= $etam1; ?><br/>
										<b>Etionamida: </b><?= $etio1; ?><br/><br/>	
										<?php
										}
										?>
										<br/>
										<h2 class="title">Alta do tratamento:</h2>
										<b>Tipo de Alta: </b><span itemprop="motivo_alta_tratamento"><?= $alta; ?></span><br/>
										<b>Data da alta: </b><span itemprop="data_alta_tratamento"><?= $data_alta1; ?></span><br/>
										<b>Observa��es: </b><span itemprop="tratamento_observacoes"><?= $observacoes; ?></span><br/>

										<br/><br/>
								</div>

                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with default header [end] -->	

                <p></p>

                <!-- box with default header [begin] -->
                <div class="box box-gradient">    
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3 header-on">

                                <?php if ($encerrado == "N�o") { ?>
                                    <br/>
                                    <h2 class="title">Editar</h2>
                                    <!-- form elements [start] -->
                                    <form method="post" class="validar" action="editar_tratamento.php">

                                        <p>
                                            <input type="hidden" name="cod_trat" value= "<?= $cod_trat; ?>" /> 
                                            <input type="hidden" name="cod" value= "<?= $cod; ?>" /> </p>




                                        <?php
                                        date_default_timezone_set('America/Sao_Paulo');
                                        $data = date("dmY");
                                        ?>

                                        <div style="width: 100%; height:100px;">
                                            <div  style="width: 30%; float:left">
                                                <label>Profissional respons�vel: </label><br/>
                                                <?php
                                                $selectpro = "SELECT cod_profissional, nome from profissional WHERE ocupacao='M�dico' ORDER BY nome";
                                                $querypro= $db->selectQuery($selectpro);
												if ($querypro) {
                                                    echo "<select name='cod_profissional'>";
                                                    echo "<option value=''></option>";
                                                    foreach ($querypro as $prof) {
                                                       	$cod_pro = $prof['cod_profissional'];
														$nome_pro = ucwords($prof['nome']);
                                                        if ($cod_profissional != $cod_pro) {
                                                            echo "<option value='$cod_pro' >$nome_pro</option>";
                                                        } else if ($cod_profissional == $cod_pro) {
                                                            echo "<option value='$cod_pro' selected='$cod_pro' >$nome_pro</option>";
                                                        } else {
                                                            echo "<option value='' selected='' ></option>";
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                                ?>

                                            </div>

                                            <div  style="width: 30%; float:left">
                                                <label id="labelpro" >Outro Profissional</label><br/>
                                                <input id="inputpro" type="text" class="text small" value="<?= $outro_profissional; ?>"  name = "outro_profissional"/>
                                            </div>


                                            <?php if ($encerrado == "N�o") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento encerrado: </label><br/>

                                                    <select name="encerrado"> 
                                                        <option value="" ></option>
                                                        <option value="1">Sim</option>
                                                        <option selected ="0" value="0">N�o</option>

                                                    </select>
                                                </div>
                                            <?php } else if ($encerrado == "Sim") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento encerrado: </label><br/>

                                                    <select name="encerrado"> 
                                                        <option value="" ></option>
                                                        <option selected ="1" value="1">Sim</option>
                                                        <option value="0">N�o</option>

                                                    </select>
                                                </div>

                                            <?php } else { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento encerrado: </label><br/>

                                                    <select name="encerrado"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="1">Sim</option>
                                                        <option value="0">N�o</option>

                                                    </select>
                                                </div>
                                            <?php } ?>

                                        </div>
                                        <div style="width: 100%; height:100px;">

                                            <div  style="width: 30%; float:left">

                                                <label>Data de notifica��o (dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data" value="<?= $data_notificacao1 ?>" name = "data_notificacao"/> 

                                            </div>


                                            <div  style="width: 30%; float:left">

                                                <label>Data de in�cio do tratamento atual(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data" value="<?= $data_trat_atual1 ?>" name = "data_trat_atual"/> 
                                            </div>



                                            <?php if ($tipo_trat == "Auto administrado") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de tratamento:</label><br/>
                                                    <select name="tipo_trat"> 
                                                        <option selected ="Auto administrado" value="Auto administrado">Auto administrado</option>
                                                        <option value="Supervisionado">Supervisionado</option>
                                                        <option value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else if ($tipo_trat == "Supervisionado") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de tratamento:</label><br/>
                                                    <select name="tipo_trat"> 
                                                        <option value="Auto administrado">Auto administrado</option>
                                                        <option selected ="Supervisionado" value="Supervisionado">Supervisionado</option>
                                                        <option value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else if ($tipo_trat == "Sem informa��o") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de tratamento:</label><br/>
                                                    <select name="tipo_trat"> 
                                                        <option value="Auto administrado">Auto administrado</option>
                                                        <option value="Supervisionado">Supervisionado</option>
                                                        <option selected = "Sem informa��o" value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de tratamento:</label><br/>
                                                    <select name="tipo_trat"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Auto administrado">Auto administrado</option>
                                                        <option value="Supervisionado">Supervisionado</option>
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>				
                                                </div>
                                                <?php
                                            }
                                            ?>     

                                        </div>
                                        <div style="width: 100%; height:100px;">
                                            <div  style="width: 30%; float:left">
                                                <label>Unidade notificante: </label><br/>
                                                <?php
                                                $selectun = "SELECT cod_unidade, nome, cidade from unidade ORDER BY nome";
                                                $queryUn= $db->selectQuery($selectun);
												if ($queryUn) {
                                                    echo "<select name='un_notificante'>";
                                                    echo "<option value=''></option>";
                                                    foreach ($queryUn as $un) {
                                                        $cod_un = $un['cod_unidade'];
														$nome_un = ucwords($un['nome']);
														$cidade_un = ucwords($un['cidade']);
														
                                                        if ($un_notificante != $cod_un) {
                                                            echo "<option value='$cod_un' >$nome_un / $cidade_un</option>";
                                                        } else if ($un_notificante == $cod_un) {
                                                            echo "<option value='$cod_un' selected='$cod_un' >$nome_un / $cidade_un</option>";
                                                        } else {
                                                            echo "<option value='' selected='' ></option>";
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                                ?>

                                            </div>
                                            <div  style="width: 30%; float:left">
                                                <label id="labeluni" >Outra Unidade Notificante</label><br/>
                                                <input id="inputuni" type="text" class="text small" value="<?= $outra_unidade_notificante; ?>"  name = "outra_unidade"/>
                                            </div>

                                            <div  style="width: 30%; float:left">
                                                <label>Unidade de atendimento (*):</label><br/>
                                                <?php
                                                $selectua = "SELECT cod_unidade, nome, cidade from unidade ORDER BY nome";
                                                $queryUa= $db->selectQuery($selectua);
												if ($queryUa) {
                                                    echo "<select name='un_atendimento' >";
                                                    echo "<option value=''></option>";
                                                     foreach ($queryUa as $un) {
                                                        $cod_ua = $un['cod_unidade'];
                                                        $nome_ua = ucwords($un['nome']);
                                                        $cidade_ua = ucwords($un['cidade']);
                                                        if ($un_atendimento != $cod_ua) {
                                                            echo "<option value='$cod_ua' >$nome_ua / $cidade_ua</option>";
                                                        } else if ($un_atendimento == $cod_ua) {
                                                            echo "<option value='$cod_ua' selected='$cod_ua' >$nome_ua / $cidade_ua</option>";
                                                        } else {
                                                            echo "<option value='' selected='' ></option>";
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                                ?>

                                            </div>
                                        </div>

										<div style="width: 100%; height:100px;">
											<div  style="width: 30%; float:left">
                                                <label>Unidade de supervis�o (*):</label><br/>
                                                <?php
                                                $selectus = "SELECT cod_unidade, nome, cidade from unidade ORDER BY nome";
                                                $queryUs= $db->selectQuery($selectus);
												if ($queryUs) {
                                                    echo "<select name='un_supervisao' >";
                                                    echo "<option value=''></option>";
                                                     foreach ($queryUs as $un) {
                                                        $cod_us = $un['cod_unidade'];
                                                        $nome_us = ucwords($un['nome']);
                                                        $cidade_us = ucwords($un['cidade']);
                                                        if ($un_supervisao != $cod_us) {
                                                            echo "<option value='$cod_us' >$nome_us / $cidade_us</option>";
                                                        } else if ($un_supervisao == $cod_us) {
                                                            echo "<option value='$cod_us' selected='$cod_us' >$nome_us / $cidade_us</option>";
                                                        } else {
                                                            echo "<option value='' selected='' ></option>";
                                                        }
                                                    }
                                                    echo "</select>";
                                                }
                                                ?>

                                            </div>
										</div>
										
                                        <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($trat_anterior == "N�o Tratou") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option selected ="N�o Tratou" value="N�o Tratou">N�o Tratou</option>
                                                        <option value="Sim, alta cura">Sim, alta cura</option>
                                                        <option value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option value="N�o sabe">N�o sabe</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($trat_anterior == "Sim, alta cura") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option value="N�o Tratou">N�o Tratou</option>
                                                        <option selected ="Sim, alta cura" value="Sim, alta cura">Sim, alta cura</option>
                                                        <option value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option value="N�o sabe">N�o sabe</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($trat_anterior == "Sim, alta abandono") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option value="N�o Tratou">N�o Tratou</option>
                                                        <option value="Sim, alta cura">Sim, alta cura</option>
                                                        <option selected ="Sim, alta abandono" value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option value="N�o sabe">N�o sabe</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($trat_anterior == "N�o sabe") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option value="N�o Tratou">N�o Tratou</option>
                                                        <option value="Sim, alta cura">Sim, alta cura</option>
                                                        <option value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option selected ="N�o sabe" value="N�o sabe">N�o sabe</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($trat_anterior == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option value="N�o Tratou">N�o Tratou</option>
                                                        <option value="Sim, alta cura">Sim, alta cura</option>
                                                        <option value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option value="N�o sabe">N�o sabe</option> 
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tratamento Anterior:</label><br/>
                                                    <select name="trat_anterior"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="N�o Tratou">N�o Tratou</option>
                                                        <option value="Sim, alta cura">Sim, alta cura</option>
                                                        <option value="Sim, alta abandono">Sim, alta abandono</option>
                                                        <option value="N�o sabe">N�o sabe</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } ?>

                                            <div  style="width: 30%; float:left">
                                                <label>Tratou h� quanto tempo</label><br/>
                                                <input type="text" value="<?= $tempo_tratamento; ?>" class="text small" name="tempo_tratamento" /> 
                                            </div>


                                            <?php
                                            if ($fc1 == "Pulmonar") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option selected ="Pulmonar"  value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Meningite") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option selected ="Meningite" value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Pleural") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected ="Pleural" value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Glang. Perif�rica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option selected ="Glang. Perif�rica" value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "�ssea") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option>  
                                                        <option selected ="�ssea" value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Vias Urin�rias") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option selected ="Vias Urin�rias" value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Genital") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option selected ="Genital" value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Intestinal") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option selected ="Intestinal" value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Oftalmica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option selected ="Oftalmica" value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Pele") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option selected ="Pele" value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Laringe") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1">                           
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                     
                                                        <option selected ="Laringe" value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Miliar") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option selected ="Miliar" value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Outras") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option selected ="Outras" value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>

                                                <?php
                                            } else if ($fc1 == "Disseminada") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option selected ="Disseminada" value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc1 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc1 == "Sistema Nervoso Central") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected="Sistema Nervoso Central" value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc1 == "Peric�rdia") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option selected ="Peric�rdia" value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Genitourin�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option selected ="Genitourin�ria" value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Ocular") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option selected="Ocular" value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Otorrinolaringol�gica") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option selected="Otorrinolaringol�gica" value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Mam�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option selected ="Mam�ria" value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Nasal") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option selected="Nasal"value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc1 == "Lar�ngea") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica :</label><br/>
                                                    <select name="fc1"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option selected="Lar�ngea" value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>

                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc1"> 
                                                        <option selected="" value=""></option>
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } ?>


                                        </div>
                                        <div style="width: 100%; height:100px;">
                                            <?php
                                            if ($fc2 == "Pulmonar") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option selected="Pulmonar" value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Meningite") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option selected ="Meningite" value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Pleural") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected="Pleural" value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Glang. Perif�rica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option selected="Glang. Perif�rica" value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "�ssea") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option selected="�ssea" value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Vias Urin�rias") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option selected="Vias Urin�rias" value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Genital") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option selected="Genital" value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Intestinal") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option selected="Intestinal" value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Oftalmica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option selected="Oftalmica" value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Pele") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option selected="Pele" value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Laringe") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2">                            
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option selected="Laringe" value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Miliar") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option selected="Miliar" value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Outras") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option selected="Outras" value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>

                                                <?php
                                            } else if ($fc2 == "Disseminada") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option selected="Disseminada" value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc2 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2: </label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option selected="Sem informa��o" value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc2 == "Sistema Nervoso Central") { ?>
                                                <div  style="width: 30%; float:left">

                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected="Sistema Nervoso Central" value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc2 == "Peric�rdia") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option selected ="Peric�rdia" value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Genitourin�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option selected ="Genitourin�ria" value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Ocular") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option selected="Ocular" value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Otorrinolaringol�gica") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option selected="Otorrinolaringol�gica" value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Mam�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option selected ="Mam�ria" value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Nasal") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option selected="Nasal"value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc2 == "Lar�ngea") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option selected="Lar�ngea" value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 2:</label><br/>
                                                    <select name="fc2"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>    
                                            <?php } ?>

                                            <?php
                                            if ($fc3 == "Pulmonar") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option selected="Pulmonar" value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Meningite") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option selected ="Meningite" value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Pleural") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected="Pleural" value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Glang. Perif�rica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option selected="Glang. Perif�rica" value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "�ssea") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option selected="�ssea" value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Vias Urin�rias") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option selected="Vias Urin�rias" value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Genital") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option  selected="Genital" value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Intestinal") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option selected="Intestinal" value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Oftalmica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option selected="Oftalmica" value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Pele") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option selected="Pele" value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Laringe") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3">                           
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option selected="Laringe" value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Miliar") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option selected="Milirar" value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Outras") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3: </label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option selected="Outras" value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>

                                                <?php
                                            } else if ($fc3 == "Disseminada") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option selected="Disseminada" value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($fc3 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">

                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option selected="Sem Informa��o" value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc3 == "Sistema Nervoso Central") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <label>Forma Cl�nica:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option selected="Sistema Nervoso Central" value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } else if ($fc3 == "Peric�rdia") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option selected ="Peric�rdia" value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Genitourin�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option selected ="Genitourin�ria" value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>

                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Ocular") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option selected="Ocular" value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Otorrinolaringol�gica") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option selected="Otorrinolaringol�gica" value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Mam�ria") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option selected ="Mam�ria" value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Nasal") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option selected="Nasal"value="Nasal">Nasal</option>
                                                        <option value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>
                                            <?php } else if ($fc3 == "Lar�ngea") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                                        <option value="Peric�rdia">Pericardia</option>
                                                        <option value="Genitourin�ria">Genitourin�ria</option>
                                                        <option value="Ocular">Ocular</option>
                                                        <option value="Otorrinolaringol�gica">Otorrinolaringol�gica</option>
                                                        <option value="Mam�ria">Mam�ria</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option selected="Lar�ngea" value="Lar�ngea">Lar�ngea</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                      
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>
                                                </div>


                                            <?php } else { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Forma Cl�nica 3:</label><br/>
                                                    <select name="fc3"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Pulmonar">Pulmonar</option>
                                                        <option value="Meningite">Meningite</option>
                                                        <option value="Pleural">Pleural</option>
                                                        <option value="Glang. Perif�rica">Glang. Perif�rica</option> 
                                                        <option value="�ssea">�ssea</option>                                            
                                                        <option value="Vias Urin�rias">Vias Urin�rias</option>
                                                        <option value="Genital">Genital</option>
                                                        <option value="Intestinal">Intestinal</option>
                                                        <option value="Oftalmica">Oftalmica</option> 
                                                        <option value="Pele">Pele</option>                        
                                                        <option value="Laringe">Laringe</option>
                                                        <option value="Miliar">Miliar</option>
                                                        <option value="Outras">Outras</option>
                                                        <option value="Disseminada">Disseminada</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>				
                                                </div>
                                            <?php } ?>



                                            <?php
                                            if ($descoberta == "Apres. espont�nea com sintomas respirat�rios") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta:</label><br/>
                                                    <select name="descoberta"> 
                                                        <option selected ="Apres. espont�nea com sintomas respirat�rios" value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option value="Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option value="Controle de comunicantes">Controle de comunicantes</option> 
                                                        <option value="Descoberto ap�s �bito">Descoberto ap�s �bito</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($descoberta == "Apres. espont�nea por outros motivos") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta:</label><br/>
                                                    <select name="descoberta"> 
                                                        <option value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option selected ="Apres. espont�nea por outros motivos" value="2- Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option value="Controle de comunicantes">Controle de comunicantes</option> 
                                                        <option value="Descoberto ap�s �bito">Descoberto ap�s �bito</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else if ($descoberta == "Encaminhado com suspeita ou diagn�stico de TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta:</label><br/>
                                                    <select name="descoberta"> 
                                                        <option value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option value="Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option selected ="Encaminhado com suspeita ou diagn�stico de TB" value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option value="Controle de comunicantes">Controle de comunicantes</option> 
                                                        <option value="Descoberto ap�s �bito">Descoberto ap�s �bito</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($descoberta == "Controle de comunicantes") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta:</label><br/>
                                                    <select name="descoberta"> 
                                                        <option value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option value="Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option selected ="Controle de comunicantes" value = "Controle de comunicantes">Controle de comunicantes</option>
                                                        <option value = "Descoberto ap�s �bito">Descoberto ap�s �bito</option>
                                                    </select>
                                                </div>
                                                <?php
                                            } else if ($descoberta == "Descoberto ap�s �bito") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta:</label><br/>
                                                    <select name="descoberta"> 
                                                        <option value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option value="Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option value="Controle de comunicantes">Controle de comunicantes</option> 
                                                        <option selected ="Descoberto ap�s �bito" value="Descoberto ap�s �bito">Descoberto ap�s �bito</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Tipo de Descoberta: </label><br/>
                                                    <select name="descoberta"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Apres. espont�nea com sintomas respirat�rios">Apres. espont�nea com sintomas respirat�rios</option>
                                                        <option value="Apres. espont�nea por outros motivos">Apres. espont�nea por outros motivos</option>
                                                        <option value="Encaminhado com suspeita ou diagn�stico de TB">Encaminhado com suspeita ou diagn�stico de TB</option>
                                                        <option value="Controle de comunicantes">Controle de comunicantes</option> 
                                                        <option value="Descoberto ap�s �bito">Descoberto ap�s �bito</option>   
                                                    </select>				
                                                </div>

                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div style="width: 100%; height:100px;">
                                            <div  style="width: 30%; float:left">
                                                <label>Foi recebido de:</label><br/>
                                                <input type="text" value="<?= $recebido; ?>" class="text small" name="recebido" /> 
                                            </div>

                                            <div  style="width: 30%; float:left">
                                                <label>Outras unidades e/ou munic�pio que foi recebido:</label><br/>
                                                <input type="text" value="<?= $outra_unidade_recebe; ?>" class="text small" name="outra_unidade_recebe" /> 
                                            </div>


                                            <?php
                                            if ($servico == "Ambulat�rio de refer�ncia") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Pronto atendimento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option selected ="Pronto atendimento" value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Ambulat�rio privado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option selected = "Ambulat�rio privado" value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Hospital p�blico") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option selected = "Hospital p�blico" value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Hospital privado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option selected ="Hospital privado" value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Aten��o b�sica") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option selected = "Aten��o b�sica" value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Outro") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option selected ="Outro" value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else
                                            if ($servico == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option>  
                                                        <option value="Outro">Outro</option>   
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>   
                                                    </select>				
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Servi�o que descobriu o caso:</label><br/>
                                                    <select name="servico"> 
                                                        <option selected ="" value="" ></option>
                                                        <option selected ="Ambulat�rio de refer�ncia" value="Ambulat�rio de refer�ncia">Ambulat�rio de refer�ncia</option>
                                                        <option value="Pronto atendimento">Pronto atendimento</option>
                                                        <option value="Ambulat�rio privado">Ambulat�rio privado</option>
                                                        <option value="Hospital p�blico">Hospital p�blico</option> 
                                                        <option value="Hospital privado">Hospital privado</option>
                                                        <option value="Aten��o b�sica">Aten��o b�sica</option> 
                                                        <option value="Outro">Outro</option>   
                                                        <option value="Sem informa��o">Sem informa��o</option>  
                                                    </select>				
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div style="width: 100%; height:100px;">

                                            <div  style="width: 50%; float:left">
                                                <label>Tempo decorrido do in�cio dos sintomas ao tratamento, em semanas (*):</label><br/>
                                                <input type="text" value="<?= $tempo_decorrido; ?>" class="text small" name="tempo_decorrido" /> 
                                            </div>
                                        </div>
                                        
                                        <p>    
                                    <label>Exames complementares</label><br/>
                                    </p>
                                        
                                        <div style="width: 100%; height:100px;">
                                            
                                             

                                            <?php
                                            if ($resultado_bac_escarro == "Positivo") {
                                                ?>		
                                                <div  style="width: 30%; float:left">
                                                  
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_escarro == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected ="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_escarro == "Em andamento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected ="Em andamento" value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_escarro == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_escarro == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia de escarro:</label><br/>
                                                    <select name="resultado_bac_escarro"> 
                                                        <option selected="" value=""></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                           
                                                    </select>	 
                                                </div>
                                            <?php } ?>

                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado Baciloscopia de escarro (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_bac_escarro1; ?>" class="text small data" name="data_bac_escarro"/>
                                            </div>
                                            
                                            </div>
                                    
                                         <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_bac_outro == "Positivo") {
                                                ?>		
                                            <div>
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                            </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_outro == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected ="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_outro == "Em andamento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected ="Em andamento" value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_outro == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_bac_outro == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option selected ="em informa��o" value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Baciloscopia outro material:</label><br/>
                                                    <select name="resultado_bac_outro"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>>                          
                                                    </select>	 
                                                </div>
                                            <?php } ?>
                                            
                                       
                                            <div  style="width: 30%; float:left">
                                            <label>Data do Resultado bacilocsopia outro material (dd/mm/aaaa): </label><br/>
                                            <input type="text" value="<?= $data_bac_outro1; ?>" class="text small data" name="data_bac_outro"/>
                                            </div>
                                             
                                             </div>
                                    
                                    <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_cultura_escarro == "Positivo") {
                                                ?>		
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_escarro == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected ="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_escarro == "Em andamento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected ="Em andamento" value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_escarro == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_escarro == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo"> Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de escarro:</label><br/>
                                                    <select name="resultado_cultura_escarro"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo"> Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                            <?php } ?>

                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado cultura de escarro (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_cultura_escarro1; ?>" class="text small data" name="data_cultura_escarro"/>
                                            </div>
                                            
                                        </div>
                                         <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_cultura_outro == "Positivo") {
                                                ?>		
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura de outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_outro == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected ="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_outro == "Em andamento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected ="Em andamento" value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_outro == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_cultura_outro == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Cultura outro material:</label><br/>
                                                    <select name="resultado_cultura_outro"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                            <?php } ?>


                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado da Cultura de Outro Material (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_cultura_outro1; ?>" class="text small data" name="data_cultura_outro"/>
                                            </div>

                                             </div>
                                    
                                    <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_rx_torax == "Normal") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option selected ="Normal" value="1- Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_torax == "Suspeita de TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option value="Normal">Normal</option>
                                                        <option selected ="Suspeita de TB" value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">utras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_torax == "Suspeita de TB com caverna") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option selected ="Suspeita de TB com caverna" value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_torax == "Outras afec��es") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option selected ="Outras afec��es" value="4- Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_torax == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_torax == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX de t�rax:</label><br/>
                                                    <select name="resultado_rx_torax"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>	 
                                                </div>
                                            <?php } ?>
                                        
                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado RX de T�rax (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_rx_torax1; ?>" class="text small data" name="data_rx_torax"/>
                                            </div>
                                        </div>
                                    
                                    <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_rx_outro == "Normal") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option selected="Normal" value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_outro == "Suspeita de TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option value="Normal">Normal</option>
                                                        <option selected="Suspeita de TB" value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_outro == "Suspeita de TB com caverna") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option selected="Suspeita de TB com caverna" value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_outro == "Outras afec��es") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option selected="Outras afec��es" value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_outro == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option selected="N�o realizado" value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option>
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_rx_outro == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option selected="Sem informa��o" value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                            <div  style="width: 30%; float:left">
                                                    <label>RX outro:</label><br/>
                                                    <select name="resultado_rx_outro"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Normal">Normal</option>
                                                        <option value="Suspeita de TB">Suspeita de TB</option>
                                                        <option value="Suspeita de TB com caverna">Suspeita de TB com caverna</option>
                                                        <option value="Outras afec��es">Outras afec��es</option> 
                                                        <option value="N�o realizado">N�o realizado</option>         
                                                        <option value="Sem informa��o">Sem informa��o</option> 
                                                    </select>	 
                                            </div>
                                            <?php } ?>
                                            
                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado de RX Outro (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_rx_outro1; ?>" class="text small data" name="data_rx_outro"/>
                                            </div>
                                        </div>
                                        <div style="width: 100%; height:100px;">



                                            <?php
                                            if ($resultado_histopatologico == "Sugestivo de TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Histopatol�gico:</label><br/>
                                                    <select name="resultado_histopatologico"> 
                                                        <option selected ="Sugestivo de TB" value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_histopatologico == "N�o sugestivo TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Histopatol�gico:</label><br/>
                                                    <select name="resultado_histopatologico"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option selected="N�o sugestivo de TB" value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_histopatologico == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Histopatol�gico:</label><br/>
                                                    <select name="resultado_histopatologico"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option selected="N�o realizado" value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                        
                                                    </select>	 
                                                </div>

                                                <?php
                                            } else
                                            if ($resultado_histopatologico == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Histopatol�gico:</label><br/>
                                                    <select name="resultado_histopatologico"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option selected="Sem informa��o" value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Histopatol�gico:</label><br/>
                                                    <select name="resultado_histopatologico"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado de Histopatol�gico (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_histopatologico1; ?>" class="text small data" name="data_histopatologico"/>
                                            </div>
                                            
                                            </div>
                                    
                                    <div style="width: 100%; height:100px;">

                                            <?php
                                            if ($resultado_necropsia == "Sugestivo de TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Necr�psia:</label><br/>
                                                    <select name="resultado_necropsia"> 
                                                        <option selected="Sugestivo de TB" value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_necropsia == "N�o sugestivo TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Necr�psia:</label><br/>
                                                    <select name="resultado_necropsia"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option selected="N�o sugestivo de TB" value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                         
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_necropsia == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Necr�psia:</label><br/>
                                                    <select name="resultado_necropsia"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option selected="N�o realizado" value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                         
                                                    </select>	 
                                                </div>

                                                <?php
                                            } else
                                            if ($resultado_necropsia == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Necr�psia:</label><br/>
                                                    <select name="resultado_necropsia"> 
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option selected ="Sem informa��o" value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Necr�psia:</label><br/>
                                                    <select name="resultado_necropsia"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Sugestivo de TB">Sugestivo de TB</option>
                                                        <option value="N�o sugestivo TB">N�o sugestivo TB</option>
                                                        <option value="N�o realizado">N�o realizado</option>
                                                        <option value=" Sem informa��o">Sem informa��o</option>                         
                                                    </select>	 
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        
                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado Necropsia(dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_necropsia1; ?>" class="text small data" name="data_necropsia"/>
                                            </div>

                                        </div>
                                    
                                    <div style="width: 100%; height:100px;">

                                            <div  style="width: 30%; float:left">
                                                <label>Outros - Especificar:</label><br/>
                                                <input type="text" value="<?= $outros; ?>" class="text small" name="outros" /> 
                                            </div>
                                            <div  style="width: 30%; float:left">
                                                <label>Outros - Resultado:</label><br/>
                                                <input type="text" value="<?= $resultado_outros; ?>" class="text small" name="resultado_outros" /> 
                                            </div>
                                       
                                            <div  style="width: 30%; float:left">
                                                <label>Data do Resultado (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_outros1; ?>" class="text small data" name="data_outros"/>
                                            </div>
                                    </div>
                                    
                                    <div style="width: 100%; height:100px;">
                                     
                                                                            
                                        
                                        <?php
                                            if ($resultado_tmrtb == "Positivo") {
                                                ?>		
                                                <div  style="width: 30%; float:left">
                                                    <label>Teste molecular r�pido para TB (TMR-TB):</label><br/>
                                                    <select name="resultado_tmrtb"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Indeterminado">Indeterminado</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_tmrtb == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Teste molecular r�pido para TB (TMR-TB):</label><br/>
                                                    <select name="resultado_tmrtb"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected ="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Indeterminado">Indeterminado</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                                     
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_tmrtb == "Indeterminado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Teste molecular r�pido para TB (TMR-TB):</label><br/>
                                                    <select name="resultado_tmrtb"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected ="Indeterminado" value="Indeterminado">Indeterminado</option>
                                                        <option value="N�o realizado">N�o realizado</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($resultado_tmrtb == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Teste molecular r�pido para TB (TMR-TB):</label><br/>
                                                    <select name="resultado_tmrtb"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Indeterminado">Indeterminado</option>
                                                        <option selected ="N�o realizado" value="N�o realizado">N�o realizado</option>  
                                                    </select>	 
                                                </div>
                                                <?php
                                            
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Teste molecular r�pido para TB (TMR-TB):</label><br/>
                                                    <select name="resultado_tmrtb"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Indeterminado">Indeterminado</option>
                                                        <option value="N�o realizado">N�o realizado</option>                          
                                                    </select>	 
                                                </div>
                                            <?php } ?>
                                    
                                    
                                        <div  style="width: 30%; float:left">
                                                <label>Data do Resultado - TMR-TB (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_tmrtb; ?>" class="text small data" name="data_tmrtb"/>
                                         </div>
                                         
                                         
                                     </div> 
                                    
                                    <div style="width: 100%; height:100px;">
                                            <?php
                                            if ($da1 == "AIDS") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option selected ="AIDS" value="AIDS">AIDS</option>
                                                        <option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da1 == "Diabetes") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option selected = "Diabetes "value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da1 == "Alcoolismo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option selected = "Alcoolismo" value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                
												
												 <?php } else if ($da1 == "Tabagismo") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                      <option value="AIDS">AIDS</option>
													<option value="Diabetes">Diabetes</option>
													<option value="Alcoolismo">Alcoolismo</option>
													<option selected = "Tabagismo" value="Tabagismo">Tabagismo</option>
													<option value="Hipertens�o">Hipertens�o</option>
													<option value="C�ncer">C�ncer</option>
													<option value="Doen�a Mental">Doen�a Mental</option>   
													<option value="Drogadi��o">Drogadi��o</option> 
													<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
													<option value="Outra">Outra</option>
													<option value="Nenhuma">Nenhuma</option>
													<option value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
												
												<?php } else if ($da1 == "Hipertens�o") { ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option selected = "Hipertens�o" value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
                                            <?php } else if ($da1 == "C�ncer") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option selected = "C�ncer"value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
												
                                            <?php } else if ($da1 == "Doen�a Mental") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option selected = "Doen�a Mental" value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da1 == "Drogadi��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option selected = "Drogadi��o" value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da1 == "Outra Imunossupress�o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option selected = "Outra Imunossupress�o" value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												
                                                <?php
                                            } else
                                            if ($da1 == "Outra") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option selected = "Outra" value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da1 == "Nenhuma") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option selected ="Nenhuma" value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da1 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option selected = "Sem informa��o" value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                            
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas:</label><br/>
                                                    <select name="da1"> 
														<option selected ="" value="" ></option>
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                            <?php } ?>
                                            
											<?php 
                                            if ($da2 == "AIDS") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2: </label><br/>
                                                    <select name="da2"> 
                                                        <option selected ="AIDS" value="AIDS">AIDS</option>
                                                        <option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da2 == "Diabetes") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option selected = "Diabetes "value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da2 == "Alcoolismo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option selected = "Alcoolismo" value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                
												
												 <?php } else if ($da2 == "Tabagismo") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                      <option value="AIDS">AIDS</option>
													<option value="Diabetes">Diabetes</option>
													<option value="Alcoolismo">Alcoolismo</option>
													<option selected = "Tabagismo" value="Tabagismo">Tabagismo</option>
													<option value="Hipertens�o">Hipertens�o</option>
													<option value="C�ncer">C�ncer</option>
													<option value="Doen�a Mental">Doen�a Mental</option>   
													<option value="Drogadi��o">Drogadi��o</option> 
													<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
													<option value="Outra">Outra</option>
													<option value="Nenhuma">Nenhuma</option>
													<option value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
												
												<?php } else if ($da2 == "Hipertens�o") { ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option selected = "Hipertens�o" value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
                                            <?php } else if ($da2 == "C�ncer") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option selected = "C�ncer"value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
												
                                            <?php } else
                                            if ($da2 == "Doen�a Mental") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option selected = "Doen�a Mental" value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da2 == "Drogadi��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option selected = "Drogadi��o" value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da2 == "Outra Imunossupress�o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option selected = "Outra Imunossupress�o" value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												
                                                <?php
                                            } else
                                            if ($da2 == "Outra") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option selected = "Outra" value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da2 == "Nenhuma") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option selected ="Nenhuma" value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da2 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option selected = "Sem informa��o" value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                            
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 2:</label><br/>
                                                    <select name="da2"> 
														<option selected ="" value="" ></option>
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                            <?php } ?>
											
											
											<?php 
                                            if ($da3 == "AIDS") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option selected ="AIDS" value="AIDS">AIDS</option>
                                                        <option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da3 == "Diabetes") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option selected = "Diabetes "value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da3 == "Alcoolismo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option selected = "Alcoolismo" value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                
												
												 <?php } else if ($da3 == "Tabagismo") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                      <option value="AIDS">AIDS</option>
													<option value="Diabetes">Diabetes</option>
													<option value="Alcoolismo">Alcoolismo</option>
													<option selected = "Tabagismo" value="Tabagismo">Tabagismo</option>
													<option value="Hipertens�o">Hipertens�o</option>
													<option value="C�ncer">C�ncer</option>
													<option value="Doen�a Mental">Doen�a Mental</option>   
													<option value="Drogadi��o">Drogadi��o</option> 
													<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
													<option value="Outra">Outra</option>
													<option value="Nenhuma">Nenhuma</option>
													<option value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
												
												<?php } else if ($da3 == "Hipertens�o") { ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option selected = "Hipertens�o" value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
                                            <?php } else if ($da3 == "C�ncer") { ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option selected = "C�ncer"value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                    
                                                    </select>	 
                                                </div>
												
                                            <?php } else
                                            if ($da3 == "Doen�a Mental") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option selected = "Doen�a Mental" value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da3 == "Drogadi��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option selected = "Drogadi��o" value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												 <?php } else
                                            if ($da3 == "Outra Imunossupress�o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option selected = "Outra Imunossupress�o" value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                       
                                                    </select>	 
                                                </div>
												
												
                                                <?php
                                            } else
                                            if ($da3 == "Outra") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                        <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option selected = "Outra" value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da3 == "Nenhuma") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option selected ="Nenhuma" value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($da3 == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option selected = "Sem informa��o" value="Sem informa��o">Sem informa��o</option>                     
                                                    </select>	 
                                                </div>
                                            
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Doen�as associadas 3:</label><br/>
                                                    <select name="da3"> 
														<option selected ="" value="" ></option>
                                                       <option value="AIDS">AIDS</option>
														<option value="Diabetes">Diabetes</option>
														<option value="Alcoolismo">Alcoolismo</option>
														<option value="Tabagismo">Tabagismo</option>
														<option value="Hipertens�o">Hipertens�o</option>
														<option value="C�ncer">C�ncer</option>
														<option value="Doen�a Mental">Doen�a Mental</option>   
														<option value="Drogadi��o">Drogadi��o</option> 
														<option value="Outra Imunossupress�o">Outra Imunossupress�o</option> 											
														<option value="Outra">Outra</option>
														<option value="Nenhuma">Nenhuma</option>
														<option value="Sem informa��o">Sem informa��o</option>                      
                                                    </select>	 
                                                </div>
                                            <?php } ?>
                                       
                                            

                                        </div>
                                        <div style="width: 100%; height:100px;">
                                            <?php
                                            if ($anti_hiv == "Positivo") {
                                                ?>		
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option selected ="Positivo" value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value="Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($anti_hiv == "Negativo") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option selected="Negativo" value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($anti_hiv == "Em andamento") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option selected="Em andamento" value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($anti_hiv == "N�o realizado") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option selected="N�o realizado" value="N�o realizado">N�o realizado</option> 
                                                        <option value=" Sem informa��o">Sem informa��o</option>                         
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else
                                            if ($anti_hiv == "Sem informa��o") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option selected="Sem informa��o" value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Anti HIV:</label><br/>
                                                    <select name="anti_hiv"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Negativo">Negativo</option>
                                                        <option value="Em andamento">Em andamento</option>
                                                        <option value="N�o realizado">N�o realizado</option> 
                                                        <option value=" Sem informa��o">Sem informa��o</option>                          
                                                    </select>	 
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if ($droga == "S") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Drogas no in�cio do tratamento:</label><br/>
                                                    <select name="droga"> 
                                                        <option selected ="S" value="S">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($droga == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Drogas no in�cio do tratamento:</label><br/>
                                                    <select name="droga"> 
                                                        <option value="S">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Drogas no in�cio do tratamento:</label><br/>
                                                    <select name="droga"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="S">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php } ?>

                                        

                                            <?php
                                            if ($rifampicina == "R") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Rifampicina:</label><br/>
                                                    <select name="rifampicina"> 
                                                        <option selected ="R" value="R">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($rifampicina == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Rifampicina:</label><br/>
                                                    <select name="rifampicina"> 
                                                        <option value="R">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Rifampicina:</label><br/>
                                                    <select name="rifampicina"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="R">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php } ?>
                                                
                                            </div>
                                        <div style="width: 100%; height:100px;">
                                            
                                            <?php
                                            if ($izoniazida == "H") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Izoniazida:</label><br/>
                                                    <select name="izoniazida"> 
                                                        <option selected ="H" value="H">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($izoniazida == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Izoniazida:</label><br/>
                                                    <select name="izoniazida"> 
                                                        <option value="H">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Izoniazida:</label><br/>
                                                    <select name="izoniazida"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="H">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if ($estreptomicina == "S") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Estreptomicina:</label><br/>
                                                    <select name="estreptomicina"> 
                                                        <option selected ="S" value="S">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($estreptomicina == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Estreptomicina:</label><br/>
                                                    <select name="estreptomicina"> 
                                                        <option value="S">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Estreptomicina:</label><br/>
                                                    <select name="estreptomicina"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="S">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php } ?>
                                        
                                            <?php
                                            if ($pirazinamida == "Z") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Pirazinamida:</label><br/>
                                                    <select name="pirazinamida"> 
                                                        <option selected ="Z" value="Z">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($pirazinamida == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Pirazinamida:</label><br/>
                                                    <select name="pirazinamida"> 
                                                        <option value="Z">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Pirazinamida:</label><br/>
                                                    <select name="pirazinamida"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Z">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php } ?>

                                            </div>
                                        <div style="width: 100%; height:100px;">
                                            
                                            <?php
                                            if ($etambutol == "E") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Etambutol:</label><br/>
                                                    <select name="etambutol"> 
                                                        <option selected ="E" value="E">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($etambutol == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Etambutol:</label><br/>
                                                    <select name="etambutol"> 
                                                        <option value="E">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Etambutol:</label><br/>
                                                    <select name="etambutol"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="E">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>

                                            <?php
                                            if ($etionamida == "ET") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Etionamida:</label><br/>
                                                    <select name="etionamida"> 
                                                        <option selected ="ET" value="ET">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($etionamida == "N") {
                                                ?>
                                            <div  style="width: 30%; float:left">
                                                    <label>Etionamida:</label><br/>
                                                    <select name="etionamida"> 
                                                        <option value="ET">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                            </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Etionamida:</label><br/>
                                                    <select name="etionamida"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="ET">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>
                                            
                                            <?php
                                            if ($rifambutina == "RB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Rifabutina:</label><br/>
                                                    <select name="rifambutina"> 
                                                        <option selected ="RB" value="RB">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($rifambutina == "N") {
                                                ?>
                                            <div  style="width: 30%; float:left">
                                                    <label>Rifabutina:</label><br/>
                                                    <select name="rifambutina"> 
                                                        <option value="RB">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                            </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Rifabutina:</label><br/>
                                                    <select name="rifambutina"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="RB">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>
                                            
                                        </div>
										
										
										<div style="width: 100%; height:100px;">
                                            
                                            <?php
                                            if ($levofloxacina == "LV") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Levofloxacina:</label><br/>
                                                    <select name="levofloxacina"> 
                                                        <option selected ="LV" value="LV">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($levofloxacina == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Levofloxacina:</label><br/>
                                                    <select name="levofloxacina"> 
                                                        <option value="LV">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Levofloxacina:</label><br/>
                                                    <select name="levofloxacina"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="LV">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>

                                            <?php
                                            if ($ofloxacina == "OF") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Ofloxacina:</label><br/>
                                                    <select name="ofloxacina"> 
                                                        <option selected ="OF" value="OF">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($ofloxacina == "N") {
                                                ?>
                                            <div  style="width: 30%; float:left">
                                                    <label>Ofloxacina:</label><br/>
                                                    <select name="ofloxacina"> 
                                                        <option value="OF">Sim</option>
                                                        <option selected ="N" value="N">N�o</option>                 
                                                    </select>
                                            </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Ofloxacina:</label><br/>
                                                    <select name="ofloxacina"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="OF">Sim</option>
                                                        <option value="N">N�o</option>                 
                                                    </select>
                                                </div>
                                            <?php }
                                            ?>
                                            
                                           
                                            
                                        </div>
										
										
										
                                        <div style="width: 100%; height:100px;">
                                            <?php
                                            if ($alta == "Cura") {
                                                ?>

                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option selected ="Cura" value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($alta == "Abandono") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option value="Cura">Cura</option>                 
                                                        <option selected ="Abandono" value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($alta == "�bito por TB") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option selected ="�bito por TB" value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($alta == "�bito por outras causas") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option selected ="�bito por outras causas" value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($alta == "Transfer�ncia") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option selected ="Transfer�ncia" value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else
                                            if ($alta == "N") {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option selected ="" value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div  style="width: 30%; float:left">
                                                    <label>Alta:</label><br/>
                                                    <select name="alta"> 
                                                        <option selected ="" value="" ></option>
                                                        <option value="Cura">Cura</option>                 
                                                        <option value="Abandono">Abandono</option>
                                                        <option value="�bito por TB">�bito por TB</option>  
                                                        <option value="�bito por outras causas">�bito por outras causas</option>                 
                                                        <option value="Transfer�ncia">Transfer�ncia</option>
                                                        <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option>  
                                                    </select>
                                                </div>
                                            <?php } ?>


                                            <div  style="width: 30%; float:left">
                                                <label>Data da alta (dd/mm/aaaa): </label><br/>
                                                <input type="text" value="<?= $data_alta1; ?>" class="text small data" name="data_alta"/>
                                            </div>

                                            <div  style="width: 30%; float:left">
                                                <label>Observa��es:</label><br/>
                                                <input type="text" value="<?= $observacoes; ?>" class="text small" name="observacoes" /> 
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <script>
                                        function verificaDroga( value ){
                                            if( value == "S"){
                                                document.getElementById("labelselect1").style.display = "";
                                                document.getElementById("select1").style.display = "";
                                                
                                                document.getElementById("labelselect2").style.display = "";
                                                document.getElementById("select2").style.display = "";
                                                
                                                document.getElementById("labelselect3").style.display = "";
                                                document.getElementById("select3").style.display = "";
                                                
                                                document.getElementById("labelselect4").style.display = "";
                                                document.getElementById("select4").style.display = "";
                                                
                                                document.getElementById("labelselect5").style.display = "";
                                                document.getElementById("select5").style.display = "";
                                                
                                                document.getElementById("labelselect6").style.display = "";
                                                document.getElementById("select6").style.display = "";

                                                document.getElementById("labelselect7").style.display = "";
                                                document.getElementById("select7").style.display = "";

                                                document.getElementById("labelselect8").style.display = "";
                                                document.getElementById("select8").style.display = "";

                                                document.getElementById("labelselect9").style.display = "";
                                                document.getElementById("select9").style.display = "";
                                                
                                                document.getElementById("labelData").style.display = "";
                                                document.getElementById("inputData").style.display = "";
                                                document.getElementById("inputData").disabled = false;
                                                

                                            }else if(value == "N") {
                                                document.getElementById("labelselect1").style.display = "None";
                                                document.getElementById("select1").style.display = "None";
                                                
                                                document.getElementById("labelselect2").style.display = "None";
                                                document.getElementById("select2").style.display = "None";
                                                
                                                document.getElementById("labelselect3").style.display = "None";
                                                document.getElementById("select3").style.display = "None";
                                                
                                                document.getElementById("labelselect4").style.display = "None";
                                                document.getElementById("select4").style.display = "None";
                                                
                                                document.getElementById("labelselect5").style.display = "None";
                                                document.getElementById("select5").style.display = "None";
                                                
                                                document.getElementById("labelselect6").style.display = "None";
                                                document.getElementById("select6").style.display = "None";

                                                document.getElementById("labelselect7").style.display = "None";
                                                document.getElementById("select7").style.display = "None";

                                                document.getElementById("labelselect8").style.display = "None";
                                                document.getElementById("select8").style.display = "None";

                                                document.getElementById("labelselect9").style.display = "None";
                                                document.getElementById("select9").style.display = "None";
                                                
                                                document.getElementById("labelData").style.display = "None";
                                                document.getElementById("inputData").style.display = "None";
                                                document.getElementById("inputData").disabled = true;
                                          
                                            }
                                            
                                              
                                                
                                        }
                                           
                                        

                                    
                                        
                                    </script>
                                        <div style="width: 100%; height:100px;">
                                        <div  style="width: 30%; float:left">    
                                        <label>Mudan�a de drogas no decorrer do tratamento:</label><br/>
                                        <select name="droga_decorrer" onChange="verificaDroga(this.value)"> 
                                            <option selected ="" value="" ></option>
                                            <option value="S">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                        </div>
                                            
                                        <div  style="width: 30%; float:left">                                              
                                            <label id="labelData" style="display:none">Data da mudan�a de drogas:</label><br/>
                                            <input id="inputData" disabled style="display:none" type="text" class="text small data"  name = "data_mudanca"/> 
  
                                        </div>
                                            
                                            
                                            
                                        </div>
                                    
                                    <div style="width: 100%; height:100px;">
                                        <div  style="width: 30%; float:left">
                                        <label id="labelselect1" style="display:none">Rifampicina:</label><br/>
                                        <select id="select1" name="rifampicinaT" style="display:none"> 
                                            <option selected ="" value="" ></option>
                                            <option value="R">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                    
  
                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect2">Izoniazida:</label><br/>
                                        <select style="display:none" id="select2" name="izoniazidaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="H">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                    
                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect3">Estreptomicina:</label><br/>
                                        <select style="display:none" id="select3"  name="estreptomicinaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="S">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                    </div>
                                    <div style="width: 100%; height:100px;">
                                    
                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect4">Pirazinamida:</label><br/>
                                        <select style="display:none" id="select4" name="pirazinamidaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="Z">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                    
                                    
                                    
        
                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect5">Etambutol:</label><br/>
                                        <select style="display:none" id="select5" name="etambutolT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="E">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                    
                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect6">Etionamida:</label><br/>
                                        <select style="display:none" id="select6" name="etionamidaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="ET">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>
                                     </div>

                                     <div style="width: 100%; height:100px;">

                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect7">Rifabutina:</label><br/>
                                        <select style="display:none" id="select7" name="rifabutinaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="RB">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>

                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect8">Levofloxacina:</label><br/>
                                        <select style="display:none" id="select8" name="levofloxacinaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="LV">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>

                                     <div  style="width: 30%; float:left">
                                        <label style="display:none" id="labelselect9">Ofloxacina:</label><br/>
                                        <select style="display:none" id="select9" name="ofloxacinaT"> 
                                            <option selected ="" value="" ></option>
                                            <option value="OF">Sim</option>
                                            <option value="N">N�o</option>                 
                                        </select>
                                     </div>

                                    </div>

                                            <p>
                                                <button  class="classy" onclick="return confirm('Tem certeza que deseja atualizar os dados deste paciente?');"><span>Salvar altera��es</span></button>
                                            </p>

                                    </form>
                                
                                <!-- form elements [end] -->

						
								<?php } ?>

                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with gradient [end] --> 

				<?php //else da permissao
            } 
            ?>

            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->