<!-- box with default header [begin] -->
<div class="box box-header">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Gráfico por motivo de cancelamento de solicitações ::</span></span></span></h3>
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
                                
                                <label><b>OBSERVAÇÃO: total de solicitações do dia 13/08/2012 até o dia 03/09/2012</b></label>
                                <br/>
                                <br/>
                                <table border>
                                    <tr>
                                        <th> <b>Tipo de cancelamento </b></th>
                                        <th> <b>Número total de solicitações</b></th>
                                        <th> <b>Porcentagem</b></th>
                                    </tr> 
                                    <tr>
                                        <th> Erro no uso do sistema </th>
                                        <th align ="center">  17 </th>
                                         <th align ="center">  24% </th>
                                       
                                    </tr>
                                    <tr>
                                        <th> Por recusa e/ou não comparecimento do paciente   </th>
                                        <th align="center">  23 </th>
                                         <th align ="center">  32% </th>
                                 
                                    </tr>
                                    <tr>
                                        <th> Por alta ou melhora </th>
                                        <th align="center">  10 </th>
                                        <th align="center">  14% </th>
                             
                                    </tr>
                                    <tr>
                                        <th> Por mudança de encaminhamento do paciente </th>
                                        <th align="center">  21 </th>
                                        <th align="center">  30% </th>
                             
                                    </tr>
                                    
                                    <tr>
                                        <th> Total </th>
                                        <th align="center">  71 </th>
                                        <th align="center">  100% </th>
                                    </tr>
                                    
                                    
                                   

                                </table>
                                <br/>
                                <br/>
                                <script src="js/RGraph.common.core.js" ></script>
                                <script src="js/RGraph.pie.js" ></script>
                                <canvas id="cvs" width="1000" height="250">[No canvas support]</canvas>
                                <script>
                                
          
                                    window.onload = function ()
                                    {
                                        // The data to be shown on the Pie chart
                                        var data = [24,32,14,30];
    
                                        // Create the Pie chart. The arguments are the canvas ID and the data to be shown.
                                        var pie = new RGraph.Pie("cvs", data);

                                        // Configure the chart to look as you want.
                                        pie.Set('chart.text.font', 'Tahoma');
                                        pie.Set('chart.text.size', '12')
                                       
                                        pie.Set('chart.labels', ['Erro no uso do sistema (24%)', 'Por recusa e/ou não comparecimento do paciente(32%)',
                                            'Por alta ou melhora (14%)', 'Por mudança de encaminhamento do paciente (30%)']);
                                        pie.Set('chart.colors', ['blue','red','pink', 'green']);
                                        pie.Set('chart.linewidth', 5);
                                     
                                        pie.Set('chart.stroke', 'white');
        
                                        // Call the .Draw() chart to draw the Pie chart.
                                        pie.Draw();
                                    }
                                </script>





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