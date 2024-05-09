<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Tratamentos e Supervisões ::</span></span></span></h3>
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
                                $cod_paciente = 1;
                                $cont = ($pagina * 10) - 9;
                                if (isset($_REQUEST)) {
                                    $nome = $_REQUEST["busca"];
                                    $statusTratamento = $_REQUEST["busca2"];
									$mes = $_REQUEST["busca3"];
                                    $ano = $_REQUEST["busca4"];		
									
									$filter = "";
									if($nome != "")
										$filter .= " AND pac.nome like '%$nome%'";							
									
									if($statusTratamento != "")
										$filter .= " AND t.encerrado = $statusTratamento";
									
									if($mes != "")
										$filter .= " AND MONTH(data_tratamento_atual) = $mes";
									
									if($ano != "")
										$filter .= " AND YEAR(data_tratamento_atual) = $ano";
									
									if($_SESSION["admin"] == 0)
										$filter .= " AND t.un_supervisao = $_SESSION[cod_unidade]";
									
									$sql = "SELECT 
												pac.nome, pac.mae, t.data_tratamento_atual, u1.nome as un_sup, u2.nome as un_at, t.cod_tratamento, t.encerrado 
											FROM tratamento as t 
												INNER JOIN paciente as pac ON t.cod_paciente = pac.cod_paciente
												INNER JOIN unidade as u1 ON t.un_supervisao = u1.cod_unidade
												INNER JOIN unidade as u2 ON t.un_atendimento = u2.cod_unidade
											WHERE 
												1=1
												$filter
											ORDER BY t.un_supervisao, t.data_tratamento_atual DESC LIMIT $inicio, $maximo";
									$consultas = $db->selectQuery($sql);
									$total = sizeof($db->selectQuery("SELECT pac.cod_paciente
											FROM tratamento as t 
												INNER JOIN paciente as pac ON t.cod_paciente = pac.cod_paciente
												INNER JOIN unidade as u1 ON t.un_supervisao = u1.cod_unidade
												INNER JOIN unidade as u2 ON t.un_atendimento = u2.cod_unidade
											WHERE 
												1=1
												$filter"));
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>
                                                <th>Estado do tratamento</th>
                                                <th>Paciente</th>
												<th>Nome da mãe</th>
                                                <th>Início do tratamento</th>
                                                <th>Unidade de Supervisão</th>
                                                <th>Unidade de Atendimento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php								
											 foreach ($consultas as $consulta) {  
                                                $nome_paciente = (ucwords($consulta['nome']));
												$nome_mae = (ucwords($consulta['mae']));
												$data_tratamento = $consulta['data_tratamento_atual'];
                                                $uni_sup = (ucwords($consulta['un_sup']));
												$uni_at = (ucwords($consulta['un_at']));
												$cod_tratamento = $consulta['cod_tratamento'];
                                                $encerrado = $consulta['encerrado'];
												
                                                if ($data_tratamento == NULL || $data_tratamento == "" || $data_tratamento == "0000-00-00") {
                                                    $data_tratamento = "";
                                                } else { 
                                                    $data_tratamento = implode("/",array_reverse(explode("-",$data_tratamento)));
                                                }
                                         ?>
                                                <tr>
                                                    <td><?=$cont?></td>
                                                    <td><a href="index.php?acao=supervisionamento_ficha&cod_tratamento=<?= $cod_tratamento ?>" class="minibutton"><span>Ver supervisão</span></a></td>
                                                    <?php if($encerrado == 0) { ?>
                                                    <td bgcolor="red"><span style="color:black;"><b>Em andamento</b></span></td>
                                                    <?php } else if($encerrado == 1) { ?>
                                                    <td bgcolor="green"><span style="color:black;"><b>Encerrado</b></span></td>
                                                    <?php } ?>
                                                    <td><?=$nome_paciente?></td>
													<td><?=$nome_mae?></td>
                                                    <td><?=$data_tratamento?></td>
                                                    <td><?=$uni_sup?></td>
                                                    <td><?=$uni_at?></td>
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
                                                echo "<a href=index.php?acao=supervisionamento_listar&pagina=$menos&busca=$nome&busca2=$statusTratamento&busca3=$mes&busca4=$ano><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=supervisionamento_listar&pagina=$i&busca=$nome&busca2=$statusTratamento&busca3=$mes&busca4=$ano><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=supervisionamento_listar&pagina=$mais&busca=$nome&busca2=$statusTratamento&busca3=$mes&busca4=$ano><span> >> </span></a> ";
                                            }
                                        }
                                    ?>
                                    </div>
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