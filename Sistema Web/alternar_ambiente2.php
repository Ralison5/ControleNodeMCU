<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
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


<div class="container" style="width: auto; margin-top: 10px">
  <div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
</div>

	<div class="card">
  <div class="card-header">
    Vincular usuario ao ambiente
  </div>
  <div class="card-body">
    <h5 class="card-title">Vincular</h5>
    <p class="card-text">Vincular usuarios.</p>
    <a href="vincular_sala.php" class="btn btn-success">Vincular agora</a>
  </div>
  </div>

  <div class="card" style="margin-top: 10px">
  <div class="card-header">
    Visualizar ambientes 
  </div>
  <div class="card-body">
    <h5 class="card-title">Visualizar</h5>
    <p class="card-text">Visualizar os usuarios vinculados ao ambiente.</p>
    <a href="seletora1.php" class="btn btn-success">Visualizar agora</a>
  </div>
</div>

<div class="card" style="margin-top: 10px">
  <div class="card-header">
    Visualizar datas e horas  
  </div>
  <div class="card-body">
    <h5 class="card-title">Data e Hora</h5>
    <p class="card-text">Visualizar as datas e horarios vinculados ao ambiente.</p>
    <a href="data_hora.php" class="btn btn-success">Visualizar agora</a>
  </div>
</div>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>