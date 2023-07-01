<?php

$usuario= $_POST['usuario'];

include 'conexao.php';
$sql= "SELECT `nivel` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$nivel1 = $array['nivel'];

?>

<?php
if($nivel1 == 1 || $nivel1== 2){

//////////////////////////////////////
$senha_atual = $_POST['senha_atual'];
$senha_nova = $_POST['senha_nova'];

$sql="SELECT `senha` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$senha_atual2 = $array['senha'];


if($senha_atual == $senha_atual2){
$sql="UPDATE `usuario_externo` SET `senha`= sha1('$senha_nova') WHERE `email` LIKE '$usuario'";
$buscar = mysqli_query($conexao,$sql);

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="margin-top: 20px">
<center>
	<h3>Senha alterada com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="index.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
</div>

<?php	
}else{
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="margin-top: 20px">
<center>
	<h3>A senha atual está incorreta</h3>
	<div style="margin-top: 10px">
	<a href="login_secundario.php?usuarioemail=<?php echo $usuario ?>" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
</div>

<?php	
}

}else{

header('Location: index.php');

}
////////////////////////////////////
	?>
