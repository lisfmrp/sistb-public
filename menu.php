<div class="mainmenu">
    <ul class="tabs">
        <li class=""><div class="main"><a href="#"><img src="images/icons/flavour/paciente.png"/><span>Paciente</span></a></div></li>
        <li><div class="main"><a href="#"><img src="images/icons/flavour/tratamento.png"/><span>Tratamento</span></a></div></li>
        <li><div class="main"><a href="#"><img src="images/icons/flavour/user_group.png"/><span>Contato</span></a></div></li>      
        <li><div class="main"><a href="#"><img src="images/icons/flavour/chart_pie.png"/><span>Controle Mensal</span></a></div></li>      
        <li><div class="main"><a href="#"><img src="images/icons/flavour/hospital.png"/><span>Internação</span></a></div></li>
        <li><div class="main"><a href="#"><img src="images/icons/flavour/calendar.png"/><span>Supervisão</span></a></div></li>
		<li><div class="main"><a href="#"><img src="images/icons/flavour/doctor.png"/><span>Profissional</span></a></div></li>
        <?php if($_SESSION["admin"] == 1) { ?> <li><div class="main"><a href="#"><img src="images/icons/flavour/health_unity.png"/><span>Unidade</span></a></div></li><?php } ?>
        <li><div class="main"><a href="#"><img src="images/icons/flavour/applications.png"/><span>Outras Opções</span></a></div></li>
		<!--<li><div class="main"><a href="#"><img src="images/icons/flavour/file.png"/><span>Arquivo</span></a></div></li>-->
    </ul>
    <div class="clearingfix"></div>
    <div class="box">
        <ul class="submenu">
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=paciente_form"><img src="images/icons/splashyIcons/contact_blue_add.png"/><span>Novo Paciente</span></a></li>
            <?php } ?>
			<li><a href="index.php?acao=paciente_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Paciente</span></a></li>
            <!--<li><a href="index.php?acao=paciente+exportar"><img src="images/icons/splashyIcons/contact_blue_edit.png"/><span>Exportar</span></a></li>
			<li><a href="index.php?acao=paciente+abrir"><img src="images/icons/splashyIcons/contact_blue_edit.png"/><span>Enviar arquivo</span></a></li>
            <li><a href="index.php?acao=paciente+importarS"><img src="images/icons/splashyIcons/contact_blue_edit.png"/><span>Importar dados do arquivo</span></a></li>
			<li><a href="index.php?acao=paciente+importarP"><img src="images/icons/splashyIcons/contact_blue_edit.png"/><span>Importar dados do Paciente</span></a></li>-->
        </ul>
    </div>
    <div class="box">
        <ul class="submenu">	
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=tratamento_form"><img src="images/icons/splashyIcons/document_a4_add.png"/><span>Novo Tratamento</span></a></li>
            <?php } ?>
			<li><a href="index.php?acao=tratamento_consultar&tipo=tratamento"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Tratamento</span></a></li>
            <li><a href="index.php?acao=tratamento_consultar_boletim_acompanhamento"><img src="images/icons/splashyIcons/search.png"/><span>Boletim de acompanhamento dos pacientes</span></a></li>
            <li><a href="index.php?acao=tratamento_consultar&tipo=ficha_completa"><img src="images/icons/splashyIcons/search.png"/><span>Consultar dados completos do tratamento</span></a></li>  			
			<!--<li><a href="index.php?acao=tratamento+relatorio1"><img src="images/icons/splashyIcons/search.png"/><span>Relatorio por ano de tratamento</span></a></li>
            <li><a href="index.php?acao=tratamento+relexame"><img src="images/icons/splashyIcons/search.png"/><span>Ficha de acompanhamento dos pacientes</span></a></li>-->
		</ul>
    </div>
    <div class="box">
        <ul class="submenu">
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=contato_form"><img src="images/icons/splashyIcons/group_grey_add.png"/><span>Novo Contato</span></a></li>      
            <?php } ?>
			<li><a href="index.php?acao=contato_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Contato</span></a></li>
            <li><a href="index.php?acao=paciente_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Relatório de Contato</span></a></li>
        </ul>
    </div>
    <div class="box">
        <ul class="submenu">
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=controle_form"><img src="images/icons/splashyIcons/calendar_month_add.png"/><span>Novo Controle Mensal</span></a></li>
            <?php } ?>
			<li><a href="index.php?acao=controle_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Controle Mensal</span></a></li>       
        </ul>
    </div>
     <div class="box">
        <ul class="submenu">
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=internacao_form"><img src="images/icons/splashyIcons/calendar_month_add.png"/><span>Cadastrar Dados de Internação</span></a></li>
            <?php } ?>
			<li><a href="index.php?acao=internacao_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Internações</span></a></li>
        </ul>
    </div>
	<div class="box">
        <ul class="submenu">
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=supervisionamento_form"><img src="images/icons/splashyIcons/calendar_day_add.png"/><span>Nova Supervisão</span></a></li>
            <?php } ?>
			<li><a href="index.php?acao=supervisionamento_consultar&tipo=supervisoes"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Supervisões</span></a></li>
			<li><a href="index.php?acao=supervisionamento_consultar&tipo=relatorio"><img src="images/icons/splashyIcons/search.png"/><span>Relatório de Supervisões por mês</span></a></li>
            <?php if($_SESSION["escrita"] == 1) { ?>
			<li><a href="index.php?acao=supervisionamento_excluir"><img src="images/icons/splashyIcons/calendar_day_remove.png"/><span>Excluir Supervisão</span></a></li>
			<?php } ?>
        </ul>
    </div>
    <div class="box">
        <ul class="submenu">
            <?php if($_SESSION["admin"] == 1) { ?>
			<li><a href="index.php?acao=profissional_form"><img src="images/icons/splashyIcons/hcard_add.png"/><span>Novo Profissional</span></a></li>
			<li><a href="index.php?acao=profissional_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Profissional</span></a></li>
			<?php } ?>										    
			<li><a href="index.php?acao=profissional_form&cod_profissional=<?=$_SESSION["cod_profissional"]?>"><img src="images/icons/splashyIcons/contact_blue_edit.png"/><span>Meus dados</span></a></li>
        </ul>
    </div>
	<?php if($_SESSION["admin"] == 1) { ?>
    <div class="box">
        <ul class="submenu">			
            <li><a href="index.php?acao=unidade_form"><img src="images/icons/splashyIcons/box_add.png"/><span>Nova Unidade</span></a></li>
            <li><a href="index.php?acao=unidade_consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Unidade</span></a></li>          
        </ul>
    </div>
	<?php } ?>    
	<div class="box">
        <ul class="submenu">	            
			<li><a href="index.php?acao=indicadores_consultar"><img src="images/icons/splashyIcons/information.png"/><span>Indicadores</span></a></li>
			<li><a href="index.php?acao=ferramentas_tb"><img src="images/icons/splashyIcons/check.png"/><span>Ferramentas para TB</span></a></li>
		</ul>
    </div>
    <!--<div class="box">
        <ul class="submenu">
            <li><a href="index.php?acao=arquivo+cadastrar"><img src="images/icons/splashyIcons/documents_add.png"/><span>Novo Arquivo de Paciente</span></a></li>
            <li><a href="index.php?acao=arquivo+consultar"><img src="images/icons/splashyIcons/search.png"/><span>Consultar Paciente do Arquivo</span></a></li>            
        </ul>
    </div>-->
</div>
<div class="clearingfix"></div>