
<?php

include 'conexao.php';

$id=$_POST['id'];

$nome = $_POST['nome'];
$email = $_POST['email'];
$nivel = $_POST['nivelusuario'];

$sql="UPDATE `usuario_externo` SET `nome`='$nome',`email`='$email',`nivel`='$nivel' WHERE id_usuario = $id";


$atualizar = mysqli_query($conexao,$sql);


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>

<div class="container" style="margin-top: 10px">
<center>
	<h3>Atualizado com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="Aprovar_usuarios2.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>