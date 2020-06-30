<?php
require '../model/init.php'; //incluir o arquivo para usar a conexão com banco de dados

if (isset($_POST['salvar'])) {

	$login_usuario = $_POST['login_usuario']; //name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
	$nome_empresa = $_POST['nome_empresa'];

	$PDO = db_connect();
	$sql1 = "SELECT id_usuarios FROM Usuarios WHERE login_usuarios = :login_usuario";

	$stmt = $PDO->prepare($sql1);

	$stmt->bindParam(':login_usuario', $login_usuario);

	// var_dump($stmt);

	$stmt->execute();

	$id_usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (count($id_usuario) <= 0) {
		echo "ID não encontrado";
		exit;
	}

	$id_usuario_empresa = $id_usuario[0];
	$id_usuario_empresabd = $id_usuario_empresa['id_usuarios'];

// 	// pegando o id da tabela USUARIO
	
	$sql2 = "SELECT id_empresas FROM Empresas WHERE nome_empresas = :nome_empresa";

	$stmt = $PDO->prepare($sql2);

	$stmt->bindParam(':nome_empresa', $nome_empresa);

	// var_dump($stmt);

	$stmt->execute();

	$id_empresa = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (count($id_empresa) <= 0) {
		echo "ID não encontrado";
		exit;
	}

	$id_empresa_usuario = $id_empresa[0];

	$id_empresa_usuariobd = $id_empresa_usuario['id_empresas'];
;
	// pegando o id da tabela EMPRESA

	//DELETANDO NA TABELA USUARIOS_EMPRESAS PELOS IDS

	$sql3 = "DELETE FROM usuarios_empresas WHERE id_empresas = :id_empresas AND id_usuarios = :id_usuarios";

	$stmt = $PDO->prepare($sql3);

	$stmt->bindParam(':id_empresas', $id_empresa_usuariobd);
	$stmt->bindParam(':id_usuarios', $id_usuario_empresabd);
	$stmt->execute();
	$usuario_empresa = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$usuario_empresas = $usuario_empresa[0];

	var_dump($usuario_empresas);

	

};
    
	header("location: painel_super_usuario.php");
