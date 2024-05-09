<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Boletim de Acompanhamento ::</span></span></span></h3>
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
									<input type="hidden" name="acao" value="tratamento_listar_boletim_acompanhamento">                     
                                    <p>
                                        <label for="busca">Tipo de unidade:<span style="color:red;">*</span></label><br/>
                                        <select name="busca" id="busca" class="required">  
                                            <option value="1">Atendimento</option>
                                            <option value="2">Supervisão</option>
                                        </select>				
                                    </p> 
                                    <p>
                                        <label id="busca2"><b>Nome da unidade:<span style="color:red;">*</span></b></label><br/>
                                        <?php
											$selectun = "SELECT cod_unidade, nome, cidade from unidade ORDER BY nome";
											$queryUn = $db->selectQuery($selectun);
											if ($queryUn) {
												echo "<select name='busca2' id='busca2' class='required js-example-basic-single' style='width:650px;'>";
												foreach ($queryUn as $un) {
													echo "<option value='".$un['cod_unidade']."'>".(strtoupper($un['cidade']))." - ".(strtoupper(($un['nome'])))."</option>";
												}
												echo "</select>";
											}
										?>
                                    </p>
									<p>
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