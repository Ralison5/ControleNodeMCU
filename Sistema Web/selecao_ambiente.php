
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
</head>
<body>

<div class= "container" id= "tamanhocontainer" style="margin-top: 10px">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="vincular_sala.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Cadastrar no ambiente</h4>
<form action="selecionar_usuarios.php" method="get" submit style ="margin-top: 20px;">

<div class="mb-3"> 
<label>Selecione o ambiente</label>
<select type="text" class="form-select" name="id_local"  aria-label="Default select example" required>
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

<label style="color:#FF0000">Defina a data e o horario de acesso ao ambiente</label>
<div class="mb-3">
<label>Data Inicial</label>
<input type="date" class="form-control" id="no-spin" name="valor1"  required autocomplete="off">
</div>

<div class="mb-3">
<label>Data Final</label>
<input type="date" class="form-control" id="no-spin" name="valor2" required autocomplete="off">
</div>

<div class="mb-3">
<label>Horario Inicial</label>
<input type="time" class="form-control" name="valor3" required autocomplete="off">
</div>

<div class="mb-3">
<label>Horario Final</label>
<input type="time" class="form-control" name="valor4" required autocomplete="off">
</div>



<div style="text-align: right;">
<button type="submit" id="botao" class="btn btn-sm">cadastrar</button>
</div>
</form>
</div>


<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
<?php }else{

header('Location: home.php');

}
?>
<script type="text/javascript">
        var today = new Date();
today.setDate(today.getDate());
today = today.toISOString().split('T')[0];

//document.getElementsByName("valor1")[0].setAttribute('min', today);
//document.getElementsByName("valor2")[0].setAttribute('min', today);

</script>

