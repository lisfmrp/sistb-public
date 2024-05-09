<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Lista de contatos ::</span></span></span></h3>
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
                                if (isset($_GET)) {
                                    $cod_paciente = $_GET["cod_paciente"];
                                    
                                    $sql = "SELECT *
                                               FROM contato
                                               WHERE contato.cod_paciente = $cod_paciente AND excluido = 0
                                               ORDER BY contato.nome";
                                    $consultas = $db->selectQuery($sql);
                                                                      
                                    $sql = "SELECT tratamento.data_tratamento_atual, unidade.nome
                                               FROM tratamento, unidade
                                               WHERE tratamento.cod_paciente = $cod_paciente AND unidade.cod_unidade = tratamento.un_atendimento
                                               ORDER BY data_tratamento_atual DESC";
                                    $consultas2 = $db->selectQuery($sql);
								
									$inicio = $consultas2[0]['data_tratamento_atual'];
									$unidade = $consultas2[0]['nome'];								
                                    $sql = "SELECT nome, sinan FROM paciente WHERE cod_paciente = $cod_paciente";                                    
                                    $consultas3 = $db->selectQuery($sql);								
                                    $paciente = $consultas3[0]['nome'];
                                    $sinan = $consultas3[0]['sinan'];
                                                                
                                    if ($inicio != NULL)
                                        $dataInicio = implode("/",array_reverse(explode("-",$inicio)));
                                    else 
										$dataInicio = "-";
                                    ?>
                                    <strong>Paciente: </strong><?=$paciente?><br/>
									<strong>SINAN: </strong><?=$sinan?><br/>
									<strong>Unidade de atendimento: </strong><?=$unidade?><br/>
									<strong>Data do início do tratamento: </strong><?=$dataInicio?>
									<table class="infotable" cellspacing="0" cellpadding="0" width="100%" style="margin-top:25px;">
                                        <thead>																				
                                            <tr>  
                                                <th>#</th>                                                
                                                <th>Contato</th>
                                                <th>Tipo de contato</th>
                                                <th>Idade</th>
                                                <th>Data da consulta</th>
                                                <th>Bac. esc.</th>
                                                <th>RX torax</th>
                                                <th>PPD</th>
                                                <th>Coinfec</th>
                                                <th>Quimio</th>
                                                <th>Data início</th>
                                                <th>Saída</th>
                                                <th>Data saída</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											$cont = 1;
											foreach ($consultas as $infos) {											
												$cod_paciente = $infos['cod_paciente'];
												$nome = (strtoupper($infos['nome']));
												$idade = $infos['idade'];
												$grau_parentesco = (strtoupper($infos['grau_parentesco']));
												$data_baciloscopia = $infos['data_baciloscopia'];
												$resultado_baciloscopia = (strtoupper($infos['resultado_baciloscopia']));
												$data_rx_pulmao = $infos['data_rx_pulmao'];
												$resultado_rx_pulmao = (strtoupper($infos['resultado_rx_pulmao']));
												$data_ppd = $infos['data_ppd'];
												$resultado_ppd = (strtoupper($infos['resultado_ppd']));
												$quimioprofilaxia = $infos['quimioprofilaxia'];
												$data_quimio = $infos['data_quimioprofilaxia'];
												$data_retorno = $infos['data_retorno'];
												$data_nasc = $infos['data_nascimento'];
												$tipo_saida = (strtoupper($infos['tipo_saida']));
												$coinfeccao = $infos['coinfeccao'];
												$data_saida = $infos['data_saida'];
																								   
												if ($data_quimio != NULL)
													$data = implode("/",array_reverse(explode("-",$data_quimio)));
												else 
													$data = "-";
												
												if ($data_retorno != NULL)
													$dataRe = implode("/",array_reverse(explode("-",$data_retorno)));
												else 
													$dataRe = "-";
																								
												if ($data_saida != NULL)
													$data_saida1 = implode("/", array_reverse(explode("-", $data_saida)));
												else
													$data_saida1 = "";                                                
												
												if ($quimioprofilaxia == "S")
													$qui = "Sim";
												else if ($quimioprofilaxia == "N")
													$qui = "Não";
												else 
													$qui = " ";
												
												if ($coinfeccao == "S")
													$coinfec = "Sim";
												else if ($coinfeccao == "N")
													$coinfec = "Não";
												else 
													$coinfec = " ";
                                                
                                                ?>
                                                <tr>
                                                    <td><?=$cont?></td>
                                                    <td><?=$nome?></td>
                                                    <td><?=$grau_parentesco?></td>
                                                    <td><?=$idade?></td>
                                                    <td><?=$dataRe?></td>
                                                    <td><?=$resultado_baciloscopia?></td>
                                                    <td><?=$resultado_rx_pulmao?></td>
                                                    <td><?=$resultado_ppd?></td>
                                                    <td><?=$coinfec?></td>
                                                    <td><?=$qui?></td>
                                                    <td><?=$data?></td>
                                                    <td><?=$tipo_saida?></td>
                                                    <td><?=$data_saida1?></td>
                                                </tr>
                                        <?php
												$cont++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <?php
                                }
                                ?>
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