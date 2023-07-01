<!DOCTYPE html>
<html>
<head>
  <title>Lista de Usuarios </title>
  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<style type="text/css">

#tamanho{
max-width: 1300px;
width: 100%;
margin: 0 auto;
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
<div class="container" style="margin-top: 10px; margin-bottom: 300px" id = "tamanho">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id="tamanho">
   <div style="text-align: right; margin-bottom: 10px">
<a href="vincular_sala.php" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar_ambiente2.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<h5>Cadastrar no ambiente</h5>

<form  action="vincular_sala.php" method="post" submit="Cadastrar">

                    <div class="form-group" id="tamanho" >
                        <input class="form-control" type="text"  name="search" placeholder="Pesquisar"/>
                    </div>
                    <div class=text-right style="text-align: left; margin-top: 10px; margin-bottom: 5px">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary" />
                    </div>
</form>
<div style="text-align: right; margin-bottom: 10px">
<a href="selecao_ambiente.php" role="button" class="btn btn-sm btn-success">Opção 2</a> 
</div>  
</div>
</div>
</nav>


<div class="table-responsive">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Sexo</th>
      <th scope="col">Tag</th>

    </tr>
  </thead>
  
 

<?php
include 'conexao.php';


$resultado=isset($_POST['search']);

if($resultado){
$search = $_POST['search'];
//echo "cadastrou $search"; 

}else{

//echo "nao cadastrou";
$search=NULL;
}



  if($search == NULL){ 

$sql= "SELECT * FROM `usuarios` WHERE `nivel`=1 ";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $id=$array['id'];

?>
  

   
    <tr>
    <td><?php echo $nome ?></td>
    <td><?php echo $cpf ?></td>
    <td><?php echo $sexo ?></td>
    <td><?php echo $tag ?></td>
	<?php if($nivel == 1 || $nivel == 2){ ?>
    <td>
	<a class="btn btn-success btn-sm" style="width:130px" href="cadastrar_sala.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;cadastrar</a>
	<a class="btn btn-danger btn-sm" style="width:130px" href="excluir_sala.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
	</td>
	<?php } ?>
    </tr> 
  

  <?php } ?>

<?php }else{  



$sql= "SELECT * FROM `usuarios` WHERE nome like '%$search%' or cpf like '%$search%' or `tag` like '%$search%'";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
   $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $id=$array['id'];
  $fase=$array['nivel'];


?>
   <tr>
     <?php if($fase == 1){ ?>
    <td><?php echo $nome ?></td>
    <td><?php echo $cpf ?></td>
    <td><?php echo $sexo ?></td>
    <td><?php echo $tag ?></td>
	<?php if($nivel == 1){ ?>
    <td>
	<a class="btn btn-success btn-sm" style="width:130px" href="cadastrar_sala.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;cadastrar</a>
	<a class="btn btn-danger btn-sm" style="width:130px" href="excluir_sala.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
	</td>
    <?php } ?>
	<?php } ?>
    </tr> 


<?php } ?> 



<?php } ?> 

</table>




</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>