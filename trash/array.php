
<?php

$arrCod=  array();

for ($i=1; $i<5; $i++){
    
    $cod_pacientet = $i*3; 
    $cod_paciente = $i*5;
    
    
    $arrCod[] = array($cod_pacientet, $cod_paciente);  
    echo ("<br />");
    print_r($arrCod);
}
echo ("<br />");
echo ("<br />");
echo ("<br />");
print_r($arrCod);
echo ("<br />");
echo ("<br />");
echo($arrCod[0][0]);echo ("<br />");
echo($arrCod[0][1]);echo ("<br />");
echo($arrCod[1][0]);echo ("<br />");
echo($arrCod[1][1]);echo ("<br />");


foreach($arrCod as $arr){

        if($k=array_search("12",$arr) !== false){

                echo ("lala, $k");

        }

}

    
?>
                                    