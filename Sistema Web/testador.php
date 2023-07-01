<?php
include 'conexao.php';

// Verifica a conexão
$resultado=isset($_GET['local']);


if($resultado==1){


$local=$_GET['local'];


}

if ($conexao->connect_error){
	
//die("Falha na conexão: " . $conexao->connect_error);
echo "conexão realizada com sucesso!!!";
	
}
$sql= "SELECT * FROM `sala` WHERE `id_local`=$local";
$busca=mysqli_query($conexao,$sql);

if ($busca->num_rows > 0)
// Imprime cada linha da resposta, que deve conter uma tag
while($row = $busca->fetch_assoc())
echo $row["tag"]."\n";
$conexao->close();
?>


