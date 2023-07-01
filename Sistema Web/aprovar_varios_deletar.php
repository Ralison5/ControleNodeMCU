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
if(isset($_POST['id'])){
$id=$_POST['id'];

for($i=0;$i < count($id);$i++){
$sql="DELETE FROM `usuario_externo` WHERE id_usuario=$id[$i]";
$deletar = mysqli_query($conexao,$sql);
}
}
header("Location: Aprovar_usuarios.php");
}else{

header('Location: home.php');
	
}
?>