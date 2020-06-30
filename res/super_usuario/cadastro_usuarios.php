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
    <title>Cadastro</title>
</head>

<body>
    <div class="container" id="tamanho_login">

        <form action="insert_usuarios.php" method="POST">
            <div class="form-group">
                <h3>Cadastro</h3>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="text" name="login_usuarios" class="form-control" placeholder="Insira o seu email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha_usuarios" class="form-control" placeholder="Insira a sua senha" autocomplete="off" required>
            </div>

            <div class="checkbox">
              <label>
                <input type="hidden" name="super_usuarios" value="0">
                <input type="checkbox" name="super_usuarios" value="1"> Acesso ao Super Usuário
              </label>
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
                            <button type="submit" id="botao_login" name="cadastro" class="btn btn-sm">Cadastrar</button>
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