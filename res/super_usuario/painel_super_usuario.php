<?php
session_start();
 
require '../model/conexao.class.php';
require '../model/check.php';

$id_usuario = $_SESSION['login_usuarios'];
$login_usuario = $_SESSION['login_usuarios'];
$super_usuario = $_SESSION['super_usuarios'];

if (!$super_usuario == 1) {
   header('Location: ../model/logout.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Listagem de Super Usuarios</title>
    <link rel="stylesheet" type="text/css" href="../../lib/css/super_usuario.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/06ffaaed9a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">

                <div class="navbar-brand row">
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Usuário:</span>
                            </div>
                            <input type="text" class="form-control" value="<?php echo $login_usuario ?>" readonly="readonly">
                        </div>
                    </div>
                </div>
                <li class="nav-item active">
                    <a class="nav-link" href="../usuarios/painel.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro_usuarios.php">Criar usuário</a>
                </li>
                

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Empresas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="empresas/painel_empresas.php">Ver empresas</a>
                        <a class="dropdown-item" href="vincular_empresa.php">Vincular empresa</a>
                        <a class="dropdown-item" href="desvincular_empresa.php">Desincular empresa</a>
                    </div>
                </li>


                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Logout
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../model/logout.php">Sair</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <!--container -->
        <!-- colocar os espaçamentos ficando esponsivo-->
        <h3 class="text-center">Lista de Usuários</h3>
        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-dark" id="conteudo_tabela">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Login Usuário</th><!-- col = coluna -->

                        <th scope="col">Super Usuário</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("../model/crud.class.php");
                    $usuario = new Crud("Usuarios");
                    $resposta = $usuario->selectCrud("*"); //$resposta está em formato de array

                    foreach ($resposta as $indice => $valor) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($valor->login_usuarios) . ' </td>';

                        echo '<td>' . htmlspecialchars($valor->super_usuarios) . ' </td>';
                        echo '<td class="text-center">';
                        echo '<a href="editar_usuarios.php?id_usuarios=' . $valor->id_usuarios . '"name="editar" title="update"><i class="fa fa-pencil"></i></a> ';
                        echo '<a href="delete_usuarios.php?id_usuarios=' . $valor->id_usuarios . '"name="delete" title="delete"><i class="fa fa-trash-o text-danger"></i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>