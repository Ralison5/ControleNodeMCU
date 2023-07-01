
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
if($nivel==1 || $nivel == 2){
include 'conexao.php';
//////////////////////////////////////
$id_local = NULL;

if(isset($_GET['id_local'])){

$id_local=$_GET['id_local'];
	
}
/////////////////////////////////////

$tag = NULL;
if(isset($_GET['tag'])){
	
$tag=$_GET['tag'];
		
}

$cont=NULL;

$data_inicial = NULL;

if(isset($_GET['valor1'])){

$data_inicial=$_GET['valor1'];
	
}


$data_final = NULL;

if(isset($_GET['valor2'])){

$data_final=$_GET['valor2'];
	
}


$hora_inicial = NULL;

if(isset($_GET['valor3'])){

$hora_inicial=$_GET['valor3'];
	
}


$hora_final = NULL;

if(isset($_GET['valor4'])){

$hora_final=$_GET['valor4'];
	
}

if($tag != NULL  && $id_local != NULL){

 for($i=0; $i < count($tag);$i++){
	
	 $resposta=ativa($tag[$i],$id_local);
	 if($resposta == 0){
		$valor1=contador($tag[$i]);
		$valor2=contador_dois($id_local);
	if(0 < $valor1 && $valor2 > 0){
	
	  inserir($tag[$i],$id_local,$data_inicial,$data_final,$hora_inicial,$hora_final);
	        $cont=$cont+1;
	}
	 }
	}
}else{
?>	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<center>
	<h3>Operação falhou</h3>
	<div style="margin-top: 10px">
	<a href="selecionar_usuarios.php?id_local=<?php echo $id_local?>&valor1=<?php echo $data_inicial?>&valor2=<?php echo $data_final?> &valor3=<?php echo $hora_inicial ?>&valor4=<?php echo $hora_final ?> " class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
</div>

<?php	
}

if($cont > 0){
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<center>
	<h3>Operação realizada com sucesso</h3>
	<div style="margin-top: 10px">
	<a href="selecionar_usuarios.php?id_local=<?php echo $id_local?>&valor1=<?php echo $data_inicial?>&valor2=<?php echo $data_final?> &valor3=<?php echo $hora_inicial ?>&valor4=<?php echo $hora_final ?> " class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>
</div>
<?php
}
}else{

header('Location: home.php');

}
?>
	
<?php


function ativa($tag,$id_local){
include 'conexao.php';
	$contador=0;
	$sql1="SELECT * FROM `sala`";
   $buscar1 = mysqli_query($conexao,$sql1);	
   while ($array1=mysqli_fetch_array($buscar1)){
	  $id_local1 = $array1['id_local'];
	  $tag1= $array1['tag'];
	if($tag1 == $tag && $id_local1==$id_local){
	$contador=$contador+1;	
		
	}
	
}
	
return $contador;

}

function inserir($tag, $id_local,$data_inicial,$data_final,$hora_inicial,$hora_final){
include 'conexao.php';	
$sql = "SELECT `nome`, `cpf`, `sexo`,`id` FROM `usuarios` WHERE `tag`='$tag' ";
$buscar = mysqli_query($conexao,$sql);
while ($array=mysqli_fetch_array($buscar)){
  
  $nome=$array['nome'];
  $cpf = $array['cpf'];
  $sexo = $array['sexo'];
  $id_usuario = $array['id'];
  
}


$codigo="SELECT * FROM `ambiente` WHERE `id_local` = $id_local";
$buscar = mysqli_query($conexao,$codigo);	
while ($array=mysqli_fetch_array($buscar)){
$nome_local = $array['nome_local'];
}

$sql= "INSERT INTO `sala`(`id_usuario`, `nome`, `cpf`, `sexo`, `tag`, `nome_local`, `id_local`) VALUES ($id_usuario, '$nome', '$cpf', '$sexo', '$tag', '$nome_local',$id_local)";
$buscar = mysqli_query($conexao,$sql);


Data_Hora($nome,$cpf,$tag,$nome_local,$id_local,$data_inicial,$data_final,$hora_inicial,$hora_final,$id_usuario);

}

function contador($tag){
include 'conexao.php';	
$codigo="SELECT * FROM `usuarios` WHERE `tag`='$tag'";
$buscar = mysqli_query($conexao,$codigo);
$resultado=mysqli_num_rows($buscar);	


return $resultado;	
}

function contador_dois($id_local){
include 'conexao.php';
$codigo="SELECT * FROM `ambiente` WHERE `id_local` = '$id_local'";
$buscar = mysqli_query($conexao,$codigo);
$resultado=mysqli_num_rows($buscar);	

return $resultado;			
}

function Data_Hora($nome,$cpf,$tag,$nome_local,$id_local,$data_inicial,$data_Final,$hora_inicial,$hora_final,$id){
include 'conexao.php';


$start = new DateTime($data_inicial);
$end = new DateTime($data_Final);

$periodArr = new DatePeriod($start , new DateInterval('P1D') , $end);

// Array com os dias da semana
$diasemana = array('Domingo', 'Segunda', 'Terca', 'Quarta', 'Quinta', 'Sexta', 'Sabado');

foreach($periodArr as $period) {
	
    $period->format('d/m/Y')." ";
	// Aqui podemos usar a data atual ou qualquer outra data no formato Ano-mês-dia (2014-02-28)
    $data = date($period->format('Y-m-d'));
	// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
   $diasemana_numero = date('w', strtotime($data));

   // Exibe o dia da semana com o Array
   $diasemana[$diasemana_numero].'<br/>';
   
   
   $sql="INSERT INTO `agendamento`(`nome`, `tag`, `cpf`, `nome_local`, `id_local`, `data`, `dia`, `hora_inicial`, `hora_Final`, `id_usuario`) VALUES ('$nome', '$tag', '$cpf', '$nome_local', '$id_local', '$data', '$diasemana[$diasemana_numero]','$hora_inicial', '$hora_final', '$id')";
   $inserir = mysqli_query($conexao,$sql);

}

    //data de término
    $end->format('d/m/Y')." ";

   $data = date($end->format('Y-m-d'));
	//codigo sql aqui
	// Varivel que recebe o dia da semana (0 = Domingo, 1 = Segunda ...)
   $diasemana_numero = date('w', strtotime($data));

   // Exibe o dia da semana com o Array
   $diasemana[$diasemana_numero].'<br/>';
   
   $sql="INSERT INTO `agendamento`(`nome`, `tag`, `cpf`, `nome_local`, `id_local`, `data`, `dia`, `hora_inicial`, `hora_Final`, `id_usuario`) VALUES ('$nome', '$tag', '$cpf', '$nome_local', '$id_local', '$data', '$diasemana[$diasemana_numero]','$hora_inicial', '$hora_final','$id')";
   $inserir = mysqli_query($conexao,$sql);
	
	
}
?>

