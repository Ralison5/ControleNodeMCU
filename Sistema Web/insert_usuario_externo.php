<?php
include 'conexao.php';
include 'script/password.php';

$nomeusuario = $_POST['nomeusuario'];
$usuarioemail= $_POST['usuarioemail'];
$senha=$_POST['usuariosenha'];
$nivelusuario='0';
$status='inativo';

$resultado1 = ativo($usuarioemail);
$resultado2 = inativo($usuarioemail);

if($resultado1 == 0 && $resultado2 == 0){

$sql= "INSERT INTO `usuario_externo`(`nome`, `email`, `senha`,`nivel`, `status`) VALUES ('$nomeusuario','$usuarioemail',sha1('$senha'),'$nivelusuario','$status')";
$inserir= mysqli_query($conexao,$sql);

}else if($resultado1 > 0){
///argumentos inseridos	
header('Location: externo_falha1.php');

}else if($resultado2 > 0){
///argumentos inseridos	
header('Location: externo_falha2.php');
	
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="margin-top: 10px">
<center>
	<h3>Usuario adicionado com sucesso, esperando aprovação</h3>
	<div style="margin-top: 10px">
	<a href="cadastro_usuario_externo.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
 
 <?php
function ativo($email){
include 'conexao.php';	
$resultado = 0;		
$sql1= "SELECT `email` FROM `usuario_externo` WHERE `email` like '$email' AND `status` = 'ativo'";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);
return $resultado;	
}

function inativo($email){
include 'conexao.php';	
$resultado = 0;	
$sql2= "SELECT `email` FROM `usuario_externo` WHERE `email` like '$email' AND `status` = 'inativo'";
$buscar2=mysqli_query($conexao,$sql2);
$resultado = mysqli_num_rows($buscar2);
return $resultado;		
		
}
?>