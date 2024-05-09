<?php
/* Verifica se o usuário está logado */
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
?>
<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Seja Bem Vindo ao Sistema da Tuberculose - SisTb ::</span></span></span></h3>
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
                                
                                <p style="font-weight:bold; font-size:16px; text-align:justify; line-height:25px;">O SisTb é um sistema de informação para controle de pacientes em tratamento supervisionado da tuberculose, para amparar os profissionais envolvidos nesse processo, 
								possibilitando o acesso e monitoramento de dados com maior facilidade, rapidez, eficiência e diminuindo a possibilidade de perda de dados.</p>
                                
                                
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