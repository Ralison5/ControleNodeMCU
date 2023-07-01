<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
@media screen and (min-width: 700px) {
      #tamanhocontainer{
      width: 500px;
    }
    
  
}
</style>



</head>


<?php
include 'conexao.php';
if(isset($_POST['ok'])){

$novasenha = substr(md5(time()),0,8);
$email = $_POST['usuarioemail'];
$contador = 0;
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
 
$contador=1;
 
}

$sql="SELECT * FROM `usuario_externo` WHERE `email`='$email'";  
$buscar= mysqli_query($conexao,$sql);
$total = mysqli_num_rows($buscar);

$sql1="SELECT * FROM `usuario_externo` WHERE `email`='$email' AND `status` ='inativo'";
$buscar1= mysqli_query($conexao,$sql1);
$total1 = mysqli_num_rows($buscar1);
 
if($total==0){
?>
<center>
<div class="alert alert-danger" id= "tamanhocontainer" role="alert">
  <strong>Este e-mail não esta cadastrado no banco de dados!!!</strong> 
</div>
</center>
<?php
$contador=1;
}else if($total1 > 0){
?>
<center>
<div class="alert alert-danger" id= "tamanhocontainer" role="alert">
  <strong> Este e-mail esta esperando aprovação de um administrador!!!</strong> 
</div>
</center>
<?php	
$contador=1;	
}	

if($contador==0 && $total > 0){

if(mail($email,"Nova senha","Sua nova senha de recuperação:".$novasenha)){

$sql = "UPDATE `usuario_externo` SET `senha`= '$novasenha' WHERE `email`= '$email'";
$executar = mysqli_query($conexao,$sql);
header('Location: login_secundario.php?usuarioemail='.$email);
}
	
}
}


?>


<body>

<div class="container" id= "tamanhocontainer" style="margin-top:10px">
<div style="text-align: right; margin-bottom: 10px">
<a href="index.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<?php 
$resultado=isset($_POST['usuarioemail']);	
	
?>

<h4>Recuperação de senha</h4>
<form action="esqueceusenha.php" method="post" submit>

<div class= "form-group" style="margin-top:10px">
<label>E-mail</label>
<input value="<?php if($resultado==1){echo $_POST['usuarioemail'];}?>" type="email" name="usuarioemail" class="form-control" required autocomplete="off" placeholder="Digite seu e-mail">
</div>

<div style="text-align: right; margin-top: 10px">
<button type="submit" name="ok" class="btn btn-sm btn-success">ok</button>
</div>
</form>

</div>



<!-- JavaScript Bundle with Popper -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>