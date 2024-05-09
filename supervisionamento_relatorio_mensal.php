<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Supervisões ::</span></span></span></h3>
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
                                $param1 = $_POST["busca3"]; //mes
                                $param2 = $_POST["busca4"]; //ano
                                $unidade = $_SESSION['cod_unidade'];
                               
                                $sql = "SELECT paciente.nome, paciente.nro_hygia, paciente.data_nascimento, tratamento.data_tratamento_atual, tratamento.data_notificacao, tratamento.un_supervisao, supervisionamento.data_supervisionamento, supervisionamento.comparecimento
                                            FROM paciente, tratamento, supervisionamento
                                            WHERE paciente.cod_paciente = tratamento.cod_paciente
                                            AND tratamento.un_supervisao = '$unidade'
                                            AND paciente.cod_paciente = supervisionamento.cod_paciente
                                            AND supervisionamento.cod_tratamento = tratamento.cod_tratamento
                                            AND YEAR( supervisionamento.data_supervisionamento ) ='$param2'
                                            AND MONTH( supervisionamento.data_supervisionamento ) ='$param1'
                                            ORDER BY paciente.nome, supervisionamento.data_supervisionamento";
								$consultas = $db->selectQuery($sql);
                                ?>
                                <h2 class="title">Relatório de Supervisão</h2>
                                <h3><b>Mês:</b> <?=$param1?> / <b>Ano:</b> <?=$param2;?></h3>
								<table align="center" style="margin-top:15px; margin-bottom:15px;">
									<tr ><th><b><font size="4">Legenda</font></b></th></tr>
									<tr><td bgcolor="orange"><b><font size="2"> Supervisionado na Unidade (SU)</font></b></td></tr>
									<tr><td bgcolor="#3299CC"><b><font size="2"> Autoadministrado (AA)</font></b></td></tr>
									<tr><td bgcolor="green"><b><font size="2"> Supervisionado em Visita Domiciliar (SVD)</font></b></td></tr>
									<tr><td bgcolor="red"><b><font size="2"> Não Tomou (N)</font></b></td></tr>
									<tr><td bgcolor="yellow"><b><font size="2"> Outro (O)</font></b></td></tr>
								</table>
                                <?php
									$nome = "";
									$nome_ant = "a";
									$ant = 0;
									$su = 0;
									$svd = 0;
									$aa = 0;
									$n = 0;
									$o = 0;
                                            
                                    foreach ($consultas as $consulta) {                                    
                                        $nome = $consulta['nome'];
										$comp = $consulta['comparecimento'];
										$d1 = explode("-", $consulta['data_supervisionamento']);
                                        if($nome_ant != $nome) {
											$nome = $consulta['nome'];
											$nro_hygia = $consulta['nro_hygia'];
											$data_nasc = $consulta['data_nascimento'];
											$data_trat_atual = $consulta['data_tratamento_atual'];
											$data_notificacao = $consulta['data_notificacao'];

											if($nome_ant != "a") echo "</tr></table>";
											echo "<table align='center' style='margin-top:15px;'><tr>";
											
											if ($data_nasc != NULL && $data_nasc != "0000-00-00") {
												$data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
											} else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
												$data_nasc1 = "";
											}

											if ($data_trat_atual != NULL && $data_trat_atual != "0000-00-00") {
												$data_trat_atual1 = implode("/", array_reverse(explode("-", $data_trat_atual)));
											} else if ($data_trat_atual == "0000-00-00" || $data_trat_atual == NULL) {
												$data_trat_atual1 = "";
											}

											if ($data_notificacao != NULL && $data_notificacao != "0000-00-00") {
												$data_notificacao1 = implode("/", array_reverse(explode("-", $data_notificacao)));
											} else if ($data_notificacao == "0000-00-00" || $data_notificacao == NULL) {
												$data_notificacao1 = "";
											}	
											 
											if($nome_ant != $nome && $nome_ant != "a") {
												echo ("<p align='center'>Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n / <b><font color='yellow'>(O):</font></b> $o</p>");
											}
  								?>						
											<b>Nome do Paciente: </b><?=$nome;?><br/>
											<b>Número Hygia: </b><?=$nro_hygia;?><br/>
											<b>Data Nascimento: </b><?=$data_nasc1;?><br/>
											<b>Data de notificação: </b><?=$data_notificacao1;?><br/>
											<b>Data de início do tratamento: </b><?=$data_trat_atual1;?><br/>                                              
                                <?php
											$nome_ant = $nome;
                                                                                   
                                            $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                            $o = 0;                         
                                            
											if ($comp == "SU") { $su++; ?>
                                                <td bgcolor="orange"><b><font size="2"> <?=$d1[2];?> (SU)</font></b></td>
                                            <?php } else if ($comp == "AA") { $aa++; ?>  
                                                <td><td bgcolor="#3299CC"><b><font size="2">  <?=$d1[2];?> (AA)</font></b></td>
                                            <?php } else if ($comp == "SVD") { $svd++; ?> 
                                                <td><td bgcolor="green"><b> <font size="2"> <?=$d1[2];?> (SVD)</font></b></td>
                                            <?php } else if ($comp == "N") { $n++; ?>  
                                                <td><td bgcolor="red"><b><font size="2"> <?=$d1[2];?> (N)</font></b></td>
                                            <?php } else if ($comp == "O") { $o++; ?>  
                                                <td bgcolor="yellow"><b><font size="2"> <?=$d1[2];?> (O)</font></b></td>
                                            <?php }
                                        } else {                            
                                            if ($comp == "SU") { $su++; ?>  
                                                <td bgcolor="orange"><b><font size="2"> <?=$d1[2];?> (SU)</font></b></td>
                                            <?php } else if ($comp == "AA") { $aa++;?>  
                                                <td bgcolor="#3299CC"><b><font size="2">  <?=$d1[2];?> (AA)</font></b></td>
                                            <?php } else if ($comp == "SVD") { $svd++; ?> 
                                                <td bgcolor="green"><b><font size="2">  <?=$d1[2];?> (SVD)</font></b></td>
                                            <?php } else if ($comp == "N") { $n++;?>  
                                                <td bgcolor="red"><b> <font size="2"> <?=$d1[2];?> (N)</font></b></td>
                                            <?php } else if ($comp == "O") { $o++; ?>  
                                                <td bgcolor="yellow"><b><font size="2"> <?=$d1[2];?> (O)</font></b></td>
                                            <?php }
                                        } ?>									
                               <?php } ?>							  
								</tr></table>
								<p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n / <b><font color='yellow'>(O):</font></b> $o"); ?>
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