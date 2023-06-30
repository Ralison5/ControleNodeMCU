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

$id=$_POST['id'];

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$tag = $_POST['tag'];
$telefone = $_POST['telefone'];

if(isset($_FILES['arquivo'])){
$file = $_FILES['arquivo'];
}

$sql="UPDATE `usuarios` SET `nome`='$nome',`cpf`='$cpf',`rg`='$rg',`sexo`='$sexo',`email`='$email',`tag`='$tag',`telefone`='$telefone' WHERE id = $id";
$atualizar = mysqli_query($conexao,$sql);

if($file['size'] != NULL && $file['size'] <= 5242880){
		
	
$sql= "SELECT * FROM arquivos WHERE id_usuario=$id";
$busca=mysqli_query($conexao,$sql);
$array=mysqli_fetch_array($busca);   
$path=$array['path']; 	
	
if(file_exists($path)) {

unlink("$path");

$sql= "DELETE FROM arquivos WHERE id_usuario = $id";
$resultado=mysqli_query($conexao,$sql);

$pasta= "arquivos/";	
$nomeDoArquivo= $file['name'];
$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION)); 
$novoNomeDoArquivo = uniqid();	

$arquivoPronto = $pasta . $novoNomeDoArquivo . "." .$extensao;
$certo = move_uploaded_file($file['tmp_name'],$arquivoPronto);

if($certo){

$sql= "INSERT INTO `arquivos`(`nome`, `path`,`id_usuario`) VALUES ('$nomeDoArquivo', '$arquivoPronto','$id')";
$inserir = mysqli_query($conexao,$sql);	

}	
}	
	
	
}



if($atualizar==NULL){
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Falha na operação</h3>
	<div style="margin-top: 10px">
	<a href="listar_produtos.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>

<?php
}else if($file['size'] > 5242880){
?>	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Falha na operação</h3>
	<div style="margin-top: 10px">
	<a href="listar_produtos.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>

<?php	
}else{

Atualizar_sala($nome, $cpf, $sexo, $tag,$id);
Atualizar_agendamento($nome, $cpf,$tag,$id);
Atualizar_acesso($nome, $cpf, $tag,$id);
Atualizar_acessonegado($tag,$id);	

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Atualizado com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="listar_produtos.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
<?php } ?>
<?php }else{
	
header('Location: home.php');	
		
}

 ?>
 
<?php

Function Atualizar_sala($nome, $cpf, $sexo, $tag,$id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `sala` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `sala` SET `nome`='$nome',`cpf`='$cpf',`sexo`='$sexo',`tag`='$tag' WHERE `id_usuario`= $id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}


Function Atualizar_acesso($nome, $cpf, $tag,$id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `acessos` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `acessos` SET `nome`='$nome',`cpf`='$cpf',`tag`='$tag' WHERE `id_usuario` = $id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}

Function Atualizar_acessonegado($tag,$id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `acessonegado` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `acessonegado` SET `tag`='$tag' WHERE `id_usuario` = $id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}


Function Atualizar_agendamento($nome, $cpf,$tag,$id){
include 'conexao.php';	
	
$resultado = '0';
$sql1="SELECT * FROM `agendamento` WHERE `id_usuario` = $id";
    
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="UPDATE `agendamento` SET `nome`='$nome',`cpf`='$cpf',`tag`='$tag' WHERE `id_usuario`= $id";
$atualizar1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
} 

?> 
