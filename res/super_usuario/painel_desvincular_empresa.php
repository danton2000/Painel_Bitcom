<?php
session_start();

require '../model/init.php';
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
    <title>Lista de Empresas/Usuários</title>
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
                    <a class="nav-link" href="painel_super_usuario.php">Ver usuários</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Empresas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="empresas/painel_empresas.php">Ver empresas</a>
                        <a class="dropdown-item" href="vincular_empresa.php">Vincular empresa</a>
                        <a class="dropdown-item" href="painel_desvincular_empresa.php">Desvincular empresa</a>
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
        <h3 class="text-center">Lista de Empresas/Usuários</h3>
        <div class="row">
            <div class="col-sm">
                <form action="painel_desvincular_empresa.php" method="POST">
                    <div class="float-right input-group input-group-sm">
                        <input type="text" class="form-control" name="pesquisa" placeholder="Pesquisar Usuários" value="">
                        <div class="input-group-prepend">
                            <button type="submit" name="btn_pesquisa" class="input-group-text" id="pesquisar">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-dark" id="conteudo_tabela">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome Empresa</th><!-- col = coluna -->

                        <th scope="col">Login Usuario</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require '../model/check.php';

                    if (isset($_POST['btn_pesquisa'])) {
                        $pesquisa = $_POST['pesquisa'];

                        $PDO = db_connect();
                        $sql = "SELECT DISTINCT id_empresas, nome_empresas, id_usuarios, login_usuarios FROM Empresas INNER JOIN Usuarios_Empresas USING(id_empresas) INNER JOIN Usuarios USING(id_usuarios) WHERE login_usuarios LIKE :pesquisa ORDER BY nome_empresas, login_usuarios ASC";
                        $stmt = $PDO->prepare($sql);
                        $pesquisar = '%' . $pesquisa . '%';
                        $stmt->bindParam('pesquisa', $pesquisar, PDO::PARAM_STR);
                        $stmt->execute();

                        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $indice => $valor) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($valor['nome_empresas']) . '</td>';
                            echo '<td>' . htmlspecialchars($valor['login_usuarios']) . '</td>';
                            echo '<td class="text-center">';
                            echo '<a href="delete_usuario_empresa.php?id_empresas=' . $valor['id_empresas'] . '&id_usuarios=' . $valor['id_usuarios'] . '"name="delete" title="delete"><i class="fa fa-trash-o text-danger"></i></a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        $PDO = db_connect();
                        $sql = "SELECT DISTINCT id_empresas, nome_empresas, id_usuarios, login_usuarios FROM Empresas INNER JOIN Usuarios_Empresas USING(id_empresas) INNER JOIN Usuarios USING(id_usuarios) ORDER BY nome_empresas, login_usuarios ASC";
                        $stmt = $PDO->prepare($sql);
                        $stmt->execute();

                        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($resultado as $indice => $valor) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($valor['nome_empresas']) . '</td>';
                            echo '<td>' . htmlspecialchars($valor['login_usuarios']) . '</td>';
                            echo '<td class="text-center">';
                            echo '<a href="delete_usuario_empresa.php?id_empresas=' . $valor['id_empresas'] . '&id_usuarios=' . $valor['id_usuarios'] . '"name="delete" title="delete"><i class="fa fa-trash-o text-danger"></i></a>';
                            echo '</td>';
                            echo '</tr>';
                        }
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