<?php 
require_once("autenticacao.php");
if ($_SESSION["escrita"] == 1) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Excluir Supervisão ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <form method="POST" class="validar" action="supervisionamento_excluir_post.php">
                                    <p>
                                        <label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
                                    </p>
                                    <p>
                                        <label for="cod_paciente">Nome do Paciente (em tratamento)/ Data do início do tratamento<span style="color:red;">*</span></label><br/>                                     
                                        <?php
										$filter = "";
                                        if($_SESSION["admin"] == 0) $filter = " AND tratamento.un_supervisao = '$_SESSION[cod_unidade]'";
										$sql = "SELECT tratamento.cod_paciente,paciente.nome, tratamento.cod_tratamento, data_tratamento_atual
                                                       FROM tratamento, paciente 
													WHERE tratamento.cod_paciente = paciente.cod_paciente
																AND tratamento.encerrado = 0 
																$filter
													ORDER BY paciente.nome";
                                        $result = $db->selectQuery($sql);
                                        if ($result) {
                                            echo "<select name='cod_paciente' class='required js-example-basic-single' id='cod_paciente' style='width:650px;'>";
                                            echo "<option value=''></option>";
                                            foreach ($result as $paciente) {
                                                $data_tratamento = implode("/", array_reverse(explode("-", $paciente['data_tratamento_atual'])));
                                                echo "<option value='".$paciente['cod_paciente']."'>".(strtoupper($paciente['nome']))." - $data_tratamento</option>";
                                            }
                                            echo "</select>";
                                        }                                 
                                        ?>
                                  </p> 
                                  <p>
                                        <label for="comparecimento">Comparecimento:<span style="color:red;">*</span></label><br/>
                                        <select name="comparecimento" id="comparecimento" class="required"> 
                                            <option></option>
                                            <option value="SU">Tratamento Supervisionado na Unidade</option> 
                                            <option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
                                            <option value="AA">Autoadministrado</option> 
                                            <option value="N">Não Tomou</option> 
                                            <option value="O">Outro</option>
                                        </select>				
                                    </p>
                                    <p>
                                        <label for="data_comparecimento">Data da supervisão (dd/mm/aaaa):<span style="color:red;">*</span></label><br/>
                                        <input type="text" class="text small data required" value="<?= $data_atual ?>" name="data_comparecimento" id="data_comparecimento"/>
                                    </p>                                     
                                    <p>
                                      <button  class="classy" onclick="return confirm('Tem certeza que deseja excluir essa supervisão?');"><span>Excluir</span></button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<?php } else { ?>
		<p>
			<img src='images/icons/splashyIcons/error.png' alt='Acesso restrito'/>                                    
			<strong>Acesso restrito</strong>
		</p>
<?php } ?>