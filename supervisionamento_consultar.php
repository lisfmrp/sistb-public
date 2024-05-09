<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Buscar Supervisões ::</span></span></span></h3>
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
								<?php if($_GET["tipo"] == "supervisoes" ) { ?>
									<input type="hidden" name="acao" value="supervisionamento_listar">
                                    <p>
                                        <label>Para ver todos registros, basta clicar no botão Buscar sem preencher os campos!</label></br>
                                    </p>                                  
                                    <p>
                                        <label for="busca">Nome do Paciente:</label><br/>
                                        <input type="text"  class="text small" name="busca" id="busca"/>                                                                                 
                                    </p>                                   
                                    <p>
                                        <label for="busca2">Status do tratamento:</label><br/>
                                        <select name="busca2" id=="busca2"> 
                                            <option value="" ></option>
                                            <option value="1">Encerrado</option>
                                            <option value="0">Em Andamento</option>
                                        </select>
                                    </p>
								<?php } else if($_GET["tipo"] == "relatorio" ) { ?>
									<input type="hidden" name="acao" value="supervisionamento_relatorio_mensal">
								<?php } ?>
								
								<?php if($_GET["tipo"] == "supervisoes" || $_GET["tipo"] == "relatorio") { ?>
                                    <p>
                                        <label for="busca3">Mês da supervisão:</label><br/>
                                        <select name="busca3" class="" required id="busca3">                                        
                                            <option value=""></option>
											<option value="1">Janeiro</option>
                                            <option value="2">Fevereiro</option> 
                                            <option value="3">Março</option>
                                            <option value="4">Abril</option> 
                                            <option value="5">Maio</option> 
                                            <option value="6">Junho</option> 
                                            <option value="7">Julho</option> 
                                            <option value="8">Agosto</option> 
                                            <option value="9">Setembro</option> 
                                            <option value="10">Outubro</option> 
                                            <option value="11">Novembro</option>
                                            <option value="12">Dezembro</option>                                     
                                        </select>	
                                    </p>                                  
                                    <p>
                                        <label for="busca4">Ano:</label><br/>
                                        <input type="number" class="text small" required name="busca4" id="busca4"/> 
                                    </p>  									
                                    <p>                                      
                                        <button class="classy" type="submit"><span>Buscar</span></button>
                                    </p>
								<?php } ?>
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