<?php

function verifica($tag,$local,$Data,$Time){

 $datatime= $Data." ".$Time; 

include 'conexao.php';
$total0 = 0;
$sql0="SELECT * FROM usuarios where tag='$tag'";
$buscar0 = mysqli_query($conexao,$sql0);
$total0=mysqli_num_rows($buscar0);
//echo "o resultado de total0: $total0";

$total1=0;

$sql1="SELECT * FROM sala WHERE tag='$tag' AND id_local = '$local'";
$buscar1 = mysqli_query($conexao,$sql1);
$total1=mysqli_num_rows($buscar1); 
//echo "o resultado de total1: $total1";

$total2=0;

$sql2="SELECT * FROM ambiente WHERE id_local = $local";
$buscar2 = mysqli_query($conexao,$sql2);
$total2=mysqli_num_rows($buscar2);
//echo "O resultado total2: $total2";
if($total2 > 0){
$array2=mysqli_fetch_array($buscar2);
$local_nome = $array2['nome_local'];
}


$sql2="SELECT * FROM ambiente WHERE id_local = $local";
$buscar2 = mysqli_query($conexao,$sql2);
$total2=mysqli_num_rows($buscar2);

$total3=0;

$sql3="SELECT * FROM `agendamento` WHERE `tag`= '$tag' AND `id_local`= '$local' AND `data`='$Data' AND `hora_inicial`<= '$Time' AND `hora_Final` >= '$Time'";
$buscar3 = mysqli_query($conexao,$sql3);
$total3=mysqli_num_rows($buscar3);

//echo '<br>';



///echo "o resultado de total0: $total0 total1: $total1  total2: $total2  total3: $total3".'<br>';

/// total0 == tabela usuarios
/// total1 == tabela sala
/// total2 == ambiente
/// total3 == agendamento



if($total0 > 0 && $total2 > 0 && $total1==0 && $total3==0){
	
while ($array=mysqli_fetch_array($buscar0)) {

$id_usuario = $array['id']; 
				
}

///echo "linha 1".'<br>';
	
 $sql= "INSERT INTO `acessonegado`(`tag`,`nome_local`,`id_local`,`id_usuario`,`datatime`) VALUES ('$tag','$local_nome','$local','$id_usuario','$datatime')";

$inserir = mysqli_query($conexao,$sql);
//return "Usuario nao cadastrado na tabela";
return "REPROVADO";
	
}else if($total0 == 0 && $total2 > 0 && $total1==0 && $total3==0){
		
//$id_usuario = 0;
//echo "linha 2".'<br>';
 $sql= "INSERT INTO `acessonegado`(`tag`,`nome_local`,`id_local`,`datatime`) VALUES ('$tag','$local_nome','$local','$datatime')";
$inserir = mysqli_query($conexao,$sql);

//return "Usuario nao cadastrado na tabela";
return "REPROVADO";
	
}else if($total1 > 0 && $total2 > 0 && $total0 > 0 && $total3 > 0){


while ($array=mysqli_fetch_array($buscar0)){
$nome=$array['nome'];
$cpf =$array['cpf'];
$tag =$array['tag'];
$id_usuario = $array['id']; 
				
}
///echo "linha 3".'<br>';
$sql= "INSERT INTO `acessos`(`nome`, `cpf`, `tag`,`nome_local`,`id_local`,`id_usuario`,`datatime`) VALUES ('$nome','$cpf','$tag','$local_nome','$local','$id_usuario','$datatime')";
$inserir = mysqli_query($conexao,$sql);
//return "Usuario cadastrado na tabela";
return "APROVADO";

    
}else if($total0 > 0 && $total2 > 0 && $total1 > 0 && $total3==0){
	
while ($array=mysqli_fetch_array($buscar0)) {

$id_usuario = $array['id']; 
				
}


///echo "linha 4".'<br>';	
$sql= "INSERT INTO `acessonegado`(`tag`,`nome_local`,`id_local`,`id_usuario`,`datatime`) VALUES ('$tag','$local_nome','$local','$id_usuario','$datatime')";

$inserir = mysqli_query($conexao,$sql);
//return "Usuario nao cadastrado na tabela";
return "REPROVADO";	


}

}
?>