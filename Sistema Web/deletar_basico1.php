


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
$nivel = $array['nivel'];

?>


<?php
if($nivel == 1 || $nivel == 2){
$id=$_GET['id'];
$id_local = $_GET['id_local'];
$id_usuario = $_GET['id_usuario'];
$sql="DELETE FROM `sala` WHERE id=$id";
$deletar = mysqli_query($conexao,$sql);

$sql="DELETE FROM `agendamento` WHERE id_local=$id_local AND id_usuario=$id_usuario";
$deletar = mysqli_query($conexao,$sql);


}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<center>
	<h3>Excluido com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="visualizar_usuarios.php?id_local=<?php echo $id_local?>" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>