<!DOCTYPE html>
<html>
<head>
	<title>Menu alternativo</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


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

<?php if($nivel == 1){?>
<div class="container" style="width: auto; margin-top: 10px;margin-bottom:300px">
<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
</div>


<div class="card">
  <div class="card-header">
    Cadastrar Administrador 
  </div>
  <div class="card-body">
    <h5 class="card-title">Cadastro de novos Administradores</h5>
    <p class="card-text">Cadastrar administradores e definir nivel de privilegios.</p>
	<?php if($nivel == 1){ ?>
    <a href="cadastro_usuario.php" class="btn btn-success">Cadastrar agora</a>
	<?php }else{?>
	<a href="alternar_aprovar.php" class="btn btn-danger">ACESSO NEGADO</a>	
	<?php } ?>
  </div>
  </div>


	<div class="card" style="margin-top: 10px">
  <div class="card-header">
    Selecionar privilegios
  </div>
  <div class="card-body">
    <h5 class="card-title">Atribuir privilegios</h5>
    <p class="card-text">atribuir privilegios para Administrador.</p>
  <?php if($nivel==1){ ?>
    <a href="Aprovar_usuarios.php" class="btn btn-success">Atribuir agora</a>
  <?php }else{ ?>
  <a href="alternar_aprovar.php" class="btn btn-danger">ACESSO NEGADO</a>
  <?php } ?>  
  </div>
  </div>

  <div class="card" style="margin-top: 10px; margin-bottom: 10px">
  <div class="card-header">
    Modificar privilegios
  </div>
  <div class="card-body">
    <h5 class="card-title">Alterar privilegios</h5>
    <p class="card-text">Modificar privilegios de administrador.</p>
   
	<?php if($nivel==1){ ?>
        <a href="Aprovar_usuarios2.php" class="btn btn-success">Modificar agora</a>
		<?php }else{ ?>
		<a href="alternar_aprovar.php" class="btn btn-danger">ACESSO NEGADO</a>
		<?php } ?>
	
  </div>
</div>

</div>
<?php }else{
	
header('Location: home.php');	
	
}	?>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>