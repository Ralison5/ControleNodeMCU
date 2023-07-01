
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

$nome=$_POST['nome'];
$cpf=$_POST['cpf'];
$sexo=$_POST['sexo'];
$tag=$_POST['tag'];
$id_local=$_POST['id_local'];
$id=$_POST['id'];
$data_inicial=$_POST['valor1'];
$data_Final=$_POST['valor2'];
$hora_inicial=$_POST['valor3'];
$hora_final=$_POST['valor4'];

$recebe=ativa($tag,$id_local);
if($recebe == 0){
$sql0 = "SELECT `nome_local` FROM `ambiente` WHERE `id_local`='$id_local';";
$buscar0 = mysqli_query($conexao,$sql0);
$array = mysqli_fetch_array($buscar0);
$nome_local=$array['nome_local'];
	
$sql= "INSERT INTO `sala`(`nome`,`cpf`,`sexo`,`tag`,`nome_local`,`id_local`,`id_usuario`) VALUES ('$nome','$cpf','$sexo','$tag','$nome_local','$id_local','$id')";
$inserir = mysqli_query($conexao,$sql);



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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="margin-top: 20px">
<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="vincular_sala.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<div style="padding-top: 20px">	
<center><h4>Usuario cadastrado no ambiente <h4></center>
</div>
<div style="padding-top: 20px">	
<center>
<a href="cadastrar_sala.php?id=<?php echo $id ?>" role="button" class="btn btn-success">Vincular um novo ambiente</a>
</center>
</div>
</div>
<?php }else{

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
?>