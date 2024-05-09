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
<div class="box box-header">
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
                                
                                $data_atual = date("d/m/Y");
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
                                    $mae = $param2;
                                    $select = "SELECT paciente.cod_paciente, paciente.cpf, paciente.nome, paciente.cns, paciente.mae, 
                                                      paciente.data_nascimento, tratamento.cod_paciente, tratamento.data_tratamento_atual, tratamento.cod_tratamento
                                               FROM paciente, tratamento
                                               WHERE nome like '%$nome%' AND mae like '%$mae%' AND paciente.cod_paciente=tratamento.cod_paciente
                                               ORDER BY nome LIMIT $inicio,$maximo";
                                    $queryPaciente = $db->selectQuery($select);
                                    $total = sizeof($db->selectQuery("SELECT paciente.cod_paciente, paciente.cpf, paciente.nome, paciente.cns, paciente.mae, 
                                                      paciente.data_nascimento, tratamento.cod_paciente, tratamento.data_tratamento_atual, tratamento.cod_tratamento
                                               FROM paciente, tratamento
                                               WHERE nome like '%$nome%' AND mae like '%$mae%' AND paciente.cod_paciente=tratamento.cod_paciente
                                               ORDER BY nome "));
                                    ?>
                                    <!-- table, pagination [start] -->
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th></th>
                                                <th>Ver relatório</th>
                                                <th>Data início tratamento</th>
                                                <th>Nome</th>
                                                <th>Data nascimento</th>
                                                <th>Nome da mãe</th>
                                                <th>CPF</th>
                                                <th>CNS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($queryPaciente as $consulta) {
								
												$cod =$consulta['cod_paciente'];
                                                $cpf = $consulta['cpf'];
                                                $nome = $consulta['nome'];
                                                $cns = $consulta['cns'];
                                                $nome_mae = $consulta['mae'];
												$data_nasc = $consulta['data_nascimento'];
												$data_trat = $consulta['data_tratamento_atual'];
												$cod_trat =$consulta['cod_tratamento'];
												
                                                if ($data_nasc != NULL) {
                                                    //$d1 = explode("-", $data_nasc);
                                                    //$data_nasc1 = $d1[2] . "/" . $d1[1] . "/" . $d1[0];
                                                    
                                                     $data = implode("/",array_reverse(explode("-",$data_nasc)));
                                                }
                                                else $data = 0;
                                                if ($data_trat != NULL) {
                                                    //$d1 = explode("-", $data_nasc);
                                                    //$data_nasc1 = $d1[2] . "/" . $d1[1] . "/" . $d1[0];
                                                    
                                                     $dataT = implode("/",array_reverse(explode("-",$data_trat)));
                                                }
                                                else $dataT = 0;
                                                ?>
                                                <tr>
                                                    <td><?= $cont ?>.</td>
                                                    <?php $cont = $cont + 1; ?>
                                                    <td><a href="index.php?acao=tratamento+relatorio+<?= $cod_trat ?>+<?= $cod ?>" class="minibutton"><span>Ver relatório</span></a></td>
                                                    <td><?= $dataT ?></td>
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
                                                echo "<a href=index.php?acao=tratamento+listar+&pagina=$menos&busca=$param1&busca2=$param2><span>anterior</span></a> ";
                                            }

                                            // Listando as paginas
                                            for ($i = 1; $i <= $pgs; $i++) {
                                                if ($i != $pagina) {
                                                    echo "<a href=index.php?acao=tratamento+listar&pagina=$i&busca=$param1&busca2=$param2><span>" . $i . "</span></a> ";
                                                } else {
                                                    echo "<a class='active' href='#'><span>" . $i . "</span></a> ";
                                                }
                                            }

                                            if ($mais <= $pgs) {
                                                echo "<a href=" . $_SERVER['PHP_SELF'] . "?acao=tratamento+listar&pagina=$mais&busca=$param1&busca2=$param2><span>próxima</span></a> ";
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