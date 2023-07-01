
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
if($nivel==1){
include 'conexao.php';

$nome=$_POST['nome'];
$cpf=$_POST['cpf'];
$rg=$_POST['rg'];
$sexo=$_POST['sexo'];
$email=$_POST['email'];
$tag=$_POST['tag'];
$telefone=$_POST['telefone'];
$arquivo = $_FILES['file'];

$resultado1 = Descobridor1($cpf);
$resultado2 = Descobridor2($rg);
$resultado3 = Descobridor3($tag);
$resultado4 = Descobridor4($email);

$nomeDoArquivo= $arquivo['name'];
$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

if($extensao == "pdf" && $arquivo['size'] <= 5242880){

$pasta= "arquivos/";
$nomeDoArquivo= $arquivo['name']; 
$novoNomeDoArquivo = uniqid();	

if($resultado1 == 0 && $resultado2 == 0 && $resultado3 == 0 && $resultado4 == 0){
$sql= "INSERT INTO `usuarios`(`nome`, `cpf`,`rg`,`sexo`,`email`,`tag`,`telefone`,`nivel`) VALUES ('$nome', '$cpf', '$rg','$sexo', '$email','$tag', '$telefone','1')";
$inserir = mysqli_query($conexao,$sql);

$arquivoPronto = $pasta . $novoNomeDoArquivo . "." .$extensao;
$certo = move_uploaded_file($arquivo['tmp_name'],$arquivoPronto);		

//////////////FAZENDO A ATUALIZAÇÃO DO ID_USUARIO\\\\\\\\\\\\\\
$id_usuario=retorna_id($tag);
$sql1 = "UPDATE `acessonegado` SET `id_usuario`= '$id_usuario' WHERE `tag`='$tag'";
$atualizar = mysqli_query($conexao,$sql1);

if($certo){

$sql= "INSERT INTO `arquivos`(`nome`, `path`,`id_usuario`) VALUES ('$nomeDoArquivo', '$arquivoPronto','$id_usuario')";
$inserir = mysqli_query($conexao,$sql);	
	
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<div style="text-align: right">
<a href="adicionar_produto.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<center><h4>Usuario cadastrado com sucesso <h4></center>
<div style="padding-top: 20px">	
<center>
<a href="adicionar_produto.php" role="button" class="btn btn-sm btn-primary">Cadastrar um novo usuario</a>
</center>
</div>


</div>
<?php }else{  ?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<center>
<?php if( 1 == contador($resultado1,$resultado2,$resultado3,$resultado4)){ ?>
	<h3>Aviso: 
	<?php if($resultado1 > 0 ){ ?>
		
	CPF,	
		
	<?php } ?> 
	<?php if($resultado2 > 0){ ?>
		
	RG,	
		
	<?php } ?> 
	<?php if($resultado3 > 0){ ?>
		
	TAG,	
		
	<?php } ?> 
	<?php if($resultado4 > 0){ ?>
		
	EMAIL,	
		
	<?php } ?> 
	
	já está vinculado a uma conta de usuario.</h3>
<?php }else{ ?>

<h3>Aviso: 
	<?php if($resultado1 > 0 ){ ?>
		
	o CPF,	
		
	<?php } ?> 
	<?php if($resultado2 > 0){ ?>
		
	o RG,
		
	<?php } ?> 
	<?php if($resultado3 > 0){ ?>
		
	a TAG,
		
	<?php } ?> 
	<?php if($resultado4 > 0){ ?>
		
	e o EMAIL,	
		
	<?php } ?> 
	
	 já estão vinculados a uma conta de usuario existente.</h3>



<?php } ?>
	
	<div style="margin-top: 20px">

	<a href="adicionar_produto.php?nome=<?php echo $nome?>&cpf=<?php echo $cpf ?>&rg=<?php echo $rg ?>&email=<?php echo $email ?>&tag=<?php echo $tag ?>&telefone=<?php echo $telefone ?>&sexo=<?php echo $sexo ?>"" role="button" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>

	</div>
</center>

 </div>


<?php }

}else{
	

?>	

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">

<center><h4>Falha, O arquivo não está no formato PDF ou é maior que 5MB!!! <h4></center>
<div style="padding-top: 20px">	
<center> 
<a href="adicionar_produto.php?nome=<?php echo $nome?>&cpf=<?php echo $cpf ?>&rg=<?php echo $rg ?>&email=<?php echo $email ?>&tag=<?php echo $tag ?>&telefone=<?php echo $telefone ?>&sexo=<?php echo $sexo ?>"" role="button" class="btn btn-sm btn-primary">Voltar</a>
</center>
</div>


</div>

<?php	
	
}
 ?>
<?php }else{

header('Location: home.php');

}

?>


<?php	
function Descobridor1($cpf){
include 'conexao.php';	
$resultado = 0;		
$sql1= "SELECT * FROM `usuarios` WHERE `cpf`= '$cpf'";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);
return $resultado;	
}


function Descobridor2($rg){
include 'conexao.php';	
$resultado = 0;		
$sql1= "SELECT * FROM `usuarios` WHERE `rg` = '$rg'";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);
return $resultado;	
}


function Descobridor3($tag){
include 'conexao.php';	
$resultado = 0;		
$sql1= "SELECT * FROM `usuarios` WHERE `tag`='$tag'";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);
return $resultado;	
}



function Descobridor4($email){
include 'conexao.php';	
$resultado = 0;		
$sql1= "SELECT * FROM `usuarios` WHERE `email`= '$email'";
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);
return $resultado;	
}




function contador($num1,$num2,$num3,$num4){
$cont=0;
if($num1 > 0 ){ 
		
	$cont= $cont + 1;	
		
 } 
 if($num2 > 0){
		
	$cont= $cont + 1;	
		
} 
if($num3 > 0){
		
	$cont= $cont + 1;	
		
} 
if($num4 > 0){ 
		
	$cont= $cont + 1;
		
}  	
	
return $cont;	
}

function retorna_id($tag){
include 'conexao.php';
$id_usuario=0;
$sql = "SELECT `id` FROM `usuarios` WHERE `tag`='$tag'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$id_usuario = $array['id'];	
	
return $id_usuario;	

}
?>