<?php 
session_start();
$usuario=$_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
header('Location: index.php');
}
include 'conexao.php';
echo $sql= "SELECT `nivel` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$array = mysqli_fetch_array($buscar);
$nivel = $array['nivel'];

?>

<?php
if($nivel==1){
include 'conexao.php';

$id=$_GET['id'];


$sql="DELETE FROM `usuario_externo` WHERE id_usuario=$id";
$deletar = mysqli_query($conexao,$sql);
observar();


header("Location: Aprovar_usuarios2.php");
}else{
header("Location: home.php");	
}
?>


<?php
function observar(){
	
session_start();
$usuario=$_SESSION['usuario'];

include 'conexao.php';
$sql= "SELECT `email` FROM `usuario_externo` WHERE email like '$usuario' and status = 'ativo'";
$buscar= mysqli_query($conexao,$sql);
$resultado = mysqli_num_rows($buscar);

if($resultado == 0){
	
unset($session['usuario']);
session_destroy();
header('Location: index.php');
	
}

}
?>