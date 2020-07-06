<?php
	include '../model/conexao.class.php'; //incluir o arquivo para usar a conexão com banco de dados
	include '../model/crud.class.php';
	
	if (isset($_POST['cadastro'])) {
	
		$login_usuarios = $_POST['login_usuarios'];//name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
        $senha_usuarios = hash("sha256",$_POST['senha_usuarios']);
        $super_usuarios = $_POST['super_usuarios'];
	
		$usuarios = new Crud("Usuarios");
		$array_dados = array(
			"login_usuarios" => $login_usuarios,
			"senha_usuarios" => $senha_usuarios,
			"super_usuarios" => $super_usuarios,
		);
	
		$resposta = $usuarios->insereCrud($array_dados); //precisa criar um array com os dados

    };
    
	header("location: cadastro_usuarios.php");
?>

