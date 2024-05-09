<html>
 <head>
        <title>Highcharts Example</title>

<script src="js/jquery.js"></script>
<script src="js/highcharts/jquery.min.js"></script>
<script src="js/highcharts/highcharts.js"></script>

<body>
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </body>

   <script type="text/javascript">     
       $(function () { 
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de Supervisão'
                },
                xAxis: {
                    categories: ['Apples', 'Bananas', 'Oranges']
                },
                yAxis: {
                    title: {
                        text: 'Fruit eaten'
                    }
                },
                series: [{
                    name: 'AA',
                    data: [6, 1, 3]
                }, {
                    name: 'SVD',
                    data: [5, 7, 3]
                }]
            });
        });     
</script>

</head>
    
</html>