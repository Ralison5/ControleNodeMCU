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
	
$cont = NULL;	
if(isset($_POST['id'])){	


$id=$_POST['id'];

for($i=0; $i < count($id);$i++){
$valor=contador($id[$i]);
if($valor == 1){
$sql="SELECT * FROM `agendamento` WHERE id=$id[$i]";	
$buscar = mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$id_usuario = $array['id_usuario'];
$id_local =  $array['id_local'];


$sql="SELECT * FROM `agendamento` WHERE id_usuario=$id_usuario AND id_local=$id_local";
$buscar = mysqli_query($conexao,$sql);
$resultado = mysqli_num_rows($buscar);

if($resultado == 1){

$sql="DELETE FROM `sala` WHERE id_usuario=$id_usuario AND id_local=$id_local";
$deletar = mysqli_query($conexao,$sql);


}	
		
$sql="DELETE FROM `agendamento` WHERE id=$id[$i]";
$deletar = mysqli_query($conexao,$sql);
$cont=$cont+1;

//Deletar_sala($id[$i]);
//Deletar_acesso($id[$i]);
//Deletar_acessonegado($id[$i]);
}
}

}

if(isset($_POST['id_usuario'])){	
	
$id_usuario=$_POST['id_usuario'];	
for($i=0; $i < count($id_usuario);$i++){	

echo "$id_usuario[$i]";

}

}
?>
<?php if($cont > 0){ ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Excluido com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="data_hora.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
<?php }else{ ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Falha na operação!!!</h3>
	<div style="margin-top: 10px">
	<a href="data_hora.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>


<?php } ?>
<?php 

}else{
	
header('Location: home.php');

}	
?>

<?php

Function Deletar_sala($id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT `id_usuario` FROM `agendamento` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `sala` WHERE `id_usuario`=$id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}


Function Deletar_acesso($id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `acessos` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `acessos` WHERE `id_usuario`=$id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}

Function Deletar_acessonegado($id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `acessonegado` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `acessonegado` WHERE `id_usuario`=$id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
} 

function contador($id){
include 'conexao.php';	
$codigo="SELECT * FROM `agendamento` WHERE `id`=$id";
$buscar = mysqli_query($conexao,$codigo);
$resultado=mysqli_num_rows($buscar);	

return $resultado;	
}
?> 