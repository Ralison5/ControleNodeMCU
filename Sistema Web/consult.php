<?php

include 'verificador.php';


$resultado=isset($_GET['tag']);

$resultado;

$Object = new DateTime();  
$Object->setTimezone(new DateTimeZone('America/Sao_Paulo'));
$Data = $Object->format("Y-m-d");  
///echo "The current date and time in Amsterdam are $Data.\n";


$Object->setTimezone(new DateTimeZone('America/Sao_Paulo'));
$Time = $Object->format("H:i:s");  
///echo "The current time and time in Sao_Paulo are $Time.\n";

if($resultado==1){

 $tag=$_GET['tag'];
 $local=$_GET['local'];

echo verifica($tag,$local,$Data,$Time);

}else{

echo "nao apresentou resultado";

}







?>
