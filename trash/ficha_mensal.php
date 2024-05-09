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
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Supervisionamento do paciente ::</span></span></span></h3>
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
								
                                $param1 = $_GET["busca"]; //mes
                                $param2 = $_GET["busca2"]; //ano


                                $select = "SELECT paciente.nome, paciente.nro_hygia, paciente.data_nascimento, tratamento.data_tratamento_atual, tratamento.data_notificacao, supervisionamento.data_supervisionamento, supervisionamento.comparecimento
                                            FROM paciente, tratamento, supervisionamento
                                            WHERE paciente.cod_paciente = tratamento.cod_paciente
                                            AND paciente.cod_paciente = supervisionamento.cod_paciente
                                            AND supervisionamento.cod_tratamento = tratamento.cod_tratamento
                                            AND YEAR( supervisionamento.data_supervisionamento ) ='$param2'
                                            AND MONTH( supervisionamento.data_supervisionamento ) ='$param1'
                                            ORDER BY paciente.nome, supervisionamento.data_supervisionamento";
                                
                               
                              
                                $query = @mysql_query($select) or die(mysql_error());

                                
                       
                                ?>
                                <br/>
                                <h2 class="title">Relatório de Supervisão: </h2>
                                <br/>
                                <label><b>Mês:</b> <?= $param1; ?> / <b>Ano:</b><?= $param2; ?></label> 
                                <br/>
                                                             
                                <?php
                                     
                                            $nome="b";
                                            $nome_ant = "a";
                                            $ant = 0;
                                            $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                            
                                    while ($l = mysql_fetch_array($query)) {
                                      
                                       $nome = ucfirst($l[0]);
                                        if($nome_ant != $nome){
                                           ?><table  align="center" border> <?php //tabela para os supervisionamentos
                                           
                                                $nome = ucfirst($l[0]);
                                                $nro_hygia = ucfirst($l[1]);
                                                $data_nasc = ucfirst($l[2]);
                                                $data_trat_atual = ucfirst($l[3]);
                                                $data_notificacao = ucfirst($l[4]);
                                            // $data_supervisao = ucfirst($l[5]);
                                            // $comp = ucfirst($l[6]);
                                                


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
                                                
                                                 
                                                $data_supervisao = ucfirst($l[5]);
                                                $comp = ucfirst($l[6]);
                                                $d1 = explode("-", $data_supervisao);
                                                    $data = $d1[2] . "/" . $d1[1] . "/" . $d1[0];  //aqui fazemos um split na data para dividirmos em dia, mês e ano

                                                if($nome_ant != $nome && $nome_ant != "a"){
                                                    ?> <p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n");
                                                }
                                                
                                                ?>
                                
                                
                                
                                              <br/><br/><p align="left">
                                                <b>Nome do Paciente: </b><?= $nome; ?><br/>
                                                <b>Número Hygia: </b><?= $nro_hygia; ?><br/>
                                                <b>Data Nascimento: </b><?= $data_nasc1; ?><br/>
                                                <b>Data de notificação: </b><?= $data_notificacao1; ?><br/>
                                                <b>Data de início do tratamento: </b><?= $data_trat_atual1; ?><br/>
                                                
                                               
                                        <?php  $nome_ant=$nome; //}
                                                                                   
                                            $su = 0;
                                            $svd = 0;
                                            $aa = 0;
                                            $n = 0;
                                            
                                            $ant = $d1[2];
                                            ?>
                                    
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
                                        }
                                        
                                        
                                        else {
                                            $data_supervisao = ucfirst($l[5]);
                                            $comp = ucfirst($l[6]);
                                            $d1 = explode("-", $data_supervisao);
                                            $data = $d1[2] . "/" . $d1[1] . "/" . $d1[0];  //aqui fazemos um split na data para dividirmos em dia, mês e ano

                                            
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
                                            $ant = $d1[2];
                                        } ?>
                                    
                                   <?php 
                                   
                                    
                                   
                                   } ?></table>
                                                <p align="center"> <?php echo ("Total: <b><font color='orange'>(SU):</font></b> $su / <b><font color='green'>(SVD):</font></b> $svd / <b><font color='#3299CC'>(AA):</font></b> $aa / <b><font color='red'>(N):</font></b> $n");
                                        ?>
                                        
                                                
                                                
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