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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../lib/css/cadastro.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"> -->
    <title>Desvincular</title>
</head>

<body>
    <div class="container" id="tamanho_login">

        <form action="delete_usuario_empresa.php" method="POST">
            <div class="form-group">
                <h3>Desvincular Empresa</h3>
            </div>

            <div class="form-group">
                <label>Usuário</label>
                <select class="form-control" name="login_usuario" required>
                    <option>Escolha um Usuário</option>
                    <?php
                        require_once("../model/crud.class.php");
                        $usuario = new Crud("Usuarios");
                        $resposta = $usuario->selectCrud("*"); //$resposta está em formato de array
                        foreach ($resposta as $indice => $valor) {
                            echo '<option>' . htmlspecialchars($valor->login_usuarios) . '</option>';
                        }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Empresa</label>
                <select class="form-control" name="nome_empresa" required>
                    <option>Escolha uma Empresa</option>
                    <?php
                        require_once("../model/crud.class.php");
                        $empresa = new Crud("Empresas");
                        $resposta = $empresa->selectCrud("*"); //$resposta está em formato de array
                        foreach ($resposta as $indice => $valor) {
                            echo '<option>' . htmlspecialchars($valor->nome_empresas) . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div id="botoes">
                <div class="row">
                    <div class="col">
                        <div class="float-xl-left">
                            <a href="painel_super_usuario.php" role="button" id="botao_voltar" class="btn btn-sm">Voltar</a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="float-right">
                            <button type="submit" id="botao_excluir" name="salvar" class="btn btn-sm">Desvincular</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>