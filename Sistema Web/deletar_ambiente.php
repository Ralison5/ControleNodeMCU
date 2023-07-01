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
if($nivel == 1){

$id=$_GET['id'];


$sql="DELETE FROM `ambiente` WHERE id_local=$id";

Excluir_acesso($id);
Excluir_acesso_negado($id);
Excluir_sala($id);

$deletar = mysqli_query($conexao,$sql);



header('Location: listar_ambiente.php');
 
}else{
	
header('Location: home.php');

}	
?>

<?php
Function Excluir_acesso($id){
include 'conexao.php';	
$resultado = 0;
$sql1="SELECT * FROM `acessos` WHERE `id_local` = $id";

      
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `acessos` WHERE id_local=$id";
$excluir1 = mysqli_query($conexao,$sql1);	
	
}


}

Function Excluir_acesso_negado($id){
include 'conexao.php';	
	
$resultado = 0;
$sql1="SELECT * FROM `acessonegado` WHERE `id_local` = $id";

      
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `acessonegado` WHERE id_local=$id";
$excluir1 = mysqli_query($conexao,$sql1);	
	
}	
		
	
}

Function Excluir_sala($id){
include 'conexao.php';	
$resultado = 0;
$sql1="SELECT * FROM `sala` WHERE `id_local` = $id";

      
$buscar1=mysqli_query($conexao,$sql1);
$resultado = mysqli_num_rows($buscar1);

if($resultado > 0){
	
$sql1="DELETE FROM `sala` WHERE id_local=$id";
$excluir1 = mysqli_query($conexao,$sql1);	
	
}		
	
	
}


?>