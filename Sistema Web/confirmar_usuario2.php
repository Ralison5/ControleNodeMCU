<?php

session_start();
$usuario=$_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
header('Location: index.php');
}
?>
<!DOCTYPE html>

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<div class="container" style="margin-top: 20px">
<center>
<h3>
<?php

include 'conexao.php';

$id= $_GET['id'];
$nivel= $_GET['nivel'];

if($nivel==1){

$update="UPDATE usuario_externo SET status = 'ativo', nivel = 1 WHERE id_usuario = $id";	
$atualizacao = mysqli_query($conexao,$update);
echo "Administrador aprovado";
	
}
if($nivel==2){

$update="UPDATE usuario_externo SET status = 'ativo', nivel = 2 WHERE id_usuario = $id";
$atualizacao = mysqli_query($conexao,$update);	
echo "Conferente aprovado";

}

?>
</h3>
<div style="margin-top: 10px">
	<a href="Aprovar_usuarios2.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
</div>
</body>
</html>