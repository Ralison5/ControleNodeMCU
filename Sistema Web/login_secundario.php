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


<?php
include 'conexao.php';
$resultado=0;
if(isset($_GET['usuarioemail'])){

$resultado=isset($_GET['usuarioemail']);

}


?>


<body>

<div class="container" id= "tamanhocontainer" style="margin-top:10px">
<div style="text-align: right; margin-bottom: 10px">
<a href="index.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>

<h4>Recuperação de senha</h4>
<form action="alteracao_login.php" method="POST" submit>

<div class= "form-group" style="margin-top:10px">
<label>E-mail</label>
<input value="<?php if($resultado==1){echo $_GET['usuarioemail'];}?>" type="email" name="usuario" class="form-control" required autocomplete="off" placeholder="Digite seu e-mail">
</div>

<div class= "form-group" style="margin-top:10px">
<label>Senha atual</label>
<input type="password" name="senha_atual" class="form-control" required autocomplete="off" placeholder="Digite a senha da conta!!!">
</div>

<div class= "form-group" style="margin-top:10px">
<label>Nova senha</label>
<input id="txtSenha" type="password" name="senha_nova" class="form-control" required autocomplete="off" placeholder="Digite a senha da conta!!!">
</div>
<div class= "form-group" style="margin-top:10px">
<label>Repetir senha</label>
<input type="password" name="senha_nova2" class="form-control"  autocomplete="off" placeholder="Repetir senha" oninput="validaSenha(this)">
<small>Precisa ser igual a senha digitada a acima</small>
</div>
<div style="text-align: right; margin-top: 10px">
<button type="submit" name="ok" class="btn btn-sm btn-success">Proximo</button>
</div>
</form>

</div>



<!-- JavaScript Bundle with Popper -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<script>
function validaSenha (input){ 
	if (input.value != document.getElementById('txtSenha').value) {
    input.setCustomValidity('Repita a senha corretamente');
  }else{
    input.setCustomValidity('');
  }
} 
</script>

</body>
</html>