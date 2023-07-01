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

#botao {
			background-color: #FF0000; /*cor de fundo*/
			color: #ffffff; /*cor da letra*/
			font-weight: bold;
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
<div class="container" style="margin-top: 10px;margin-bottom:300px" id = "tamanho">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id = "tamanho">
   <div style="text-align: right; margin-bottom: 10px">
<a href="listar_ambiente.php" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar_ambiente.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<h5>Listagem de usuarios</h5>

<form  action="listar_ambiente.php" method="post" submit="Cadastrar">

                    <div class="form-group" id="tamanho" >
                        <input class="form-control" type="text"  name="search" placeholder="Pesquisar"/>
                    </div>
					
                    <div class=text-right style="text-align: left; margin-top: 10px; margin-bottom: 5px">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary" />
                    </div>
</form>
<?php if($nivel == 1){ ?>  
<div style="text-align: left; margin-bottom: 5px; margin-top: 5px">
<a class="btn btn-success btn-sm"  style = "background-color: #008000" href="javascript:marcar()">Marcar Todas</a>
<a class="btn btn-danger btn-sm" style = "background-color: #FF0000" href="javascript:desmarcar()">Desmarcar Todas</a> 
</div>
<?php } ?>  
  
</div>
</div>
</nav>


<div class="table-responsive">
<form action="deletar_varios_ambiente.php" method="post" submit>
<table class="table table-bordered">
  <thead>
    <tr>
	<?php if($nivel == 1){?>
	  <th scope="col">#</th>
	<?php } ?>
      <th scope="col"><center>#Ambiente</center></th>
      <th scope="col"><center>Numero ID</center></th>
      <th scope="col">Editar/Excluir</th>
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

$sql= "SELECT * FROM `ambiente`";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome_local'];
  $id=$array['id_local'];

?>
  
   
    <tr>
	<?php if($nivel == 1){?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
    <td><center><?php echo $nome ?></center></td>
    <td><center><?php echo $id ?></center></td>
	<?php if($nivel == 1){ ?>
    <td>
	<a class="btn btn-warning btn-sm" style="width:130px" href="editar_ambiente.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar </a>
    <a class="btn btn-danger btn-sm" style="width:130px" href="deletar_ambiente.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
	</td>
	<?php }else{?> 
	<td>
	 <a class="btn btn-danger btn-sm" style="width:130px" href="listar_ambiente.php?id=<?php echo $id ?>" role="button">Acesso negado</a>
	</td>
	<?php } ?>
    </tr> 
  

  <?php } ?>

<?php }else{  



$sql= "SELECT * FROM `ambiente` WHERE nome_local like '%$search%' or id_local like '%$search%'";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
$nome=$array['nome_local'];
$id=$array['id_local'];

?>
    <tr>
	<?php if($nivel == 1){?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
    <td><center><?php echo $nome ?></center></td>
    <td><center><?php echo $id ?></center></td>
	<?php if($nivel==1){ ?>
    <td>
	<a class="btn btn-warning btn-sm" style="width:130px" href="editar_ambiente.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Editar </a>
    <a class="btn btn-danger btn-sm" style="width:130px" href="deletar_ambiente.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
    </td>
    <?php } ?>
    </tr> 


<?php } ?> 



<?php } ?> 

</table>
<?php if($nivel == 1){ ?>
<button type="submit" class="btn btn-danger btn-sm" class="btn btn-sm"><i class="far fa-trash-alt"></i>&nbsp;Excluir</button>
<?php } ?>
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