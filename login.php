<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lib/css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"> -->
    <title>Login</title>
</head>

<body>
    <div class="container" id="tamanho_login">

        <form action="res/login/login.php" method="POST">
            <div class="form-group text-center">
                <h3>Login</h3>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="text" name="login_usuarios" class="form-control" placeholder="Insira o seu email" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha_usuarios" class="form-control" placeholder="Insira a sua senha" autocomplete="off" required>
            </div>

            <div id="botao_direita">
                <button type="submit" id="botao_login" class="btn btn-sm">Entrar</button>
            </div>
        </form>

    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>