<?php
/* Verifica se o usu�rio est� logado */
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
        * e realiza a conex�o */
        $db = banco::connectToTB();

?>
<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Lista de pacientes ::</span></span></span></h3>
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


                                <?php
                               
                                // Maximo de registros por pagina
                                $maximo = 10;

                                if (!isset($_GET['pagina'])) {
                                    $pagina = "1";
                                } else {
                                    $pagina = $_GET['pagina'];
                                }

                                // Calculando o registro inicial
                                $inicio = $pagina - 1;
                                $inicio = $maximo * $inicio;
                                $cod_paciente = 1;

                                $cont = ($pagina * 10) - 9;




                                if (isset($_GET)) {
                                    $param1 = $_GET["busca"];
                                    $param2 = $_GET["busca2"];
                                    $param3 = $_GET["busca3"];
                                    
                                    $nome = $param1;
                                    $mes = $param2; 
                                    $ano = $param3;
                                     
                                  
                                    $select = "SELECT paciente.cod_paciente, paciente.cpf, paciente.nome, paciente.cns, paciente.mae, paciente.data_nascimento, tratamento.cod_paciente, tratamento.encerrado

                                            FROM tratamento  LEFT JOIN paciente ON tratamento.cod_paciente = paciente.cod_paciente
                                            WHERE paciente.nome like '%$nome%' 
                                            ORDER BY tratamento.encerrado, paciente.nome LIMIT $inicio,$maximo";
                                    $consultas = $db->selectQuery($select);
									
                                    $total = sizeof($db->selectQuery("SELECT paciente.cod_paciente, paciente.cpf, paciente.nome, paciente.cns, paciente.mae, paciente.data_nascimento, tratamento.cod_paciente, tratamento.encerrado
                                            FROM tratamento  LEFT JOIN paciente ON tratamento.cod_paciente = paciente.cod_paciente
                                            WHERE paciente.nome like '%$nome%' 
                                            ORDER BY tratamento.encerrado, paciente.nome "));

                                   
                                    ?>
                                    <!-- table, pagination [start] -->
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
           
                                            <tr>  
                                                <th></th>
                                                <th>Ver ficha paciente</th>
                                                <th>Status</th>
                                                <th>Nome</th>
                                                <th>Data nascimento</th>
                                                <th>Nome da m�e</th>
                                                <th>CPF</th>
                                                <th>CNS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
										   
										   foreach ($consultas as $consulta) {
											 
                                                $cod =$consulta['cod_paciente'];
                                                $cpf = $consulta['cpf'];
                                                $nome = $consulta['nome'];
                                                $cns = $consulta['cns'];
                                                $nome_mae = $consulta['mae'];
                                                $data_nasc = $consulta['data_nascimento'];
                                                
                                                $encerrado = $consulta['encerrado'];

                                                
                                                if ($data_nasc != "0000-00-00" && $data_nasc != NULL) {
                                                    //$d1 = explode("-", $data_nasc);
                                                    //$data_nasc1 = $d1[2] . "/" . $d1[1] . "/" . $d1[0];
                                                    
                                                     $data = implode("/",array_reverse(explode("-",$data_nasc)));
                                                }
                                                else $data = 0;
                                                ?>
                                                <tr>
                                                    <td><?= $cont ?>.</td>
                                                    <?php $cont = $cont + 1; ?>
                                                    <td><a href="index.php?acao=supervisionamento+mostrar_paciente_mes+<?= $cod?>+<?= $mes?>+<?= $ano ?>" class="minibutton"><span>Ver ficha paciente</span></a></td>
                                                    
                                                    <?php if($encerrado == "0") { ?>
                                                    <td bgcolor="red"><font color = "black"><b>Em andamento</b></font></td>
                                                    <?php } else if($encerrado == "1") { ?>
                                                    <td bgcolor="green"><font color = "black"><b>Encerrado</b></font></td>
                                                    <?php } else if($encerrado == "2") { ?>
                                                    <td bgcolor="blue"><font color = "black"><b>Arquivo</b></font></td>
                                                    <?php }?>
                                                    
                                                    <td><?= $nome ?></td>
                                                    <td><?= $data ?></td>
                                                    <td><?= $nome_mae ?></td>
                                                    <td><?= $cpf ?></td>
                                                    <td><?= $cns ?></td>
                                                    
                                                </tr>
                                                <?php //}
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
                                                echo "<a href=index.php?acao=supervisionamento+listar_mes+&pagina=$menos&busca=$param1&busca2=$param2&busca3=$param3><span>anterior</span></a> ";
                                            }

                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=supervisionamento+listar_mes&pagina=$i&busca=$param1&busca2=$param2&busca3=$param3><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }

                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=supervisionamento+listar_mes&pagina=$mais&busca=$param1&busca2=$param2&busca3=$param3><span>pr�xima</span></a> ";
                                            }
                                        }
                                        ?>
                                    </div>

                                    <!-- table, pagination [end] -->
                                    <?php
                                } else {
                                    echo "Por favor, digite o nome do paciente.";
                                }
                                ?>	






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