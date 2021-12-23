<?php
   $idcliente = isset($_GET["idcliente"]) ? $_GET["idcliente"]: null;
   $op = isset($_GET["op"]) ? $_GET["op"]: null;
    
   
       try {
           $servidor = "localhost";
           $usuario = "root";
           $senha = "";
           $bd = "bdprojeto";
           $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

           //estou deletando os dados no BD
           if($op=="del"){
               $sql = "delete  FROM  tblclientes where idcliente= :idcliente";
               $stmt = $con->prepare($sql);
               $stmt->bindValue(":idcliente",$idcliente);
               $stmt->execute();
               header("Location:listarclientes.php");
           }
   
   
           if($idcliente){
               //estou buscando os dados do cliente no BD
               $sql = "SELECT * FROM  tblclientes where idcliente= :idcliente";
               $stmt = $con->prepare($sql);
               $stmt->bindValue(":idcliente",$idcliente);
               $stmt->execute();
               $cliente = $stmt->fetch(PDO::FETCH_OBJ);
               //var_dump($cliente);
           }
              // estou atualizando os dados no BD
           if($_POST){
               if($_POST["idcliente"]){
                   $sql = "UPDATE tblclientes SET cliente=:cliente, cpf=:cpf, email=:email WHERE idcliente =:idcliente";
                   $stmt = $con->prepare($sql);
                   $stmt->bindValue(":cliente", $_POST["cliente"]);
                   $stmt->bindValue(":cpf",$_POST["cpf"]);
                   $stmt->bindValue(":email", $_POST["email"]);                   
                   $stmt->bindValue(":idcliente", $_POST["idcliente"]);
                   $stmt->execute(); 

                   //comando para inserir os dados no BD
               } else {
                   $sql = "INSERT INTO tblclientes (cliente,cpf,email) VALUES (:cliente,:cpf,:email)";
                   $stmt = $con->prepare($sql);
                   $stmt->bindValue(":cliente",$_POST["cliente"]);
                   $stmt->bindValue(":cpf",$_POST["cpf"]);
                   $stmt->bindValue(":email",$_POST["email"]);
                   $stmt->execute(); 
               }
               header("Location:listarclientes.php");
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
    <title>Clientes</title>
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
<h1>Cadastro de Clientes</h1>
<hr>


<form method="POST">
   
    <div class="row">

        <div class="col">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Cliente</label>

                <input type="text" class="form-control" required name="cliente"  value="<?php echo isset($cliente) ? $cliente->cliente : null ?>"><br> 

             </div>      

    </div>
    
    <div class="row">

        <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Email</label>

            <input type="email" class="form-control" required name="email" value="<?php echo isset($cliente) ? $cliente->email : null ?>"><br>

    </div>

    </div>

    <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">CPF</label>

             <input type="text" class="form-control" required name="cpf" value="<?php echo isset($cliente) ? $cliente->cpf : null ?>"><br>

             <input type="hidden"     name="idcliente"   value="<?php echo isset($cliente) ? $cliente->idcliente : null ?>">   

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

      <a href="listarclientes.php"  class="btn btn-outline-primary">volta</a>

    </div>

    
</body>
</html>