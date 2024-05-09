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

?><!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Dados do profissional ::</span></span></span></h3>
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
                               
                                $maximo = 10;

                                if (!isset($_GET['pagina'])) {
                                    $pagina = "1";
                                } else {
                                    $pagina = $_GET['pagina'];
                                }

                                // Calculando o registro inicial
                                $inicio = $pagina - 1;
                                $inicio = $maximo * $inicio;
                                $cod = $conteudo[2];



                                if ($cod != $_SESSION['cod_profissional']){
                                    echo "Acesso restrito. A informação só pode ser modificada pelo usuário a qual ela pertence.";
                                    
                                 } else 
                                {


                                    $select = "SELECT nome, email, numero_conselho, login, ocupacao  FROM profissional WHERE profissional.cod_profissional = '$cod'";

                                    $consultas = $db->selectQuery($select);

                                    $nome = $consultas[0]['nome'];   
                                    $email =$consultas[0]['email'];   
                                    $nro_conselho = $consultas[0]['numero_conselho'];   
                                    $login = $consultas[0]['login'];   
                                    $ocupacao = $consultas[0]['ocupacao'];   
                                    ?>


                                    <br/>
                                    <h2 class="title">Informações Gerais</h2> 
                                    <b>Nome do profissional: </b><?= $nome; ?><br/>
                                    <b>Nº conselho: </b><?= $nro_conselho; ?><br/>
                               
                                    <b>Unidades onde o profissional trabalha:</b><br/>
                                    <?php 
                                    $selectu = "SELECT unidade.nome FROM usuario, unidade WHERE usuario.cod_profissional = '$cod' AND usuario.cod_unidade = unidade.cod_unidade";

    								$consultasu = $db->selectQuery($selectu);
    								foreach ($consultasu as $consultau) {
    									$nome_unidade =$consultau['nome'];
                                    //while($l = mysql_fetch_array($query)){
                                        //$nome_unidade = ucfirst($l[0]);
                                    ?>
                                    <?= $nome_unidade; ?><br/>
                                    <?php } ?>
                                    
                                    <b>Email: </b><?= $email; ?><br/>
                                    <b>Login: </b><?= $login; ?><br/>

                                    <br/>




                                </div>
                            </div>
                        </div>
                        <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                    </div>
                    <!-- box with default header [end] -->	

                    <p></p>

                    <!-- box with default header [begin] -->
                    <div class="box box-gradient">    
                        <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                        <div class="box-1">
                            <div class="box-2">
                                <div class="box-3 header-on">


                                    <br/>
                                    <h2 class="title">Editar</h2>
                                    <!-- form elements [start] -->
                                    <form method="post" class="validar" action="editar_profissional.php">

                                        <p>
                                            <input type="hidden" name="cod_prof" value= "<?= $cod; ?>" /> </p>

                                        <p>
                                            <label>Nome do profissional:</label><br/>
                                            <input type="text" value="<?= $nome; ?>" class="text small" name="nome" /> 
                                        </p>


                                        <p>
                                            <label>Número conselho:</label><br/>
                                            <input type="text" value="<?= $nro_conselho; ?>" class="text small" name="nro_conselho" /> 
                                        </p>



                                        <p>
                                            <label>Email:</label><br/>
                                            <input type="text" value="<?= $email; ?>" class="text small" name="email" /> 
                                        </p>

                                        <p>
                                            <label>Login:</label><br/>
                                            <input type="text" value="<?= $login; ?>" class="text small" name="login" /> 
                                        </p>

                                        <p>
                                            <label>Senha: (*)</label><br/>
                                            <input id="senha" class="text small required" type="password"  name="senha1"/>  
                                        </p>

                                        <p>
                                            <label>Redigite Senha: (*)</label><br/>
                                            <input id="senha2" class="text small required" type="password" name="senha2"/>  
                                        </p>



                                        <p>
                                            <button  class="classy" onclick="return confirm('Tem certeza que deseja atualizar os dados deste profissional?');"><span>Salvar alterações</span></button>
                                        </p>

                                    </form>
                                    <!-- form elements [end] -->





                                </div>
                            </div>
                        </div>
                        <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                    </div>
                    <!-- box with gradient [end] --> 

            <?php //else da permissao
            } ?>

            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->