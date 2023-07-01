<!DOCTYPE html>
<html>
<head>
	<title>Lista de Usuarios </title>
	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="60">
<style type="text/css">

#tamanho{
max-width: 1300px;
width: 100%;
margin: 0 auto;
    }


#casa{

margin-top: 10px;

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



<div class="container" id= "tamanho" style="margin-top: 10px; margin-bottom: 300px">



<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id = "tamanho">
   
   <div style="text-align: right; margin-bottom: 10px">
<a href="Historico.php" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h5>Historico de acessos permitidos</h5>

<form action="Historico.php" method="post" submit="Cadastrar">

                    <div class="form-group" id="tamanho" >
                        <input class="form-control " type="text"  name="search" placeholder="Pesquisar"/>
                    </div>
                    
                    <div class="text-right" style="text-align: left; margin-top: 10px; margin-bottom: 5px">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary" />
                        <a href="buscadata.php" role="button" class="btn btn-sm btn-primary">Busca por Data</a>
                    </div>
                    
                    
                
              
            
</form>
</div>
</nav>
<?php if($nivel == 1){ ?>
<div style="text-align: left; margin-bottom: 10px; margin-top: 5px">
<a class="btn btn-success btn-sm"  style = "background-color: #008000" href="javascript:marcar()">Marcar Todas</a>
<a class="btn btn-danger btn-sm" style = "background-color: #FF0000" href="javascript:desmarcar()">Desmarcar Todas</a> 
</div> 
<?php } ?>
<div class="table-responsive">
<form action="excluir_varios_historico.php" method="post" submit>
<table class="table table-bordered">
  <thead>
    <tr>
	<?php if($nivel == 1){ ?>
	  <th scope="col">#</th>
	<?php } ?>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
       <th scope="col">Tag</th>
	   <th scope="col">local</th>
	   <th scope="col">id_local</th>
      <th scope="col">Datahora</th>
     
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

$sql= "SELECT * FROM `acessos` ORDER BY `datatime` DESC";


$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
	$nome=$array['nome'];
	$cpf=$array['cpf'];
    $tag=$array['tag'];
	$local=$array['nome_local'];
	$id_local=$array['id_local'];
	$datatime=$array['datatime'];
    $id=$array['id'];
	
$timestamp = strtotime($datatime); 
$newDate = date("d/m/Y H:i:s",$timestamp);

?>
   
    <tr>
	<?php if($nivel == 1){ ?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
    <td><?php echo $nome ?></td>
    <td><?php echo $cpf ?></td>
    <td><?php echo $tag ?></td>
	<td><?php echo $local?></td>
	<td><?php echo $id_local ?></td>
    <td><?php echo $newDate ?></td>
	<?php if($nivel==1){ ?>
    <td>
    <a class="btn btn-danger btn-sm" href="deletar_historico.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
    </td>
	<?php } ?>
    </tr> 
    

  <?php } ?>

<?php }else{  



$sql= "SELECT * FROM `acessos` WHERE nome like '%$search%' or cpf like '%$search%' or tag like '%$search%' or nome_local like '%$search%' or id_local like '%$search%'";

$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome'];
  $cpf=$array['cpf'];
  $tag=$array['tag'];
  $local=$array['nome_local'];
  $id_local=$array['id_local'];
  $datatime=$array['datatime'];
  $id=$array['id'];
  
$timestamp = strtotime($datatime); 
$newDate = date("d/m/Y H:i:s",$timestamp);

?>
    <tr>
	<?php if($nivel == 1){ ?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
     <td><?php echo $nome ?></td>
	<td><?php echo $cpf ?></td>
    <td><?php echo $tag ?></td>
	<td><?php echo $local?></td>
	<td><?php echo $id_local ?></td>
    <td><?php echo $newDate ?></td>
	<?php if($nivel==1){ ?>
    <td>
    <a class="btn btn-danger btn-sm" href="deletar_historico.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
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