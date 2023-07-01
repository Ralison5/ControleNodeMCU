<!DOCTYPE html>
<html>
<head>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<title></title>
	<style type="text/css">
		
	
@media screen and (min-width: 700px) {
      #tamanhocontainer{
      width: 500px;
	  
    }
    
  
}

		#botao {
			background-color: #5CC5AB; /*cor de fundo*/
			color: #ffffff; /*cor da letra*/
			font-weight: bold;
		}


    
	</style>
	<!-- CSS only -->
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
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

<div class= "container"  id= "tamanhocontainer" style="margin-top: 20px; border-radius: 25px; border: 2px solid #808080">
<?php if($nivel==1){ ?>
<div style="padding: 10px">
<div style="text-align: right">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar_ambiente.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Cadastro de ambiente</h4>
<form action="_inserir_ambiente.php" method="post" submit="Cadastrar" style ="margin-top: 10px;">

<div class="mb-3">
    <label>Nome do Local</label>
    <input type="text" class="form-control" name="nome"  placeholder="Coloque o nome do ambiente" required autocomplete="off">
</div>

<div style="text-align: right;">
<button type="submit" id="botao" class="btn btn-sm">Cadastrar ambiente</button>
</div>
</form>
<?php }else{
header('Location: home.php');
}
?>
</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>