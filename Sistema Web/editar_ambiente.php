

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

<div class= "container" id= "tamanhocontainer" style="margin-top: 10px; margin-bottom:300px">

<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="listar_ambiente.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Formulário de cadastro</h4>
<form action="_atualizar_ambiente.php" method="post" submit style ="margin-top: 20px;">
<?php

$sql="SELECT * FROM `ambiente` WHERE id_local=$id";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)) {
    $nome = $array['nome_local'];
    $id_super = $array['id_local'];


?>
<div class="mb-3">
<label>Nome do Local</label>
<input type="text" class="form-control" name="nome" value="<?php echo $nome ?>" required>

</div>
<div class="mb-3">
<label>Numero ID</label>
<input type="number" class="form-control" name="id" value="<?php echo $id_super ?>" readonly>
</div>
<div style="text-align: right;">
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