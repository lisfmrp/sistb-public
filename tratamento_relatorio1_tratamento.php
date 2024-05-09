<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">::Relatório::</span></span></span></h3>
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


                                <?php
                                $con = mysql_connect("localhost", "tuberculose", "senha");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }

                                mysql_select_db("tuberculose", $con);
                                
                                  if (isset($_GET)) {
                                    $param1 = $_GET["busca"];
                                    
                                    $ano = $param1;
                                 
                                   
                                    
                                    $selectAnd = "SELECT cod_tratamento from tratamento where YEAR(data_alta_tratamento) = ' ' ";
                                 
                                    $query1 = @mysql_query($selectAnd) or die(mysql_error());
                                   //$totalAnd = mysql_num_rows(mysql_query("SELECT cod_tratamento from tratamento where YEAR(data_alta_tratamento) = ' ' "));
                                   $totalAnd = mysql_num_rows($query1);
                                    
                                    $selectCount = "SELECT motivo_alta from tratamento where YEAR(data_alta_tratamento) = '$ano' ";
                                    $query2 = @mysql_query($selectCount) or die(mysql_error());
                                    
                                    $selectEnc = "SELECT motivo_alta, COUNT(motivo_alta) from tratamento where YEAR(data_alta_tratamento) = '$ano' group by motivo_alta";
                                   
                                    $query3 = @mysql_query($selectEnc) or die(mysql_error());
                                     $totalEnc = mysql_num_rows($query3);
                                    
                                   
                                    ?>
   
                                    <table class="infotable" cellspacing="0" cellpadding="0" width="100%">
                                        <thead>
                                            <tr>  
                                                <th></th>
                                                <th>Em andamento: </th>
                                                <th> <?= $totalAnd ?></th>
                                                <th>Encerrado: </th>
                                                <th> <?= $totalEnc ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                            while ($l = mysql_fetch_array($query3)) {

                                                $motivo = ucfirst($l[0]);
                                                $contagem = ucfirst($l[1]);
                                     ?>           
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                     <td><?= $motivo ?></td>
                                                    <td><?= $contagem ?></td>
                                                    
                                                </tr>
                                                
                                                
                                  
                        
                                        <?php //}
                                            }
                                          
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
