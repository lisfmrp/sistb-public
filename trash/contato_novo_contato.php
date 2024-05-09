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
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Novo Contato ::</span></span></span></h3>
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
                                <form method="post" class="validar" action="insere_contato.php">
                                    <?php                            
                                    
                                    $data_atual = date("d/m/Y");
                                    ?>

                                    <p>
                                        <label>Campos com (*) são obrigatórios!</label><br/>
                                    </p>


                                    <p>
                                        <label>Nome do paciente: (*)</label><br/>
                                        <?php
                                        if (isset($conteudo[2])) {

                                            $cod_paciente = $conteudo[2];
                                            $select = "SELECT cod_paciente,nome, mae FROM paciente WHERE cod_paciente = '$cod_paciente' ORDER BY nome";
                                            //$query = @mysql_query($select) or die(mysql_error());
                                            $queryPacientes = $db->selectQuery($select);
											
                                            echo "<select name='cod_paciente' class='required'>";
                                            foreach ($queryPacientes as $paciente) {
                                                $valor = $paciente['cod_paciente'];
                                                $nome = ucwords($paciente['nome']);
                                                $mae = ucwords($paciente['mae']);
                                                echo "<option value='$valor'>$nome / $mae</option>";
                                            }
                                            echo "</select>";
											
				                        } else {
                                            $select = "SELECT cod_paciente,nome, mae FROM paciente ORDER BY nome";


                                            $queryPacientes = $db->selectQuery($select);
											
                                            echo "<select name='cod_paciente' class='required'>";
											echo "<option value = ''</option>";
                                            foreach ($queryPacientes as $paciente) {
                                                $valor = $paciente['cod_paciente'];
                                                $nome = ucwords($paciente['nome']);
                                                $mae = ucwords($paciente['mae']);
                                                echo "<option value='$valor'>$nome / $mae</option>";
                                            }
                                                echo "</select>";
                                            }
                                        
                                        ?>
                                    </p>

                                    <p>
                                        <label>Nome do contato: (*)</label><br/>
                                        <input type="text" class="text small required" name="nome" /> 
                                    </p>


                                    <p>
                                        <label>Idade: (*)</label><br/>
                                        <input type="text" class="text small required" name="idade"/> 
                                    </p>

                                    <p>
                                        <label >Data de Nascimento (dd/mm/aaaa): (*)</label><br/>
                                        <input id="id8" type="text" class="text small data required" name="data_nascimento" />
                                    </p>

                                    <p>
                                        <label>Parentesco: (*)</label><br/>
                                        <input type="text" class="text small required" name="parentesco"/> 
                                    </p>

                                    <p>
                                        <label>Resultado baciloscopia:</label><br/>
                                        
                                        <select name="resultado_baciloscopia"> 
                                            <option selected ="" value="" ></option>
                                            <option value="1- Positivo">1- Positivo</option>
                                            <option value="2- Negativo">2- Negativo</option>
                                            <option value="3- Em andamento">3- Em andamento</option>
                                            <option value="8- Não realizado">8- Não realizado</option> 
                                            <option value="9- Sem informação">9- Sem informação</option>                          
                                        </select>
                                    </p>
                                    <p>
                                        <label>Data do Resultado (dd/mm/aaaa): </label><br/>
                                        <input type="text" class="text small data" name="data_baciloscopia"/>
                                    </p>  

                                    <p>
                                        <label>Resultado RX pulmão:</label><br/>
                                        
                                        <select name="resultado_rx_pulmao"> 
                                            <option selected ="" value="" ></option>
                                            <option value="1- Normal">1- Normal</option>
                                            <option value="2- Suspeita de TB">2- Suspeita de TB</option>
                                            <option value="3- Suspeita de TB com caverna">3- Suspeita de TB com caverna</option>
                                            <option value="4- Outras afecções">4- Outras afecções</option> 
                                            <option value="8- Não realizado">8- Não realizado</option>         
                                            <option value="9- Sem informação">9- Sem informação</option> 
                                        </select>
                                    </p>
                                    <p>
                                        <label>Data do Resultado (dd/mm/aaaa): </label><br/>
                                        <input type="text" class="text small data" name="data_rx_pulmao"/>
                                    </p>

                                    <p>
                                        <label>Resultado PPD (em mm):</label><br/>
                                        <input type="text" class="text small ppd" name="resultado_ppd"/>
                                        
                                    </p>
                                    <p>
                                        <label>Data do Resultado (dd/mm/aaaa): </label><br/>
                                        <input type="text" class="text small data" name="data_ppd"/>
                                    </p> 
                                    
                                    
                                    <p>
                                        <label>Coinfecção HIV/AIDS:</label><br/>
                                        <select name="coinfeccao"> 
                                            <option selected ="" value="" ></option>
                                            <option value="N">Não</option> 
                                            <option value="S">Sim</option>
                                        </select>				
                                    </p>
                                    
                                    <script>
                                        function verificaOpcao( value ){
                                            if( value == "S" || value == "A"){
                                                document.getElementById("labelquimio").style.display = "";
                                                document.getElementById("quimio").style.display = "";
                                                document.getElementById("labelquimiosaida").style.display = "";
                                                document.getElementById("quimiosaida").style.display = "";
                                             

                                            }else if(value != "S" || value == "A") {
                                                document.getElementById("labelquimio").style.display = "None";
                                                document.getElementById("quimio").style.display = "None";
                                                document.getElementById("labelquimiosaida").style.display = "None";
                                                document.getElementById("quimiosaida").style.display = "None";
                                            
                                            }
                                         }
                                           
                                        
                                    </script>
                                    
                                    <p>
                                        <label>Quimioprofilaxia:</label><br/>
                                        <select name="quimio" onChange="verificaOpcao(this.value)"> 
                                            <option selected ="" value="" ></option>
                                            <option value="N">Não</option> 
                                            <option value="S">Sim</option>
                                            <option value="A">Em andamento</option>
                                        </select>				
                                    </p> 
                                    <p>
                                        <label style="display:none" id="labelquimio">Data de início(dd/mm/aaaa): </label><br/>
                                        <input style="display:none" id="quimio" type="text" class="text small data" name="data_quimio"/>
                                    </p> 
                                    

                                    <p>
                                        <label>Data do retorno (dd/mm/aaaa): </label><br/>
                                        <input type="text" class="text small data" name="data_retorno"/>
                                    </p> 

                                    <p>
                                         <label>Tipo de Saída:</label><br/>
                                        <select name="alta"> 
                                            <option selected ="" value="" ></option> 
                                            <option value="Encerramento da investigação">Encerramento da investigação</option>
                                            <option value="Encaminhado para tratamento de TB">Encaminhado para tratamento de TB</option>
                                            <option value="Abandono">Abandono</option>
                                            <option value="Óbito por outras causas">Óbito por outras causas</option>                 
                                            <option value="Transferência">Transferência</option>
                                            <option value="Mudança de diagnóstico">Mudança de diagnóstico</option> 
                                            <option value="Encaminhado para investigação">Encaminhado para investigação</option>  
                                        </select>
                                        
                                    </p>
                                    <p>
                                        <label style="display:none" id="labelquimiosaida">Data de saída(dd/mm/aaaa): </label><br/>
                                        <input style="display:none" id="quimiosaida" type="text" class="text small data" name="data_saida"/>
                                    </p>

                                    <p>
                                      <label>Observações:</label><br/>
                                      <textarea name="observacao_contato" class="" rows="5" cols="70" id="observacao_contato"></textarea> 
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
