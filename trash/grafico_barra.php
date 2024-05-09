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

                                <h2 class="title">Gráficos </h2>

                                <lable><b> Número de comparecimentos x mês </b></lable>
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
                                        var data = [[10,50,4,2], [8,66,9,3], [13,53,11,1], [4,71,15,4],[7,88,9,2],[12,79,5,1],[15,60,4,4]];
        
        
                                        // An example of the data used by stacked and grouped charts
                                        // var data = [[1,5,6], [4,5,3], [7,8,9]]

        
                                        // Create the br chart. The arguments are the ID of the canvas tag and the data
                                        var bar = new RGraph.Bar('myBar', data);
        
        
                                        // Now configure the chart to appear as wanted by using the .Set() method.
                                        // All available properties are listed below.
                                        bar.Set('chart.labels', ['Janeiro', 'Fevereiro', 'Maçor', 'Abril', 'Maio', 'Junho', 'Julho']);
                                        bar.Set('chart.key', ['SU','SVD','A','N']);
                                        bar.Set('chart.gutter.left', 45);
                                        bar.Set('chart.background.barcolor1', 'white');
                                        bar.Set('chart.background.barcolor2', 'white');
                                        bar.Set('chart.background.grid', true);
                                        bar.Set('chart.colors', ['yellow','green','teal','red']);
        
        
                                        // Now call the .Draw() method to draw the chart
                                        bar.Draw();
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