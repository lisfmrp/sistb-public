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
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Cadastro de Paciente ::</span></span></span></h3>
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
                                <form method="post" class="validar" action="insere_paciente_arquivo.php">

                                    <p>
                                        <label>Campos com (*) são obrigatórios!</label><br/>
                                    </p>
                                
                                    
                                    <div style="width: 100%; height:100px;"> 
                                   
                                    
                                    
                                                                        <script>
                                        function verificaPro( value ){
                                            if( value == "Outro"){
                                                document.getElementById("labeloutro").style.display = "";
                                                document.getElementById("inputoutro").style.display = "";
                                                document.getElementById("inputoutro").disabled = false;
                                                
                                                document.getElementById("labelProntuario").style.display = "";
                                                document.getElementById("inputProntuario").style.display = "";
                                                document.getElementById("inputProntuario").disabled = false;
                                                
                                                document.getElementById("labelNascimento").style.display = "";
                                                document.getElementById("inputNascimento").style.display = "";
                                                document.getElementById("inputNascimento").disabled = false;
                                                
                                                document.getElementById("labelSexo").style.display = "";
                                                document.getElementById("inputSexo").style.display = "";

                                            }else if(value != "Outro") {
                                                document.getElementById("labeloutro").style.display = "None";
                                                document.getElementById("inputoutro").style.display = "None";
                                                document.getElementById("inputoutro").disabled = true;
                                                
                                                document.getElementById("labelProntuario").style.display = "None";
                                                document.getElementById("inputProntuario").style.display = "None";
                                                document.getElementById("inputProntuario").disabled = true;
                                                
                                                document.getElementById("labelNascimento").style.display = "None";
                                                document.getElementById("inputNascimento").style.display = "None";
                                                document.getElementById("inputNascimento").disabled = true;
                                                
                                                document.getElementById("labelSexo").style.display = "None";
                                                document.getElementById("inputSexo").style.display = "None";
                                                
                                            }
                                            
                                              
                                                
                                        }
                                           
                                    </script>
                                    
                                     <div  style="width: 30%; float:left">
                                        <label>Paciente / Data Nascimento / Prontuário: </label><br/>
                                        <?php
                                       
                                            $select2 = "SELECT cod_paciente, nome, data_nascimento, nro_prontuario FROM paciente ORDER BY nome";
                                        

                                        $queryPacientes = $db->selectQuery($select2);
										if ($queryPacientes) {
                                            echo "<select name='nome' class='required' onChange='verificaPro(this.value)'>";
                                            echo "<option value=''></option>";
                                            foreach ($queryPacientes as $paciente) {
                                                $valor2 = $paciente['cod_paciente'];
                                                $nome = ucwords($paciente['nome']);
                                                $data_nasc = ucwords($paciente['data_nascimento']);
                                                $nro = ucwords($paciente['nro_prontuario']);
                                                
                                                if ($data_nasc != NULL && $data_nasc != "0000-00-00") {
                                                    $data1 = implode("/", array_reverse(explode("-", $data_nasc)));
                                                } else if ($data_nasc == "0000-00-00" || $data == NULL) {
                                                    $data1 = "";
                                                }
                                               
                                                echo "<option value='$valor2'>$nome $data1 $nro  </option>";
                                            }
                                            echo "<option value = 'Outro'>Outro</option>";
                                            echo "</select>";
                                        }
                                        
                                        ?>
                                     </div>
                                    <div  style="width: 30%; float:left">

                                        <label id="labeloutro" style="display:none">Nome do Paciente (*):</label><br/>
                                        <input id="inputoutro" disabled style="display:none" type="text" class="text small"  name = "outro_paciente"/> 

                                    </div>
                                    </div>
                                                                   
                                    <p>
                                        <label id="labelProntuario" style="display:none">Número do Prontuário:</label><br/>
                                        <input id="inputProntuario" disabled style="display:none" type="text" class="text small" name="nro_prontuario" /> 
                                    </p>

                                    <p>
                                        <label id="labelNascimento" style="display:none">Data de Nascimento (dd/mm/aaaa):</label><br/>
                                        <input id="inputNascimento" disabled style="display:none"type="text" class="text small data" name="data_nascimento" /> 
                                    </p>
                                                                        
                                     <p>
                                        <label id="labelSexo" style="display:none">Sexo:</label><br/>
                                        <select id ="inputSexo" name="sexo" style="display:none" > 
                                            <option></option>
                                            <option value="M">Masculino</option> 
                                            <option value="F">Feminino</option> 
                                        </select>				
                                    </p>   
                                   
                                    
                                    <p>
                                        <label>Forma Clínica (*):</label><br/>
                                        <select name="fc1" class="required"> 
                                            <option selected ="" value="" ></option>
                                            <option value="Pulmonar">Pulmonar</option>
                                            <option value="Meningite">Meningite</option>
                                            <option value="Sistema Nervoso Central">Sistema Nervoso Central</option>
                                            <option value="Pericárdia">Pericardia</option>
                                            <option value="Genitourinária">Genitourinária</option>
                                            <option value="Ocular">Ocular</option>
                                            <option value="Otorrinolaringológica">Otorrinolaringológica</option>
                                            <option value="Mamária">Mamária</option>
                                            <option value="Nasal">Nasal</option>
                                            <option value="Laríngea">Laríngea</option>
                                            <option value="Pleural">Pleural</option>
                                            <option value="Glang. Periférica">Glang. Periférica</option> 
                                            <option value="Óssea">Óssea</option>                                            
                                             <option value="Vias Urinárias">Vias Urinárias</option>
                                            <option value="Genital">Genital</option>
                                            <option value="Intestinal">Intestinal</option>
                                            <option value="Oftalmica">Oftalmica</option> 
                                            <option value="Pele">Pele</option>                      
                                            <option value="Laringe">Laringe</option>
                                            <option value="Miliar">Miliar</option>
                                            <option value="Outras">Outras</option>
                                            <option value="Disseminada">Disseminada</option> 
                                            <option value="Sem informação">Sem informação</option>
                                        </select>
                                    </p>
                                    
                                    <p>
                                        <label>Data de início do tratamento(dd/mm/aaaa) (*): </label><br/>
                                        <input type="text" class="text small data required" value="<?= $data ?>" name = "data_inicio"/> 
                                    </p>     

                                    <p>
                                        <label>Data da alta(dd/mm/aaaa) (*): </label><br/>
                                        <input type="text" class="text small data required" value="<?= $data ?>" name = "data_alta"/> 
                                    </p>
                                    
                                     
                                    
                                     <script>
                                        function verificaOpcao5( value ){
                                            if( value != ""){
                                                document.getElementById("labelalta1").style.display = "";
                                                document.getElementById("alta1").style.display = "";
                                            
                                            }else if(value == "") {
                                                document.getElementById("labelalta1").style.display = "None";
                                                document.getElementById("alta1").style.display = "None";
                                            
                                            }   
                                        }
                                        
                                    </script>    
                                    <p>
                                        <label>Alta (*):</label><br/>
                                        <select name="alta" onChange="verificaOpcao5(this.value)" class="required"> 
                                            <option selected ="" value="" ></option>
                                            <option value="Cura">Cura</option>                 
                                            <option value="Abandono">Abandono</option>
                                            <option value="Óbito por TB">Óbito por TB</option>  
                                            <option value="Óbito por outras causas">Óbito por outras causas</option>                 
                                            <option value="Transferência">Transferência</option>
                                            <option value="Mudança de diagnóstico">Mudança de diagnóstico</option>  
                                        </select>
                                    </p>

                                    <p>
                                    <label>Unidade de Tratamento</label><br/>
                                        <?php
                                        
                                            
                                            $selectUn = "SELECT cod_unidade,nome, cidade FROM unidade ORDER BY cidade, nome";
                                             $queryUn= $db->selectQuery($selectUn);
                                            if ($queryUn) {
                                                echo "<select name='un_atendimento' >";
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
