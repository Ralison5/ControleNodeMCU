<?php 
session_start();
$usuario=$_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
header('Location: index.php');
}
include 'conexao.php';
echo $sql= "SELECT `nivel` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$nivel = $array['nivel'];

?>

<?php
if($nivel==1){
include 'conexao.php';

$id_usuario = $_GET['id'];


$sql="UPDATE `usuarios` SET `nivel`= '1' WHERE `id`= $id_usuario";
$deletar = mysqli_query($conexao,$sql);



header("Location: listar_processos.php");
}else{
header("Location: home.php");	
}
?>
