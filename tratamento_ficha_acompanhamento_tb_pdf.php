<?php
require_once("autenticacao.php");	
include('relatorio/fpdf/fpdf.php');

$codtrat = $_GET['cod_tratamento'];
$codpac = $_GET['cod_paciente'];

$select = "SELECT * FROM tratamento, paciente, paciente_tipo_ocupacao 
			WHERE tratamento.cod_tratamento = $codtrat AND paciente.cod_tipo_ocupacao = paciente_tipo_ocupacao.cod_tipo_ocupacao AND paciente.cod_paciente = $codpac";
							$consultas = $db->selectQuery($select);

$un_not = $consultas[0]['un_notificante'];

$select2 ="SELECT *  FROM unidade WHERE unidade.cod_unidade = '$un_not'";
							$consulta = $db->selectQuery($select2);
$total = sizeof($consulta);                            
$pdf = new FPDF('P','cm','A4');
$pdf->AddPage();
$pdf->Image('images/cab_ficha_not_tb.jpg',0,0,21);
$pdf->Ln(2);
$pdf->SetFont('Arial','B', 10);

//IDENTIFICAÇÃO

$identificacao = "IDENTIFICAÇÃO";
$pdf->Cell(0,0.6,$identificacao, 0, 1,'T');
$pdf->SetFont('arial','',9);
$x = $pdf->GetX();
$y = $pdf->GetY();
$numero = "Nº";
$pdf->MultiCell(6, 0.5, $numero.' SINAN'."\n".$consultas[0]['sinan'].' ',1,"L");
$pdf->SetXY($x + 6, $y);
$pdf->MultiCell(6, 0.5, 'RG'."\n".' ',1,"L");
$pdf->SetXY($x + 12, $y);
$ncartao = "Nº CARTÃO NAC. SAÚDE";
$pdf->MultiCell(7, 0.5, $ncartao."\n".$consultas[0]['cns'].' ',1,"L");

$pdf->MultiCell(19, 0.5, 'NOME'."\n".$consultas[0]['nome'],1,"L");

$x = $pdf->GetX();
$y = $pdf->GetY();

$sexo = $consultas[0]['sexo'];	
if ($sexo == "F") {
	$sexo1 = "Feminino";
} else {
	$sexo1 = "Masculino";
}

$pdf->MultiCell(2, 0.5, 'SEXO'."\n".$sexo1.' ',1,"L");
$pdf->SetXY($x + 2, $y);

$data_nasc = $consultas[0]['data_nascimento'];
if ($data_nasc != NULL) {
	$data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
} else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
	$data_nasc1 = "";
}
				
$pdf->MultiCell(4, 0.5, 'DATA DE NASCIMENTO'."\n".$data_nasc1.' ',1,"L");
$pdf->SetXY($x + 6, $y);
$pdf->MultiCell(5, 0.5, 'NACIONALIDADE'."\n".$consultas[0]['naturalidade'].' ',1,"L");
$pdf->SetXY($x + 11, $y);

$gestante = $consultas[0]['gestante'];
$gestante1 = "";
if ($gestante == "N") {
	$gestante1 = "Não";
} else {
	$gestante1 = "Sim";
}

$pdf->MultiCell(2.5, 0.5, 'GESTANTE'."\n".$gestante1.' ',1,"L");
$pdf->SetXY($x + 13.5, $y);
$pdf->SetFont('arial','',8.5);
$pdf->MultiCell(5.5, 0.5, 'ESCOLARIDADE'."\n".$consultas[0]['escolaridade'].' ANOS DE ESTUDO COMPLETOS',1,"L");
$pdf->SetFont('arial','',9);
$nmae = "NOME DA MÃE";
$pdf->MultiCell(19, 0.5, $nmae."\n".$consultas[0]['mae'].' ',1,"L");

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(3, 0.5, 'ETNIA'."\n".$consultas[0]['etnia'].' ',1,"L");
$pdf->SetXY($x + 3, $y);
$ocupacao = "OCUPAÇÃO (POR EXTENSO)";
$pdf->MultiCell(8, 0.5, $ocupacao."\n".$consultas[0]['ocupacao'].' ',1,"L");
$pdf->SetXY($x + 11, $y);
$tocupacao = "TIPO DE OCUPAÇÃO";
$pdf->MultiCell(8, 0.5, $tocupacao."\n". $consultas[0]['tipo_ocupacao'].' ',1,"L");

$x = $pdf->GetX();
$y = $pdf->GetY();
$cpf = "CPF(SÓ NÚMEROS)";
$pdf->MultiCell(11, 0.5, $cpf."\n".$consultas[0]['cpf'].' ',1,"L");
$pdf->SetXY($x + 11, $y);
$beneficiario = "BENEFICIÁRIO DE PROG. GOV. TRANSF. RENDA";
$pdf->MultiCell(8, 0.5, $beneficiario."\n".' ',1,"L");
$pdf->Ln(0.2);

// ENDEREÇO

$pdf->SetFont('Arial','B', 10);
$endereco = "ENDEREÇO";
$pdf->Cell(0,0.6,$endereco, 0, 1,'B');

$pdf->SetFont('arial','',9);
$x = $pdf->GetX();
$y = $pdf->GetY();
$tendereco = "TIPO DE ENDEREÇO";
$pdf->MultiCell(15, 0.5, $tendereco."\n".' ',1,"L");
$pdf->SetXY($x + 15, $y);
$pdf->MultiCell(4, 0.5, 'TELEFONE'."\n".$consultas[0]['telefone'].' ',1,"L");

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(2, 0.5, 'ESTADO'."\n".$consultas[0]['estado'],1,"L");
$pdf->SetXY($x + 2, $y);
$municipio = "MUNICÍPIO DE RESIDÊNCIA";
$pdf->MultiCell(13, 0.5, $municipio."\n".$consultas[0]['cidade'],1,"L");

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(15, 0.5, 'CEP'."\n".$consultas[0]['cep'].' ',1,"L");


$x = $pdf->GetX();
$y = $pdf->GetY();
$endereco = "ENDEREÇO";
$pdf->MultiCell(15, 0.5, $endereco."\n".$consultas[0]['endereco'].' ',1,"L");


$pdf->SetXY($x + 15, $y -2.0);
$pdf->MultiCell(4, 1.5, 'INSTITUCIONALIZADO'."\n".' ',1,"L");
$pdf->Ln(0.2);

//NOTIFICAÇÃO

$pdf->SetFont('Arial','B', 10);
$notificacao = "NOTIFICAÇÃO";
$pdf->Cell(0,0.6,($notificacao), 0, 1,'B');

$pdf->SetFont('arial','',9);
$x = $pdf->GetX();
$y = $pdf->GetY();
$cnes = "CÓD. UNID. (CNES)";
$pdf->MultiCell(4, 0.5, ($cnes)."\n".' ',1,"L");
$pdf->SetXY($x + 4, $y);

if($total != 0){
    $pdf->MultiCell(15, 0.5, 'UNIDADE'."\n".($consulta[0]['nome']).' ',1,"L");
}else{
    $pdf->MultiCell(15, 0.5, 'UNIDADE'."\n".' ',1,"L");
}

$x = $pdf->GetX();
$y = $pdf->GetY();
$municipio = "MUNICÍPIO DE ATENDIMENTO";
if($total != 0){
    $pdf->MultiCell(12, 0.5, ($municipio)."\n".($consulta[0]['cidade']).' ',1,"L");
}else{
    $pdf->MultiCell(12, 0.5, ($municipio)."\n".' ',1,"L");
}
$pdf->SetXY($x + 12, $y);
$data_notificacao = $consultas[0]['data_notificacao'];
if ($data_notificacao != NULL && $data_notificacao != "0000-00-00") {
                    $data_notificacao1 = implode("/", array_reverse(explode("-", $data_notificacao)));
                } else if ($data_notificacao == "0000-00-00" || $data_notificacao == NULL) {
                    $data_notificacao1 = "";
                }
$dtanotificacao = "DATA DE NOTIFICAÇÃO";
$pdf->MultiCell(4, 0.5, ($dtanotificacao)."\n".$data_notificacao1.' ',1,"L");
$pdf->SetXY($x + 16, $y);
$prontuario = "PRONTUÁRIO";
$pdf->MultiCell(3, 0.5, ($prontuario)."\n".$consultas[0]['nro_hygia'].' ',1,"L");
$pdf->Ln(0.2);

//TRATAMENTO

$pdf->SetFont('Arial','B', 10);
$pdf->Cell(0,0.6,'TRATAMENTO', 0, 1,'B');

$pdf->SetFont('arial','',9);
$historico = "HISTÓRICO DE TRATAMENTO ANTERIOR";
$pdf->MultiCell(19, 0.5, ($historico)."\n".' ',1,"L");

$dtainicio = "DATA DE INÍCIO:";
$dtadiagnostico = "DATA DE DIAGNÓSTICO:";
$data_trat_atual = $consultas[0]['data_tratamento_atual'];
if ($data_trat_atual != NULL && $data_trat_atual != "0000-00-00") {
	$data_trat_atual1 = implode("/", array_reverse(explode("-", $data_trat_atual)));
} else if ($data_trat_atual == "0000-00-00" || $data_trat_atual == NULL) {
	$data_trat_atual1 = "";
}
$pdf->MultiCell(19, 0.5, 'TRATAMENTO ATUAL'."\n".($dtainicio).'  '.$data_trat_atual1.'                   '.($dtadiagnostico).'  '.' ',1,"L");
$pdf->Ln(0.2);

//FORMAS CLÍNICAS

$pdf->SetFont('Arial','B', 10);
$fclinicas = "FORMAS CLÍNICAS";
$pdf->Cell(0,0.6,($fclinicas), 0, 1,'B');

$pdf->SetFont('arial','',9);
$fclinica = "FORMA CLÍNICA";
$pdf->MultiCell(19, 0.7, ($fclinica).' 1:  '.($consultas[0]['forma_clinica1']).' ',1,"L");
$pdf->MultiCell(19, 0.7, ($fclinica).' 2:  '.($consultas[0]['forma_clinica2']).' ',1,"L");
$pdf->MultiCell(19, 0.7, ($fclinica).' 3:  '.($consultas[0]['forma_clinica3']).' ',1,"L");
$pdf->Ln(0.2);

//DESCOBERTA

$pdf->SetFont('Arial','B', 10);
$pdf->Cell(0,0.6,'DESCOBERTA', 0, 1,'B');
$pdf->SetFont('arial','',9);
$pdf->MultiCell(19, 0.5, 'TIPO DE DESCOBERTA'."\n".' ',1,"L");
$pdf->Ln(4);

//EXAMES COMPLEMENTARES

$pdf->SetFont('Arial','B', 10);
$pdf->Cell(0,0.6,'EXAMES COMPLEMENTARES', 0, 1,'B');
$pdf->SetFont('arial','',9);
$pdf->MultiCell(19, 0.5, 'BACTERIOLOGIA'."\n".'BACILOSCOPIA DE ESCARRO: '.($consultas[0]['resultado_escarro']).'                             BACILOSCOPIA DE OUTRO MATERIAL: '.($consultas[0]['resultado_outro'])."\n".'CULTURA DE ESCARRO: '.($consultas[0]['resultado_cultura_escarro']).'                                       CULTURA DE OUTRO MATERIAL: '.($consultas[0]['resultado_cultura_outro']),1,"L");
$rxtorax = "RX DO TÓRAX";
$pdf->MultiCell(19, 0.5, 'RADIOLOGIA'."\n".($rxtorax).':  '.($consultas[0]['resultado_rx_torax']).'                                                    RX DE OUTRO: '.($consultas[0]['resultado_rx_outro']).' ',1,"L");
$x = $pdf->GetX();
$y = $pdf->GetY();
$histo = "HISTOPATOLÓGICO";
$necro = "NECRÓPSIA";
$pdf->MultiCell(11, 0.5, ($histo).'/'.($necro)."\n".($histo).':  '.($consultas[0]['resultado_histopatologico']).'         '.($necro).':  '.($consultas[0]['resultado_necropsia']),1,"L");
$pdf->SetXY($x + 11, $y);
$pdf->MultiCell(8, 0.5,'TESTE DE SENSIBILIDADE         DATA DA COLETA'."\n".' ',1,"L");

$tmrtb = "TESTE MOLECULAR RÁPIDO TB (TMR-TB)";
if(($consultas[0]['resultado_tmrtb'])==NULL){
    $pdf->MultiCell(19, 0.5,($tmrtb)."\n \n",1,"L");
}else{
    $pdf->MultiCell(19, 0.5,($tmrtb)."\n".($consultas[0]['resultado_tmrtb']),1,"L");
}

$x = $pdf->GetX();
$y = $pdf->GetY();

if(($consultas[0]['anti_hiv']) == NULL){
    $pdf->MultiCell(5, 0.5,'HIV'."\n \n",1,"L"); 
}else{
    $pdf->MultiCell(5, 0.5,'HIV'."\n".($consultas[0]['anti_hiv']),1,"L");
}

$pdf->SetXY($x + 5, $y);

$data_outros = $consultas[0]['data_outros'];
if ($data_outros != NULL && $data_outros != "0000-00-00") {
	$data_outros1 = implode("/", array_reverse(explode("-", $data_outros)));
} else if ($data_outros == "0000-00-00" || $data_outros == NULL) {
	$data_outros1 = "";
}

$pdf->MultiCell(14, 0.5,'OUTROS EXAMES'."\n".'EXAME: '.($consultas[0]['outros']).'   RESULTADO: '.($consultas[0]['resultado_outros']). '    DATA: '.$data_outros1 ,1,"L");
$pdf->Ln(0.6);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(0,0.6,'AGRAVOS ASSOCIADOS', 0, 1,'B');
$pdf->SetFont('arial','',9);

if((($consultas[0]['doenca_associada1']) == NULL) AND (($consultas[0]['doenca_associada2']) == NULL) AND (($consultas[0]['doenca_associada3']) == NULL)){
    $pdf->MultiCell(19, 0.5,'AGRAVOS ASSOCIADOS'."\n".'Nenhum Agravo Associado',1,"L");
}else{
    $pdf->MultiCell(19, 0.5,'AGRAVOS ASSOCIADOS'."\n".($consultas[0]['doenca_associada1']).'   '.($consultas[0]['doenca_associada2']). '    '.($consultas[0]['doenca_associada3']),1,"L");
}

$pdf->Ln(0.6);
$pdf->SetFont('Arial','B', 10);
$pdf->Cell(0,0.6,'DROGAS E TIPO DE TRATAMENTO', 0, 1,'B');
$pdf->SetFont('arial','',9);
$x = $pdf->GetX();
$y = $pdf->GetY();

$rifampicina = $consultas[0]['rifampicina'];
$rifampicina1 = "";
if ($rifampicina == "R") {
	$rifampicina1 = "Sim";
} else {
	$rifampicina1 = "Não";
}

$izoniazida = $consultas[0]['izoniazida'];
$isoniazida1 = "";
if ($izoniazida == "H") {
	$isoniazida1 = "Sim";
} else {
	$isoniazida1 = "Não";
}

$pirazinamida = $consultas[0]['pirazinamida'];
$pirazinamida1 = "";
if ($pirazinamida == "Z") {
	$pirazinamida1 = "Sim";
} else {
	$pirazinamida1 = "Não";
}

$etambutol = $consultas[0]['etambutol'];
$etambutol1 = "";
if ($etambutol == "E") {
	$etambutol1 = "Sim";
} else {
	$etambutol1 = "Não";
}

$estreptomicina = $consultas[0]['estreptomicina'];
$estreptomicina1 = "";
if ($estreptomicina == "N") {
	$estreptomicina1 = "Não";
} else if ($estreptomicina == "S") {
	$estreptomicina1 = "Sim";
} 

$etionamida = $consultas[0]['etionamida'];
$etionamida1 = "";
if ($etionamida == "N") {
	$etionamida1 = "Não";
} else if ($etionamida == "ET") {
	$etionamida1 = "Sim";
}

$rifambutina= $consultas[0]['rifambutina'];
$rifambutina1 = "";
if ($rifambutina == "N") {
	$rifambutina1 = "Não";
} else if ($rifambutina == "RB") {
	$rifambutina1 = "Sim";
}

$levofloxacina= $consultas[0]['levofloxacina'];
$levofloxacina1 = "";
if ($levofloxacina == "N") {
	$levofloxacina1 = "Não";
} else if ($levofloxacina == "LV") {
	$levofloxacina1 = "Sim";
}

$ofloxacina= $consultas[0]['ofloxacina'];
$ofloxacina1 = "";
if ($ofloxacina == "N") {
	$ofloxacina1 = "Não";
} else if ($ofloxacina == "OF") {
	$ofloxacina1 = "Sim";
}
                                
$pdf->MultiCell(11, 0.5, 'ESQUEMA'."\n".'RIFAMPICINA (R):'.($rifampicina1).'          ISONIAZIDA (H):'.($isoniazida1)."\n".'ETAMBUTOL (E):'.($etambutol1).'           ESTREPTOMICINA (S):'.($estreptomicina1)."\n".'ETIONAMIDA (ET):'.($etionamida1).'        PIRAZINAMIDA (Z):'.($pirazinamida1)."\n".'RIFABUTINA (RB):'.($rifambutina1).'         LEVOFLOXACINA (LV):'.($levofloxacina1)."\n".'OFLOXACINA (LV):'.($ofloxacina1) ,1,"L");
$pdf->SetXY($x + 11, $y);
$arv = "UTILIZAÇÃO DE ANTI-RETROVIRAL (ARV)";
$pdf->MultiCell(3.5, 0.5,($arv)."\n \n \n".' ',1,"L");
$pdf->SetXY($x + 14.5, $y);
$pdf->MultiCell(4.5, 0.5,'TIPO DE TRATAMENTO'."\n \n".'   '.($consultas[0]['tipo_tratamento_atual'])." \n \n \n ".' ',1,"L");

$pdf->Ln(0.6);
$pdf->SetFont('Arial','B', 10);
$internacao = "INTERNAÇÃO";
$pdf->Cell(0,0.6,($internacao), 0, 1,'B');

$select4 = "SELECT *  FROM internacao, unidade WHERE internacao.cod_paciente = $codpac  AND internacao.cod_unidade = unidade.cod_unidade";
        $consulta_internacao = $db->selectQuery($select4);
$internacao = sizeof($consulta_internacao);
$pdf->SetFont('arial','',9);
$naoint = "ESTE PACIENTE NÃO POSSUI INTERNAÇÃO";
$dataint = "DATA DA INTERNAÇÃO";
$tiposaida = "TIPO DE SAÍDA HOSPITALAR";

if($internacao != 0){
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(3, 0.5,'CNES'."\n".' ',1,"L");
    $pdf->SetXY($x + 3, $y);
    $pdf->MultiCell(16, 0.5,'HOSPITAL'."\n".($consulta_internacao[0]['nome']),1,"L");
    $x = $pdf->GetX();
    $y = $pdf->GetY();
	
    $data_int = $consulta_internacao[0]['data'];
    if ($data_int != NULL) {
		$data_int1 = implode("/", array_reverse(explode("-", $data_int)));
	} else if ($data_int == "0000-00-00" || $data_int == NULL) {
		$data_int1 = "";
	}
	
    $pdf->MultiCell(5, 0.5,($dataint)."\n".$data_int1,1,"L");
    $pdf->SetXY($x + 5, $y);
	
    if(($consulta_internacao[0]['motivo']) == NULL){
        $pdf->MultiCell(14, 0.5,'MOTIVO'."\n".' ',1,"L");
    }else{
        $pdf->MultiCell(14, 0.5,'MOTIVO'."\n".($consulta_internacao[0]['motivo']),1,"L");
    }
	
    $x = $pdf->GetX();
    $y = $pdf->GetY();
	
    $data_alta = $consulta_internacao[0]['data_alta'];
    if ($data_alta != NULL) {
		$data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
	} else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
		$data_alta1 = "";
	}
	
    $pdf->MultiCell(5, 0.5,'DATA DA ALTA HOSPITALAR'."\n".$data_alta1,1,"L");
    $pdf->SetXY($x + 5, $y);
	
    if(($consulta_internacao[0]['tipo_alta'])==NULL){    
        $pdf->MultiCell(14, 0.5,($tiposaida)."\n".' ',1,"L");
    }else{
        $pdf->MultiCell(14, 0.5,($tiposaida)."\n".($consulta_internacao[0]['tipo_alta']),1,"L");
    }
}else{
    $pdf->MultiCell(19, 0.5,($naoint),0,"C");
}

$pdf->Ln(0.6);
$select3 = "SELECT *  FROM contato WHERE cod_paciente = $codpac ";
        $consulta_contato = $db->selectQuery($select3);
    
$totalcontatos = sizeof($consulta_contato);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','B', 10);
$pdf->MultiCell(10, 0.6,'CONTATOS',0,"L");
$pdf->SetXY($x + 10, $y);
$pdf->MultiCell(9, 0.6,'TOTAL DE CONTATOS:'.$totalcontatos,0,"R");
$not = "ESTE PACIENTE NÃO POSSUI CONTATOS.";

if($totalcontatos != 0){
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(8.5, 0.5,'NOME',1,"C");
    $pdf->SetXY($x + 8.5, $y);
    $pdf->MultiCell(2, 0.5,'IDADE',1,"C");
    $pdf->SetXY($x + 10.5, $y);
    $pdf->MultiCell(8.5, 0.5,'TIPO DE CONTATO',1,"C");
    for($i=0;$i<$totalcontatos;$i++){
        $pdf->SetFont('arial','',9);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(8.5, 0.5,($consulta_contato[$i]['nome']),1,"L");
        $pdf->SetXY($x + 8.5, $y);
        $pdf->MultiCell(2, 0.5,$consulta_contato[$i]['idade'],1,"C");
        $pdf->SetXY($x + 10.5, $y);
        $pdf->MultiCell(8.5, 0.5,($consulta_contato[$i]['grau_parentesco']),1,"L"); 
    }
}else{
    $pdf->SetFont('arial','',10);
    $pdf->MultiCell(19, 0.5,($not),0,"C");
}
$pdf->Output();
?>