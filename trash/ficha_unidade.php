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
                
                $cod = $conteudo[2];
                $select = "SELECT *  FROM  unidade WHERE cod_unidade = '$cod'";
                $infos = $db->selectQuery($select);
                                
                $cod_un = $infos[0]['cod_unidade'];
                $nome = $infos[0]['nome'];
                $cidade = $infos[0]['cidade'];
                $estado = $infos[0]['estado'];
                $endereco = $infos[0]['endereco'];
                $telefone = $infos[0]['telefone'];
                $atencao = $infos[0]['atencao'];
               
                $at = "";
                if ($atencao == "0") {
                    $at = "Atenção Básica";
                } else if ($atencao == "1"){
                    $at = "Atenção Hospitalar";
                } else if ($atencao == "2"){
                    $at = "Atenção Especializada";
                }
                ?>
                
                <br/>
                <h2 class="title">Informações</h2> 
                <b>Nome da unidade: </b><?= $nome; ?><br/>
                <b>Endereco: </b><?= $endereco; ?><br/>
                <b>Cidade: </b><?= $cidade; ?><br/>
                <b>Estado: </b><?= $estado; ?><br/>
                <b>Telefone: </b><?= $telefone; ?><br/>
                <b>Tipo de Atenção: </b><?= $at; ?><br/>
                <br/>

                <br/>


            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>

<div class="box box-gradient">    
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">


                <br/>
                <h2 class="title">Editar</h2>
                <!-- form elements [start] -->
                <form method="post" class="validar" action="editar_unidade.php">

                    <p>
                        <input type="hidden" name="cod_un" value= "<?= $cod_un; ?>" /> </p>

                    <p>
                        <label>Nome da unidade:</label><br/>
                        <input type="text" value="<?= $nome; ?>" class="text small" name="nome" /> 
                    </p>


                    <p>
                        <label>Endereço:</label><br/>
                        <input type="text" value="<?= $endereco; ?>" class="text small" name="endereco" /> 
                    </p>

                    <p>
                        <label>Cidade:</label><br/>
                        <input type="text" value="<?= $cidade; ?>" class="text small" name="cidade" /> 
                    </p>

                    <p>
                        <label>Estado:</label><br/>
                        <input type="text" value="<?= $estado; ?>" class="text small" name="estado" /> 
                    </p>

                    <p>
                        <label>Telefone:</label><br/>
                        <input type="text" value="<?= $telefone; ?>" class="text small telefone" name="telefone" /> 
                    </p>

                    
                    <?php
                        if ($atencao == "0") { ?>
                            <p>
                                <label>Tipo de atenção:</label><br/>
                                <select name="atencao"> 
                                    <option selected ="Atenção Básica" value="0">Atenção Básica</option>
                                    <option value="1">Atenção Hospitalar</option> 
                                    <option value="2">Atenção Especializada</option> 

                                </select>				
                            </p>
                    <?php
                        } else if ($atencao == "1") { ?>
                            <p>
                                <label>Tipo de atenção:</label><br/>
                                <select name="atencao"> 
                                    <option value="0">Atenção Básica</option>
                                    <option selected ="Atenção Hospitalar" value="1">Atenção Hospitalar</option> 
                                    <option value="2">Atenção Especializada</option> 

                                </select>				
                            </p>
                    <?php
                        } else if ($atencao == "2") { ?>
                            <p>
                                <label>Tipo de atenção:</label><br/>
                                <select name="atencao"> 
                                    <option value="0">Atenção Básica</option>
                                    <option value="1">Atenção Hospitalar</option> 
                                    <option selected ="Atenção Especializada" value="2">Atenção Especializada</option> 

                                </select>				
                            </p>
                            <?php
                        } else { ?>
                            <p>
                                <label>Tipo de atenção:</label><br/>
                                <select name="atencao"> 
                                    <option selected ="" value="" ></option>
                                    <option value="0">Atenção Básica</option>
                                    <option value="1">Atenção Hospitalar</option> 
                                    <option value="2">Atenção Especializada</option> 

                                </select>				
                            </p>
                         <?php }?>
                            
                    <p>
                        <button  class="classy" onclick="return confirm('Tem certeza que deseja atualizar os dados desta unidade?');"><span>Salvar alterações</span></button>
                    </p>

                </form>
                <!-- form elements [end] -->





            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>