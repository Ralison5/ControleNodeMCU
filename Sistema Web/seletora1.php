
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


?>


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
			background-color: #008000; /*cor de fundo*/
			color: #ffffff; /*cor da letra*/
			font-weight: bold;
		}
	</style>
	<!-- CSS only -->
<link rel="stylesheet" href="css/bootstrap.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

<div class= "container" id= "tamanhocontainer" style="margin-top: 10px">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar_ambiente2.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Visualizar no ambiente</h4>
<form action="visualizar_usuarios.php" method="get" submit style ="margin-top: 20px;">

<div class="mb-3"> 
<label>Selecione o ambiente</label>
<select type="text" id="local" class="form-select" name="id_local"  aria-label="Default select example" required>
<?php
  
  $sql= "SELECT * FROM ambiente";
  
  $buscar=mysqli_query($conexao,$sql);
  while ($array=mysqli_fetch_array($buscar)){
	  $id_local=$array['id_local'];
	  $nome_local=$array['nome_local'];
	  
?>	
 
<option value="<?php echo $id_local ?>"><?php echo $nome_local ?></option>

<?php } ?> 

</select>
</div>

<div style="text-align: right;">
<button type="submit" id="botao" class="btn btn-sm">Entrar</button>
</div>
</form>
</div>
<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#local').select2();
});
</script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
<?php }else{

header('Location: home.php');

}
?>

