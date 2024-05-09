<!-- box with default header [begin] -->
<div class="box box-header">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Gr�fico por tipo de solicita��o de interna��o ::</span></span></span></h3>
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
                                
                                <label><b>OBSERVA��O: total de solicita��es do dia 13/08/2012 at� o dia 03/09/2012</b></label>
                                <br/>
                                <br/>
                                <table border>
                                    <tr>
                                        <th> <b>Tipo solicita��o </b></th>
                                        <th> <b>N�mero total de solicita��es</b></th>
                                      
                                    </tr> 
                                    <tr>
                                        <th> Solicita��es realizadas </th>
                                        <th align ="center">  127 </th>
                                       
                                    </tr>
                                    <tr>
                                        <th> Solicita��es canceladas    </th>
                                        <th align="center">  71 </th>
                                 
                                    </tr>
                                    <tr>
                                        <th> Alta hospitalar </th>
                                        <th align="center">  31 </th>
                             
                                    </tr>
                                    <tr>
                                        <th> Total </th>
                                        <th align="center">  229 </th>
                             
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
                                        var data = [127,71,31];
    
                                        // Create the Pie chart. The arguments are the canvas ID and the data to be shown.
                                        var pie = new RGraph.Pie("cvs", data);

                                        // Configure the chart to look as you want.
                                        pie.Set('chart.text.font', 'Tahoma');
                                        pie.Set('chart.text.size', '12')
                                       
                                        pie.Set('chart.labels', ['Solicita��es realizadas (127)', 'Solicita��es canceladas (71)', 'Alta hospitalar (31)']);
                                        pie.Set('chart.colors', ['#3299CC','red','pink']);
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