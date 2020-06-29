<?php 
require_once("../model/crud.class.php");

if (isset($_POST['salvar'])){
	
	$usuario = new Crud("Usuarios");
	$array_dados = array(
		"login_usuarios" =>  $_POST['login_usuarios'],//name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
		"senha_usuarios" => hash("sha256",$_POST['senha_usuarios']),
		"super_usuarios" => $_POST['super_usuarios'],
	);

	$array_id = array(
		"id_usuarios" =>  $_POST['id_usuarios'],
	);

	$resposta = $usuario->atualizaCrud($array_dados, $array_id);
	if($resposta){
		header("Location: painel_super_usuario.php");
	}
	else{
		header("Location: painel_super_usuario.php?update=erro");
	}
			
}
?>



