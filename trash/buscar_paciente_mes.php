<?php
/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);


?>
<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Busca de Paciente ::</span></span></span></h3>
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
                                <form method="get" action="index.php">
                               
                                    <p>
                                        <label>***OBSERVAÇÃO: preencher os campos com (*)!</label></br>
                                    </p>
                                    
                                    <p>
                                        <label>Nome do Paciente:</label><br/>
                                        <input type="text"  class="text small" name="busca" /> 
                                        
                                    </p>
                                    
                                      <p>
                                        <label>Mês da supervisão(*):</label><br/>
                                        <select name="busca2" class="required"> 
                                            <option selected =""value=""></option>
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
                                        <input type="hidden" name="acao" value="supervisionamento listar_mes">
                                    </p>
                                    
                                    <p>
                                        <label>Ano(*):</label><br/>
                                        <input type="text"  class="text small required" name="busca3" /> 
                                    </p>    
                                                                          
                                     
                                        
                                    <p>
                                        <button class="classy" type="submit"><span>Buscar</span></button>

                                    </p>

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