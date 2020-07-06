<?php
require '../model/init.php'; //incluir o arquivo para usar a conexão com banco de dados

	$id_empresas = $_GET['id_empresas']; //name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
	$id_usuarios = $_GET['id_usuarios'];

	if(isset($id_empresas , $id_usuarios)){
		$PDO = db_connect();
		//DELETANDO NA TABELA USUARIOS_EMPRESAS PELOS IDS

		$sql = "DELETE FROM Usuarios_Empresas WHERE id_empresas = :id_empresas AND id_usuarios = :id_usuarios";

		$stmt = $PDO->prepare($sql);

		$stmt->bindParam(':id_empresas', $id_empresas);
		$stmt->bindParam(':id_usuarios', $id_usuarios);
		$stmt->execute();
		$usuario_empresa = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$usuario_empresas = $usuario_empresa[0];

		// var_dump($stmt);

	}


	header("location: painel_desvincular_empresa.php");
