<?php
// inclui o arquivo de inicialização
require '../model/init.php';

$login_usuarios = isset($_POST['login_usuarios']) ? $_POST['login_usuarios'] : '';
$senha_usuarios = isset($_POST['senha_usuarios']) ? $_POST['senha_usuarios'] : '';

$passwordHash = hash("sha256",$_POST['senha_usuarios']);

// echo $login_usuarios;
// echo $passwordHash;

$PDO = db_connect();

$sql = "SELECT id_usuarios, login_usuarios, senha_usuarios, super_usuarios FROM Usuarios WHERE login_usuarios = :login_usuarios AND senha_usuarios = :senha_usuarios";

$stmt = $PDO->prepare($sql);

$stmt->bindParam(':login_usuarios', $login_usuarios);
$stmt->bindParam(':senha_usuarios', $passwordHash);

// var_dump($usuario);

$stmt->execute();
 
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
if (count($usuarios) <= 0)
{
    echo "Email ou senha incorretos";
    exit;
}
 
// pega o primeiro usuário
$usuario = $usuarios[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['id_usuarios'] = $usuario['id_usuarios'];
$_SESSION['login_usuarios'] = $usuario['login_usuarios'];
$_SESSION['super_usuarios'] = $usuario['super_usuarios'];


// var_dump($usuario['super_usuarios']);

header('Location: ../usuarios/painel.php');