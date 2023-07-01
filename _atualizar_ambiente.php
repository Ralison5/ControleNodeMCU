


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
if($nivel==1){
include 'conexao.php';

$id=$_POST['id'];
$nome = $_POST['nome'];


$recebe=verificar($nome,$id);

if($recebe==0){
$sql="UPDATE `ambiente` SET nome_local='$nome' WHERE id_local = $id" ;
$atualizar = mysqli_query($conexao,$sql);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="width: 400px">
<center>
    <div style="margin-top: 20px">
	<h3>Atualizado com sucesso</h3>
	</div>
	<div style="margin-top: 10px">
	
	<a href="listar_ambiente.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
<?php }else{ ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 10px">
<center>
	<h3>Este ambiente ja está cadastrado</h3>
	<div style="margin-top: 10px">
	<a href="listar_ambiente.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
 </div>
<?php } ?>

<?php 
////////////////////
$resultado=0;

$sql1= "SELECT * FROM `sala` WHERE `id_local` = $id";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);


if($resultado > 0){
	
$sql1="UPDATE `sala` SET `nome_local`='$nome' WHERE `id_local`='$id'";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}

$resultado = 0;
$sql1="SELECT * FROM `acessonegado` WHERE `id_local` = $id";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `acessonegado` SET `nome_local`='$nome' WHERE `id_local`='$id'";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}

$resultado = 0;
$sql1="SELECT * FROM `acessonegado` WHERE `id_local` = $id";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `acessonegado` SET `nome_local`='$nome' WHERE `id_local`='$id'";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}

$resultado = 0;
$sql1="SELECT * FROM `acessos` WHERE `id_local` = $id";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `acessos` SET `nome_local`='$nome' WHERE `id_local`='$id'";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}

$resultado = 0;
$sql1="SELECT * FROM `agendamento` WHERE `id_local` = $id";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `agendamento` SET `nome_local`='$nome' WHERE `id_local`='$id'";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}


////////////////////
}else{
	
header('Location: home.php');	
		
}


function verificar($nome,$id){
	
include 'conexao.php';

///$sql1= "SELECT `nome_local` FROM `ambiente` WHERE nome_local like '%$nome%'";

$sql1= "SELECT `nome_local` FROM `ambiente` WHERE nome_local like '%$nome%'and `id_local` != '$id'";

$buscar1= mysqli_query($conexao,$sql1);
$total = mysqli_num_rows($buscar1);

return $total;		
}	

 ?>
 
