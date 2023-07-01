
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
			background-color: #FF0000; /*cor de fundo*/
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
<a href="vincular_sala.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Excluir do ambiente</h4>
<form action="deletar_sala.php" method="post" submit style ="margin-top: 20px;">
<?php

$sql="SELECT * FROM `usuarios` WHERE id=$id";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)) {
    $nome = $array['nome'];
	$cpf = $array['cpf'];
	$sexo = $array['sexo'];
	$tag = $array['tag'];
    $id_super = $array['id'];


?>
<div class="mb-3">
    <label>Nome do usuario</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>" disabled>
	<input type="number" class="form-control" name="id" value="<?php echo $id_super ?>" style="display: none">
</div>
<div class="mb-3">
<label>CPF do Usuario</label>
<input type="text" class="form-control" name="cpf" value="<?php echo $cpf ?>" placeholder="Insira o CPF do usuario!!!" required autocomplete="off"  onkeypress="$(this).mask('000.000.000-00');" disabled>
</div>
<div class="mb-3">
    <input type="text" class="form-control" name="sexo" value="<?php echo $sexo ?>" style="display: none" disabled>
</div>
<div class="mb-3">
    <label>Tag do usuario</label>
    <input type="text" class="form-control" name="tag" value="<?php echo $tag ?>" readonly>
</div>

<div class="mb-3"> 
<label>Selecione o ambiente</label>
<select type="text" class="form-select" name="ambiente"  aria-label="Default select example" required>
  <?php
  
  $sql= "SELECT * FROM ambiente";
  
  $buscar=mysqli_query($conexao,$sql);
  while ($array=mysqli_fetch_array($buscar)){
	  $id_local=$array['id_local'];
	  $nome_local=$array['nome_local'];
	  
	
	$recebe=ativa($tag,$id_local);
	//$recebe=0;
  ?>
  
  <?php if($recebe > 0){ ?>
 
 <option value="<?php echo $id_local ?>"><?php echo $nome_local ?></option>

  <?php } ?>
 
 
  <?php } ?>
</select>
</div>




<div style="text-align: right;">
<button type="submit" id="botao" class="btn btn-sm">Excluir</button>
</div>
</form>
 <?php } ?>
</div>


<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
<?php }else{

header('Location: home.php');

}
?>

<?php

function ativa($tag,$id_local){
include 'conexao.php'; 
	$contador=0;
	$sql1="SELECT * FROM `sala`";
   $buscar1 = mysqli_query($conexao,$sql1);	
   while ($array1=mysqli_fetch_array($buscar1)){
	  $id_local1 = $array1['id_local'];
	  $tag1= $array1['tag'];
	if($tag1 == $tag && $id_local1==$id_local){
	$contador=$contador + 1;	
		
	}
	
}	
return $contador;


}
?>
