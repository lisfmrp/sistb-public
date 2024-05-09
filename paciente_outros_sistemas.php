<?php require_once("autenticacao.php"); ?>
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Dados do paciente - Outros Sistemas ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
		<?php 
			if (isset($_GET["cod_paciente"]) && $_GET["cod_paciente"] != "" && is_numeric($_GET["cod_paciente"])) { 
				$cod_paciente = $_GET["cod_paciente"];
				$sql = "SELECT nome, data_nascimento, sinan, mae, cns FROM paciente WHERE cod_paciente = $cod_paciente";
				$infos = $db->selectQuery($sql);     
				if(sizeof($infos) == 0) {
			?> 		<script type="text/javascript">window.location.replace("index.php");</script>
			<?php 
					exit();
				}
				
				$cns = $infos[0]['cns'];									
				$nome = ($infos[0]['nome']);
				$data_nasc = $infos[0]['data_nascimento'];
				$mae = ($infos[0]['mae']);
				$sinan = $infos[0]['sinan'];
		
		?>
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                             <!-- TB WEB, SINAN, SITE-TB, GAL -->							 
							 <div style="width: 100%; height:100px;">     
								<!-- TB WEB -->
								<div  style="width: 25%; float:left">
									<h2 class="title">TBWeb</h2>
								<?php
									$dados = array();
									$sql = "SELECT * FROM dados_tb.tbweb WHERE (Nome LIKE '%$nome%' AND Data_Nascimento = '$data_nasc') OR SINAN = '$sinan'";
									$dados = $dbAzure->selectQuery($sql); 
									
									if(sizeof($dados) == 0) {
										echo "Nenhum registro encontrado";
									} else {
										foreach($dados[0] as $key => $value) {
											echo "<strong>$key:</strong> $value<br/>";
										}
									}									
								?>
								</div>
								<!-- SINAN -->
								<div  style="width: 25%; float:left">
									<h2 class="title">SINAN</h2>
								<?php
									$dados = array();
									/*$sql = "SELECT * FROM dados_tb.";
									$dados = $dbAzure->selectQuery($sql); */
									
									if(sizeof($dados) == 0) {
										echo "Nenhum registro encontrado";
									} else {
										foreach($dados[0] as $key => $value) {
											echo "<strong>$key:</strong> $value<br/>";
										}
									}									
								?>	
								</div>
								<!-- SITETB -->
								<div  style="width: 25%; float:left">
									<h2 class="title">SITETB</h2>
								<?php
									$dados = array();
									$sql = "SELECT * FROM dados_tb.sitetb_2000_ago2019 WHERE (Nome_Paciente LIKE '%$nome%' AND Nome_Mae LIKE '%$mae%' AND Data_Nascimento = '$data_nasc') OR SINAN = '$sinan' OR CNS = '$cns'";
									$dados = $dbAzure->selectQuery($sql); 
									
									if(sizeof($dados) == 0) {
										echo "Nenhum registro encontrado";
									} else {
										foreach($dados[0] as $key => $value) {
											echo "<strong>$key:</strong> $value<br/>";
										}
									}									
								?>
								</div>
								<!-- GAL -->
								<div  style="width: 25%; float:left">
									<h2 class="title">GAL</h2>
								<?php
									$dados = array();
									$sql = "SELECT * FROM dados_tb.gal_01_ago_2010_01_mai_2017 WHERE (Nome_Paciente LIKE '%$nome%' AND Nome_Mae LIKE '%$mae%' AND Data_Nascimento = '$data_nasc') OR CNS_Paciente = '$cns'";
									$dados = $dbAzure->selectQuery($sql); 
									
									if(sizeof($dados) == 0) {
										echo "Nenhum registro encontrado";
									} else {
										foreach($dados[0] as $key => $value) {
											echo "<strong>$key:</strong> $value<br/>";
										}
									}									
								?>
								</div>
							 </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
		<?php } ?>
            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>