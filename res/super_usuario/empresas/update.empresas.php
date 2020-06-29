<?php 
require_once("../../model/crud.class.php");

if (isset($_POST['salvar'])){
	$data_validade_empresas = $_POST['data_validade_empresas'];
	$date = date("Y-m-d",strtotime(str_replace('/','-',$data_validade_empresas)));

	$empresas = new Crud("Empresas");

	$array_dados = array(
		"nome_empresas" =>  $_POST['nome_empresas'],//name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
		"data_validade_empresas" => $date,
	);

	$array_id = array(
		"id_empresas" => $_POST['id_empresas'],
	);

	

	$resposta = $empresas->atualizaCrud($array_dados, $array_id);
	if($resposta){
		header("Location: painel_empresas.php");
	}
	else{
		header("Location: painel_empresas.php?update=erro");
	}
			
}
?>



