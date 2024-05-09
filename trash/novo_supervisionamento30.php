<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Novo Supervisionamento ::</span></span></span></h3>
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
                                <form method="post" class="validar" action="insere_supervisionamento30.php">

                                    <?php
                                    $con = mysql_connect("localhost", "tuberculose", "senha");
                                    if (!$con) {
                                        die('Could not connect: ' . mysql_error());
                                    }

                                    mysql_select_db("tuberculose", $con);
                                    //$cod_paciente = $conteudo[2];
                                    ?>

                                    <?php
                                    date_default_timezone_set('America/Sao_Paulo');
                                    $data_atual = date("d/m/Y");
                                    ?>

                                    <p>
                                        <label>Campos com (*) são obrigatórios!</label><br/>
                                    </p>

                                    <p>
                                        <label>Nome do paciente (Em tratamento)/ Data do início do tratamento(*)</label><br/>

                                        <?php
                                        $select = "SELECT tratamento.cod_paciente,paciente.nome, tratamento.cod_tratamento, data_tratamento_atual
                                                       FROM tratamento,paciente WHERE tratamento.cod_paciente = paciente.cod_paciente
                                                       AND tratamento.encerrado = 0 ORDER BY paciente.nome";
                                        $query = @mysql_query($select) or die(mysql_error());
                                        if ($query) {
                                            echo "<select name='cod_paciente' class='required' id='pac1' >";

                                            echo "<option value = ''</option>";
                                            while ($l = mysql_fetch_array($query)) {
                                                $valor = ucfirst($l[0]);
                                                $nome = ucfirst($l[1]);
                                                $cod_tratamento = ucfirst($l[2]);
                                                $data_tratamento = ucfirst($l[3]);
                                                $data_tratamento = implode("/", array_reverse(explode("-", $data_tratamento)));
                                                echo "<option value='$valor'>$nome - $data_tratamento</option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>

                                    </p> 



                                    <p>
                                        <label>Unidade do supervisionamento</label><br/>
                                        <?php
                                        $select = "SELECT cod_unidade,nome, cidade FROM unidade WHERE atencao = 0  or atencao = 2 ORDER BY cidade, nome";
                                        $query = @mysql_query($select) or die(mysql_error());
                                        if ($query) {
                                            echo "<select name='cod_unidade'>";
                                            echo "<option value = ''</option>";
                                            while ($l = mysql_fetch_array($query)) {
                                                $valor = ucfirst($l[0]);
                                                $nome = ucfirst($l[1]);
                                                $municipio = ucfirst($l[2]);
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


                                        $query2 = @mysql_query($select2) or die(mysql_error());
                                        if ($query2) {
                                            echo "<select name='cod_profissional' class='required'>";
                                            echo "<option value=''></option>";
                                            while ($l = mysql_fetch_array($query2)) {
                                                $valor2 = ucfirst($l[0]);
                                                $prof = ucfirst($l[1]);

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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
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
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento10"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 11 11 11 11************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento11" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento11"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 12 12 12************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento12" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento12"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 13 13 13 13************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento13" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento13"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 14 14 14************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento14" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">


                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento14"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 15 15 15 ************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento15" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">




                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento15"/>
                                            </p> 


                                        </div>
                                    </div>

                                    <!-- 111111111111************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento16" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento16"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 22222222222************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento17" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento17"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 3333333333************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento18" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento18"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 44444444************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento19" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento19"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 55555555555************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento20" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento20"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 666666666666666************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento21" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento21"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 777777777************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento22" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento22"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 8888************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento23" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento23"/>
                                            </p> 

                                        </div>
                                    </div>
                                    <!-- 99999************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento24" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento24"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 10 10 10************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento25" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento25"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 11 11 11 11************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento26" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento26"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 12 12 12************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento27" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">

                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento27"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 13 13 13 13************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento28" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>


                                        </div>


                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento28"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 14 14 14************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento29" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>

                                        </div>


                                        <div  style="width: 50%; float:left">


                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento29"/>
                                            </p> 
                                        </div>
                                    </div>
                                    <!-- 15 15 15 ************************************************** -->
                                    <div style="width: 100%; height:100px;">

                                        <div  style="width: 50%; float:left">
                                            <p>
                                                <label>Comparecimento: (*)</label><br/>
                                                <select name="comparecimento30" class="required"> 
                                                    <option></option>
                                                    <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                                    <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                                    <option value="AA">Autoadministrado</option> 
                                                    <option value="N">Não Tomou</option> 

                                                </select>				
                                            </p>
                                        </div>


                                        <div  style="width: 50%; float:left">




                                            <p>
                                                <label>Data supervisionamento(dd/mm/aaaa) (*): </label><br/>
                                                <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento30"/>
                                            </p> 


                                        </div>
                                    </div>



                                    <p>

                                        <label>Observações: </label><br/>                                       
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
