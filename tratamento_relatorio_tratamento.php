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
<div class="box box-gradient">    
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">

                <?php
                
				$data_atual = date("d/m/Y");

                $maximo = 10;

                if (!isset($_GET['pagina'])) {
                    $pagina = "1";
                } else {
                    $pagina = $_GET['pagina'];
                }

                // Calculando o registro inicial
                $inicio = $pagina - 1;
                $inicio = $maximo * $inicio;
                $cod_trat = $conteudo[2];
                $cod = $conteudo[3];

                $select = "SELECT *  FROM tratamento, paciente WHERE tratamento.cod_tratamento = '$cod_trat' AND paciente.cod_paciente = '$cod'";
                $select2 = "SELECT data_supervisionamento, comparecimento, observacoes, cod_tratamento FROM supervisionamento WHERE cod_tratamento = '$cod_trat' order by data_supervisionamento";
               
               $consultas = $db->selectQuery($select);
			   $consultas2 = $db->selectQuery($select2);
			   
               
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
                $telefone = $consultas[0]['telefone'];
                $cidade = $consultas[0]['cidade'];
                $estado = $consultas[0]['estado'];
                $escolaridade = $consultas[0]['escolaridade'];
                $tipo_ocupacao = $consultas[0]['tipo_ocupacao'];
                $ocupacao = $consultas[0]['ocupacao'];
                $obs = $consultas[0]['observacoes'];
                $nro_prontuario = $consultas[0]['nro_prontuario'];
                $un_not = $consultas[0]['un_notificante'];
                $un_at = $consultas[0]['un_atendimento'];

                $naturalidade = $consultas[0]['naturalidade'];
                $etnia = $consultas[0]['etnia'];
                $nro_fie = $consultas[0]['nro_fie'];
                $nro_hygia = $consultas[0]['nro_hygia'];


                 $sexo1 = "";
                if ($sexo == "F") {
                    $sexo1 = "Feminino";
                } else {
                    $sexo1 = "Masculino";
                }

                $gestante1 = "";
                if ($gestante == "N") {
                    $gestante1 = "Não";
                } else {
                    $gestante1 = "Sim";
                }
                
                if ($data_nasc != NULL) {
                    $data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
                } else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
                    $data_nasc1 = "";
                }
                
                
                $droga1 = "";
                if ($droga == "N") {
                    $droga1 = "Não";
                } else if ($droga == "S"){
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
                } else if ($izoniazida == "H"){
                    $izoniazida1 = "1- Sim";
                }
                         
                $estreptomicina1 = "";
                if ($estreptomicina == "N") {
                    $estreptomicina1 = "2- Não";
                } else if ($estreptomicina == "S"){
                    $estreptomicina1 = "1- Sim";
                }
                
                $pirazinamida1 = "";
                if ($pirazinamida == "N") {
                    $pirazinamida1 = "2- Não";
                } else if ($pirazinamida == "Z"){
                    $pirazinamida1 = "1- Sim";
                }
                
                $etambutol1 = "";
                if ($etambutol == "N") {
                    $etambutol1 = "2- Não";
                } else if ($pirazinamida == "E"){
                    $etambutol1 = "1- Sim";
                }
                
                $etionamida1 = "";
                if ($etionamida == "N") {
                    $etionamida1 = "2- Não";
                } else if ($etionamida == "ET"){
                    $etionamida1 = "1- Sim";
                }
				
				$rifambutina1 = "";
                if ($rifambutina == "N") {
                    $rifambutina1 = "2- Não";
                } else if ($rifambutina == "RB"){
                    $rifambutina1 = "1- Sim";
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
                if ($data_trat_atual != NULL && $data_trat_atual != "0000-00-00") {
                    $data_trat_atual1 = implode("/", array_reverse(explode("-", $data_trat_atual)));
                } else if ($data_trat_atual == "0000-00-00" || $data_trat_atual == NULL) {
                    $data_trat_atual1 = "";
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
                if ($data_alta != NULL && $data_alta != "0000-00-00") {
                    $data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
                } else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
                    $data_alta1 = "";
                }
                if ($data_notificacao != NULL && $data_notificacao != "0000-00-00") {
                    $data_notificacao1 = implode("/", array_reverse(explode("-", $data_notificacao)));
                } else if ($data_notificacao == "0000-00-00" || $data_notificacao == NULL) {
                    $data_notificacao1 = "";
                }
                ?>


                <br/>
                <h2 class="title">Relatório do Tratamento:</h2> 
                
                <b>Nome paciente: </b><?= $nome; ?><br/>
                <b>CPF: </b><?= $cpf; ?><br/>
                <b>Cartão Nacional de Saúde: </b><?= $cns; ?><br/>
                <b>Número do Prontuário: </b><?= $nro_prontuario; ?><br/>
                <b>Número Hygia: </b><?= $nro_hygia; ?><br/>
                <b>Data de Nascimento: </b><?= $data_nasc1; ?><br/>
                <b>Sexo: </b><?= $sexo1; ?><br/>
                <b>Gestante: </b><?= $gestante1; ?><br/>

                <b>Escolaridade: </b><?= $escolaridade; ?><br/>
                <b>Tipo de Ocupação: </b><?= $tipo_ocupacao; ?><br/>
                <b>Ocupação: </b><?= $ocupacao; ?><br/>
                <b>Observações: </b><?= $obs; ?><br/>
                <b>Unidade Notificante: </b><?= $un_not; ?><br/>
                <b>Unidade de Atendimento: </b><?= $un_at; ?><br/>
                <b>Número FIE: </b><?= $nro_fie; ?><br/>

               
                <b>Data de notificação: </b><?= $data_notificacao1; ?><br/>
                <b>Data de início do tratamento: </b><?= $data_trat_atual; ?><br/>
                <b>Tipo de tratamento: </b><?= $tipo_trat; ?><br/>
                <b>Unidade notificante: </b><?= $un_notificante ?><br/>
                <b>Unidade de atendimento: </b><?= $un_atendimento; ?><br/>
                <b>Tratamento anterior: </b><?= $trat_anterior; ?><br/>
                <b>Se sim, tratou a quantos anos completos: </b><?= $tempo_tratamento; ?><br/>
                <b>Forma clinica: </b><?= $fc1; ?><br/><?= $fc2; ?><br/><?= $fc3; ?><br/>
                <b>Tipo de descoberta: </b><?= $descoberta; ?><br/>
                <b>Se encaminhado foi recebido de: </b><?= $recebido; ?><br/>
                <b>Serviço que descobriu o caso: </b><?= $servico; ?><br/>
                <b>Tempo decorrido do início dos sintomas ao tratamento: </b><?= $tempo_decorrido; ?><br/><br/>

                <b>Exames/resultados/data: </b><br/>

                <b>Baciloscopia de escarro: </b><?= $resultado_bac_escarro; ?>  <?= $data_bac_escarro1; ?><br/>
                <b>Baciloscopia de outro material: </b><?= $resultado_bac_outro; ?>  <?= $data_bac_outro1; ?><br/>
                <b>Cultura de escarro: </b><?= $resultado_cultura_escarro; ?>  <?= $data_cultura_escarro1; ?><br/>
                <b>Cultura de outro material: </b><?= $resultado_cultura_outro; ?>  <?= $data_cultura_outro1; ?><br/>
                <b>RX de tórax: </b><?= $resultado_rx_torax; ?>  <?= $data_rx_torax1; ?><br/>
                <b>RX outro: </b><?= $resultado_rx_outro; ?>  <?= $data_rx_outro1; ?><br/>
                <b>Histopatológco: </b><?= $resultado_histopatologico; ?>  <?= $data_histopatologico1; ?><br/>
                <b>Necrópsia: </b><?= $resultado_necropsia; ?> <?= $data_necropsia1; ?><br/>
                <b>Outros: </b><?= $outros; ?>  <?= $resultado_outros; ?> <?= $data_outros1; ?><br/><br/>
                <b>Doenças Associadas: </b><?= $da1; ?><br/><?= $da2; ?><br/><?= $da3; ?><br/>
                <b>Anti HIV: </b><?= $anti_hiv; ?><br/><br/>

                <b>Drogas no início do tratamento: </b><?= $droga1; ?><br/>
                <b>Rifampicina: </b><?= $rifampicina1; ?><br/>
                <b>Izoniazida: </b><?= $izoniazida1; ?><br/>
                <b>Estreptomicina: </b><?= $estreptomicina1; ?><br/>
                <b>Pirazinamida: </b><?= $pirazinamida1; ?><br/>
                <b>Etambutol: </b><?= $etambutol1; ?><br/>
                <b>Etionamida: </b><?= $etionamida1; ?><br/>


                <b>Alta: </b><?= $alta; ?><br/>
                <b>Data da alta: </b><?= $data_alta1; ?><br/>
                <b>Observações: </b><?= $observacoes; ?><br/>


                <br/>

                <br/>
                
                <?php
              /*  if ($cont == 0){
 
                    echo "Não existem registros sobre o comparecimento do supervisionamento.";
 
                }else{
                    // exibindo o resultado
                    echo "<strong>Controle do Tratamento</strong>:";
                    echo "<br />";	
                    while ($rows = mysql_fetch_array($query2)){
			echo "<strong>Data</strong>: ".$rows['data_supervisionamento'];
			
			echo "<strong> - </strong> ".$rows['comparecimento'];
			echo "<br />";
                    }
                }  */
                ?>

            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->	

<p></p>

