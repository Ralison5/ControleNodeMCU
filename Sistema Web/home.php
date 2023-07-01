<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

#tamanho{
	
width: 130px;	
	
	
}


</style>

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


<div class="container" style="width: auto; margin-bottom: 300px;">
  <div style="text-align: right; margin-top: 10px; margin-bottom: 10px;">
  <a> <?php echo $usuario ?> </a>
<a href="logoff.php" role="button" class="btn btn-sm btn-primary">Sair</a>
</div>

	<div class="row">
	
  <div class="col-sm-6" style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Cadastrar Usuarios</h5>
        <p class="card-text">Opção para cadastrar novos usuarios no sistema.</p>
		<?php if($nivel==1){ ?>
        <a href="adicionar_produto.php" class="btn btn-primary" id="tamanho">Cadastrar</a>
		<?php }else{ ?>
		<a href="home.php" class="btn btn-danger">ACESSO NEGADO</a>
		<?php } ?>
      </div>
    </div>
  </div>
	
  <div class="col-sm-6" style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Usuarios cadastrados</h5>
		<?php if($nivel == 1){ ?>
        <p class="card-text">Visualizar, editar e excluir os usuarios cadastrados.</p>
		<?php }else{ ?>
		<p class="card-text">Visualizar os usuarios cadastrados.</p>
		<?php } ?>
        <a href="alternar_ambiente3.php" class="btn btn-primary" id="tamanho">Cadastros</a>
      </div>
    </div>
  </div>
  
   <div class="col-sm-6" style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Permissões do sistema</h5>
        <p class="card-text">Configurando permissões de controle do sistema.</p>
		<?php if($nivel == 1){ ?>
        <a href="alternar_aprovar.php" class="btn btn-primary" id="tamanho" >Configurações</a>
		<?php }else{ ?>
		<a href="home.php" class="btn btn-danger">ACESSO NEGADO</a>
		<?php }?>
      </div>
    </div>
  </div>
  
   <div class="col-sm-6"  style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Historico</h5>
        <p class="card-text">Visualizar registros de acesso no sistema.</p>
        <a href="alternar.php" class="btn btn-primary" id="tamanho">Registros</a>
      </div>
    </div>
  </div>
  
  <div class="col-sm-6" style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Cadastrar ambientes</h5>
        <p class="card-text">Cadastrar, visualizar, editar e excluir ambientes.</p>
        <a href="alternar_ambiente.php" class="btn btn-primary" id="tamanho" >Cadastrar</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6" style="margin-bottom: 10px">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Vincular usuarios ao ambiente</h5>
        <p class="card-text">Vincular, desvincular ou visualizar os usuarios no ambiente.</p>
        <a href="alternar_ambiente2.php" class="btn btn-primary" id="tamanho">Entrar</a>
      </div>
    </div>
  </div>
</div>
	
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>