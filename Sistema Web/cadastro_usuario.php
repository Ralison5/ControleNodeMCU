
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<style type="text/css">
@media screen and (min-width: 700px) {
      #tamanhocontainer{
      width: 500px;
	 
    }
    
  
}
</style>
</head>
<body>

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

<?php if($nivel == 1){?>
<div class="container" id="tamanhocontainer" style=" margin-top:10px;margin-bottom: 300px">
<div style="text-align: right; margin-bottom: 10px">
<a href="home.php" role="button" class="btn btn-sm btn-primary">Home</a>
<a href="alternar_aprovar.php" role="button" class="btn btn-sm btn-primary">Voltar</a>
</div>
<h4>Cadastrar Administrador</h4>
<form action="insert_usuario.php" method="post" submit>
<div class= "form-group">
<label>Nome do usuario</label>
<input type="text" name="nomeusuario" class="form-control" required autocomplete="off" placeholder="Nome completo" >
</div>
<div class= "form-group" style="margin-top:10px">
<label>E-mail</label>
<input type="email" name="usuarioemail" class="form-control" required autocomplete="off" placeholder="Digite seu e-mail">
</div>
<div class= "form-group" style="margin-top:10px">
<label>Senha do usuario</label>
<input id="txtSenha" type="password" name="usuariosenha" class="form-control"  required autocomplete="off" placeholder="Digite sua senha" required  >
</div>
<div class= "form-group"style="margin-top:10px">
<label>Repetir senha</label>
<input type="password" name="usuariosenha2" class="form-control"  autocomplete="off" placeholder="Repetir senha" oninput="validaSenha(this)">
<small>Precisa ser igual a senha digitada a acima</small>
</div>
<div class="form-group"style="margin-top:10px">
<label>Nivel de acesso</label>
<select name="nivelusuario" class="form-control">

<option value="1">Administrador</option>
<option value="2">Conferente</option>


</select>
</div>
<div style="text-align: right; margin-top: 10px">
<button type="submit" class="btn btn-sm btn-success">Cadastrar</button>
</div>
</form>

</div>

<?php }else{
	
header('Location: home.php');	

}
	?>



<!-- JavaScript Bundle with Popper -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<script>
function validaSenha (input){ 
	if (input.value != document.getElementById('txtSenha').value) {
    input.setCustomValidity('Repita a senha corretamente');
  } else {
    input.setCustomValidity('');
  }
} 
</script>




</body>
</html>