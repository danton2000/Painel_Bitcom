<?php
require_once("../../model/crud.class.php");

$id_empresas = $_GET['id_empresas'];

if(isset($id_empresas)){
	$empresas = new Crud("Empresas");
	$filtro = array(
		"id_empresas" => $id_empresas
	);
	$resposta = $empresas->selectCrud("*", true, $filtro);
	// echo "<pre>";
	// print_r($resposta);
	// echo "</pre>";
	$id_empresas = $resposta[0]->id_empresas;

	if (isset($id_empresas)){
		$resposta = $empresas->excluiCrud($filtro);
		if($resposta){
            header("location: painel_empresas.php");
        }else{
			header("Location:painel_empresas.php?delete=erro");
		}
		
	}
}

?>