<?php
session_start();

$id_usuario = $_SESSION['login_usuarios'];
$login_usuario = $_SESSION['login_usuarios'];
$super_usuario = $_SESSION['super_usuarios'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../lib/css/painel.css">
    <link rel="stylesheet" type="text/css" href="../../lib/css/navbar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"> -->
    <title>Painel</title>

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
                    <a class="nav-link" href="painel.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <?php
                if (($super_usuario == 1)) {
                ?>

                    <li class="nav-item">
                        <a class="nav-link" href="../super_usuario/painel_super_usuario.php">Ver usuários</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Empresas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../super_usuario/empresas/painel_empresas.php">Ver empresas</a>
                            <a class="dropdown-item" href="../super_usuario/vincular_empresa.php">Vincular empresa</a>
                            <a class="dropdown-item" href="../super_usuario/painel_desvincular_empresa.php">Desvincular empresa</a>
                        </div>
                    </li>

                <?php } ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Logout
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../../res/model/logout.php">Sair</a>
                    </div>
                </li>
            </ul>
        </div>

        </ul>
        </div>
    </nav>


    <div class="container">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Empresas</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01">
                <option>Todas</option>
                <?php
                require '../model/check.php';
                require '../model/init.php';
                $id_usuario = $_SESSION['id_usuarios'];

                $PDO = db_connect();
                $sql = "SELECT DISTINCT nome_empresas FROM Empresas a INNER JOIN Usuarios_Empresas b USING(id_empresas) WHERE id_usuarios = :id_usuario ORDER BY nome_empresas ASC";
                $stmt = $PDO->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->execute();

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $empresa = $resultado[0];
                $nome_empresa = $empresa['nome_empresas'];
                foreach ($resultado as $indice => $valor) {
                    echo '<option>' . htmlspecialchars($valor['nome_empresas']) . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="float-xl-left">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Data Inicial</span>
                        </div>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="float-xl-right">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Data Final</span>
                        </div>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="container painel">
        <fieldset class="borda fieldset-border">
            <!-- O elemento HTML <fieldset> é usado para agrupar elementos, assim como labels (<label>), dentro de um formulário web. -->
            <legend class="legend-border">Notas</legend>
            <!-- O Elemento HTML <legend> (ou Elemento HTML Campo "Legend") representa um rótulo para o conteúdo do seu ancestral <fieldset>. -->
            <div class="row">
                <div class="col-sm">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Qtd Emitidas</span>
                        </div>
                        <input type="text" class="form-control" value="30" readonly="readonly">
                    </div>
                </div>

                <div class="col-sm">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Qtd Canceladas</span>
                        </div>
                        <input type="text" class="form-control" value="2" readonly="readonly">
                    </div>
                </div>

                <div class="col-md">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Totais</span>
                        </div>
                        <input type="text" class="form-control" value="7741,00" readonly="readonly">
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="borda2 fieldset-border">
            <!-- O elemento HTML <fieldset> é usado para agrupar elementos, assim como labels (<label>), dentro de um formulário web. -->
            <legend class="legend-border">Cupons Eletrônicos</legend>
            <!-- O Elemento HTML <legend> (ou Elemento HTML Campo "Legend") representa um rótulo para o conteúdo do seu ancestral <fieldset>. -->
            <div class="row">
                <div class="col-sm">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Qtd Emitidas</span>
                        </div>
                        <input type="text" class="form-control" value="130" readonly="readonly">
                    </div>
                </div>

                <div class="col-sm">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Qtd Canceladas</span>
                        </div>
                        <input type="text" class="form-control" value="8" readonly="readonly">
                    </div>
                </div>

                <div class="col-md">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Totais</span>
                        </div>
                        <input type="text" class="form-control" value="3520,00" readonly="readonly">
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="borda3 fieldset-border">
            <!-- O elemento HTML <fieldset> é usado para agrupar elementos, assim como labels (<label>), dentro de um formulário web. -->
            <legend class="legend-border">Orçamentos</legend>
            <!-- O Elemento HTML <legend> (ou Elemento HTML Campo "Legend") representa um rótulo para o conteúdo do seu ancestral <fieldset>. -->
            <div class="row">
                <div class="col-sm">
                    <div class="input-group input-group-sm mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="titulo">Totais</span>
                        </div>
                        <input type="text" class="form-control" value="0,00" readonly="readonly">
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>