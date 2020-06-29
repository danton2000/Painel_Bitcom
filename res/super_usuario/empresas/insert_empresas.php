<?php
	include '../../model/conexao.class.php'; //incluir o arquivo para usar a conexão com banco de dados
	include '../../model/crud.class.php';
	
	if (isset($_POST['cadastro'])) {
	
		$nome_empresas = $_POST['nome_empresas'];//name(do html)=[] //RECEBE O VALOR DO ATRIBUTO
		$data_validade_empresas = $_POST['data_validade_empresas'];
		$date = date("Y-m-d",strtotime(str_replace('/','-',$data_validade_empresas)));
	
		$empresas = new Crud("Empresas");
		$array_dados = array(
			"nome_empresas" => $nome_empresas,
			"data_validade_empresas" => $date
		);
	
		$resposta = $empresas->insereCrud($array_dados); //precisa criar um array com os dados

		// var_dump($array_dados);

	};
	
	header("location: painel_empresas.php");
?>

