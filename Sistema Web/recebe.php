

<?php

include 'conexao.php';
include 'script/password.php';

$usuario=$_POST['login_usuario'];
$senha=$_POST['login_senha'];


$sql= "SELECT `email`, `senha`  FROM `usuario_externo` WHERE email like '%$usuario%' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$total = mysqli_num_rows($buscar);

//echo "resultado $total||";

while($array=mysqli_fetch_array($buscar)){
	$password=$array['senha'];
	
//echo "senha $password||";	

}

$senhadecodificada=sha1($senha);
if($total > 0){
	
if($senhadecodificada==$password){
	session_start();
	$_SESSION['usuario'] = $usuario;
header('Location:home.php');
//echo "HOME||";
}else{
header('Location:erro2.php');
//echo "ERRO|| ";
}	
	
}else{
header('Location:erro.php');
//echo "ERRO||";
	
}



?>