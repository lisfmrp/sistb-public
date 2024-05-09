<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Pacientes ::</span></span></span></h3>
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
                                    $param1 = $_REQUEST["busca"];
                                    $param2 = $_REQUEST["busca2"];
                                    $nome = $param1;
                                    $mae = $param2;                                                                       
                                    //0 = em andamento
									$e=0;
									if ($mae!= " ") {
										$sql = "SELECT paciente.cod_paciente, paciente.nro_hygia, paciente.nome, paciente.cns, paciente.mae, paciente.data_nascimento																				
										  FROM paciente
										  WHERE paciente.nome like '%$nome%' AND paciente.mae like '%$mae%' 
										  ORDER BY paciente.nome LIMIT $inicio,$maximo";
										$consultas = $db->selectQuery($sql);								
										$total = sizeof($db->selectQuery("SELECT cod_paciente
										   FROM paciente
										   WHERE nome like '%$nome%' AND mae like '%$mae%'"));
									} else{
										$sql = "SELECT paciente.cod_paciente, paciente.nro_hygia, paciente.nome, paciente.cns, paciente.mae, paciente.data_nascimento 																				
										  FROM paciente
										  WHERE paciente.nome like '%$nome%' 
										  ORDER BY paciente.nome LIMIT $inicio,$maximo";
										$consultas = $db->selectQuery($sql);								
										$total = sizeof($db->selectQuery("SELECT cod_paciente
										   FROM paciente
										   WHERE nome like '%$nome%'"));                                        
                                    }
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>
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
												$cod =$consulta['cod_paciente'];
                                                $nro_hygia = $consulta['nro_hygia'];
                                                $nome = $consulta['nome'];
                                                $cns = $consulta['cns'];
                                                $nome_mae = $consulta['mae'];
                                                $data_nasc = $consulta['data_nascimento'];                                                
                                                if ($data_nasc != "0000-00-00" && $data_nasc != NULL) 
                                                    $data = implode("/",array_reverse(explode("-",$data_nasc)));
                                                else 
													$data = 0;
                                        ?>
                                                <tr>
                                                    <td><?=$cont?></td>
                                                    <td>
														<a href="index.php?acao=paciente_form&cod_paciente=<?=$cod?>" class="minibutton"><span>Ver ficha</span></a>
														<a href="index.php?acao=contato_relatorio&cod_paciente=<?=$cod?>" class="minibutton"><span>Ver contatos</span></a>
														<a href="index.php?acao=paciente_outros_sistemas&cod_paciente=<?=$cod?>" class="minibutton"><span>Ver dados de outros sistemas</span></a>
													</td>            
                                                    <td><?=$nro_hygia?></td>
                                                    <td><?=($nome)?></td>
                                                    <td><?=$data?></td>
                                                    <td><?=($nome_mae)?></td>                                                    
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
                                                echo "<a href=index.php?acao=paciente_listar&pagina=$menos&busca=$param1&busca2=$param2><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=paciente_listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=paciente_listar&pagina=$mais&busca=$param1&busca2=$param2><span> >> </span></a> ";
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