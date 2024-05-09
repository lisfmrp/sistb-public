<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Lista de tratamentos ::</span></span></span></h3>
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
                                    $mae = $param2;
										if ($mae!=''){                                        
											$select = "SELECT paciente.cod_paciente, paciente.nro_hygia, paciente.nome, paciente.cns, paciente.mae, 
                                                      paciente.data_nascimento, tratamento.cod_paciente, tratamento.data_tratamento_atual, tratamento.cod_tratamento,
                                                      tratamento.encerrado  
                                               FROM paciente, tratamento
                                               WHERE paciente.nome LIKE '%$nome%' AND paciente.mae LIKE '%$mae%' AND paciente.cod_paciente=tratamento.cod_paciente
                                                   ORDER BY tratamento.un_supervisao DESC, tratamento.data_tratamento_atual DESC LIMIT $inicio,$maximo";
											$consultas = $db->selectQuery($select);                                        
											$total = sizeof($db->selectQuery("SELECT paciente.cod_paciente
                                                   FROM paciente, tratamento
                                                   WHERE paciente.nome LIKE '%$nome%' AND paciente.mae LIKE '%$mae%' AND paciente.cod_paciente=tratamento.cod_paciente
                                                   ORDER BY tratamento.un_supervisao DESC, tratamento.data_tratamento_atual DESC "));
                                        } else {
                                            $select = "SELECT paciente.cod_paciente, paciente.nro_hygia, paciente.nome, paciente.cns, paciente.mae, 
                                                      paciente.data_nascimento, tratamento.cod_paciente, tratamento.data_tratamento_atual, tratamento.cod_tratamento,
                                                      tratamento.encerrado  
                                               FROM paciente, tratamento
                                               WHERE paciente.nome LIKE '%$nome%' AND paciente.cod_paciente=tratamento.cod_paciente
                                               ORDER BY tratamento.un_supervisao DESC, tratamento.data_tratamento_atual DESC LIMIT $inicio,$maximo";
                                            $consultas = $db->selectQuery($select);                                            
                                            $total = sizeof($db->selectQuery("SELECT paciente.cod_paciente 
                                                       FROM paciente, tratamento
                                                       WHERE paciente.nome LIKE '%$nome%' AND paciente.cod_paciente=tratamento.cod_paciente
                                                       ORDER BY tratamento.un_supervisao DESC, tratamento.data_tratamento_atual DESC "));                                             
										}
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th></th>
                                                <th>Ver ficha do tratamento</th>
                                                <th>Status do tratamento</th>
                                                <th>Data início tratamento</th>
                                                <th>Hygia</th>
                                                <th>Nome</th>
                                                <th>Data nascimento</th>
                                                <th>Nome da mãe</th>                                                
                                                <th>CNS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											foreach ($consultas as $consulta) {
											 
                                                $cod_paciente = $consulta['cod_paciente'];
                                                $nro_hygia = $consulta['nro_hygia'];
                                                $nome = (strtoupper($consulta['nome']));
                                                $cns = $consulta['cns'];
                                                $nome_mae = (strtoupper($consulta['mae']));
                                                $data_nasc = $consulta['data_nascimento'];
                                                $data_trat = $consulta['data_tratamento_atual'];
                                                $cod_trat = $consulta['cod_tratamento'];
                                                $encerrado = $consulta['encerrado'];

                                                if ($data_nasc != NULL) {
                                                    $data = implode("/",array_reverse(explode("-",$data_nasc)));
                                                } else { 
													$data = 0;
												}
                                                if ($data_trat != NULL) {
                                                    $dataT = implode("/",array_reverse(explode("-",$data_trat)));
                                                } else {
													$dataT = 0;
												}
                                                ?>
                                                <tr>
                                                    <td><?=$cont?></td>
                                                    <td>
														<a href="index.php?acao=tratamento_form&cod_tratamento=<?=$cod_trat?>" class="minibutton"><span>Ver ficha</span></a>
														<a href="tratamento_ficha_acompanhamento_tb_pdf.php?cod_tratamento=<?=$cod_trat;?>&cod_paciente=<?=$cod_paciente?>" class="minibutton" target="_blank"><span>Ficha de notificação</span></a>
													</td>
                                                    <?php if($encerrado == "0") { ?>
                                                    <td bgcolor="red"><font color = "black"><b>Em andamento</b></font></td>
                                                    <?php } else if($encerrado == "1") { ?>
                                                    <td bgcolor="green"><font color = "black"><b>Encerrado</b></font></td>
                                                    <?php } else if($encerrado == "2") { ?>
                                                    <td bgcolor="#3299CC"><font color = "black"><b>Arquivo</b></font></td>
                                                    <?php } ?>                                                    
                                                    <td><?=$dataT?></td>
                                                    <td><?=$nro_hygia?></td>
                                                    <td><?=$nome?></td>
                                                    <td><?=$data?></td>
                                                    <td><?=$nome_mae?></td>
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
                                                echo "<a href=index.php?acao=tratamento_listar&pagina=$menos&busca=$param1&busca2=$param2><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=tratamento_listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=tratamento_listar&pagina=$mais&busca=$param1&busca2=$param2><span> >> </span></a> ";
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