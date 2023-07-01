
<html>
<body>
<?php  
include 'conexao.php';
if(isset($_POST['acao'])){
$arquivo = $_FILES['file'];

for ($controle = 0; $controle < count($arquivo['name']); $controle++){

$arquivoNovo = explode('.',$arquivo['name'][$controle]);	
if($arquivoNovo[sizeof($arquivoNovo)-1]!='pdf' && $arquivoNovo[sizeof($arquivoNovo)-1]!='png'){

die('Você não pode fazer upload deste tipo de arquivo');

}else{
$pasta= "arquivos/";
$nomeDoArquivo= $arquivo['name'][$controle]; 
$novoNomeDoArquivo = uniqid();	

$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));	
echo "a extensão apresentada: $extensao"; 	
$arquivoPronto = $pasta . $novoNomeDoArquivo . "." .$extensao;
$certo = move_uploaded_file($arquivo['tmp_name'][$controle],$arquivoPronto);		

if($certo){

$sql= "INSERT INTO `arquivos`(`nome`, `path`) VALUES ('$nomeDoArquivo', '$arquivoPronto')";
$inserir = mysqli_query($conexao,$sql);	
echo "<p> Arquivo enviado com sucesso! Para acessá - lo, clique aqui: <a target=\"_blank\" href=\"arquivos/$novoNomeDoArquivo.$extensao\">Clique aqui</a></p>";	
$superPronto="$arquivoPronto";
echo "<p>segunda opção! para acessar: <a href=\"visualizararquivos2.php?arquivo=<?php echo $superPronto?>\">clique Aquis</a></p>";		
}
}
}

}
?>
<form action="" method="post"  enctype="multipart/form-data">
<input type="file" name="file[]" multiple="multiple"/>
<input type="submit" name="acao" value="Enviar" />
</form>
////////////////////////////////////////////
 
<table border="1" cellpadding="10">
<thead>
<th>Preview</th>
<th>Arquivo</th>
<th>Data de envio</th>
<th>Excluir</th>
</thead>
<tbody>
<?php
$sql= "SELECT * FROM arquivos";
$busca=mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($busca)){
    $nome = $array['nome'];
	$path = $array['path'];
    $data = $array['data_upload'];
    $id_arquivo = $array['id'];	
?>
<tr>
<td><img height="50"  src="<?php echo $path;?>" alt=""></td>
<td><a target="_blank" href="<?php echo $path;?>"><?php echo $nome;?></td>
<td><a class="btn btn-danger btn-sm" href="visualizararquivos2.php?nome_arquivo=<?php echo $path ?>&id_arquivo=<?php echo $id_arquivo?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;visualizar</a></td>
<td><?php echo date("d/m/Y H:i",strtotime($data));?></td>
<td><a class="btn btn-danger btn-sm" href="deletar_arquivos2.php?nome_arquivo=<?php echo $path ?>&id_arquivo=<?php echo $id_arquivo?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Excluir</a></td>
<td><a class="btn btn-danger btn-sm" href="baixar.php?nome_arquivo=<?php echo $path?>" role="button"><i class="far fa-trash-alt"></i>&nbsp;Baixar</a></td>



</tr>

</tbody>
<?php } ?>
</table>
 
 
 
///////////////////////////////////////////// 


</body>
</html>

<!--<br color:="" rgb(0,="" 102,="" 255);"="">  Este será o link que apontará para o
nosso script PHP.<br color:="" rgb(0,="" 102,="" 255);"="">  Use no href
"baixar.php?arquivo=" + caminho de seu arquivo;<br color:="" rgb(0,="" 102,
="" 255);"="">  No Exemplo abaixo utilizei uma imagem com o nome "imagem.jpg"
que esta dentro da pasta "arquivos".<br color:="" rgb(0,="" 102,="" 255);"
="">--><br color:="" rgb(0,="" 102,="" 245);"=""><a href="baixar
.php?arquivo=arquivos/imagem.jpg">Baixar Arquivo</a>
