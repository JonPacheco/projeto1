<?php
    $idproduto = isset($_GET["idproduto"]) ? $_GET["idproduto"]: null;
    $op = isset($_GET["op"]) ? $_GET["op"]: null;
     
    
        try {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $bd = "bdprojeto";
            $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 
   
            //estou deletando os dados no BD
            if($op=="del"){
                $sql = "delete  FROM  tblprodutos where idproduto= :idproduto";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idproduto",$idproduto);
                $stmt->execute();
                header("Location:listarprodutos.php");
            }
    
    
            if($idproduto){
                //estou buscando os dados do cliente no BD
                $sql = "SELECT * FROM  tblprodutos where idproduto= :idproduto";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idproduto",$idproduto);
                $stmt->execute();
                $produto = $stmt->fetch(PDO::FETCH_OBJ);
                //var_dump($cliente);
            }
               // estou atualizando os dados no BD
            if($_POST){
                if($_POST["idproduto"]){
                    $sql = "UPDATE tblprodutos SET produto=:produto, precohr=:precohr, usohr=:usohr WHERE idproduto =:idproduto";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(":produto", $_POST["produto"]);
                    $stmt->bindValue(":precohr",$_POST["precohr"]);
                    $stmt->bindValue(":usohr", $_POST["usohr"]);                  
                    $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                    $stmt->execute(); 
   
                    //comando para inserir os dados no BD
                } else {
                    $sql = "INSERT INTO tblprodutos (produto,precohr,usohr) VALUES (:produto,:precohr,:usohr)";
                    $stmt = $con->prepare($sql);
                    $stmt->bindValue(":produto", $_POST["produto"]);
                    $stmt->bindValue(":precohr",$_POST["precohr"]);
                    $stmt->bindValue(":usohr", $_POST["usohr"]);                   
                    $stmt->execute(); 
                }
                header("Location:listarprodutos.php");
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
    <title>Produtos</title>
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
<h1>Produtos</h1>
<hr>


<form method="POST">
   
    <div class="row">

        <div class="col">

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Produto</label>

                <input type="text" class="form-control" required name="produto" value="<?php echo isset($produto) ? $produto->produto : null ?>"><br>

             </div>      

        </div>

    <div class="col">

        <div class="mb-3">

            <label for="exampleInputPassword1" class="form-label">Preço Hora</label>

            <input type="text" class="form-control" required name="precohr" value="<?php echo isset($produto) ? $produto->precohr : null ?>"><br>

        </div>

    </div>

    <div class="col">

        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Uso Hora</label>

             <input type="text" class="form-control" required name="usohr" value="<?php echo isset($produto) ? $produto->usohr : null ?>"><br>

             <input type="hidden"     name="idproduto"   value="<?php echo isset($produto) ? $produto->idproduto : null ?>">     

        </div>

    </div>

    <div class="row">

      <div class="col">

        <div class="mb-3">        

        <button type="submit" class="btn btn-primary">Cadastrar</button>

    </div>

    


</form>   
  <div class="row">

    <div class="col">

      <div class="mb-3">        

      <a href="listarprodutos.php" class="btn btn-outline-primary">volta</a>

  </div>

<!--Carrousel-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/img1.jpg" class="d-block w-100" alt="..." width="1000px" height="568.5px">
            <div class="carousel-caption d-none d-md-block">
              <h5>JPS Technology</h5>
              <p>World Connection.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/cloud1.jpg" class="d-block w-100" alt="..." width="1000px" height="568.5px">
            <div class="carousel-caption d-none d-md-block">
              <h5>JPS Technology</h5>
              <p>Cloud</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/serv1.jpg" class="d-block w-100" alt="..." width="1000px" height="568.5px">
            <div class="carousel-caption d-none d-md-block">
              <h5>JPS Technology</h5>
              <p>Web Server</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>    




<!--Fim Carrousel-->


      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

