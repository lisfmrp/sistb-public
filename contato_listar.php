<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Contatos ::</span></span></span></h3>
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
								// Maximo de registros por pagina
								$maximo = 10;
								if (!isset($_REQUEST['pagina'])) {
									$pagina = "1";
								} else {
									$pagina = $_REQUEST['pagina'];
								}
								// Calculando o registro inicial
								$inicio = $pagina - 1;
								$inicio = $maximo * $inicio;
								$cont = ($pagina * 10) - 9;
							    if (isset($_REQUEST)) {
									$param1 = $_REQUEST["busca"];
									$param2 = $_REQUEST["busca2"];
									$nome = $param1;
									$contato = $param2;
									$select = "SELECT paciente.nro_hygia, paciente.nome, paciente.cns,  
													  contato.cod_contato, contato.nome as nome_contato, 
													  contato.data_nascimento as data_nasc_contato, contato.grau_parentesco														 
											   FROM paciente, contato
											   WHERE paciente.nome LIKE '%$nome%' AND contato.nome LIKE '%$contato%' 
													AND paciente.cod_paciente = contato.cod_paciente AND contato.excluido = 0
											   ORDER BY paciente.nome LIMIT $inicio,$maximo";
									$consultas = $db->selectQuery($select);										
									$total = sizeof($db->selectQuery("SELECT contato.cod_contato
																	   FROM paciente, contato
																	   WHERE paciente.nome LIKE '%$nome%' AND contato.nome LIKE '%$contato%' 
																		AND paciente.cod_paciente = contato.cod_paciente AND contato.excluido = 0 "));
							?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>                                                
                                                <th>Nome do Contato</th>
												<th>Grau de Parentesco</th>
                                                <th>Data de nasc. do Contato</th>
												<th>Nome do Paciente</th>
                                                <th>Hygia</th>
                                                <th>CNS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											foreach ($consultas as $consulta) {																						
                                                $nro_hygia = $consulta['nro_hygia'];
                                                $nome = (strtoupper($consulta['nome']));
                                                $cns = $consulta['cns'];
												$cod_contato = $consulta['cod_contato'];
                                                $cont_nome = (strtoupper($consulta['nome_contato']));
												$parentesco = (strtoupper($consulta['grau_parentesco']));
												$cont_nasc = $consulta['data_nasc_contato'];											                                               
											
                                                if ($cont_nasc != NULL) {
                                                    $dataC = implode("/",array_reverse(explode("-",$cont_nasc)));
                                                } else {
													$dataC = "";
												}
                                        ?>
                                                <tr>
                                                    <td><?=$cont?>.</td>
                                                    <td><a href="index.php?acao=contato_form&cod_contato=<?=$cod_contato?>" class="minibutton"><span>Ver ficha do Contato</span></a></td>                                               
                                                    <td><?=$cont_nome?></td>
													<td><?=$parentesco?></td>
                                                    <td><?=$dataC?></td>
													<td><?=$nome?></td>
                                                    <td><?=$nro_hygia?></td>
                                                    <td><?=$cns?></td>                                                    
                                                </tr>
                                        <?php
												$cont++;
                                            }
                                        ?>
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
                                                echo "<a href=index.php?acao=contato_listar&pagina=$menos&busca=$param1&busca2=$param2><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=contato_listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=contato_listar&pagina=$mais&busca=$param1&busca2=$param2><span> >> </span></a> ";
                                            }
                                        }
                                    ?>
                                    </div>
                            <?php } ?>	
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