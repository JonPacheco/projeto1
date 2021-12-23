<?php
   $idusuario = isset($_GET["idusuario"]) ? $_GET["idusuario"]: null;
   $op = isset($_GET["op"]) ? $_GET["op"]: null;
    
   
       try {
           $servidor = "localhost";
           $usuario = "root";
           $senha = "";
           $bd = "bdprojeto";
           $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

           //estou deletando os dados no BD
           if($op=="del"){
               $sql = "delete  FROM  tblusuarios where idusuario= :idusuario";
               $stmt = $con->prepare($sql);
               $stmt->bindValue(":idusuario",$idusuario);
               $stmt->execute();
               header("Location:listarusuarios.php");
           }
   
   
           if($idusuario){
               //estou buscando os dados do cliente no BD
               $sql = "SELECT * FROM  tblusuarios where idusuario= :idusuario";
               $stmt = $con->prepare($sql);
               $stmt->bindValue(":idusuario",$idusuario);
               $stmt->execute();
               $user = $stmt->fetch(PDO::FETCH_OBJ);
               //var_dump($cliente);
           }
              // estou atualizando os dados no BD
           if($_POST){
               if($_POST["idusuario"]){
                   $sql = "UPDATE tblusuarios SET nome=:nome, email=:email, senha=:senha, idsituacao=:idsituacao, idnivelacesso=:idnivelacesso, criado=:criado, modificado=:modificado WHERE idusuario =:idusuario";
                   $stmt = $con->prepare($sql);
                   $stmt->bindValue(":nome", $_POST["nome"]);
                   $stmt->bindValue(":email", $_POST["email"]);
                   $stmt->bindValue(":senha",$_POST["senha"]);   
                   $stmt->bindValue(":idsituacao",$_POST["idsituacao"]);    
                   $stmt->bindValue(":idnivelacesso",$_POST["idnivelacesso"]);   
                   $stmt->bindValue(":criado",$_POST["criado"]);
                   $stmt->bindValue(":modificado",$_POST["modificado"]);         
                   $stmt->bindValue(":idusuario", $_POST["idusuario"]);
                   $stmt->execute(); 

                   //comando para inserir os dados no BD
               } else {
                   $sql = "INSERT INTO tblusuarios (nome,email,senha,idsituacao,idnivelacesso,criado,modificado) VALUES (:nome,:email,:senha,:idsituacao,:idnivelacesso,:criado,:modificado)";
                   $stmt = $con->prepare($sql);
                   $stmt->bindValue(":nome", $_POST["nome"]);
                   $stmt->bindValue(":email", $_POST["email"]);
                   $stmt->bindValue(":senha",$_POST["senha"]);   
                   $stmt->bindValue(":idsituacao",$_POST["idsituacao"]);    
                   $stmt->bindValue(":idnivelacesso",$_POST["idnivelacesso"]);   
                   $stmt->bindValue(":criado",$_POST["criado"]);
                   $stmt->bindValue(":modificado",$_POST["modificado"]); 
                   $stmt->execute(); 
               }
               header("Location:listarusuarios.php");
           } 
       } catch(PDOException $e){
            echo "erro".$e->getMessage;
           }
   
    
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>
<!-- Inicio da Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">JPS Technology</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="listarclientes.php">Cliente</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listarfuncionarios.php">Funcionário</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listarprodutos.php">Produtos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listarservicos.php">Serviços</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listarvendas.php">Vendas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="listarusuarios.php">Usuários</a>
              </li>
             

             <!--
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Cadastrar
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="frmclientes.php">Clientes</a></li>
                  <li><a class="dropdown-item" href="produtos.php">Produtos</a></li>
                  <li><a class="dropdown-item" href="vendas.php">Vendas</a></li>
                  <li><a class="dropdown-item" href="vendedores.php">Vendedores</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#"></a></li>
                </ul>
              </li>
              -->
              <li class="nav-item">
                <a class="nav-link disabled"></a>
              </li>
            </ul>

            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
          </div>
        </div>
      </nav>
      <!-- Fim do Navbar-->


<div class="container">
<h1>Cadastro de Usuários</h1>
<hr>


<form method="POST">
   
    <div class="row">

        <div class="col">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Usuário</label>

                <input type="text" class="form-control" required name="nome"  value="<?php echo isset($user) ? $user->nome : null ?>"><br> 

             </div>      

    </div>
    
    <div class="row">

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Email</label>

            <input type="email" class="form-control" required name="email" value="<?php echo isset($user) ? $user->email : null ?>"><br>

    </div>

    </div>

    <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Senha</label>

             <input type="text" class="form-control" required name="senha" value="<?php echo isset($user) ? $user->senha : null ?>"><br>  

        </div>

    </div>

    <div class="row">

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">idSituação</label>

            <input type="text" class="form-control" required name="idsituacao" value="<?php echo isset($user) ? $user->idsituacao : null ?>"><br>

    </div>

    </div>

    <div class="row">

<div class="col">

<div class="mb-3">

    <label for="exampleInputPassword1" class="form-label">idNivelAcesso</label>

    <input type="text" class="form-control" required name="idnivelacesso" value="<?php echo isset($user) ? $user->idnivelacesso : null ?>"><br>

</div>

</div>

<div class="row">

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Criado</label>

            <input type="date" class="form-control" required name="criado" value="<?php echo isset($user) ? $user->criado : null ?>"><br>

    </div>

    </div>

    <div class="row">

<div class="col">

<div class="mb-3">

    <label for="exampleInputPassword1" class="form-label">Modificado</label>

    <input type="date" class="form-control" required name="modificado" value="<?php echo isset($user) ? $user->modificado : null ?>"><br>

    <input type="hidden"     name="idusuario"   value="<?php echo isset($user) ? $user->idusuario : null ?>"> 

</div>

</div>


    <div class="row">

      <div class="col">

        <div class="mb-3">        

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>


           


</form>  

    <div class="col">

      <div class="mb-3">

      <a href="listarusuarios.php"  class="btn btn-outline-primary">volta</a>

    </div>

    
</body>
</html>