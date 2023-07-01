
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
$nivel1 = $array['nivel'];


?>


<?php

 if($nivel1 == 1 || $nivel1 == 2){
$id=$_POST['id'];

$nome = $_POST['nome'];
$email = $_POST['email'];
$nivel2 = $_POST['nivelusuario'];

$sql="UPDATE `usuario_externo` SET `nome`='$nome',`email`='$email',`nivel`='$nivel2',`status`='ativo' WHERE id_usuario = $id";

$atualizar = mysqli_query($conexao,$sql);

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<div class="container" style="margin-top: 10px">
<center>
	<h3>Atualizado com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="Aprovar_usuarios.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
<?php }else{

header('Location: home.php');

}
?>