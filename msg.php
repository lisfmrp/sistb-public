<?php
	$tipoMsg = $_GET["t"];
	$msg = base64_decode($_GET["m"]);	
?>
<div class="box box-header-black">
    <!--<h3 class="header"><span class="header-2"><span class="header-3"><span class="color"></span></span></span></h3>-->
    <div class="box box-gradient">		
		<div class="box-1">
			<div class="box-2">
				<div class="box-3">
					<?php if($tipoMsg == "ok") { ?>
					<p>
						<img src='images/icons/splashyIcons/gem_okay.png' alt='Sucesso'/>                                    
						<strong><?=$msg?></strong>
					</p>
					<?php } else if($tipoMsg == "erro") { ?>
					<p>
						<img src='images/icons/splashyIcons/error.png' alt='Erro'/>                                    
						<strong><?=$msg?></strong>
					</p>
					<?php } ?>
					<p>
						<?php if (isset($_GET["r"])) { ?>
							<a href='index.php?<?=base64_decode($_GET["r"])?>'>Continuar</a>
						<?php } else { ?>
							<a href='javascript:void(0)' onclick='window.history.back();'>Voltar</a>
						<?php } ?>
					</p>
				</div>
			</div>
		</div>
		<div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
	</div>
</div>