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
			background-color: #008000; /*cor de fundo*/
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


$data_inicial = isset($_GET['valor1']);

if($data_inicial){
$data_inicial = $_GET['valor1'];
//echo "cadastrou $search"; 

}else{
//echo "nao cadastrou";
$data_inicial=NULL;
}

$data_final = isset($_GET['valor2']);

if($data_final){
$data_final = $_GET['valor2'];
//echo "cadastrou $search"; 

}else{
//echo "nao cadastrou";
$data_final=NULL;
}

$hora_inicial = isset($_GET['valor3']);

if($hora_inicial){
$hora_inicial = $_GET['valor3'];
//echo "cadastrou $search"; 

}else{
//echo "nao cadastrou";
$hora_inicial=NULL;
}

$hora_final = isset($_GET['valor4']);

if($hora_final){
$hora_final = $_GET['valor4'];
//echo "cadastrou $search"; 

}else{
//echo "nao cadastrou";
$hora_final=NULL;
}
?>


<div class="container" style="margin-top: 10px; margin-bottom: 300px" id = "tamanho">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
   <div class="container" id="tamanho">
   <div style="text-align: right; margin-bottom: 10px">
<a href="vincular_sala.php" role="button" class="btn btn-sm btn-primary">Atualizar</a>
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="selecao_ambiente.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<h5>Cadastrar no ambiente</h5>

<form  action="selecionar_usuarios.php" method="get" submit="Cadastrar">

                    <div class="form-group" id="tamanho" >
                        <input class="form-control" type="text"  name="search" placeholder="Pesquisar"/>
						<input type="text" class="form-control" name="id_local" value="<?php echo $_GET['id_local'] ?>" style="display: none">
                    </div>
                    <div class="text-right" style="text-align: left; margin-top: 10px; margin-bottom: 5px">
                        <input type="submit" value="Buscar" class="btn btn-sm btn-primary"/>
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
<form action="salvar_varios.php" method="get" submit>
<table class="table table-bordered">
  <thead>
    <tr>
	  <th scope="col"></th>
      <th scope="col">#Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Sexo</th>
      <th scope="col">Tag</th>
	  <th scope="col">Ação</th>

    </tr>
  </thead>
  
<input type="text" class="form-control" name="id_local" value="<?php echo $id_local ?>" style="display: none">
<input type="text" class="form-control" name="valor1" value="<?php echo $data_inicial ?>" style="display: none">
<input type="text" class="form-control" name="valor2" value="<?php echo $data_final ?>" style="display: none">
<input type="text" class="form-control" name="valor3" value="<?php echo $hora_inicial ?>" style="display: none">
<input type="text" class="form-control" name="valor4" value="<?php echo $hora_final ?>" style="display: none">
<?php

if($search == NULL){ 

$sql= "SELECT * FROM `usuarios`";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $id=$array['id'];
  $resposta=ativa($tag,$id_local);
if($resposta == 0){
?>

   
    <tr>
	<td><input type="checkbox" name="tag[]" value="<?php echo $tag ?>"></td>
    <td><?php echo $nome ?></td>
    <td><?php echo $cpf ?></td>
    <td><?php echo $sexo ?></td>
    <td><?php echo $tag ?></td>
	<td><a class="btn btn-success btn-sm" style="width:130px" href="cadastrar_sala2.php?tag=<?php echo $tag ?>&id_local=<?php echo $id_local ?>&data_inicial=<?php echo $data_inicial ?>&data_final=<?php echo $data_final ?>&hora_inicial=<?php echo $hora_inicial?>&hora_final=<?php echo $hora_final ?>" role="button"><i class="far fa-edit"></i>&nbsp;cadastrar</a></td>
    </tr> 
  
  <?php } ?>
  <?php } ?>

<?php }else{  

$sql= "SELECT * FROM `usuarios` WHERE nome like '%$search%' or cpf like '%$search%'";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)) {
  $nome=$array['nome'];
  $cpf=$array['cpf'];
  $sexo=$array['sexo'];
  $tag=$array['tag'];
  $id=$array['id'];

$resposta=ativa($tag,$id_local);
if($resposta == 0){
?>
   <tr>
   <td><input type="checkbox" name="tag[]" value="<?php echo $tag ?>"></td>
    <td><?php echo $nome ?></td>
    <td><?php echo $cpf ?></td>
    <td><?php echo $sexo ?></td>
    <td><?php echo $tag ?></td>
	<td><a class="btn btn-success btn-sm" style="width:130px" href="cadastrar_sala2.php?tag=<?php echo $tag ?>&id_local=<?php echo $id_local ?>&data_inicial=<?php echo $data_inicial ?>&data_final=<?php echo $data_final ?>&hora_inicial=<?php echo $hora_inicial?>&hora_final=<?php echo $hora_final ?>" role="button"><i class="far fa-edit"></i>&nbsp;cadastrar</a></td>
    <?php } ?>
    </tr> 

<?php } ?> 



<?php } ?> 

</table>
<button type="submit" class="btn btn-success btn-sm"  class="btn btn-sm"><i class="far fa-edit"></i>&nbsp;CadastrarX</button>
</form>


</div>
</div>


<script language="JavaScript">
  function marcar(){
    var boxes = document.getElementsByName("tag[]");
    for(var i = 0; i < boxes.length; i++)
      boxes[i].checked = true;
  }
    
  function desmarcar(){
    var boxes = document.getElementsByName("tag[]");
    for(var i = 0; i < boxes.length; i++)
      boxes[i].checked = false;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

<?php
function ativa($tag,$id_local){
include 'conexao.php';
	$contador=0;
	$sql1="SELECT * FROM `sala`";
   $buscar1 = mysqli_query($conexao,$sql1);	
   while ($array1=mysqli_fetch_array($buscar1)){
	  $id_local1 = $array1['id_local'];
	  $tag1= $array1['tag'];
	if($tag1 == $tag && $id_local1==$id_local){
	
	$contador=$contador+1;	
		
	}
	
}	
return $contador;


}

?>