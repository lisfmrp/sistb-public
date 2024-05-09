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
                                    $param1 = $_GET["busca"];
                                    
                                    $ano = $param1;
                                 
                                   
                                    
                                   
                                    
                                    $selectCount = "SELECT motivo_alta from tratamento where YEAR(data_alta_tratamento) = '$ano' ";
                                    $query2 = @mysql_query($selectCount) or die(mysql_error());
                                    $totalEnc = mysql_num_rows($query2);
                                    
                                    $selectEnc = "SELECT motivo_alta, COUNT(motivo_alta) from tratamento where YEAR(data_alta_tratamento) = '$ano' group by motivo_alta";
                                   
                                    $query3 = @mysql_query($selectEnc) or die(mysql_error());
                                     
                                    
                                   
                                    ?>
   
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="70%">
                                        <thead>
                                            <tr>
                                                </tr>
                                            <tr> </tr> 
                                            <tr>  
                                                
                                                <th>Encerrados no ano de <?= $ano ?> : <?= $totalEnc ?></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                     $cura = 0;
                                    $ab =0;
                                    $otb =0;
                                    $ooc =0;
                                     $transf =0;
                                     $mud =0;
                                    
                                    while ($l = mysql_fetch_array($query3)) {

                                                $motivo = ucfirst($l[0]);
                                                $contagem = ucfirst($l[1]);
                                                if ($motivo == "Cura") {
                                                    $cura = $contagem;
                                                }
                                                if ($motivo == "Abandono") {
                                                    $ab = $contagem;
                                                }
                                                if ($motivo == "Óbito por TB") {
                                                    $otb = $contagem;
                                                }
                                                if ($motivo == "Óbito por outras causas") {
                                                    $ooc = $contagem;
                                                }
                                                if ($motivo =="Transferência") {
                                                    $transf == $contagem;
                                                }
                                                if ($motivo == "Mudança de diagnóstico") {
                                                    $mud = $contagem;
                                                }
                                               
                                     ?>           
                                                <tr>
                                                    
                                                       <td> </td>
                                                     <td><?= $motivo ?></td>
                                                    <td><?= $contagem ?></td>
                                                    
                                                    
                                                </tr>
                                                
                                              
                                  
                        
                                        <?php //}
                                            } ?>
                                            
                                              </tbody>
                                    </table> 
                                 
                                 
                                 
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
                                        var data = [[<?php echo $cura; ?>, <?php echo $ab; ?>, <?php echo $otb; ?>, <?php echo $ooc; ?>, <?php echo $transf; ?>, <?php echo $mud; ?>]];
                                        
         
                                        // An example of the data used by stacked and grouped charts
                                        // var data = [[1,5,6], [4,5,3], [7,8,9]]

        
                                        // Create the br chart. The arguments are the ID of the canvas tag and the data
                                        var bar = new RGraph.Bar('myBar', data);
        
        
                                        // Now configure the chart to appear as wanted by using the .Set() method.
                                        // All available properties are listed below.
                                        bar.Set('chart.labels', ['Motivo da Alta']);
                                        bar.Set('chart.key', ['Cura', 'Abandono', 'Óbito por TB', 'Óbito por outras causas', 'Transferência', 'Mudança de Diagnóstico']);
                                        bar.Set('chart.gutter.left', 45);
                                        bar.Set('chart.background.barcolor1', 'white');
                                        bar.Set('chart.background.barcolor2', 'white');
                                        bar.Set('chart.background.grid', true);
                                        bar.Set('chart.colors', ['blue','yellow','black','gray','orange','red']);
        
        
                                        // Now call the .Draw() method to draw the chart
                                        //bar.Draw();
                                    }
                                </script>
                                 
                                 
                                 
                                 
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