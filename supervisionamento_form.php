<?php 
require_once("autenticacao.php");
if ($_SESSION["escrita"] == 1) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Nova Supervisão ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <form method="POST" class="validar" action="supervisionamento_post.php">
                                    <p>
										<label>Campos com <span style="color:red;">*</span> são obrigatórios!</label>
                                    </p>
                                    <p>
                                        <label for="paciente_tratamento">Nome do Paciente (em tratamento) / Data do início do tratamento<span style="color:red;">*</span></label><br/>
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
                                            echo "<select name='paciente_tratamento' class='required js-example-basic-single' id='paciente_tratamento' style='width:650px;'>";
                                            echo "<option value=''></option>";
                                            foreach ($result as $paciente) {
                                                $data_tratamento = implode("/", array_reverse(explode("-", $paciente['data_tratamento_atual'])));
                                                echo "<option value='".$paciente['cod_paciente']."|".$paciente['cod_tratamento']."'>".(strtoupper($paciente['nome']))." - $data_tratamento</option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                    </p> 
                                    <p>
                                        <label for="cod_unidade">Unidade de supervisão<span style="color:red;">*</span></label><br/>
                                        <?php
                                            $sql = "SELECT cod_unidade,nome, cidade FROM unidade WHERE atencao = 0 or atencao = 2 ORDER BY cidade, nome";
                                            $result= $db->selectQuery($sql);
                                            if ($result) {
                                                $selected = "";
												echo "<select name='cod_unidade' class='required js-example-basic-single' id='cod_unidade'style='width:650px;'>";
                                                echo "<option value=''></option>";
                                                 foreach ($result as $un) {
                                                    if ($un['cod_unidade'] == $_SESSION['cod_unidade']) $selected = "selected";
                                                    echo "<option $selected value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper($un['nome']))."</option>";
                                                }
                                                echo "</select>";
                                            }
                                        ?>
                                    </p>
                                    <p>
                                        <label for="cod_profissional">Profissional:<span style="color:red;">*</span></label><br/>
                                        <?php
                                        $sql = "SELECT cod_profissional, nome FROM profissional ORDER BY nome";
                                        $result = $db->selectQuery($sql);
                                        if ($result) {
											$selected = "";
                                            echo "<select name='cod_profissional' class='required js-example-basic-single' id='cod_profissional' style='width:650px;'>";
                                            echo "<option value=''></option>";
                                            foreach ($result as $prof) {
                                                if ($prof['cod_profissional'] == $_SESSION['cod_profissional']) $selected = "selected";
												echo "<option $selected value='".$prof['cod_profissional']."'>".(strtoupper($prof['nome']))."</option>";
                                            }
                                            echo "</select>";
                                        }
                                        ?>
                                     </p>
									<h2>Supervisões</h2>
									<button type="button" onclick="adicionarSupervisao()" class="classy" style="height: 25px; margin-bottom:15px;">Adicionar outra supervisão</button>
                                    <div id="supervisoes">
										<div style="width: 100%; height:100px;" id="supervisao">
											<div  style="width: 50%; float:left">
												<p>
													<label for="">Comparecimento:<span style="color:red;">*</span></label><br/>
													<select name="comparecimento[]" required style='width:650px;'> 
														<option></option>
														<option value="SU">Tratamento Supervisionado na Unidade</option> 
														<option value="SVD">Tratamento Supervisionado em Visita Domiciliar</option> 
														<option value="AA">Autoadministrado</option> 
														<option value="N">Não Tomou</option> 
														<option value="O">Outro</option>
													</select>               
												</p>
											</div>
											<div style="width: 50%; float:left">
												<p class="data-supervisao">
													<label for="">Data da supervisão (dd/mm/aaaa)<span style="color:red;">*</span>: </label><br/>
													<input type="date" class="text small" required name="data_comparecimento[]"/>
												</p>
											</div>											
										</div>
									</div>
                                    <p>
                                        <label for="observacoes">Observações:</label><br/>                                       
                                        <textarea name="observacoes" id="observacoes" rows="5" cols="70"></textarea> 
                                    </p>
                                    <p>
                                        <button class="classy" type="submit"><span>Salvar</span></button>
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
<script type="text/javascript">
	function adicionarSupervisao() {
		let divSupervisao = $('#supervisao').clone();
		let idDivSupervisao = $('#supervisoes').children().length + 1;
		divSupervisao.attr("id","supervisao" + idDivSupervisao);
		divSupervisao.appendTo("#supervisoes");
		$("#supervisao"+idDivSupervisao+" .data-supervisao").append("<a href='javascript:void(0)' onclick='removerSupervisao("+idDivSupervisao+")'>[x]</a>");
	}
	
	function removerSupervisao(idDivSupervisao) {
		$("#supervisao"+idDivSupervisao).remove();
	}
</script>