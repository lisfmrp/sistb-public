<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <title>Sistema da Tuberculose - SISTB - v1.5</title>
        <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" media="screen" />
		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		<link rel="icon" href="images/favicon.ico" sizes="16x16" />
        <!--<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>-->
		<script src="https://code.jquery.com/jquery-1.7.2.min.js" integrity="sha256-R7aNzoy2gFrVs+pNJ6+SokH04ppcEqJ0yFLkNGoFALQ=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.calendar.js"></script>
        <script type="text/javascript" src="js/jquery.flot.min.js"></script>
        <script type="text/javascript" src="js/jquery.ba-resize.min.js"></script>
        <script type="text/javascript" src="js/jquery.wysiwyg.js"></script> 
        <script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"></script>		
        <script type="text/javascript" src="js/RGraph.common.core.js"></script>
        <script type="text/javascript" src="js/RGraph.common.annotate.js"></script> 
        <script type="text/javascript" src="js/RGraph.common.context.js"></script>   
        <script type="text/javascript" src="js/RGraph.common.effects.js"></script>   
        <script type="text/javascript" src="js/RGraph.common.key.js"></script>       
        <script type="text/javascript" src="js/RGraph.common.resizing.js"></script>  
        <script type="text/javascript" src="js/RGraph.common.tooltips.js"></script>  
        <script type="text/javascript" src="js/RGraph.common.zoom.js"></script>      
        <script type="text/javascript" src="js/RGraph.bar.js"></script>            
        <script type="text/javascript" src="js/RGraph.bipolar.js"></script>       
        <script type="text/javascript" src="js/RGraph.fuel.js"></script>            
        <script type="text/javascript" src="js/RGraph.funnel.js"></script>           
        <script type="text/javascript" src="js/RGraph.gantt.js"></script>          
        <script type="text/javascript" src="js/RGraph.gauge.js"></script>           
        <script type="text/javascript" src="js/RGraph.hbar.js"></script>             
        <script type="text/javascript" src="js/RGraph.hprogress.js"></script>      
        <script type="text/javascript" src="js/RGraph.led.js"></script>            
        <script type="text/javascript" src="js/RGraph.line.js"></script>             
        <script type="text/javascript" src="js/RGraph.meter.js"></script>            
        <script type="text/javascript" src="js/RGraph.odo.js"></script>              
        <script type="text/javascript" src="js/RGraph.pie.js"></script>              
        <script type="text/javascript" src="js/RGraph.radar.js"></script>            
        <script type="text/javascript" src="js/RGraph.rose.js"></script>             
        <script type="text/javascript" src="js/RGraph.rscatter.js"></script>         
        <script type="text/javascript" src="js/RGraph.scatter.js"></script>         
        <script type="text/javascript" src="js/RGraph.thermometer.js"></script>      
        <script type="text/javascript" src="js/RGraph.vprogress.js"></script>        
        <script type="text/javascript" src="js/RGraph.waterfall.js"></script>        
        <script type="text/javascript" src="js/jquery.validate.min.js"></script> 
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
				$('.js-example-basic-single').select2();
				$(".telefone").mask("(99) 9999-9999");
                $(".cpf").mask("999.999.999-99");
                $(".cep").mask("99999-999");
                $(".data").mask("99/99/9999");
                $(".hora").mask("99:99");
                $(".cid10").mask("a99?.9");
                $(".cns").mask("999999?999999999");
                $(".nome").mask("?");
                $(".data2").mask("99/99/9999 99:99:00"); 				
                $(".validar").validate({
					  highlight: function(element) {
						$(element).css('background-color', '#fee').css('border-color', '#fbb');
					  },
					  unhighlight: function(element) {
						$(element).css('background-color', '#fff').css('border-color', '#bbb');
					  }
				});                               
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "&nbsp;<span style='color:#f00'>[Campo obrigatório]</span>"
            });

        </script>
        <script type="text/javascript" src="js/lang/lang.en.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>
    <body>