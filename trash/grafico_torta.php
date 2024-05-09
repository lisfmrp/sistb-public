<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Relatórios sobre tratamentos ::</span></span></span></h3>
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

                                <h2 class="title">Taxas </h2>

                                <table border align="left">
                                    <tr>
                                        <th> <b>Status do tratamento</b></th>
                                        <th> <b>Total</b></th>
                                    </tr>
                                    <tr>
                                        <td><b>Em andamento</b></td>
                                        <td><b>2</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Encerrado</b></td> 
                                        <td><b>10</b></td>
                                    </tr>
                                </table>

                                <br/>
                                <br/>
                                <br/>
                                <br/>

                                <table border>
                                    <tr>
                                        <th> <b>Tipo da taxa</b></th>
                                        <th> <b>Valor em %</b></th>
                                        <th align="center"> <b>Definição</b></th>
                                    </tr> 
                                    <tr>
                                        <th> <b>Taxa de cura</b></th>
                                        <th> <b> 77% </b></th>
                                        <th> <b> Número de total pacientes curados sobre o total de pacientes com tratamento encerrado </b></th>
                                    </tr>
                                    <tr>
                                        <th> <b>Taxa de mortalidade</b></th>
                                        <th> <b> 2% </b></th>
                                        <th> <b> Número de total óbitos sobre o total de pacientes com tratamento encerrado </b></th>
                                    </tr>
                                    <tr>
                                        <th> <b>Taxa de abandono</b></th>
                                        <th> <b> 21% </b></th>
                                        <th> <b> Número total de abandonos sobre o total de pacientes com tratamento encerrado </b></th>
                                    </tr>

                                </table>
                                <br/>
                                <br/>
                                <h2 class="title">Gráficos </h2>
                                
                                <!--
                                <lable><b> Desfecho dos tratamentos </b></lable>
                                <br/>
                                <script src="js/RGraph.common.core.js" ></script>
                                <script src="js/RGraph.pie.js" ></script>

                                <canvas id="cvs" width="400" height="300">[Alo]</canvas>                            
                                <script>
                                    window.onload = function ()
                                    {
                                        var pie = new RGraph.Pie('cvs', [77,2,21]);
                                        pie.Set('chart.centerx');
                                        pie.Set('chart.title.font', 'Tahoma');
                                        pie.Set('chart.title.bold', 'true');
                                        pie.Set('chart.title.color', 'green');
                                
                                        pie.Set('chart.exploded', [0,0,0]);
                                        pie.Set('chart.labels', ['Cura (77%)','Morte (2%)','Abandono (21%)']);
                                        pie.Set('chart.colors', ['rgb(50,205,50)','rgb(255,0,0)','rgb(255,165,0)']);
                                        pie.Draw();
                                    }
                                </script> -->
                                <lable><b> Efetividade do tratamento (%) x mês </b></lable>
                                <br/>
                                <br/>
                                <script src="js/RGraph.common.core.js" ></script>
                                <script src="js/RGraph.line.js" ></script>
                                <canvas id="cvs" width="1000" height="250">[No canvas support]</canvas>
                                <script>
                                    
                                    window.onload = function ()
                                    {
                                        // The data for the Line chart. Multiple lines are specified as seperate arrays.
                                        var data = [68,73,75,66,77,90,70];
                                        var data2 = [2,5,10,1,9,6,4];
                                        var data3 = [21,18,26,32,17,23,27];
    
                                        // Create the Line chart object. The arguments are the canvas ID and the data array.
                                        var line = new RGraph.Line("cvs", data,data2, data3);
                                        // The way to specify multiple lines is by giving multiple arrays, like this:
                                        // var line = new RGraph.Line("myLine", [4,6,8], [8,4,6], [4,5,3]);
        
                                        // Configure the chart to appear as you wish.
                                        line.Set('chart.title','')
                                        line.Set('chart.background.barcolor1', 'white');
                                        line.Set('chart.background.barcolor2', 'white');
                                        line.Set('chart.background.grid.color', 'rgba(238,238,238,1)');
                                        line.Set('chart.colors', ['blue','red','orange']);
                                        line.Set('chart.key', ['Cura','Óbitos', 'Abandono']);
                                        line.Set('chart.key.position', 'gutter');
                                        line.Set('chart.linewidth', 2);
                                        line.Set('chart.filled', false);
                                        line.Set('chart.hmargin', 5);
                                        
                                        line.Set('chart.labels', ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho']);
                                        line.Set('chart.gutter.left', 40);
                                        
                                        line.Draw();
                                        // Now call the .Draw() method to draw the chart.
                                       
                                            
                                    }
                                    </script>
                                <br/>
                                <br/>

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



