<?php

function verifica($tag,$local){



include 'conexao.php';


$sql1="SELECT * FROM sala WHERE tag='$tag' AND ambiente = '$ambiente'";
$buscar1 = mysqli_query($conexao,$sql1);
$total1=mysqli_num_rows($buscar1);


if($total1 > 0){



$sql= "INSERT INTO `acessos`(`nome`, `cpf`, `tag`,'nome_local') VALUES ('$nome','$cpf','$recebe')";


$inserir = mysqli_query($conexao,$sql);

return "Usuario cadastrado";



}else{

$sql= "INSERT INTO `acessonegado`(`tag`) VALUES ('$tag')";

$inserir = mysqli_query($conexao,$sql);

return "Usuario nao cadastrado";

}



}

?>