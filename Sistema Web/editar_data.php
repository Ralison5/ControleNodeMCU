
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
$id_usuario=$_GET['id_usuario'];
$id_local=$_GET['id_local'];

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

<div class= "container" id= "tamanhocontainer" style="margin-top: 10px; margin-bottom: 300px">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="visualizar_usuarios.php?id_local=<?php echo $id_local ?>" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Cadastrar no ambiente</h4>
<form action="update_datahorario.php" method="post" submit style ="margin-top: 20px;">
<input type="number" class="form-control" name="id_usuario" value="<?php echo $id_usuario ?>" style="display: none">
<?php

$sql="SELECT * FROM `sala` WHERE id=$id";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)) {
    $nome = $array['nome'];
	$cpf = $array['cpf'];
	$sexo = $array['sexo'];
	$tag = $array['tag'];
    $id_super = $array['id'];
	$nome_local = $array['nome_local'];
	

?>
<div class="mb-3">
    <label>Nome do usuario</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>" readonly>
    <input type="number" class="form-control" name="id" value="<?php echo $id_super ?>" style="display: none">
	<input type="number" class="form-control" name="id_local" value="<?php echo $id_local ?>" style="display: none">
	<input type="text" class="form-control" name="nome_local" value="<?php echo $nome_local ?>" style="display: none">
</div>
<div class="mb-3">
<label>CPF do Usuario</label>
<input type="text" class="form-control" name="cpf" value="<?php echo $cpf ?>" placeholder="Insira o CPF do usuario!!!" required autocomplete="off"  onkeypress="$(this).mask('000.000.000-00');" readonly>
</div>
<div class="mb-3">
    <input type="text" class="form-control" name="sexo" value="<?php echo $sexo ?>" style="display: none" readonly>
</div>
<div class="mb-3">
    <label>Tag do usuario</label>
    <input type="text" class="form-control" name="tag" value="<?php echo $tag ?>" readonly>
</div>
<div class="mb-3">
    <label>Ambiente</label>
    <input type="text" class="form-control" name="nome_local" value="<?php echo $nome_local ?>" readonly>
</div>
 <?php } ?>
 

<?php
$sql="SELECT MIN(`data`) FROM agendamento WHERE `id_local`= $id_local AND `id_usuario`= $id_usuario";
$buscar = mysqli_query($conexao,$sql);
while($array=mysqli_fetch_array($buscar)) {
  $data_inicial = $array['MIN(`data`)'];

}
?> 

<?php
$sql="SELECT MAX(`data`) FROM agendamento WHERE `id_local`= $id_local AND `id_usuario`= $id_usuario";
$buscar = mysqli_query($conexao,$sql);
while($array=mysqli_fetch_array($buscar)){
 $data_final = $array['MAX(`data`)'];

}
?> 

<?php
$sql="SELECT MIN(`data`) FROM agendamento WHERE `id_local`= $id_local AND `id_usuario`= $id_usuario";
$buscar = mysqli_query($conexao,$sql);
while($array=mysqli_fetch_array($buscar)) {
  $data_inicial = $array['MIN(`data`)'];

}
?> 

<?php
$sql="SELECT * FROM agendamento WHERE `id_local`= $id_local AND `id_usuario`= $id_usuario";
$buscar = mysqli_query($conexao,$sql);
while($array=mysqli_fetch_array($buscar)) {
  $hora_inicial = $array['hora_inicial'];
  $hora_final = $array['hora_Final'];

}
?> 
 
<label style="color:#FF0000">Defina a data e o horario de acesso ao ambiente</label>
<div class="mb-3">
<label>Data Inicial</label>
<input type="date" class="form-control" id="no-spin" name="valor1" value="<?php echo $data_inicial ?>" required autocomplete="off">
</div>

<div class="mb-3">
<label>Data Final</label>
<input type="date" class="form-control" id="no-spin" name="valor2" value="<?php echo $data_final?>" required autocomplete="off">
</div>

<div class="mb-3">
<label>Horario Inicial</label>
<input type="time" class="form-control" name="valor3" value="<?php echo $hora_inicial?>" required autocomplete="off">
</div>

<div class="mb-3">
<label>Horario Final</label>
<input type="time" class="form-control" name="valor4" value="<?php echo $hora_final?>" required autocomplete="off">
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
