<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Dados do tratamento no ano ::</span></span></span></h3>
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
                               <?php
                                $con = mysql_connect("localhost", "tuberculose", "senha");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }

                                mysql_select_db("tuberculose", $con);
                                
                                  if (isset($_GET)) {
                                    //$param1 = $_GET["busca"];
                                    
                                    //$ano = $param1;
                                 
                                   /*
                                    
                                    $selectAnd = "SELECT cod_tratamento from tratamento where YEAR(data_alta_tratamento) = ' ' ";
                                 
                                    $query1 = @mysql_query($selectAnd) or die(mysql_error());
                                   //$totalAnd = mysql_num_rows(mysql_query("SELECT cod_tratamento from tratamento where YEAR(data_alta_tratamento) = ' ' "));
                                   $totalAnd = mysql_num_rows($query1);
                                    
                                    $selectCount = "SELECT motivo_alta from tratamento where YEAR(data_alta_tratamento) = '$ano' ";
                                    $query2 = @mysql_query($selectCount) or die(mysql_error());
                                    $totalEnc = mysql_num_rows($query2);
                                    
                                    $selectEnc = "SELECT motivo_alta, COUNT(motivo_alta) from tratamento where YEAR(data_alta_tratamento) = '$ano' group by motivo_alta";
                                   
                                    $query3 = @mysql_query($selectEnc) or die(mysql_error());
                                     
                                    */
                                    
                                    $select1 = "select COUNT(resultado_escarro), MONTH(data_escarro) from tratamento where YEAR(data_rx_torax)=2014 group by MONTH(data_escarro)";
                                    $query1[0] = @mysql_query($select1) or die(mysql_error());
                                    
                                    $select2 = "select COUNT(resultado_rx_torax), MONTH(data_rx_torax) from tratamento where YEAR(data_rx_torax)=2014 group by MONTH(data_rx_torax)";
                                    $query1[1] = @mysql_query($select2) or die(mysql_error());
                                    
                                    $select3 = "select COUNT(resultado_rx_outro), MONTH(data_rx_outro) from tratamento where YEAR(data_rx_outro)=2014 group by MONTH(data_rx_outro)";
                                    $query1[2] = @mysql_query($select3) or die(mysql_error());
                                    
                                    $select4 = "select COUNT(resultado_histopatologico), MONTH(data_histopatologico) from tratamento where YEAR(data_histopatologico)=2014 group by MONTH(data_histopatologico)";
                                    $query1[3] = @mysql_query($select4) or die(mysql_error());
                                    
                                    $select5 = "select COUNT(resultado_necropsia), MONTH(data_necropsia) from tratamento where YEAR(data_necropsia)=2014 group by MONTH(data_necropsia)";
                                    $query1[4] = @mysql_query($select5) or die(mysql_error());
                                    
                                    $select6 = "select COUNT(resultado_outros), MONTH(data_outros) from tratamento where YEAR(data_outros)=2014 group by MONTH(data_outros)";
                                    $query1[5] = @mysql_query($select6) or die(mysql_error());
                                    
                                    $select7 = "select COUNT(resultado_outro), MONTH(data_outro) from tratamento where YEAR(data_outro)=2014 group by MONTH(data_outro)";
                                    $query1[6] = @mysql_query($select7) or die(mysql_error());
                                    
                                    $select8 = "select COUNT(resultado_cultura_escarro), MONTH(data_cultura_escarro) from tratamento where YEAR(data_cultura_escarro)=2014 group by MONTH(data_cultura_escarro)";
                                    $query1[7] = @mysql_query($select8) or die(mysql_error());
                                  //                                    
                                    $select9 = "select COUNT(resultado_cultura_outro), MONTH(data_cultura_outro) from tratamento where YEAR(data_cultura_outro)=2014 group by MONTH(data_cultura_outro)";
                                    $query1[8] = @mysql_query($select9) or die(mysql_error());
                                   
                                    ?>
                                 
                                 <table class="infotable" cellspacing="0" cellpadding="0" width="70%">
                                       <tbody>
                                 
                                 <?php
                                 
                                 for ($i=0; $i<9; $i++){
                                     echo "ex ";
                                     echo ($i);
                                     
                                     ?>
                                            <br> <br> <br>
                                     <tr>      
                                    <!-- <table class="infotable" cellspacing="0" cellpadding="0" width="70%">
                                      <tbody> -->
                                    <?php
                                     $jan = 0;
                                    $fev =0;
                                    $mar =0;
                                    $abr =0;
                                     $mai =0;
                                     $jun =0;
                                     $jul=0;
                                     $ago=0;
                                     $set=0;
                                     $out=0;
                                     $nov=0;
                                     $dez=0;
                                    //$i=0;
                                     
                                    while ($l = mysql_fetch_array($query1[$i])) {

                                                $contagem = ucfirst($l[0]);
                                                $m = ucfirst($l[1]);
                                                
                                       
                                                if ($m == 1) {
                                                    $jan = $contagem;
                                                    print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 2) {
                                                    $fev = $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 3) {
                                                    $mar = $contagem;
                                                    print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 4) {
                                                    $abr = $contagem;
                                                    print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 5) {
                                                    $mai == $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                    
                                                }
                                                if ($m == 6) {
                                                    $jun = $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                    
                                                }
                                                if ($m == 7) {
                                                    $jul = $contagem;
                                                    print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 8) {
                                                    $ago = $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 9) {
                                                    $set = $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 10) {
                                                    $out = $contagem;
                                                   print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 11) {
                                                    $nov == $contagem;
                                                     print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                if ($m == 12) {
                                                    $dez = $contagem;
                                                    print ("mes: ");
                                                    print($m);
                                                    print("C: ");
                                                    print($contagem);
                                                }
                                                
                                       } //while         
                                       echo ($jan+ $fev+ $mar+ $abr+ $mai+ $jun+ $jul+ $ago+ $set+ $out+ $nov+ $dez);
                                       echo $jan;
                                       echo $fev;
                                       
                                    ?>
                                            
                                   <!--           </tbody>
                                    </table> 
                                 
                                 -->
                                 
                                 <lable><b> Altas </b></lable>
                                <br/>
                                <br/>
                                <script src="/libraries/RGraph.common.core.js" ></script>
                                <script src="/libraries/RGraph.bar.js" ></script>
                                <canvas id="myBar" width="1000" height="250">[No canvas support]</canvas>
                                <script> 
                                    window.onload = function ()
                                    {
        
                                        // Some data that is to be shown on the bar chart. To show a stacked or grouped chart
                                        // each number should be an array of further numbers instead.
                                        var data = [[<?php echo $jan; ?>, <?php echo $fev; ?>, <?php echo $mar; ?>, <?php echo $abr; ?>, <?php echo $mai; ?>, <?php echo $jun; ?>, <?php echo $jul; ?>, <?php echo $ago; ?>, <?php echo $set; ?>, <?php echo $out; ?>, <?php echo $nov; ?>, <?php echo $dez; ?>]];
                                        
         
                                        // An example of the data used by stacked and grouped charts
                                        // var data = [[1,5,6], [4,5,3], [7,8,9]]

        
                                        // Create the br chart. The arguments are the ID of the canvas tag and the data
                                        var bar = new RGraph.Bar('myBar', data);
        
        
                                        // Now configure the chart to appear as wanted by using the .Set() method.
                                        // All available properties are listed below.
                                        bar.Set('chart.labels', ['Motivo da Alta']);
                                        bar.Set('chart.key', ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']);
                                        bar.Set('chart.gutter.left', 45);
                                        bar.Set('chart.background.barcolor1', 'white');
                                        bar.Set('chart.background.barcolor2', 'white');
                                        bar.Set('chart.background.grid', true);
                                        bar.Set('chart.colors', ['blue','yellow','black','gray','teal','red', 'blue','yellow','black','gray','teal','red' ]);
        
        
                                        // Now call the .Draw() method to draw the chart
                                        bar.Draw();
                                    }
                                </script>
                                 
                                 </tr>
                                
                                 
                                     <?php 
                                    //}//while  
                                   
                                    
                                 }//for
                                  ?>   
                                 
                                 </tbody>
                                    </table>
                                 
                                 <?php
                                } else {
                                    echo "Por favor, digite o nome do paciente.";
                                }
                                ?>



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