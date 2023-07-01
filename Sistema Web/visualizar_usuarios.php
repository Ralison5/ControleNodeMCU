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


<?php
include 'conexao.php';

$id_local = isset($_GET['id_local']);

if($id_local){
$id_local = $_GET['id_local'];
//echo "cadastrou $search"; 

}else{
//echo "nao cadastrou";
$id_local=NULL;
}

$resultado=isset($_GET['search']);

if($resultado){
$search = $_GET['search'];
//echo "cadastrou $search"; 

}else{

//echo "nao cadastrou";
$search=NULL;
}
?>


<div class="container" style="margin-top: 10px; margin-bottom: 300px" id = "tamanho">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id="tamanho">
   <div style="text-align: right; margin-bottom: 10px">
<a href="visualizar_usuarios.php?id_local=<?php echo $id_local ?>" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="seletora1.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<h5>Visualizar no ambiente</h5>

<form  action="visualizar_usuarios.php" method="get" submit="Cadastrar">

                    <div class="form-group" id="tamanho" >
                        <input class="form-control" type="text"  name="search" placeholder="Pesquisar"/>
						<input type="text" class="form-control" name="id_local" value="<?php echo $_GET['id_local'] ?>" style="display: none">
                    </div>
                    <div class=text-right style="text-align: left; margin-top: 10px; margin-bottom: 5px">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary" />
                    </div>
</form>

<div style="text-align: left; margin-bottom: 5px">
<a class="btn btn-success btn-sm"  style = "background-color: #008000" href="javascript:marcar()">Marcar Todas</a>
<a class="btn btn-danger btn-sm" style = "background-color: #FF0000" href="javascript:desmarcar()">Desmarcar Todas</a> 
</div>  
</div>
</div>
</nav>


<div class="table-responsive">
<form action="seletora_deletar.php" method="get" submit>
<table class="table table-bordered">
  <thead>
    <tr>
	  <th scope="col"></th>
      <th scope="col">#Nome</th>
      <th scope="col">CPF</th>
	  <th scope="col">Tag</th>
      <th scope="col">Sexo</th>
	  <th scope="col">Ambiente</th>
	  <th scope="col">Id_local</th>
	  <th scope="col">Excluir</th>

    </tr>
  </thead>
  
<input type="text" class="form-control" name="id_local" value="<?php echo $id_local ?>" style="display: none">

<?php

if($search == NULL){ 

$sql= "SELECT * FROM `sala` WHERE id_local= $id_local";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $ambiente=$array['id_local'];
  $nome_local=$array['nome_local'];
  $id=$array['id'];
  $id_usuario=$array['id_usuario'];
  
  
  if($id_local==$ambiente){
?>

   <tr>
   <td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
    <td><?php echo $nome?></td>
    <td><?php echo $cpf?></td>
	<td><?php echo $tag?></td>
    <td><?php echo $sexo?></td>
	<td><?php echo $nome_local ?></td>
	<td><?php echo $ambiente ?></td>
	<?php if($nivel==1 || $nivel == 2){ ?>
    <td>
	<a class="btn btn-warning btn-sm" href="editar_data.php?id=<?php echo $id ?>&id_local=<?php echo $id_local?>&id_usuario=<?php echo $id_usuario ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar </a>
    <a class="btn btn-danger btn-sm" href="deletar_basico1.php?id=<?php echo $id ?>&id_local=<?php echo $id_local?>&id_usuario=<?php echo $id_usuario ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
    </td>
    <?php } ?>
    </tr> 
  

  <?php } ?>
<?php } ?>
<?php }else{  

$sql= "SELECT * FROM `sala` WHERE nome like '%$search%' or cpf like '%$search%' or nome_local like '%$search%' or tag like '%$search%' or id_local like '%$search%'";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
 $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $ambiente = $array['id_local'];
  $nome_local=$array['nome_local'];
  $id=$array['id'];
  $id_usuario=$array['id_usuario'];

   
if($id_local==$ambiente){
?>
   <tr>
    <td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
    <td><?php echo $nome?></td>
    <td><?php echo $cpf?></td>
	<td><?php echo $tag?></td>
    <td><?php echo $sexo?></td>
	<td><?php echo $nome_local ?></td>
	<td><?php echo $ambiente ?></td>
	<?php if($nivel==1 || $nivel == 2){ ?>
    <td>
	<a class="btn btn-warning btn-sm" href="editar_data.php?id=<?php echo $id ?>&id_local=<?php echo $id_local?>&id_usuario=<?php echo $id_usuario ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar </a>
    <a class="btn btn-danger btn-sm" href="deletar_basico1.php?id=<?php echo $id ?>&id_local=<?php echo $id_local?>&id_usuario=<?php echo $id_usuario ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
    </td>
    <?php } ?>
    </tr> 



<?php } ?>

<?php } ?> 

<?php } ?>

</table>

<button type="submit" class="btn btn-danger btn-sm" class="btn btn-sm"><i class="far fa-trash-alt"></i>&nbsp;Excluir</button>
</form>


</div>
</div>


<script language="JavaScript">
  function marcar(){
    var boxes = document.getElementsByName("id[]");
    for(var i = 0; i < boxes.length; i++)
      boxes[i].checked = true;
  }
    
  function desmarcar(){
    var boxes = document.getElementsByName("id[]");
    for(var i = 0; i < boxes.length; i++)
      boxes[i].checked = false;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

