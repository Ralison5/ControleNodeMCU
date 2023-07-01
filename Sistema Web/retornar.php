

<?php


function retorno($id){
	
include 'conexao.php';
	

$sql2="SELECT * FROM `acessonegado` WHERE id=$id";
$buscar2 = mysqli_query($conexao,$sql2);
while ($array2=mysqli_fetch_array($buscar2)) {
    
	$tag2 = $array2['tag'];
}

$tag_usuario = 0;
$sql3="SELECT * FROM `usuarios`";
$buscar3 = mysqli_query($conexao,$sql3);
while ($array3=mysqli_fetch_array($buscar3)) {
    
	  $ponto = $array3['tag'];
	  
	  if($tag2==$ponto){
		  
	   $tag_usuario = 1;
	  
	  }
	
}

return  $tag_usuario;

}
?>	