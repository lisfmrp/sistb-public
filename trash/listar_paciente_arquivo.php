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
                                    $nome = $param1;
                                    $nro = $param2;
                                    $dois = 2;
                                    $select = "SELECT paciente.cod_paciente, paciente.nome, paciente.sexo, paciente.data_nascimento, paciente.nro_prontuario, tratamento.cod_tratamento, tratamento.cod_paciente, tratamento.encerrado
                                               FROM  tratamento LEFT JOIN paciente ON paciente.cod_paciente=tratamento.cod_paciente
                                               WHERE tratamento.encerrado like '%$dois%' AND paciente.nome like '%$nome%' AND paciente.nro_prontuario like '%$nro%'     
                                               ORDER BY paciente.nome LIMIT $inicio,$maximo";
                                    $consultas = $db->selectQuery($select);
									
                                    $total = sizeof($db->selectQuery("SELECT paciente.cod_paciente, paciente.nome, paciente.sexo, paciente.data_nascimento, paciente.nro_prontuario, tratamento.cod_tratamento, tratamento.cod_paciente, tratamento.encerrado
                                               FROM  tratamento LEFT JOIN paciente ON paciente.cod_paciente=tratamento.cod_paciente
                                               WHERE tratamento.encerrado like '%$dois%' AND paciente.nome like '%$nome%' AND paciente.nro_prontuario like '%$nro%'    
                                               ORDER BY paciente.nome "));
											   /* Encerra a conexão com o banco */
                                        $db->endConnection();
                                    ?>
                                    <!-- table, pagination [start] -->
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th></th>
                                                <th>Ver ficha paciente</th>
                                                
                                                <th>Nome</th>
                                                <th>Nº Prontuário</th>
                                                <th>Data Nascimento</th>
                                                <th>Sexo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($consultas as $consulta) {
											
												$cod =$consulta['cod_paciente'];
                                                $nome = $consulta['nome'];
                                                $sexo = $consulta['sexo'];
                                                $data_nasc = $consulta['data_nascimento'];
												$nro_prontuario = $consulta['nro_prontuario'];
                                                $trat = $consulta['cod_tratamento'];
;
                                                
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
                                                    <td><a href="index.php?acao=arquivo+mostrar+<?= $trat ?>" class="minibutton"><span>Ver ficha paciente</span></a></td>
                                                    
                                                    <td><?= $nome ?></td>
                                                    <td><?= $nro_prontuario ?></td>
                                                    <td><?= $data ?></td>
                                                    <td><?= $sexo ?></td>
                                                    
                                                    
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
                                                echo "<a href=index.php?acao=arquivo+listar+&pagina=$menos&busca=$param1&busca2=$param2><span>anterior</span></a> ";
                                            }

                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=arquivo+listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }

                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=arquivo+listar&pagina=$mais&busca=$param1&busca2=$param2><span>próxima</span></a> ";
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