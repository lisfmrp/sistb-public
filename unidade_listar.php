<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Unidades ::</span></span></span></h3>
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
                                    $nome = $param1;
                                    $select = "SELECT *
                                               FROM unidade
                                               WHERE nome like '%$nome%' 
                                               ORDER BY nome LIMIT $inicio,$maximo";
                                    $consultas = $db->selectQuery($select);							
                                    $total = sizeof($db->selectQuery("SELECT cod_unidade
                                               FROM unidade
                                               WHERE nome like '%$nome%'"));
								?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>
                                                <th>Nome da Unidade</th>
                                                <th>Endereço</th>
                                                <th>Cidade</th>
                                                <th>Estado</th>
                                                <th>Telefone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php										
											foreach ($consultas as $consulta) {											 
                                                $cod_un = $consulta['cod_unidade'];                                              
                                                $nome = (strtoupper($consulta['nome']));
                                                $cidade = (strtoupper($consulta['cidade']));
												$estado = $consulta['estado'];
												$endereco = (strtoupper($consulta['endereco']));
                                                $telefone = $consulta['telefone'];                                                
                                        ?>
                                                <tr>
                                                    <td><?=$cont?></td>
                                                    <td>
														<a href="index.php?acao=unidade_form&cod_unidade=<?=$cod_un?>" class="minibutton"><span>Ver dados</span></a>
														<a href="unidade_boletim_acompanhamento_pdf.php?cod_unidade=<?=$cod_un?>" class="minibutton" target="_blank"><span>Boletim de Acompanhamento</span></a>
													</td>                                              
                                                    <td><?=$nome?></td>
                                                    <td><?=$endereco?></td>
                                                    <td><?=$cidade?></td>
                                                    <td><?=$estado?></td>
                                                    <td><?=$telefone?></td>
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
                                                echo "<a href=index.php?acao=unidade_listar+&pagina=$menos&busca=$param1><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=unidade_listar&pagina=$i&busca=$param1><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=unidade_listar&pagina=$mais&busca=$param1><span> >> </span></a> ";
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