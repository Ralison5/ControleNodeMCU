

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
if($nivel == 1){
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

<!-- bootstrap 3.0.3 utilizado para implementar o cpf -->
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//assets.locaweb.com.br/locastyle/2.0.6/stylesheets/locastyle.css">


	<title>Editar</title>
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

<div class= "container" id= "tamanhocontainer" style="margin-top: 10px; margin-bottom: 300px">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="listar_produtos.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Formulário de cadastro</h4>
<form action="_atualizar_produto.php" enctype="multipart/form-data" method="post"  style ="margin-top: 20px;" submit>
<?php

$sql="SELECT * FROM `usuarios` WHERE id=$id";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)) {
    $nome = $array['nome'];
	$cpf = $array['cpf'];
	$rg = $array['rg'];
	$sexo = $array['sexo'];
	$email = $array['email'];
	$tag = $array['tag'];
    $telefone = $array['telefone'];
    $id_super = $array['id'];


?>
<div class="mb-3">
    <label>Nome do usuario</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>">
    <input type="number" class="form-control" name="id" value="<?php echo $id_super ?>" style="display: none">
</div>
<div class="mb-3">
<label>CPF do Usuario</label>
<input type="text" class="form-control cpf-mask" name="cpf" value="<?php echo $cpf ?>" placeholder="Insira o CPF do usuario!!!" required autocomplete="off">
</div>
<div class="mb-3">
    <label>Numero do RG</label>
    <input type="text" class="form-control" name="rg" value="<?php echo $rg ?>">
</div>
<div class="mb-3">
<label>Sexo do usuario</label>
<select type="text" class="form-select" name="sexo"  aria-label="Default select example" required>
 <?php if($sexo == NULL){ ?> 
  <option selected></option>
  <option>Masculino</option>
  <option>Feminino</option>
  <?php }else if($sexo=="Feminino"){ ?>
	<option>Feminino</option>  
	<option>Masculino</option> 
  <?php }else{ ?>
	<option> Masculino </option>
    <option>Feminino</option>    
 <?php } ?>
</select>
</div>

<div class="mb-3">
    <label>E-mail do usuario</label>
    <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
</div>
<div class="mb-3">
    <label>Tag do usuario</label>
    <input type="text" class="form-control" name="tag" value="<?php echo $tag ?>">
</div>
<div class="mb-3">
    <label>Telefone do usuario</label>
    <input type="text" class="form-control" name="telefone" value="<?php echo $telefone ?>">
</div>
<div class="mb-3">
    <label>Adicione o CPF e o RG</label>
	</br>
    <input type="file" name="arquivo" autocomplete="off">
</div>



<div style="text-align: Left; margin-bottom: 10px">
<button type="submit" id="botao" class="btn btn-sm">Atualizar</button>
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

<!-- Atente-se para a ordem: primeiro jquery, depois locastyle, depois o JS do Bootstrap. -->
<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="//assets.locaweb.com.br/locastyle/2.0.6/javascripts/locastyle.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>