<?php
require_once("autenticacao.php"); 
if ($_SESSION["admin"] == 1) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Profissionais ::</span></span></span></h3>
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
                                    $sql = "SELECT cod_profissional, nome, numero_conselho, email
                                               FROM profissional
                                               WHERE nome like '%$param1%' OR login like '%$param1%' 
                                               ORDER BY nome LIMIT $inicio,$maximo";
                                    $consultas = $db->selectQuery($sql);	
                                    $total = sizeof($db->selectQuery("SELECT cod_profissional
                                               FROM profissional
                                               WHERE nome like '%$param1%' OR login like '%$param1%'"));
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th></th>
                                                <th>Nome do Profissional</th>
												<th>E-mail</th>
                                                <th>Nº Conselho</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												foreach ($consultas as $consulta) {										 
													$cod = $consulta['cod_profissional'];                                        
													$nome = ($consulta['nome']);
													$numero_conselho = $consulta['numero_conselho'];
													$email = $consulta['email'];
                                            ?>
													<tr>
														<td><?=$cont?></td>
														<td>
															<a href="index.php?acao=profissional_form&cod_profissional=<?=$cod?>" class="minibutton"><span>Ver dados</span></a>                                            
															<a href="index.php?acao=profissional_unidade_form&cod_profissional=<?=$cod?>" class="minibutton"><span>Ver Unidades</span></a>
														</td>  
														<td><?=$nome?></td>
														<td><?=$email?></td>
														<td><?=$numero_conselho?></td>
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
                                            echo "<br />";
                                            // Mostragem de pagina
                                            if ($menos > 0) {
                                                echo "<a href=index.php?acao=profissional_listar&pagina=$menos&busca=$param1><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=profissional_listar&pagina=$i&busca=$param1><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=profissional_listar&pagina=$mais&busca=$param1><span> >> </span></a> ";
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
<?php } else { ?>
		<p>
			<img src='images/icons/splashyIcons/error.png' alt='Acesso restrito'/>                                    
			<strong>Acesso restrito</strong>
		</p>
<?php } ?>