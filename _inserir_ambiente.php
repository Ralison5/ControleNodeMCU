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
$nivel1 = $array['nivel'];

?>

<?php
if($nivel1 == 1){

$nome = $_POST['nome'];

$recebe=verificar($nome);

if($recebe==0){
$id_local = gerador_senha();
$sql= "INSERT INTO `ambiente`(`nome_local`,`id_local`)VALUES('$nome','$id_local')";
$inserir= mysqli_query($conexao,$sql);
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 10px">
<center>
	<h3>Ambiente adicionado com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="Cadastrar_ambiente.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
 </div>
 
 
<?php }else{ ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 10px">
<center>
	<h3>Este ambiente ja está cadastrado</h3>
	<div style="margin-top: 10px">
	<a href="Cadastrar_ambiente.php" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
 </div>



<?php }	?> 
<?php }else{

header('Location: home.php');

}
?>


<?php function verificar($nome){
	
include 'conexao.php';

$sql1= "SELECT `nome_local` FROM `ambiente` WHERE nome_local like '%$nome%'";
$buscar1= mysqli_query($conexao,$sql1);
$total = mysqli_num_rows($buscar1);

return $total;		
}

function gerador_senha(){
include 'conexao.php';

do{
$valor = rand(1, 99999);
$novasenha=str_pad($valor, 5, 0, STR_PAD_LEFT);	
$sql1= "SELECT `nome_local` FROM `ambiente` WHERE id_local = $novasenha";
$buscar1= mysqli_query($conexao,$sql1);
$total = mysqli_num_rows($buscar1);	


}while($total >= 1);

return $novasenha;
}	
?>


