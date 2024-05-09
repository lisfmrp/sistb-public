<?php
require_once("autenticacao.php");		
include('relatorio/fpdf/fpdf.php');

$codigoun = $_GET['cod_unidade'];
		
$select = "SELECT nome, cidade FROM unidade WHERE cod_unidade = $codigoun";
$consulta = $db->selectQuery($select);
$nome = $consulta[0]['nome'];
$municipio = $consulta[0]['cidade'];

$mes_atual = date("m");
$ano_atual = date("Y");
if ($mes_atual == '01'){
    $mes_anterior = 12;
    $ano_anterior = $ano_atual - 1; 
} else {
    $mes_anterior = $mes_atual - 1;
}
                                                                                              
$atual=date("d/m/Y");
$select2 = "SELECT * FROM tratamento, paciente 
			WHERE tratamento.un_atendimento = $codigoun AND tratamento.cod_paciente = paciente.cod_paciente 
					AND (tratamento.encerrado = '0'  
					OR (MONTH(tratamento.data_alta_tratamento) = $mes_atual AND YEAR(tratamento.data_alta_tratamento)= $ano_atual)
					OR (MONTH(tratamento.data_alta_tratamento) = $mes_anterior  AND YEAR(tratamento.data_alta_tratamento)=$ano_atual))";

$consultas = $db->selectQuery($select2);

$originalDate = date('Y-m-d H:i');
$brDate = date("d-m-Y H:i", strtotime($originalDate));

$pdf = new FPDF('L','cm','A4');
$pdf->AddPage();
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','B', 9);
$pdf->MultiCell(25, 0.5, 'EMITIDO EM:  ',0,"R");
$pdf->SetFont('Arial','', 9);
$pdf->SetXY($x + 25, $y);
$pdf->MultiCell(3, 0.5, $brDate ,0,"L");
$pdf->SetFont('Arial','B', 16);
$pdf->MultiCell(28, 1, 'TUBERCULOSE - BOLETIM DE ACOMPANHAMENTO',0,"C");
$pdf->SetFont('Arial','', 12);
$pdf->MultiCell(28, 0.5, 'Unidade de Atendimento: '. ($nome) ,0,"L");
$municipioat = "Município de Atendimento";
$pdf->MultiCell(28, 0.5, ($municipioat).': '.($municipio),0,"L");
$pdf->Ln(0.5);

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','B', 8);
$pdf->MultiCell(1.5, 0.5,"\n".'SINAM',0,"C");
$pdf->SetXY($x + 1.5, $y);
$pdf->MultiCell(4, 0.5, "\n".'NOME',0,"C");
$pdf->SetXY($x + 5.5, $y);
$pdf->MultiCell(2.5, 0.5,"\n".'PRONT.',0,"C");
$pdf->SetXY($x + 8, $y);
$inicio = "INÍCIO";
$pdf->MultiCell(2, 0.5,"\n".($inicio),0,"C");
$pdf->SetXY($x + 10 , $y);
$pdf->MultiCell(5, 0.5, "\n".'EXAMES',0,"C");
$pdf->SetXY($x + 15 , $y);
$pdf->MultiCell(2, 0.5, 'ESQUEMA ATUAL',0,"C");
$pdf->SetXY($x + 17 , $y);
$pdf->MultiCell(3, 0.5, 'ULT.BAC. CONTROLE',0,"C");
$pdf->SetXY($x + 20 , $y);
$numero = "NÚMERO DE DIAS SUPERV.";
$pdf->MultiCell(2.5, 0.5, ($numero),0,"C");
$pdf->SetXY($x + 22.5 , $y);
$situacao = "SITUAÇÃO ATUAL";
$pdf->MultiCell(2, 0.5, ($situacao),0,"C");
$pdf->SetXY($x + 24.5 , $y);
$pdf->MultiCell(2.5, 0.5, 'CONTATOS DOMICILIARES',0,"C");
$pdf->Ln(0.5);

$count=0;
$total = sizeof($consultas);
if($total == 0){
    $pdf->Ln(4);
    $unnao = "Essa unidade não possui paciente.";
    $pdf->SetFont('Arial','', 16);
    $pdf->MultiCell(28, 1, ($unnao),0,"C");
}

for($i=0;$i<$total;$i++){
    $paciente = $consultas[$i]['cod_paciente'];
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetFont('Arial','', 8);
    $pdf->MultiCell(1.5, 0.5, $consultas[$i]['sinan']."\n \n \n \n",1,"L");
    $pdf->SetXY($x + 1.5, $y);
    $pdf->MultiCell(4, 0.5, $consultas[$i]['nome']."\n \n \n".'                                               ',1,"L");
    $pdf->SetXY($x + 5.5, $y); 
    $pdf->MultiCell(2.5, 0.5, $consultas[$i]['nro_hygia']."\n \n \n \n",1,"L");
    $pdf->SetXY($x + 8, $y);
    $data_trat_atual = $consultas[$i]['data_tratamento_atual'];
    $data = date("d/m/Y", strtotime($data_trat_atual));
    $pdf->MultiCell(2, 0.5, $data."\n \n \n \n",1,"C");
    $pdf->SetXY($x + 10 , $y);
    $pdf->MultiCell(5, 0.5, 'Baciloscopia: '.($consultas[$i]['resultado_escarro'])."\n". 'Cultura Esc.:  '.($consultas[$i]['resultado_cultura_escarro'])."\n".'Anti-HIV: '.($consultas[$i]['anti_hiv'])."\n".'Teste Sensibilidade: ',1,"L");
    $pdf->SetXY($x + 15 , $y);
    $pdf->MultiCell(2, 0.5, $rifampicina = $consultas[0]['rifampicina'].$izoniazida = $consultas[0]['izoniazida'].$pirazinamida = $consultas[0]['pirazinamida'].$etambutol = $consultas[0]['etambutol']."\n \n \n \n",1,"L");
    $pdf->SetXY($x + 17 , $y);

	$select4 = "SELECT * FROM controle_mensal WHERE cod_paciente = $paciente AND tipo_exame = 'Baciloscopia' ORDER BY data_controle DESC";
	$consulta_baciloscopia = $db->selectQuery($select4);

	$z = sizeof($consulta_baciloscopia);
	if($z!=0){
	$bac = $consulta_baciloscopia[0]['resultado_controle'];
	$databac = $consulta_baciloscopia[0]['data_controle'];
	$brdatabac = date("d-m-Y", strtotime($databac));
	}else{
		$bac = NULL;
		$brdatabac = NULL;
	}

	if($bac == "Não realizado"){
		$pdf->MultiCell(3, 0.5, 'Resultado: '."\n".($bac)." \n \n \n",1,"L");
	}else{
		$pdf->MultiCell(3, 0.5, 'Resultado: '.($bac)."\n".'Data:'.$brdatabac."\n \n \n",1,"L");   
	}

    $pdf->SetXY($x + 20 , $y);

    $data_inicio = $consultas[$i]['data_tratamento_atual'];
    $primeiro = date('Y-m-d', strtotime("+61 days",strtotime($data_inicio)));
    $segundo0 = date('Y-m-d', strtotime("+1 days",strtotime($primeiro)));
    $segundo = date('Y-m-d', strtotime("+122 days",strtotime($primeiro)));
    $apos = date('Y-m-d', strtotime("+1 days",strtotime($segundo)));
    
    $select5 = "SELECT * FROM supervisionamento WHERE cod_paciente = $paciente AND ((comparecimento = 'SU') OR (comparecimento = 'SVD')) AND data_supervisionamento <= '$primeiro' ";
    $consulta_primeiro = $db->selectQuery($select5);
    $totalprimeiro = sizeof($consulta_primeiro);
    
    $select6 = "SELECT * FROM supervisionamento WHERE cod_paciente = $paciente AND ((comparecimento = 'SU') OR (comparecimento = 'SVD')) AND data_supervisionamento BETWEEN '$segundo0' AND '$segundo' ";
    $consulta_segundo = $db->selectQuery($select6);
    $totalsegundo = sizeof($consulta_segundo);

    $select7 = "SELECT * FROM supervisionamento WHERE cod_paciente = $paciente AND ((comparecimento = 'SU') OR (comparecimento = 'SVD')) AND data_supervisionamento >='$apos' ";
    $consulta_apos = $db->selectQuery($select7);
    $totalapos = sizeof($consulta_apos);

    $primeiro = date("d/m/Y", strtotime($primeiro));
    $segundo0 = date("d/m/Y", strtotime($segundo0));
    $segundo = date("d/m/Y", strtotime($segundo));
    $apos = date("d/m/Y", strtotime($apos));

    $ate ="Até ";
    $ate1 =" até ";
    $aposs = "Após ";
    $pdf->SetFont('Arial','', 4.5);
    $pdf->MultiCell(2.5, 0.5, ($ate).$primeiro.': '.$totalprimeiro."\n".$segundo0.($ate1).$segundo.': '.$totalsegundo."\n".($aposs).$apos.': '.$totalapos." \n \n",1,"L");
    $pdf->SetFont('Arial','', 8);
    $pdf->SetXY($x + 22.5 , $y);

    $motivo_alta = $consultas[$i]['motivo_alta'];
    $data_alta = $consultas[$i]['data_alta_tratamento'];
    $data_alta = date("d/m/Y", strtotime($data_alta));
    if($motivo_alta == NULL){
        $pdf->MultiCell(2, 0.5,"\n".'Em tratamento'." \n ",1,"C");
    }else{
        $pdf->MultiCell(2, 0.5, ($motivo_alta)."\n \n ".$data_alta." \n ",1,"C");   
    }
    $pdf->SetXY($x + 24.5 , $y);

	$select3 = "SELECT *  FROM contato WHERE cod_paciente = $paciente ";
	$consulta_contato = $db->selectQuery($select3);
    
    $totalcontatos = sizeof($consulta_contato);
    $total_contatos_examinados = 0;
    $total_contatos_adoecidos =0;
    for($j=0;$j<$totalcontatos;$j++){
        if($consulta_contato[$j]['resultado_baciloscopia'] != "8- Não realizado"){
            $total_contatos_examinados = 1 + $total_contatos_examinados;
            if($consulta_contato[$j]['resultado_baciloscopia']!= NULL){                
                if($consulta_contato[$j]['resultado_baciloscopia'] == "1- Positivo"){
                    $total_contatos_adoecidos = 1 + $total_contatos_adoecidos;
                }
            }
        }
    }

    $pdf->MultiCell(2.5, 0.5, 'Total: '.$totalcontatos."\n".'Examin:'.$total_contatos_examinados."\n".'Adoece.:'.$total_contatos_adoecidos."\n".' ',1,"L");
    $count = 1 + $count;
        if($i == 5){
            $pdf->Ln(0.25);
            $pdf->MultiCell(28, 0.5, 'OBS:_______________________________________________________________________________________________________________________________________________________________________'."\n".'____________________________________________________________________________________________________________________________________________________________________________',0,"L");
            $pdf->AddPage();
            $count=0;
            }
    
        if($count==8){
            $pdf->Ln(0.25);
            $pdf->MultiCell(28, 0.5, 'OBS:_______________________________________________________________________________________________________________________________________________________________________'."\n".'____________________________________________________________________________________________________________________________________________________________________________',0,"L");
            $pdf->AddPage();
            $count=0;  
        }
}
$pdf->Output();
?>