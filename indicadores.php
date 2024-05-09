<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Indicador ::</span></span></span></h3>
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
								/*Mes De*/
								if (isset($_POST["busca_de_mes"])) {
									$mes_de = $_POST["busca_de_mes"];
								} else {
									$mes_de = date('m'); }
								/*Ano De*/
								if (isset($_POST["busca_de_ano"])) {
									$ano_de = $_POST["busca_de_ano"];
								} else {
									$ano_de = date('Y'); }
								/*Mes Até*/
								if (isset($_POST["busca_ate_mes"])) {
									$mes_ate = $_POST["busca_ate_mes"];
								} else {
									$mes_ate = date('m'); }
								/*Ano De*/
								if (isset($_POST["busca_ate_ano"])) {
									$ano_ate = $_POST["busca_ate_ano"];
								} else {
									$ano_ate = date('Y'); }
								$data_de = (string)$mes_de.'/01/'.(string)$ano_de;
								$data_de = date('Y-m-d', strtotime($data_de));
								if(($mes_ate == '01') OR ($mes_ate == '03') OR ($mes_ate == '05') OR ($mes_ate == '07') OR ($mes_ate == '08') OR ($mes_ate == '10') OR ($mes_ate == '12')){  
									$data_ate = (string)$mes_ate.'/31/'.(string)$ano_ate;
								}else if(($mes_ate == '04') OR ($mes_ate == '06') OR ($mes_ate == '09') OR ($mes_ate == '11')){
										 $data_ate = (string)$mes_ate.'/30/'.(string)$ano_ate;
								}else if(($ano_ate % 400 == 0) OR (($ano_ate % 4 == 0) AND ($ano_ate % 100 != 0))){
										 $data_ate = (string)$mes_ate.'/29/'.(string)$ano_ate;
								}else{
									$data_ate = (string)$mes_ate.'/28/'.(string)$ano_ate;
								}									
								
								$data_ate = date('Y-m-d', strtotime($data_ate));
								$unidade = $_SESSION['cod_unidade'];
							  
								$select_indicador1_hiv = "SELECT * FROM tratamento WHERE (anti_hiv = 'Positivo' OR anti_hiv = 'Negativo') AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador1_hiv = $db->selectQuery($select_indicador1_hiv);
								$totalhiv = sizeof($consulta_indicador1_hiv);
							  
								$select_indicador1_total = "SELECT * FROM tratamento WHERE data_tratamento_atual BETWEEN '$data_de' AND '$data_ate' ";
								$consultas_indicador1_total = $db->selectQuery($select_indicador1_total);
								$total = sizeof($consultas_indicador1_total);
								
								$select_indicador2_hiv = "SELECT * FROM tratamento WHERE anti_hiv = 'Positivo' AND tratamento_anterior = 'Não Tratou' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador2_hiv = $db->selectQuery($select_indicador2_hiv);
								$total2hiv = sizeof($consulta_indicador2_hiv);

								$select_indicador2_total = "SELECT * FROM tratamento WHERE tratamento_anterior = 'Não Tratou' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate' ";
								$consultas_indicador2_total = $db->selectQuery($select_indicador2_total);
								$total2 = sizeof($consultas_indicador2_total);
							   
								$select_indicador3_hiv = "SELECT * FROM tratamento WHERE anti_hiv = 'Em andamento' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador3_hiv = $db->selectQuery($select_indicador3_hiv);
								$totalhiv3 = sizeof($consulta_indicador3_hiv);
								
								$select_indicador3_hiv_total = "SELECT * FROM tratamento WHERE anti_hiv = 'Positivo' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador3_hiv_total = $db->selectQuery($select_indicador3_hiv_total);
								$total3hiv = sizeof($consulta_indicador3_hiv_total);

								$select_indicador4_cura = "SELECT * FROM tratamento WHERE motivo_alta = 'Cura' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador4_cura = $db->selectQuery($select_indicador4_cura);
								$totalcura = sizeof($consulta_indicador4_cura);
								
								$select_indicador5_abandono = "SELECT * FROM tratamento WHERE motivo_alta = 'Abandono' AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador5_abandono = $db->selectQuery($select_indicador5_abandono);
								$totalabandono = sizeof($consulta_indicador5_abandono);
								
								$select_indicador6_obito = "SELECT * FROM tratamento WHERE (motivo_alta = 'Óbito por TB' OR motivo_alta = 'Óbito por outras causas') AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador6_obito = $db->selectQuery($select_indicador6_obito);
								$totalobito = sizeof($consulta_indicador6_obito);
								
								$select_indicador7 = "SELECT * FROM tratamento, supervisionamento WHERE tratamento.cod_paciente = supervisionamento.cod_paciente  AND tratamento.data_tratamento_atual BETWEEN '$data_de' AND '$data_ate' ORDER BY tratamento.cod_paciente";
								$consulta_indicador7 = $db->selectQuery($select_indicador7);
								$totalindicador7 = sizeof($consulta_indicador7);
								$totalsupervisionado = 0;

								for($i=1;$i<$totalindicador7;$i++){
									$if1 = $consulta_indicador7[$i]['cod_paciente'];
									$if2 = $consulta_indicador7[$i-1]['cod_paciente'];
									if(($if1 != $if2) OR ($i == ($totalindicador7 - 1))){
										$data_inicio = $consulta_indicador7[$i-1]['data_tratamento_atual'];
								
										$primeiro = date('Y-m-d', strtotime("+61 days",strtotime($data_inicio)));
										$segundo0 = date('Y-m-d', strtotime("+1 days",strtotime($primeiro)));
										$segundo = date('Y-m-d', strtotime("+122 days",strtotime($primeiro)));
										
										$paciente = $consulta_indicador7[$i-1]['cod_paciente'];
										$selectprimeiro = "SELECT * FROM supervisionamento WHERE cod_paciente =$paciente AND ((comparecimento = 'SU') OR (comparecimento = 'SVD')) AND data_supervisionamento <= '$primeiro' ";
										$consultaprimeiro = $db->selectQuery($selectprimeiro);
										$totalprimeiro = sizeof($consultaprimeiro);

										$selectsegundo = "SELECT * FROM supervisionamento WHERE cod_paciente = $paciente AND ((comparecimento = 'SU') OR (comparecimento = 'SVD')) AND data_supervisionamento BETWEEN '$segundo0' AND '$segundo' ";
										$consultasegundo = $db->selectQuery($selectsegundo);
										$totalsegundo = sizeof($consultasegundo);
										if (($totalprimeiro >= 24) AND ($totalsegundo >=36)){                
											$totalsupervisionado++;
										}
									}   
								}

								$select_indicador8_cultura = "SELECT * FROM tratamento WHERE ((tratamento_anterior = 'Sim, alta cura') OR (tratamento_anterior = 'Sim, alta abandono')) AND ((resultado_cultura_escarro = 'Positivo') OR (resultado_cultura_escarro = 'Negativo') OR (resultado_cultura_escarro = 'Em Andamento') OR (resultado_cultura_outro = 'Positivo') OR (resultado_cultura_outro = 'Negativo') OR (resultado_cultura_outro = 'Em Andamento')) AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador8_cultura = $db->selectQuery($select_indicador8_cultura);
								$totalcultura = sizeof($consulta_indicador8_cultura);

								$select_indicador8_total = "SELECT * FROM tratamento WHERE ((tratamento_anterior = 'Sim, alta cura') OR (tratamento_anterior = 'Sim, alta abandono')) AND data_tratamento_atual BETWEEN '$data_de' AND '$data_ate'";
								$consulta_indicador8_total = $db->selectQuery($select_indicador8_total);
								$totalrecidivo = sizeof($consulta_indicador8_total);

								if ($data_de != NULL) {
									$data_de1 = implode("/", array_reverse(explode("-", $data_de)));
								} else if ($data_de == "0000-00-00" || $data_de == NULL) {
									$data_de1 = "";
								}
								if ($data_ate != NULL) {
									$data_ate1 = implode("/", array_reverse(explode("-", $data_ate)));
								} else if ($data_ate == "0000-00-00" || $data_ate == NULL) {
									$data_ate1 = "";
								}

								 /*Tipo de Indicador*/
								if (isset($_POST["tipo_indicador"])) {
									$tipo_indicador = $_POST["tipo_indicador"];
									if ($tipo_indicador == 1){
										if ($total != 0){
											$indicador = (bcdiv($totalhiv,$total,3)) * 100;
										}else{
											$indicador = 0;
										}									
										$descIndicador = "Proporção de Casos de Tuberculose Testados para HIV";
										$metodoCalc = "Numerador: Número de casos de tuberculose notificados com teste HIV realizado em determinado período.<br/>Denominador: Número de casos de tuberculose notificados em determinado período x 100.";
										$numeradorValor = "<u>Número de casos de tuberculose notificados com teste HIV no período:</u> $totalhiv pacientes.";
										$denominadorValor = "<u>Número de casos de tuberculose notificados no período:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAN";																
									} else if ($tipo_indicador==2){
										if($total2 != 0){
											$indicador = (bcdiv($total2hiv,$total2,3)) * 100;
										}else{
											$indicador = 0;
										}					
										$descIndicador = "Proporção de Coinfecção de TB/HIV";
										$metodoCalc = "Numerador: Número de casos novos de tuberculose notificados com teste HIV positivo em determinado período.<br/>Denominador: Número de casos novos de tuberculose notificados em determinado período x 100.";
										$numeradorValor = "<u>Número de casos novos de tuberculose notificados com teste HIV positivo no período:</u> $total2hiv pacientes.";
										$denominadorValor = "<u>Número de casos novos de tuberculose notificados no período:</u> $total2 pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";									   
									} else if ($tipo_indicador==3){
										if($total3hiv != 0){
											$indicador = (bcdiv($totalhiv3,$total3hiv,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Tuberculose com HIV em Andamento";
										$metodoCalc = "Numerador: Número de casos novos de tuberculose com resultado do HIV em andamento no período avaliado.<br/>Denominador: Número de casos novos de tuberculose notificados com HIV realizado no período avaliado x 100.";
										$numeradorValor = "<u>Número de casos novos de tuberculose com resultado do HIV em andamento no período:</u> $totalhiv3 pacientes.";
										$denominadorValor = "<u>Número de casos novos de tuberculose notificados com HIV realizado no período:</u> $total3hiv pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";		 			
									}else if ($tipo_indicador==4){
										if ($total != 0){
											$indicador = (bcdiv($totalcura,$total,3)) * 100;
										}else{
											$indicador = 0;
										}								
										$descIndicador = "Proporção de Casos de Tuberculose Curados";
										$metodoCalc = "Numerador: Número de casos de tuberculose encerrados por cura por data de diagnóstico.<br/>Denominador: Número de casos de tuberculose notificados por data de diagnóstico x 100.";
										$numeradorValor = "<u>Número de casos de tuberculose encerrados por cura:</u> $totalcura pacientes.";
										$denominadorValor = "<u>Número de casos de tuberculose notificados:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";	
									}else if ($tipo_indicador==5){
										if ($total != 0){
											$indicador = (bcdiv($totalabandono,$total,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Tuberculose que Abandonaram o Tratamento";
										$metodoCalc = "Numerador: Número de casos de tuberculose encerrados por abandono de tratamento por data de diagnóstico.<br/>Denominador: Número de casos de tuberculose notificados por data de diagnóstico x 100.";
										$numeradorValor = "<u>Número de casos de tuberculose encerrados por abandono de tratamento:</u> $totalabandono pacientes.";
										$denominadorValor = "<u>Número de casos de tuberculose notificados:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";	
									}else if ($tipo_indicador==6){
										if ($total != 0){
											$indicador = (bcdiv($totalobito,$total,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Tuberculose com Encerramento Óbito";
										$metodoCalc = "Numerador: Número de casos de tuberculose encerrados por óbito* pela data de diagnóstico.<br/>Denominador: Número de casos de tuberculose notificados pela data de diagnóstico x 100. <br/>*Situação de encerramento = óbito por TB + óbito por outras causas.";
										$numeradorValor = "<u>Número de casos de tuberculose encerrados por óbito:</u> $totalobito pacientes.";
										$denominadorValor = "<u>Número de casos de tuberculose notificados:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";				
									}else if ($tipo_indicador==7){
										if ($total != 0){
											$indicador = (bcdiv($totalsupervisionado,$total,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Tuberculose que Realizaram Tratamento Diretamente Observado";
										$metodoCalc = "Numerador: Número de casos de tuberculose que realizaram tratamento diretamente observado no período analisado.<br/>Denominador: Número de casos  novos de tuberculose notificados no período avaliado x 100.";
										$numeradorValor = "<u>Número de casos de tuberculose que realizaram tratamento diretamente observado:</u> $totalsupervisionado pacientes.";
										$denominadorValor = "<u>Número de casos novos de tuberculose notificados:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";								
									}else if ($tipo_indicador==8){
										if ($totalrecidivo != 0){
											$indicador = (bcdiv($totalcultura,$totalrecidivo,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Retratamento que Realizaram o Exame de Cultura";
										$metodoCalc = "Numerador: Número de casos de retratamento* de tuberculose que realizaram o exame de cultura no período avaliado.<br/>Denominador: Número de casos  novos de retratamento* de tuberculose notificados no período avaliado x 100.";
										$numeradorValor = "<u>Número de casos de retratamento de tuberculose que realizaram exame de cultura:</u> $totalcultura pacientes.";
										$denominadorValor = "<u>Número de casos de retratamento de tuberculose notificados:</u> $totalrecidivo pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";								
									}
									else if ($tipo_indicador==9){
										if ($total != 0){
											$indicador = (bcdiv($totalrecidivo,$total,3)) * 100;
										}else{
											$indicador = 0;
										}
										$descIndicador = "Proporção de Casos de Retratamento de Tuberculose";
										$metodoCalc = "Numerador: Número de casos de retratamento* de tuberculose no período avaliado.<br/>Denominador: Número de casos  novos de tuberculose notificados no período avaliado x 100.";
										$numeradorValor = "<u>Número de casos de retratamento de tuberculose:</u> $totalrecidivo pacientes.";
										$denominadorValor = "<u>Número de casos de tuberculose notificados:</u> $total pacientes.";
										$fonte = "Sistema de Informação de Agravos de Notificação - SINAM";	
									}   
										echo "<strong>$descIndicador</strong><br/><br/>" ;
										echo "<strong>De:</strong> $data_de1<br/><strong>Até:</strong> $data_ate1<br/><br/>";
										echo "$numeradorValor<br/>" ;
										echo "$denominadorValor<br/><br/>";
										echo "<strong>Indicador:</strong> $indicador%<br/><br/>";
										echo "<strong>Método de Cálculo:</strong><br/>$metodoCalc<br/><br/>";
										echo "<strong>Fonte:</strong> $fonte";									
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