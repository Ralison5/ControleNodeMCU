<?php
include 'conexao.php';
echo $path=$_GET['nome_arquivo'];
echo $id_arquivo = $_GET['id_arquivo']; 


if(file_exists($path)) {
echo "O arquivo $path existe";
unlink("$path");

echo $sql= "DELETE FROM arquivos WHERE id = $id_arquivo";
$resultado=mysqli_query($conexao,$sql);
	
}else{
    echo "O arquivo $path não existe";
}

?>
