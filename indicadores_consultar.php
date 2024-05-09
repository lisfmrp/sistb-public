<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Indicadores ::</span></span></span></h3>
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
									<input type="hidden" name="acao" value="indicadores">
                                    <p>
                                        <label for="tipo_indicador">Indicador:<span style="color:red;">*</span></label><br/>
                                        <select name="tipo_indicador" id="tipo_indicador" class="required" style="width:650px;"> 
                                            <option value="1">Proporção  de Casos de Tuberculose Testados para HIV</option>
                                            <option value="2">Proporção de Coinfecção TB/ HIV</option>
                                            <option value="3">Proporção de Casos de Tuberculose com HIV em Andamento</option>
                                            <option value="4">Proporção de Casos de Tuberculose Curados</option>
                                            <option value="5">Proporção de Casos de Tuberculose que Abandonaram o Tratamento</option>
                                            <option value="6">Proporção de Casos de Tuberculose com Encerramento Óbito</option>
                                            <option value="7">Proporção de Casos de Tuberculose que Realizaram Tratamento Diretamento Observado</option>
                                            <option value="8">Proporção de Retratamento que Realizaram o Exame de Cultura</option>
                                            <option value="9">Proporção de Casos de Retratamento de Tuberculose</option>
                                        </select>				
                                    </p>     
                                    <p>
                                        <label>Período<span style="color:red;">*</span></label>
									</p>
									<p>
										<label>De:</label><br/>
										<select name="busca_de_mes" class="required"> 
                                            <option value="01">Janeiro</option>
                                            <option value="02">Fevereiro</option>
                                            <option value="03">Março</option> 
                                            <option value="04">Abril</option>
                                            <option value="05">Maio</option>
                                            <option value="06">Junho</option> 
                                            <option value="07">Julho</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setembro</option> 
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option> 
                                        </select>
										<input type="number" class="text small" required name="busca_de_ano" placeholder="Ano" style="margin-top:-6px;"/>
									</p>
                                    <p>    
                                        <label>Até:</label><br/>
										<select name="busca_ate_mes" class="required"> 
                                            <option value="01">Janeiro</option>
                                            <option value="02">Fevereiro</option>
                                            <option value="03">Março</option> 
                                            <option value="04">Abril</option>
                                            <option value="05">Maio</option>
                                            <option value="06">Junho</option> 
                                            <option value="07">Julho</option>
                                            <option value="08">Agosto</option>
                                            <option value="09">Setembro</option> 
                                            <option value="10">Outubro</option>
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option> 
										</select>
                                        <input type="number" class="text small" required name="busca_ate_ano" placeholder="Ano"  style="margin-top:-6px;"/> <br/>
                                    </p>                                   
                                        <button class="classy" type="submit"><span>Calcular indicador</span></button>
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