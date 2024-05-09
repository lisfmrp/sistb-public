<?php 
require_once("autenticacao.php"); 
if ($_SESSION["admin"] == 1) {
?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Buscar Profissional ::</span></span></span></h3>
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
                                        Para ver todos os profissionais, basta clicar no botao Buscar sem preencher os campos!
                                    </p>                             
                                    <p>
                                        <label>Nome ou login do Profissional:</label><br/>
                                        <input type="text"  class="text small" name="busca" />                                     
                                        <input type="hidden" name="acao" value="profissional_listar">
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
<?php } else { ?>
		<p>
			<img src='images/icons/splashyIcons/error.png' alt='Acesso restrito'/>                                    
			<strong>Acesso restrito</strong>
		</p>
<?php } ?>