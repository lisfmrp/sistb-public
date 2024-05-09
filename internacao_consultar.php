<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Buscar Internação ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <form method="POST" action="index.php">                                  
                                    <p>
                                        <label>Para ver todas as internações, basta clicar no botão Buscar sem preencher os campos!</label></br>
                                    </p>
                                    <p>
                                        <label for="busca">Nome do Paciente:</label><br/>
                                        <input type="text"  class="text small" name="busca" id="busca"/>                                       
                                        <input type="hidden" name="acao" value="internacao_listar">
                                    </p>    
                                    <p>
                                        <label for="busca2">Motivo da internação:</label><br/>
                                        <select name="busca2" id="busca2" class="js-example-basic-single"> 
                                            <option value="" ></option>
											<?php
												$sql = "SELECT * FROM internacao_motivo;";
												$motivos = $db->selectQuery($sql);
												foreach($motivos as $m) {
													echo "<option value='".$m["cod_motivo_internacao"]."'>".($m["motivo"])."</option>";
												}
											?>
                                        </select>				
                                    </p> 
									<p>
                                        <label id="busca3"><b>Local da internação</b></label><br/>                                     
										<?php
                                                $selectun = "SELECT cod_unidade, nome from unidade ORDER BY nome";
                                                $queryUn= $db->selectQuery($selectun);
												if ($queryUn) {
                                                    echo "<select name='busca3' id='busca3' class='js-example-basic-single'>";
                                                    echo "<option value=''></option>";
                                                    foreach ($queryUn as $un) {
														echo "<option value='$un[cod_unidade]'>".(strtoupper($un['nome']))."</option>";
                                                    }
                                                    echo "</select>";
                                                }
                                                ?>
                                    </p>                                  
                                        <button class="classy" type="submit"><span>Buscar</span></button>
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