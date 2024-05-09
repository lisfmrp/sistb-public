<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Lista de exames para controle mensal ::</span></span></span></h3>
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
                                    $nome = $param1;
                                    $mae = $param2;
                                    $sql = "SELECT controle_mensal.cod_paciente, paciente.nome, tratamento.data_tratamento_atual,
                                               controle_mensal.resultado_controle, controle_mensal.data_controle, controle_mensal.cod_tratamento,
                                               controle_mensal.cod_controle,  controle_mensal.tipo_exame,  controle_mensal.material_controle, tratamento.data_alta_tratamento
                                               FROM controle_mensal, paciente, tratamento
                                               WHERE paciente.nome LIKE '%$nome%' AND paciente.mae LIKE '%$mae%' AND controle_mensal.cod_paciente = paciente.cod_paciente
                                               AND controle_mensal.cod_tratamento = tratamento.cod_tratamento
                                               ORDER BY controle_mensal.data_controle DESC LIMIT $inicio,$maximo";
                                    $result = $db->selectQuery($sql);									
                                    $total = sizeof($db->selectQuery("SELECT controle_mensal.cod_paciente FROM controle_mensal, paciente, tratamento
                                               WHERE paciente.nome LIKE '%$nome%' AND paciente.mae LIKE '%$mae%' AND controle_mensal.cod_paciente = paciente.cod_paciente
                                               AND controle_mensal.cod_tratamento = tratamento.cod_tratamento "));
                                    ?>
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th>#</th>
                                                <th>Editar</th>
                                                <th>Data do início do tratamento</th>
                                                <th>Nome</th>                            
                                                <th>Exame</th>
                                                <th>Material</th>
                                                <th>Resultado</th>
                                                <th>Data do resultado</th>
                                                <th>Tempo de tratamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											foreach ($result as $consulta) {										
												$cod_paciente = $consulta['cod_paciente'];                                                
                                                $nome_paciente = ($consulta['nome']);
												$data_tratamento_atual = $consulta['data_tratamento_atual'];
                                                $tipo_exame = $consulta['tipo_exame'];
                                                $resultado = $consulta['resultado_controle'];
                                                $data_controle = $consulta['data_controle'];
												$cod_tratamento= $consulta['cod_tratamento'];
												$cod_controle= $consulta['cod_controle'];
												$data_alta= $consulta['data_alta_tratamento'];
                                                $material_controle = $consulta['material_controle'];
												
                                                $tempo = 0;
                                                if ($data_tratamento_atual != NULL || $data_tratamento_atual != "0000-00-00") {
                                                    //$d1 = explode("-", $data_nasc);
                                                    //$data_nasc1 = $d1[2] . "/" . $d1[1] . "/" . $d1[0];
                                                    if ($data_controle != "0000-00-00") {                                                       
                                                        $data_tratamento_atual = implode("/",array_reverse(explode("-",$data_tratamento_atual)));
                                                        $data_controle = implode("/",array_reverse(explode("-",$data_controle)));
                                                     
                                                        //calcular tempo de tratamento - inicio até dia atual
                                                        // Separa em dia, mês e ano
                                                        list($dia, $mes, $ano) = explode('/', $data_tratamento_atual);
                                                        list($diaA, $mesA, $anoA) = explode('/', $data_controle);
                                                        // Descobre que dia é hoje e retorna a unix timestamp
                                                        $alta = mktime(0, 0, 0, $mesA, $diaA, $anoA);
                                                        // Descobre a unix timestamp da data de nascimento do fulano
                                                        $inicioT = mktime( 0, 0, 0, $mes, $dia, $ano);
                                                        // Depois apenas fazemos o cálculo já citado :)
                                                        $tempo = floor(($alta - $inicioT)/ 2592000);
                                                    }else{
                                                         $data_tratamento_atual = implode("/",array_reverse(explode("-",$data_tratamento_atual)));                                                
                                                        
														//calcular tempo de tratamento - inicio até dia atual
                                                        // Separa em dia, mês e ano
                                                        list($dia, $mes, $ano) = explode('/', $data_tratamento_atual);
                                                        // Descobre que dia é hoje e retorna a unix timestamp
                                                        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                                                        // Descobre a unix timestamp da data de nascimento do fulano
                                                        $inicioT = mktime( 0, 0, 0, $mes, $dia, $ano);
                                                        // Depois apenas fazemos o cálculo já citado :)
                                                        $tempo = floor(($hoje - $inicioT)/ 2592000);
                                                        //echo $tempo;
                                                    }                                                    
                                                } else { 
													$data_tratamento_atual = " ";
												}
												
                                                $data_controle = "";
                                                if ($data_controle != NULL || $data_controle != "0000-00-00") {
                                                    $data_controle = implode("/",array_reverse(explode("-",$data_controle)));
                                                }
                                        ?>
                                                <tr>
                                                    <td><?=$cont?>.</td>
                                                    <td><a href="index.php?acao=controle_form&cod_controle=<?=$cod_controle?>" class="minibutton"><span>Editar dados do exame</span></a></td>
                                                    <td><?=$data_tratamento_atual?></td>
                                                    <td><?=$nome_paciente?></td>
                                                    <td><?=$tipo_exame?></td>
                                                    <td><?=$material_controle?></td>
                                                    <td><?=$resultado?></td>
                                                    <td><?=$data_controle?></td>
                                                    <td><?=$tempo?> meses</td>                                                    
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
                                                echo "<a href=index.php?acao=controle_listar&pagina=$menos&busca=$param1&busca2=$param2><span> << </span></a> ";
                                            }
                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=controle_listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }
                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=controle_listar&pagina=$mais&busca=$param1&busca2=$param2><span> >> </span></a> ";
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