
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
$tag=$_POST['tag'];
$id_local=$_POST['id_local'];
$id_usuario = $_POST['id_usuario'];
$id=$_POST['id'];
$data_inicial=$_POST['valor1'];
$data_Final=$_POST['valor2'];
$hora_inicial=$_POST['valor3'];
$hora_final=$_POST['valor4'];
$nome_local=$_POST['nome_local'];


$sql="DELETE FROM agendamento WHERE `id_local`= $id_local AND `id_usuario`= $id_usuario";
$resultado = mysqli_query($conexao,$sql);

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
   
   
   $sql="INSERT INTO `agendamento`(`nome`, `tag`, `cpf`, `nome_local`, `id_local`, `data`, `dia`, `hora_inicial`, `hora_Final`, `id_usuario`) VALUES ('$nome', '$tag', '$cpf', '$nome_local', '$id_local', '$data', '$diasemana[$diasemana_numero]','$hora_inicial', '$hora_final', '$id_usuario')";
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
   
    $sql="INSERT INTO `agendamento`(`nome`, `tag`, `cpf`, `nome_local`, `id_local`, `data`, `dia`, `hora_inicial`, `hora_Final`, `id_usuario`) VALUES ('$nome', '$tag', '$cpf', '$nome_local', '$id_local', '$data', '$diasemana[$diasemana_numero]','$hora_inicial', '$hora_final','$id_usuario')";
   $inserir = mysqli_query($conexao,$sql);



?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6c72517177.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="container" style="width: 400px; margin-top: 20px">
<center>
	<h3>Alterado com sucesso!!!</h3>
	<div style="margin-top: 10px">
	<a href="visualizar_usuarios.php?id_local=<?php echo $id_local ?>" class="btn btn-sm  btn-warning" style="color: #fff">Voltar</a>
	</div>
</center>

 </div>
<?php }else{

header('Location: home.php');

}
?>
