<?php
/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
 /* Importa-se o namespace (caminho do arquivo) da clase banco e 
    * cria-se um aliase (apelido) para ele */
    use Uteis\banco as banco;

    /* Importa-se a classe banco */
    require_once 'classes/banco.php';
    
    date_default_timezone_set('America/Sao_Paulo');
    //$data=date("dmY"); //aqui pegamos a data pois foi ela quem usamos como valor da sessao logado
    
    /* Cria um objeto da classe banco, voltado para o sistb 
        * e realiza a conexão */
        $db = banco::connectToTB();

?>
<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Ficha do Paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">

                <!-- box with gradient [begin] -->
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">

                                <div style="width:100%; height: 100%; overflow-x: auto; overflow-y:hidden">
                                <?php
									
                                //$cod_tratamento = $conteudo[2];
                                //$cod_tratamento = "87";
								$cod_trat = $conteudo[2];
								$cod = $conteudo[3];


								$select = "SELECT *  FROM tratamento, paciente WHERE tratamento.cod_tratamento = '$cod_trat' AND paciente.cod_paciente = '$cod'";
								$consultas = $db->selectQuery($select);


                               $trat_anterior = $consultas[0]['tratamento_anterior'];
                                         
								$tempo_tratamento = $consultas[0]['tempo_tratamento_anterior'];
								$fc1 = $consultas[0]['forma_clinica1'];
								$fc2 = $consultas[0]['forma_clinica2'];
								$fc3 = $consultas[0]['forma_clinica3'];
								$descoberta = $consultas[0]['tipo_descoberta'];
								$recebido = $consultas[0]['recebido'];
								$tempo_decorrido = $consultas[0]['tempo_inicio_sintomas'];
								$data_bac_escarro = $consultas[0]['data_escarro'];
								$resultado_bac_escarro = $consultas[0]['resultado_escarro'];
								$outros = $consultas[0]['outros'];
								$data_rx_torax = $consultas[0]['data_rx_torax'];
								$resultado_rx_torax = $consultas[0]['resultado_rx_torax'];
								$data_rx_outro = $consultas[0]['data_rx_outro'];
								$resultado_rx_outro = $consultas[0]['resultado_rx_outro'];
								$data_histopatologico = $consultas[0]['data_histopatologico'];
								$resultado_histopatologico = $consultas[0]['resultado_histopatologico'];
								$data_necropsia = $consultas[0]['data_necropsia'];
								$resultado_necropsia = $consultas[0]['resultado_necropsia'];
								$data_outros = $consultas[0]['data_outros'];
								$resultado_outros = $consultas[0]['resultado_outros'];
								$da1 = $consultas[0]['doenca_associada1'];
								$da2 = $consultas[0]['doenca_associada2'];
								$da3 = $consultas[0]['doenca_associada3'];
								$anti_hiv = $consultas[0]['anti_hiv'];
								$data_trat_atual = $consultas[0]['data_tratamento_atual'];
								$tipo_trat = $consultas[0]['tipo_tratamento_atual'];
								$droga = $consultas[0]['droga_tratamento'];
								$rifampicina = $consultas[0]['rifampicina'];
								$izoniazida = $consultas[0]['izoniazida'];
								$estreptomicina = $consultas[0]['estreptomicina'];
								$pirazinamida = $consultas[0]['pirazinamida'];
								$etambutol = $consultas[0]['etambutol'];
								$etionamida = $consultas[0]['etionamida'];
								$observacoes = $consultas[0]['observacoes'];
								$cod_profissional = $consultas[0]['cod_profissional'];
								$cod_paciente = $consultas[0]['cod_paciente'];
								$data_bac_outro = $consultas[0]['data_outro'];
								$resultado_bac_outro = $consultas[0]['resultado_outro'];
								$data_cultura_escarro = $consultas[0]['data_cultura_escarro'];
								$resultado_cultura_escarro = $consultas[0]['resultado_cultura_escarro'];
								$data_cultura_outro = $consultas[0]['data_cultura_outro'];
								$resultado_cultura_outro = $consultas[0]['resultado_cultura_outro'];
								$servico = $consultas[0]['servico_descobriu'];
								$data_alta = $consultas[0]['data_alta_tratamento'];
								$alta = $consultas[0]['motivo_alta'];
								$un_notificante = $consultas[0]['un_notificante'];
								$un_atendimento = $consultas[0]['un_atendimento'];
								$data_notificacao = $consultas[0]['data_notificacao'];
								$encerrado= $consultas[0]['encerrado'];
								$rifambutina= $consultas[0]['rifambutina'];
								$resultado_tmrtb= $consultas[0]['resultado_tmrtb'];
								$data_tmrtb= $consultas[0]['data_tmrtb'];
								$un_supervisao= $consultas[0]['un_supervisao'];
							  
								$cpf = $consultas[0]['cpf'];
								$cns = $consultas[0]['cns'];
								$gestante = $consultas[0]['gestante'];
								$nome = $consultas[0]['nome'];
								$data_nasc = $consultas[0]['data_nascimento'];
								$idade = $consultas[0]['idade'];
								$sexo = $consultas[0]['sexo'];
								$mae = $consultas[0]['mae'];
								$endereco = $consultas[0]['endereco'];
								$cep = $consultas[0]['cep'];
								$telefone = $consultas[0]['telefone'];
								$cidade = $consultas[0]['cidade'];
								$estado = $consultas[0]['estado'];
								$escolaridade = $consultas[0]['escolaridade'];
								$tipo_ocupacao = $consultas[0]['tipo_ocupacao'];
								$ocupacao = $consultas[0]['ocupacao'];
								$observacoesp = $consultas[0]['observacoesp'];
								$nro_prontuario = $consultas[0]['nro_prontuario'];
								$un_not = $consultas[0]['un_notificante'];
								$un_at = $consultas[0]['un_atendimento'];

								$naturalidade = $consultas[0]['naturalidade'];
								$etnia = $consultas[0]['etnia'];
								$nro_fie = $consultas[0]['nro_fie'];
								$nro_hygia = $consultas[0]['nro_hygia'];
								
								$selectu1 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_notificante'";
                                $consultan = $db->selectQuery($selectu1);
								if (empty($consultan[0])){
									$nome_un_not = " ";
								} else {
                                $nome_un_not = $consultan[0]['nome'];}

                                $selectu2 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_atendimento'";
                                 $consultaa = $db->selectQuery($selectu2);
								 if (empty($consultaa[0])){
									$nome_un_at = " ";
								} else {
                                $nome_un_at = $consultaa[0]['nome'];}
								
								$selectu3 = "SELECT nome  FROM unidade WHERE cod_unidade = '$un_supervisao'";
                                 $consultas = $db->selectQuery($selectu3);
								 if (empty($consultas[0])){
									$nome_un_sup = " ";
								} else {
                                $nome_un_sup = $consultas[0]['nome'];}

                               

                                $droga1 = "";
                                if ($droga == "N") {
                                    $droga1 = "Não";
                                } else if ($droga == "S") {
                                    $droga1 = "Sim";
                                }

                                $rifampicina1 = "";
                                if ($rifampicina == "N") {
                                    $rifampicina1 = "Não";
                                } else if ($rifampicina == "R") {
                                    $rifampicina1 = "1- Sim";
                                }

                                $izoniazida1 = "";
                                if ($izoniazida == "N") {
                                    $izoniazida1 = "2- Não";
                                } else if ($izoniazida == "H") {
                                    $izoniazida1 = "1- Sim";
                                }

                                $estreptomicina1 = "";
                                if ($estreptomicina == "N") {
                                    $estreptomicina1 = "2- Não";
                                } else if ($estreptomicina == "S") {
                                    $estreptomicina1 = "1- Sim";
                                }

                                $pirazinamida1 = "";
                                if ($pirazinamida == "N") {
                                    $pirazinamida1 = "2- Não";
                                } else if ($pirazinamida == "Z") {
                                    $pirazinamida1 = "1- Sim";
                                }

                                $etambutol1 = "";
                                if ($etambutol == "N") {
                                    $etambutol1 = "2- Não";
                                } else if ($etambutol == "E") {
                                    $etambutol1 = "1- Sim";
                                }

                                $etionamida1 = "";
                                if ($etionamida == "N") {
                                    $etionamida1 = "2- Não";
                                } else if ($etionamida == "ET") {
                                    $etionamida1 = "1- Sim";
                                }
								
								$rifambutina1 = "";
                                if ($rifambutina == "N") {
                                    $rifambutina1 = "2- Não";
                                } else if ($rifambutina == "RB") {
                                    $rifambutina1 = "1- Sim";
                                }


                                if ($data_alta != NULL && $data_alta != "0000-00-00") {
                                    $data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
                                } else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
                                    $data_alta1 = "";
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
								
								if ($data_bac_escarro != NULL && $data_bac_escarro != "0000-00-00") {
									$data_bac_escarro1 = implode("/", array_reverse(explode("-", $data_bac_escarro)));
								} else if ($data_bac_escarro == "0000-00-00" || $data_bac_escarro == NULL) {
									$data_bac_escarro1 = "";
								}

								if ($data_rx_torax != NULL && $data_rx_torax != "0000-00-00") {
									$data_rx_torax1 = implode("/", array_reverse(explode("-", $data_rx_torax)));
								} else if ($data_rx_torax == "0000-00-00" || $data_rx_torax == NULL) {
									$data_rx_torax1 = "";
								}
								if ($data_rx_outro != NULL && $data_rx_outro != "0000-00-00") {
									$data_rx_outro1 = implode("/", array_reverse(explode("-", $data_rx_outro)));
								} else if ($data_rx_outro == "0000-00-00" || $data_rx_outro == NULL) {
									$data_rx_outro1 = "";
								}
								if ($data_histopatologico != NULL && $data_histopatologico != "0000-00-00") {
									$data_histopatologico1 = implode("/", array_reverse(explode("-", $data_histopatologico)));
								} else if ($data_histopatologico == "0000-00-00" || $data_histopatologico == NULL) {
									$data_histopatologico1 = "";
								}
								if ($data_necropsia != NULL && $data_necropsia != "0000-00-00") {
									$data_necropsia1 = implode("/", array_reverse(explode("-", $data_necropsia)));
								} else if ($data_necropsia == "0000-00-00" || $data_necropsia == NULL) {
									$data_necropsia1 = "";
								}
								if ($data_outros != NULL && $data_outros != "0000-00-00") {
									$data_outros1 = implode("/", array_reverse(explode("-", $data_outros)));
								} else if ($data_outros == "0000-00-00" || $data_outros == NULL) {
									$data_outros1 = "";
								}
								
								if ($data_bac_outro != NULL && $data_bac_outro != "0000-00-00") {
									$data_bac_outro1 = implode("/", array_reverse(explode("-", $data_bac_outro)));
								} else if ($data_bac_outro == "0000-00-00" || $data_bac_outro == NULL) {
									$data_bac_outro1 = "";
								}
								if ($data_cultura_escarro != NULL && $data_cultura_escarro != "0000-00-00") {
									$data_cultura_escarro1 = implode("/", array_reverse(explode("-", $data_cultura_escarro)));
								} else if ($data_cultura_escarro == "0000-00-00" || $data_cultura_escarro == NULL) {
									$data_cultura_escarro1 = "";
								}
								if ($data_cultura_outro != NULL && $data_cultura_outro != "0000-00-00") {
									$data_cultura_outro1 = implode("/", array_reverse(explode("-", $data_cultura_outro)));
								} else if ($data_cultura_outro == "0000-00-00" || $data_cultura_outro == NULL) {
									$data_cultura_outro1 = "";
								}
                
                                
                                
                                
                                $sexo1 = "";
                                if ($sexo == "F") {
                                    $sexo1 = "Feminino";
                                } else {
                                    $sexo1 = "Masculino";
                                }

                                $gestante1 = "";
                                if ($gestante == "S") {
                                    $gestante1 = "Sim";
                                } else {
                                    $gestante1 = "Não";
                                }

                                if ($data_nasc != NULL) {
                                    $data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
                                } else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
                                    $data_nasc1 = "";
                                }
                                
                                
                                ?>


                                <br/>
                                <h2 class="title">Informações do Paciente:</h2> 
                                
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"><label><b>Nome do Paciente: </b></label><?= $nome; ?></div> 
                                    <div  style="width: 30%; float:left"><label><b>Número Hygia: </b></label><?= $nro_hygia; ?></div>
                                    <div  style="width: 30%; float:left"><label><b>Número do Prontuário: </b></label><?= $nro_prontuario; ?></div>
                                </div>
                                    
                                    
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Cartão Nacional de Saúde: </b><?= $cns; ?> </div> 
                                    <div  style="width: 30%; float:left"> <b>CPF: </b><?= $cpf; ?><br/> </div>
                                    <div  style="width: 30%; float:left"> <b>Número SINAN: </b><?= $nro_fie; ?><br/> </div>
                                </div>
                                 <div style="width: 100%; height:30px;">
                                     <div  style="width: 30%; float:left"> <b>Nome mãe: </b><?= $mae; ?><br/> </div>
                                    <div  style="width: 30%; float:left"> <b>Data de Nascimento: </b><?= $data_nasc1; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Idade: </b><?= $idade; ?><br/> </div>
                                </div>
                                 <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Sexo: </b><?= $sexo1; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Gestante: </b><?= $gestante1; ?><br/> </div>
                                    <div  style="width: 30%; float:left">  </div>
                                </div>
                                 <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Etnia: </b><?= $etnia; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Naturalidade: </b><?= $naturalidade; ?><br/> </div>
                                    <div  style="width: 30%; float:left">  </div>
                                </div>
                                 <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Escolaridade: </b><?= $escolaridade; ?> ano(s) concluído(s)<br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Tipo de Ocupação: </b><?= $tipo_ocupacao; ?><br/></div>
                                    <div  style="width: 30%; float:left"> <b>Outro tipo de ocupação: </b><?= $ocupacao; ?><br/> </div>
                                </div>
                                <h2 class="title">Contato</h2>  
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 50%; float:left"> <b>Endereço: </b><?= $endereco; ?><br/> </div>
                                    <div  style="width: 20%; float:left"> <b>CEP: </b><?= $cep; ?><br/> </div> 
                                    <div  style="width: 20%; float:left"><b>Cidade: </b><?= $cidade; ?><br/>  </div>
                                    <div  style="width: 10%; float:left"> <b>UF: </b><?= $estado; ?><br/> </div>
                                </div>
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 100%; float:left">  <b>Telefone: </b><?= $telefone; ?><br/></div> 
                                </div> 
                                                                    
                                <br/>
                                <h2 class="title">Informações do Tratamento:</h2>    
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Data de notificação: </b><?= $data_notificacao1; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Data de início do tratamento: </b><?= $data_trat_atual1; ?><br/> </div>
                                    <div  style="width: 30%; float:left"> <b>Tipo de tratamento: </b><?= $tipo_trat; ?><br/></div>
									
                                </div>
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Unidade notificante: </b><?= $nome_un_not; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Unidade de atendimento: </b><?= $nome_un_at; ?><br/> </div>
                                    <div  style="width: 30%; float:left"> <b>Unidade de supervisão: </b><?= $nome_un_sup; ?><br/> </div>
                                </div>
								
								<div style="width: 100%; height:30px;">
								<div  style="width: 100%; float:left"> <b>Tempo decorrido do início dos sintomas ao tratamento: </b><?= $tempo_decorrido; ?><br/></div>
								</div>
								
								<div style="width: 100%; height:30px;">
								<div  style="width: 50%; float:left"><b>Se encaminhado foi recebido de: </b><?= $recebido; ?><br/></div> 
								<div  style="width: 50%; float:left"><b>Serviço que descobriu o caso: </b><?= $servico; ?><br/></div> 
								</div>
                                
								<div style="width: 100%; height:30px;">
									<div  style="width: 30%; float:left"> <b>Tipo de descoberta: </b><?= $descoberta; ?><br/> </div>
                                    <div  style="width: 30%; float:left"> <b>Tratamento anterior: </b><?= $trat_anterior; ?><br/> </div> 
                                    <div  style="width: 30%; float:left"> <b>Se sim, tratou a quantos anos completos: </b><?= $tempo_tratamento; ?><br/> </div>
                                   
                                </div>
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 100%; float:left"> <b>Forma clinica: </b><?= $fc1; ?><br/><?= $fc2; ?><br/><?= $fc3; ?><br/> </div> 
                                    <div  style="width: 100%; float:left"> <b>Doenças Associadas: </b><?= $da1; ?>  <?= $da2; ?>  <?= $da3; ?><br/> </div>
                                    
                                </div>
								
								<br/><br/>
								<div style="width: 100%; height:30px;"><br/><br/>
                                <h2 class="title">Exames/resultados/data:</h2> 
								<div style="width: 100%; height:30px;">		
									<div  style="width: 100%; float:left"> <b>Anti HIV: </b><?= $anti_hiv; ?><br/> </div>								
                					<div  style="width: 100%; float:left"><b>Baciloscopia de escarro: </b><?= $resultado_bac_escarro; ?>  <?= $data_bac_escarro1; ?><br/>
									<div  style="width: 100%; float:left"><b>Baciloscopia de outro material: </b><?= $resultado_bac_outro; ?>  <?= $data_bac_outro1; ?><br/>
									<div  style="width: 100%; float:left"><b>Cultura de escarro: </b><?= $resultado_cultura_escarro; ?>  <?= $data_cultura_escarro1; ?><br/>
									<div  style="width: 100%; float:left"><b>Cultura de outro material: </b><?= $resultado_cultura_outro; ?>  <?= $data_cultura_outro1; ?><br/>
									<div  style="width: 100%; float:left"><b>RX de tórax: </b><?= $resultado_rx_torax; ?>  <?= $data_rx_torax1; ?><br/>
									<div  style="width: 100%; float:left"><b>RX outro: </b><?= $resultado_rx_outro; ?>  <?= $data_rx_outro1; ?><br/>
									<div  style="width: 100%; float:left"><b>TMR-TB: </b><?= $resultado_tmrtb; ?>  <?= $data_tmrtb; ?><br/>
									<div  style="width: 100%; float:left"><b>Histopatológco: </b><?= $resultado_histopatologico; ?>  <?= $data_histopatologico1; ?><br/>
									<div  style="width: 100%; float:left"><b>Necrópsia: </b><?= $resultado_necropsia; ?> <?= $data_necropsia1; ?><br/>
									<div  style="width: 100%; float:left"><b>Outros: </b><?= $outros; ?>  <?= $resultado_outros; ?> <?= $data_outros1; ?><br/><br/>
								
								</div>
								
                                <div style="width: 100%; height:30px;">        
                                
								<div  style="width: 100%; float:left"> <b>Drogas no início do tratamento: </b><?= $droga1; ?><br/> </div> 
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 25%; float:left"> <b>Rifampicina: </b><?= $rifampicina1; ?><br/> </div>
                                    <div  style="width: 25%; float:left"> <b>Izoniazida: </b><?= $izoniazida1; ?><br/> </div>
                                    <div  style="width: 25%; float:left"> <b>Pirazinamida: </b><?= $pirazinamida1; ?><br/> </div>
                                    <div  style="width: 25%; float:left"> <b>Etambutol: </b><?= $etambutol1; ?><br/> </div>
                                </div>                  
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 25%; float:left"> <b>Estreptomicina: </b><?= $estreptomicina1; ?><br/> </div>
                                    <div  style="width: 25%; float:left"> <b>Etionamida: </b><?= $etionamida1; ?><br/> </div>
                                    <div  style="width: 25%; float:left"> <b>Rifabutina: </b><?= $rifambutina1; ?><br/> </div>
                                </div>
                            <br/><br/>
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 30%; float:left"> <b>Motivo da Alta: </b><?= $alta; ?><br/> </div> 
                                    <div  style="width: 30%; float:left">  <b>Data da alta: </b><?= $data_alta1; ?><br/></div>
									<div  style="width: 30%; float:left">  <br/></div>
                                    
                                </div>
                                
                                <div style="width: 100%; height:30px;">
                                    <div  style="width: 100%; float:left">   <b>Observações: </b><?= $observacoes; ?> <?= $observacoesp; ?><br/><br/></div> 
                                </div> 
                              
                              
    


                                <?php
                                /**
								//query para pegar o tipo de comparecimento

                                $selectC = "SELECT comparecimento, data_supervisionamento FROM supervisionamento WHERE cod_tratamento = '$cod_tratamento' ORDER BY data_supervisionamento ASC";
                                $queryC = @mysql_query($selectC) or die(mysql_error());

                                $ant = 0;
                                ?> 
                                

                                
                                    <?php
                                    
                                    
                                             $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                    while ($lC = mysql_fetch_array($queryC)) {

                                        $comp = ucfirst($lC[0]);   //pegamos o tipo de comparecimento do banco
                                        $data = ucfirst($lC[1]);   // pegamos a data do supervisinamento

                                        $d1 = explode("-", $data);
                                        $data = $d1[2] . "/" . $d1[1] . "/" . $d1[0];  //aqui fazemos um split na data para dividirmos em dia, mês e ano

                                        if ($ant != $d1[1]) {
                                            if ($ant !=0){
                                                ?> <p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n");
                                            }
                                            
                                            $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                            
                                            $ant = $d1[1];
                                            ?>
                                    

                                        <table border align="center">
                                            <?php if ($d1[1] == 1) { ?>

                                                <tr> <p>
                                                    <td>
                                                        <b>
                                                           <font size="3"> Janeiro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                      
                                            <table border align="center">
                                                <!--// aqui se o contador for 1, então o mês é janeiro, se for 2 eh fevereiro e assim por diante. a variável $d1[0] é o ano. -->
                                            <?php } else if ($d1[1] == 2) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3"> Fevereiro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr> 
                                            </table>
                                         
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 3) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3"> Março <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                     
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 4) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Abril <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                        
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 5) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Maio <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                   
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 6) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Junho <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr> 
                                            </table>
                                 
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 7) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Julho <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>  
                                                </tr>
                                            </table>
                                    
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 8) {   ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Agosto <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                             
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 9) {   ?> 
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Setembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td> 
                                                </tr>
                                            </table>
                                   
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 10) {  ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Outubro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                  
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 11) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Novembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                          
                                            <table border align="center">
                                            <?php } else if ($d1[1] == 12) { ?>
                                                <tr><p>
                                                    <td>
                                                        <b>
                                                            <font size="3">Dezembro <?= $d1[0]; ?></font>
                                                        </b>
                                                    </td> 
                                                </tr>
                                            </table>
                                        <?php } ?>
                                  
                                        <table align="center" border>

                                            <?php if ($comp == "SU") { $su++; ?>
                                                <td bgcolor="orange"><b><font size="2"> <?= $d1[2]; ?> (SU)</font> </b></td>
                                            <?php } else if ($comp == "AA") { $aa++; ?>  
                                                <td><td bgcolor="#3299CC"><b><font size="2">  <?= $d1[2]; ?> (AA)</font></b></td>
                                            <?php } else if ($comp == "SVD") { $svd++; ?> 
                                                <td><td bgcolor="green"><b> <font size="2"> <?= $d1[2]; ?> (SVD)</font> </b></td>
                                            <?php } else if ($comp == "N") { $n++; ?>  
                                                <td><td bgcolor="red"><b><font size="2"> <?= $d1[2]; ?> (N)</font></b> </td>
                                                <?php
                                            }
                                        } else {
                                            if ($comp == "SU") { $su++;
                                                ?>  
                                                <td bgcolor="orange"><b><font size="2"> <?= $d1[2]; ?> (SU)</font> </b></td>
                                            <?php } else if ($comp == "AA") { $aa++;?>  
                                                <td bgcolor="#3299CC"><b><font size="2">  <?= $d1[2]; ?> (AA)</font> </b></td>
                                            <?php } else if ($comp == "SVD") { $svd++; ?> 
                                                <td bgcolor="green"><b><font size="2">  <?= $d1[2]; ?> (SVD)</font>  </b></td>
                                            <?php } else if ($comp == "N") { $n++;?>  
                                                <td bgcolor="red"><b> <font size="2"><?= $d1[2]; ?> (N)</font> </b> </td>
                                                <?php
                                            }
                                        }  } 
                                
                               
                                 
                                            <p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n");
                                       * */  ?> 
                                        </table>
                                                
                                                
                                    <table  align="center">
                                        <br/>
                                        <br/>
                                        <tr ><th><b><font size="4">Legenda</font></b></th></tr>
                                    </table>
                                    <br/>

                                    <table  align="center" border>

                                        <tr>  <td bgcolor="orange"><b><font size="2"> Supervisionado na Unidade (SU)</font></b></td></tr>
                                        <tr>  <td bgcolor="#3299CC"><b><font size="2"> Autoadministrado (AA)</font></b></td></tr>
                                        <tr>  <td bgcolor="green"><b><font size="2"> Supervisionado em Visita Domiciliar (SVD)</font></b></td></tr>
                                        <tr>  <td bgcolor="red"><b><font size="2"> Não Tomou (N)</font></b></td></tr>
                                    </table>
                                    <br/>
                                    <br/>

                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with gradient [end] --> 


            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->