<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Buscar Paciente ::</span></span></span></h3>
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
									<input type="hidden" name="acao" value="paciente_listar">
                                    <p>
                                        Para ver todos os pacientes, basta clicar no botão Buscar sem preencher os campos!
                                    </p>                                    
                                    <p>
                                        <label for="busca">Nome do Paciente:</label><br/>
                                        <input type="text"  class="text small" name="busca" id="busca"/>                                         
                                    </p>                                    
                                    <p>
                                        <label for="busca2">Nome da mãe do Paciente:</label><br/>
                                        <input type="text"  class="text small" name="busca2" id="busca2"/> 
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