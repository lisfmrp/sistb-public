<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Internações ::</span></span></span></h3>
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
                                    $param3 = $_REQUEST["busca3"];
                                    $nome = $param1;
                                    $motivo = $param2;
                                    $cod_unidade = $param3;
                                    $sql = "SELECT paciente.cod_paciente, paciente.cpf, paciente.nome, 
                                                      paciente.data_nascimento, internacao.cod_paciente,
                                                     internacao.cod_internacao, internacao_motivo.motivo, internacao_tipo_alta.tipo_alta,
                                                     internacao.data_internacao, internacao.data_alta, internacao.cod_unidade
                                               FROM internacao 
											   INNER JOIN paciente ON paciente.cod_paciente = internacao.cod_paciente
                                               INNER JOIN unidade ON unidade.cod_unidade = internacao.cod_unidade
											   INNER JOIN internacao_motivo ON internacao_motivo.cod_motivo_internacao = internacao.cod_motivo_internacao
                                               LEFT JOIN internacao_tipo_alta ON internacao_tipo_alta.cod_tipo_alta = internacao.cod_tipo_alta
											   WHERE paciente.nome LIKE '%$nome%' AND internacao_motivo.cod_motivo_internacao LIKE '%$motivo%'
                                               AND internacao.cod_unidade LIKE '%$cod_unidade%'     
                                               ORDER BY internacao.data_internacao DESC LIMIT $inicio,$maximo";
                                    $result = $db->selectQuery($sql);
                                    $total = sizeof($db->selectQuery("SELECT paciente.cod_paciente
                                               FROM internacao 
											   INNER JOIN paciente ON paciente.cod_paciente = internacao.cod_paciente
                                               INNER JOIN unidade ON unidade.cod_unidade = internacao.cod_unidade
											   INNER JOIN internacao_motivo ON internacao_motivo.cod_motivo_internacao = internacao.cod_motivo_internacao
                                               LEFT JOIN internacao_tipo_alta ON internacao_tipo_alta.cod_tipo_alta = internacao.cod_tipo_alta
                                               WHERE paciente.nome LIKE '%$nome%' AND internacao_motivo.cod_motivo_internacao LIKE '%$motivo%'
                                               AND internacao.cod_unidade LIKE '%$cod_unidade%'"));
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>
                                                <th>Nome do Paciente</th>
                                                <th>Local da internação</th>
                                                <th>Motivo da internação</th>
                                                <th>Data da internação</th>
                                                <th>Tipo de alta</th>
                                                <th>Data da alta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												foreach ($result as $consulta) {						
													$cod_paciente =$consulta['cod_paciente'];
													$cpf = $consulta['cpf'];
													$nome = $consulta['nome'];
													$data_nasc = $consulta['data_nascimento'];
													$cod_int = $consulta['cod_internacao'];
													$motivo = ($consulta['motivo']);
													$tipo_alta = ($consulta['tipo_alta']);
													$data_internacao = $consulta['data_internacao'];
													$data_alta = $consulta['data_alta'];
													$hospital = $consulta['cod_unidade'];
																					   
													if ($data_alta != NULL || $data_alta != "0000-00-00" || $data_alta != "") {                                                                                                    
														 $data_alta = implode("/",array_reverse(explode("-",$data_alta)));
													} else {
														$data_alta = "";
													}
													
													if ($data_internacao != NULL || $data_internacao != "0000-00-00" || $data_internacao != "") {                                                                                    
														 $data_internacao = implode("/",array_reverse(explode("-",$data_internacao)));
													} else {
														$data_internacao = "";
													}

													$selectu1 = "SELECT nome FROM unidade WHERE cod_unidade = '$hospital'";
													$consultan = $db->selectQuery($selectu1);
													if (empty($consultan[0])) {
														$nome_un_not = " ";
													} else {
														$nome_hospital = ($consultan[0]['nome']);
													}
                                            ?>
													<tr>
														<td><?=$cont?></td>
														<td><a href="index.php?acao=internacao_form&cod_internacao=<?=$cod_int?>" class="minibutton"><span>Ficha da Internação</span></a></td>                                                                                         
														<td><?=$nome?></td>
														<td><?=$nome_hospital?></td>
														<td><?=$motivo?></td>
														<td><?=$data_internacao?></td>  
														<td><?=$tipo_alta?></td>
														<td><?=$data_alta?></td>
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
                                                echo "<a href=index.php?acao=internacao_listar&pagina=$menos&busca=$param1&busca2=$param2&busca3=$param3><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=internacao_listar&pagina=$i&busca=$param1&busca2=$param2&busca3=$param3><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=internacao_listar&pagina=$mais&busca=$param1&busca2=$param2&busca3=$param3><span> >> </span></a> ";
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