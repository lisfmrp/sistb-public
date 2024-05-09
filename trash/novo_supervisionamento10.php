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
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Nova Supervis�o ::</span></span></span></h3>
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


                                <!-- form elements [start] -->
                                <form method="post" class="validar" action="insere_supervisionamento10.php">

                                    <?php
                                    $data_atual = date("d/m/Y");                                    
                                    ?>

                                    <p>
                                        <label>Campos com (*) s�o obrigat�rios!</label><br/>
                                    </p>

                                    <p>
                                        <label>Nome do paciente (Em tratamento)/ Data do in�cio do tratamento(*)</label><br/>

                                        <?php
                                        $select = "SELECT tratamento.cod_paciente,paciente.nome, tratamento.cod_tratamento, data_tratamento_atual
                                                       FROM tratamento,paciente WHERE tratamento.cod_paciente = paciente.cod_paciente
                                                       AND tratamento.encerrado = 0 AND tratamento.un_supervisao = '$_SESSION[cod_unidade]' ORDER BY paciente.nome";
                                          $queryPacientes = $db->selectQuery($select);
                                        if ($queryPacientes) {
                                            echo "<select name='cod_paciente' class='required' id='pac1' >";
                                            
                                            echo "<option value = ''</option>";
                                            foreach ($queryPacientes as $paciente) {
                                                $valor = $paciente['cod_paciente'];
                                                $nome = ucwords($paciente['nome']);
                                                $cod_tratamento = ucwords($paciente['cod_tratamento']);
                                                $data_tratamento = ucwords($paciente['data_tratamento_atual']);
                                                $data_tratamento = implode("/", array_reverse(explode("-", $data_tratamento)));
                                                echo "<option value='$valor'>$nome - $data_tratamento</option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>

                                    </p> 



                                    <p>
                                        <label>Unidade de Supervis�o</label><br/>
                                        <?php
                                        $selectUn = "SELECT cod_unidade,nome, cidade FROM unidade WHERE atencao = 0 or atencao = 2 ORDER BY cidade, nome";
                                            $queryUn= $db->selectQuery($selectUn);
                                            if ($queryUn) {
                                                echo "<select name='cod_unidade'>";
                                                echo "<option value = ''</option>";
                                                 foreach ($queryUn as $un) {
                                                    $valor = $un['cod_unidade'];
                                                    $nome = ucwords($un['nome']);
                                                    $municipio = ucwords($un['cidade']);
                                                    echo "<option value='$valor'>$municipio - $nome</option>";
                                                }
                                                echo "</select>";
                                            }
                                        ?>

                                    </p>

                                    <p>
                                        <label>Profissional: (*)</label><br/>
                                        <?php
                                         $select2 = "SELECT cod_profissional, nome FROM profissional ORDER BY nome";
                                        $query2= $db->selectQuery($select2);
                                        if ($query2) {
                                            echo "<select name='cod_profissional' class='required'>";
                                            echo "<option value=''></option>";
                                            foreach ($query2 as $prof) {
                                                $valor2 = $prof['cod_profissional'];
                                                $prof = ucwords($prof['nome']);
                                               
                                                echo "<option value='$valor2'>$prof </option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                    </p>


                                    <!-- 111111111111************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 22222222222************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento2" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento2"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 3333333333************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento3" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento3"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 44444444************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento4" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento4"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 55555555555************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento5" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento5"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 666666666666666************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento6" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento6"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 777777777************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento7" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento7"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 8888************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento8" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento8"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 99999************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento9" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">N�o Tomou</option> 
                                                    <option value="O">Outro</option>

                                                </select>				
                                            </p>
                                        </div>
                                    

                                    <div  style="width: 50%; float:left">
                                        <p>
                                            <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                            <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento9"/>
                                        </p> 
                                    </div>
                            </div>
                            <!-- 10 10 10************************************************** -->
                            <div style="width: 100%; height:100px;">

                                <div  style="width: 50%; float:left">

                                    <p>
                                        <label>Comparecimento: (*)</label><br/>
                                        <select name="comparecimento10" class="required"> 
                                            <option></option>
                                            <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                            <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                            <option value="AA">Autoadministrado</option> 
                                            <option value="N">N�o Tomou</option> 
                                            <option value="O">Outro</option>

                                        </select>				
                                    </p>

                                </div>


                                <div  style="width: 50%; float:left">

                                    <p>
                                        <label>Data supervis�o(dd/mm/aaaa) (*): </label><br/>
                                        <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento10"/>
                                    </p> 
                                </div>
                            </div>
                            
                            <p>

                                <label>Observa��es: </label><br/>                                       
                                <textarea name="observacoes" class="" rows="5" cols="70"></textarea> 

                            </p>



                            <p>
                                <button class="classy" type="submit"><span>Salvar</span></button>

                            </p>
                            </form>
                            <!-- form elements [end] -->



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
