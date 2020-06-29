<?php
require_once("../model/crud.class.php");

$id_usuarios = $_GET['id_usuarios'];

if(isset($id_usuarios)){
	$usuario = new Crud("Usuarios");
	$filtro = array(
		"id_usuarios" => $id_usuarios
	);
	$resposta = $usuario->selectCrud("*", true, $filtro);
	// echo "<pre>";
	// print_r($resposta);
	// echo "</pre>";
	$id_usuarios = $resposta[0]->id_usuarios;

	if (isset($id_usuarios)){
		$resposta = $usuario->excluiCrud($filtro);
		if($resposta){
            header("location: painel_super_usuario.php");
        }else{
			header("Location:painel_super_usuario.php?delete=erro");
		}
		
	}
}

?>