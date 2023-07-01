<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tela de Login</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<style type="text/css">

#tamanho{
	
width: 299px;
-webkit-box-shadow: 1px 5px 18px 5px rgba(0,0,0,0.77); 
box-shadow: 1px 5px 18px 5px rgba(0,0,0,0.77);
}	


	
	

</style>

</head>
<body>

<div class="container" id="tamanho" style="margin-top: 100px;border-radius: 15px; border: 2px solid #808080">
<div style="padding: 10px">
<center>
<img src="imagem/cadeado1.png" width="150px" height="150px">
</center>
<form action="recebe.php" method="POST" submit>
<div class="form-group" Style="margin-bottom: 10px">
<label>Usuario</label>
<input type="email" name="login_usuario" class="form-control" placeholder="Usuario" autocomplete="off" required>
</div>

<div class="form-group">
<label>Senha</label>
<input type="password" name="login_senha" class="form-control" placeholder="Senha" autocomplete="off" required>
</div>

<div style="text-align: right; margin-top: 10px">
<button type="submit" class="btn btn - sm btn-success">Entrar</button>
</div>
</form>
</div>
</div>

<div style="margin-top: 10px; margin-bottom: 300px">
<center>
<small>Voce não possui cadastro de usuario? Clique <a href="cadastro_usuario_externo.php">Aqui</a></small>
</center>
<center>
<small>Esqueceu sua senha? Clique <a href="esqueceusenha.php">Aqui</a></small>
</center>
<center>
<small>Adicionar um cadastro de acesso? Clique <a href="adicionar_produto2.php">Aqui</a></small>
</center>
</div>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>