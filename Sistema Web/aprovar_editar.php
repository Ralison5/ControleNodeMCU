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

include 'conexao.php';

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
			background-color: #5CC5AB; /*cor de fundo*/
			color: #ffffff; /*cor da letra*/
			font-weight: bold;
		}
	</style>
	<!-- CSS only -->
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<?php if($nivel== 1){ ?>
<div class= "container" id= "tamanhocontainer" style="margin-top: 10px; margin-bottom: 300px;">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="Aprovar_usuarios.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Formulário de cadastro</h4>
<form action="aprovar_atualizar.php" method="post" submit style ="margin-top: 20px;">
<?php

$sql= "SELECT `nome`, `email`, `id_usuario`,`nivel` FROM `usuario_externo` WHERE id_usuario = $id";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)) {
    $nome=$array['nome'];
  $email=$array['email'];
  $id_usuario=$array['id_usuario'];
  $nivel=$array['nivel'];


?>
<div class="mb-3">
    <label>Nome do usuario</label>
    <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>">
    <input type="number" class="form-control" name="id" value="<?php echo $id_usuario ?>" style="display: none">
</div>

<div class="mb-3">
    <label>E-mail do usuario</label>
    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
</div>


<div class="form-group"style="margin-top:10px; margin-bottom:10px">
<label>Nivel de acesso</label>
<select name="nivelusuario" class="form-control" >
<?php if($nivel==1 || $nivel == 2){?>
<option value="1">Administrador</option>
<option value="2">Conferente</option>
<?php }else{?>
<option value="2">Conferente</option>
<option value="1">Administrador</option>
<?php }?>
</select>
</div>




<div style="text-align: right;">
<button type="submit" id="botao" class="btn btn-sm">Atualizar</button>
</div>
</form>
 <?php } ?>
</div>
<?php }else{ 
header('Location: home.php');
}
?>


<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>