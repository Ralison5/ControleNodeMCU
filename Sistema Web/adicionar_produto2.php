<!DOCTYPE html>
<html>
<head>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">



	<title></title>
	<style type="text/css">
		
	



@media screen and (min-width: 700px) {
      #tamanhocontainer{
      width: 500px;
    }
    
  
}

		#botao {
			background-color: #5CC5AB; /*cor de fundo*/
			color: #ffffff; /*cor da letra*/
			font-weight: bold;
		}
    
	</style>
	<!-- CSS only -->
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<?php
if(isset($_GET['nome'])){
$nome = $_GET['nome'];
}else{
$nome = NULL;	
}

if(isset($_GET['cpf'])){
$cpf = $_GET['cpf'];
}else{
$cpf = NULL;	
}

if(isset($_GET['rg'])){
$rg = $_GET['rg'];
}else{
$rg = NULL;	
}


if(isset($_GET['email'])){
$email = $_GET['email'];
}else{
$email = NULL;	
}

if(isset($_GET['telefone'])){
$telefone = $_GET['telefone'];
}else{
$telefone = NULL;	
}


if(isset($_GET['tag'])){
$tag = $_GET['tag'];
}else{
$tag = NULL;	
}

if(isset($_GET['sexo'])){
$sexo = $_GET['sexo'];
}else{
$sexo = NULL;	
}
?>
<body>


<div class= "container" id= "tamanhocontainer" style="margin-top: 20px; margin-bottom: 300px">

<div style="text-align: right">
<a href="home.php" role="button" class="btn btn-sm btn-primary">voltar</a>
</div>
<h4>Formulário de cadastro</h4>
<form action="_inserir_produto_externo.php" method="post" enctype="multipart/form-data" submit="Cadastrar" style ="margin-top: 10px;">

<div class="mb-3">
    <label>Nome do Usuario</label>
    <input type="text" class="form-control" name="nome"  placeholder="Insira o nome do Usuario!!!" value="<?php echo $nome ?>" required>
</div>
<div class="mb-3">
<label>CPF do Usuario</label>
<input type="text" class="form-control" name="cpf" placeholder="Insira o CPF do usuario!!!" value="<?php echo $cpf ?>" required autocomplete="off"  onkeypress="$(this).mask('000.000.000-00');">
</div>
<div class="mb-3">
<label>RG do Usuario</label>
<input type="text" class="form-control" name="rg" placeholder="Insira o RG do usuario!!!" value="<?php echo $rg ?>" required autocomplete="off">
</div>
<div class="mb-3"> 
<label>Selecione o sexo do usuario</label>
<select type="text" class="form-select" name="sexo"  aria-label="Default select example" required>
 <?php if($sexo == NULL){ ?> 
  <option selected></option>
  <option>Masculino</option>
  <option>Feminino</option>
  <?php }else if($sexo=="Feminino"){ ?>
	<option>Feminino</option>  
	<option>Masculino</option> 
  <?php }else{ ?>
	<option> Masculino </option>
    <option>Feminino</option>    
 <?php } ?>
</select>
</div>
<div class="mb-3">
    <label>Insira o e-mail do usuario</label>
    <input type="email" class="form-control" name="email" placeholder="Insira o E-mail do usuario!!!" value="<?php echo $email ?>" required autocomplete="off">
</div>
<div class="mb-3">
    <label>Numero de telefone do Usuario</label>
    <input type="number" class="form-control" name="telefone" placeholder="Insira o numero de telefone do usuario!!!" value="<?php echo $telefone ?>" required autocomplete="off">
</div>
<div class="mb-3">
    <label>Tag do Usuario</label>
    <input type="text" class="form-control" name="tag" placeholder="Insira a Tag do usuario!!!" value="<?php echo $tag ?>" required autocomplete="off">
</div>

<div class="mb-3">
    <label>Adicione o CPF e o RG</label>
	</br>
    <input type="file" name="file" required autocomplete="off"/>
</div>



<div style="text-align: Left; margin-bottom: 10px">
<button type="submit" name="acao" id="botao" class="btn btn-sm">Enviar dados</button>
</div>
</form>

</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>