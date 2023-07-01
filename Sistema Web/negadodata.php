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

#botao{

width: 130px;

}

#botao2 {
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
include 'retornar.php';
include 'conexao.php';
$sql= "SELECT `nivel` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$nivel = $array['nivel'];

?>


<div class="container" style="margin-top: 10px; margin-bottom: 300px" id="tamanho">


<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id = "tamanho">
   <div style="text-align: right; margin-bottom: 10px">
<a href="negadodata.php" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="negado.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h5>Historico de acessos negados</h5>

<form action=negadodata.php method=POST submit>
<p>Data Inicial: <input type=datetime-local name=DataI autocomplete="off" required /></p>
<p>Data Final: <input type=datetime-local name=DataF autocomplete="off" required /></p>
<p><input type=submit /></p>
</form>
  
</div>
</nav>
<?php if($nivel == 1){ ?>
<div style="text-align: left; margin-bottom: 10px; margin-top: 10px">
<a class="btn btn-success btn-sm"  style = "background-color: #008000" href="javascript:marcar()">Marcar Todas</a>
<a class="btn btn-danger btn-sm" style = "background-color: #FF0000" href="javascript:desmarcar()">Desmarcar Todas</a> 
</div>
<?php }  ?>

<div class="table-responsive">
<form action="excluir_varios_negadodata.php" method="post" submit>
<table class="table table-bordered">
  <thead>
    <tr>
	<?php if($nivel == 1){ ?>
	  <th scope="col">#</th>
	<?php } ?>
      <th scope="col">#TAG</th>
	  <th scope="col">#LOCAL</th>
	  <th scope="col">#ID_LOCAL</th>
      <th scope="col">DATAHORA</th>
	  <?php if($nivel == 1){ ?>
	  <th scope="col">CADASTRAR/EXCLUIR</th>
	  <?php } ?>

    </tr>
  </thead>
  
 

<?php

$resultado=isset($_POST['DataI']);
$resultado2=isset($_POST['DataF']);
if($resultado == 1 && $resultado2 == 1){
$coletor = $_POST['DataI'];
$coletor2 = $_POST['DataF'];


$sql = "SELECT `tag`, `datatime`, `nome_local`,`id_local`,`id` FROM `acessonegado` WHERE datatime > '" . $_POST['DataI'] . "' AND  datatime < '" . $_POST['DataF']. "'"; 

$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
$tag=$array['tag'];
$local=$array['nome_local'];
$id_local= $array['id_local'];
$Datatime=$array['datatime'];
$id=$array['id'];

$timestamp = strtotime($Datatime); 
$newDate = date("d/m/Y H:i:s",$timestamp);
	
?>

    <tr>
	<?php if($nivel == 1){ ?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
    <td><?php echo $tag ?></td>
	<td><?php echo $local ?></td>
	<td><?php echo $id_local ?></td>
    <td><?php echo $newDate ?></td>
    <?php if($nivel==1){ ?>
    <td>
	<?php if(0 == retorno($id)){ ?>
	<a class="btn btn-warning btn-sm" id="botao" href="negadodata_editar.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Cadastrar </a>
    <?php }else{ ?>
	<a class="btn btn-success btn-sm" id="botao" href="negadodata_editar.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Vinculado </a>
	<?php } ?>
    <a class="btn btn-danger btn-sm" id="botao" href="deletar_negadodata.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
	</td>
	<?php } ?>
    </tr> 
  

   <?php } ?>


<?php }else{  ?>


  <?php 
 
$sql = "SELECT * FROM `acessonegado` ORDER BY `datatime` DESC";

$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
$tag=$array['tag'];
$local=$array['nome_local'];
$id_local= $array['id_local'];
$Datatime=$array['datatime'];
$id=$array['id'];

$timestamp = strtotime($Datatime); 
$newDate = date("d/m/Y H:i:s",$timestamp);

  ?>


    <tr>
	<?php if($nivel == 1){ ?>
	<td><input type="checkbox" name="id[]" value="<?php echo $id ?>"></td>
	<?php } ?>
    <td><?php echo $tag ?></td>
	<td><?php echo $local ?></td>
	<td><?php echo $id_local ?></td>
    <td><?php echo $newDate ?></td>
    <?php if($nivel==1){ ?>
	<td>
	<?php if(0 == retorno($id)){ ?>
	<a class="btn btn-warning btn-sm" id="botao" href="negadodata_editar.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Cadastrar </a>
    <?php }else{ ?>
	<a class="btn btn-success btn-sm" id="botao" href="negadodata_editar.php?id=<?php echo $id ?>" role="button"><i class="far fa-edit"></i>&nbsp;Vinculado </a>
	<?php } ?>
    <a class="btn btn-danger btn-sm" id="botao" href="deletar_negadodata.php?id=<?php echo $id ?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a>
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

