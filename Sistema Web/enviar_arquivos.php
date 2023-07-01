
<html>
<body>
<?php  
include 'conexao.php';
if(isset($_POST['acao'])){
$arquivo = $_FILES['file'];
$arquivoNovo = explode('.',$arquivo['name']);	

if($arquivoNovo[sizeof($arquivoNovo)-1]!='jpg' && $arquivoNovo[sizeof($arquivoNovo)-1]!='png'){

die('Você não pode fazer upload deste tipo de arquivo');

}else{
$pasta= "arquivos/";
$nomeDoArquivo= $arquivo['name']; 
$novoNomeDoArquivo = uniqid();	

$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));	
echo "a extensão apresentada: $extensao"; 	
$arquivoPronto = $pasta . $novoNomeDoArquivo . "." .$extensao;
$certo = move_uploaded_file($arquivo['tmp_name'],$arquivoPronto);		
if($certo){

$sql= "INSERT INTO `arquivos`(`nome`, `path`) VALUES ('$nomeDoArquivo', '$arquivoPronto')";
$inserir = mysqli_query($conexao,$sql);	
echo "<p> Arquivo enviado com sucesso! Para acessá - lo, clique aqui: <a target=\"_blank\" href=\"arquivos/$novoNomeDoArquivo.$extensao\">Clique aqui</a></p>";	
		
}
}
}
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="file"/>
<input type="submit" name="acao" value="Enviar" />
</form>
////////////////////////////////////////////
 
 <table border="1" cellpadding="10">
<thead>
<th>Preview</th>
<th>Arquivo</th>
<th>Data de envio</th>
</thead>
<tbody>
<?php
$sql= "SELECT * FROM arquivos";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)){
    $nome = $array['nome'];
	$path = $array['path'];
    $data = $array['data_upload'];	
?>
<tr>
<td><img height="50"  src="<?php echo $path;?>" alt=""></td>
<td> <a target="_blank" href= "<?php echo $path; ?>"><?php echo $nome;?></td>
<td><?php echo date("d/m/Y H:i",strtotime($data));?></td>
</tr>

</tbody>
<?php } ?>
</table>
 
 
 
///////////////////////////////////////////// 


</body>
</html>