<?php
include('conexao.php');

try{
    $sql = "SELECT * from tblusuarios";
    $qry = $con->query($sql);
    $user = $qry->fetchAll(PDO::FETCH_OBJ);
   
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários </title>
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
    
<h1>Listar Usuários</h1>
<hr>
    <a href="index.php" class="btn btn-dark">Menu</a>
<hr>
    <a href="usuarios.php" class="btn btn-primary">Novo Cadastro</a>
<hr>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
           <th>idUsuário</th> 
           <th>Nome</th>
           <th>Email</th>
           <th>Senha</th>
           <th>idSituação</th>
           <th>idNivelAcesso</th>
           <th>Criado</th>
           <th>Modificado</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($user as $user) { ?>
        <tr>
            <td><?php echo $user->idusuario ?></td>
            <td><?php echo $user->nome ?></td>
            <td><?php echo $user->email ?></td>
            <td><?php echo $user->senha ?></td>
            <td><?php echo $user->idsituacao ?></td>
            <td><?php echo $user->idnivelacesso ?></td>
            <td><?php echo date ("d/m/Y", strtotime($user->criado)) ?></td>
            <td><?php echo date ("d/m/Y", strtotime($user->modificado)) ?></td>
            <td><a href="usuarios.php?idusuario=<?php echo $user->idusuario ?>" class="btn btn-success">Editar</a></td>
            <td><a href="usuarios.php?op=del&idusuario=<?php echo  $user->idusuario ?>" class="btn btn-danger">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>


      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

