<?php

session_start();
$usuario=$_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
header('Location: index.php');
}
include 'conexao.php';
$sql= "SELECT `nivel` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$nivel1 = $array['nivel'];

?>

<?php
if($nivel1 == 1){
include 'conexao.php';

$id=$_GET['id'];


$sql="DELETE FROM `usuario_externo` WHERE id_usuario=$id";

$deletar = mysqli_query($conexao,$sql);
header("Location: Aprovar_usuarios.php");

}else{

header('Location: home.php');	
	
}
?>


