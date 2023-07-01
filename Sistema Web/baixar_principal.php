<!DOCTYPE html>

<?php

session_start();
$usuario=$_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
header('Location: index.php');
}
?>

<?php
include 'conexao.php';
$id_usuario=$_GET['id_usuario'];
$sql= "SELECT * FROM arquivos WHERE id_usuario=$id_usuario";
$busca=mysqli_query($conexao,$sql);
$array=mysqli_fetch_array($busca);   
$arquivo=$array['path'];    
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<style type="text/css">

<?php
if(isset($arquivo) && file_exists($arquivo)){
   //faz o teste se a variavel não esta vazia e se o arquivo realmente existe
      switch(strtolower(substr(strrchr(basename($arquivo),"."),1))){
      // verifica a extensão do arquivo para pegar o tipo
         case "pdf": $tipo="application/pdf"; break;
         case "exe": $tipo="application/octet-stream"; break;
         case "zip": $tipo="application/zip"; break;
         case "doc": $tipo="application/msword"; break;
         case "xls": $tipo="application/vnd.ms-excel"; break;
         case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
         case "gif": $tipo="image/gif"; break;
         case "png": $tipo="image/png"; break;
         case "jpg": $tipo="image/jpg"; break;
         case "mp3": $tipo="audio/mpeg"; break;
	     case "php": // deixar vazio por seurança
         case "htm": // deixar vazio por seurança
         case "html": // deixar vazio por seurança
      }
      header("Content-Type: ".$tipo);
      // informa o tipo do arquivo ao navegador
      header("Content-Length: ".filesize($arquivo));
      // informa o tamanho do arquivo ao navegador
      header("Content-Disposition: attachment; filename=".basename($arquivo));
      // informa ao navegador que é tipo anexo e faz abrir a janela de download,
      //tambem informa o nome do arquivo
	  ob_clean();
      flush();
      readfile($arquivo); // lê o arquivo
      exit; // aborta pós-ações
   }	
?>
</style>

</head>
<body>
<div style="height: 300px; width: 100%;">

<object data="$recebido" type="application/pdf">
    <p>Seu navegador não tem um plugin pra PDF</p>
</object>
</div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>