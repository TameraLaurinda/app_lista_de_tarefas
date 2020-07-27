<?php

	require 'model_app.php';

	//Reperando email e senha subimentidos no formulário pelo action com metodo POST
	if($_POST['email'] != '' && $_POST['senha'] != ''){
		
		$usuario = new Usuario();
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		$conexao = new Conexao();
		$bd = new DBServise();
		$bd->conexao = $conexao->conectar();
		$bd->__set('usuario',  $usuario);

		$user_login = $bd->validarAcesso();

		print_r($user_login);
		if($user_login->senha == $usuario->__get('senha')){

			$usuario->__set('id', $user_login->id);
			$usuario->__set('nome', $user_login->nome);
			$_SESSION['autenticado'] = 'sim';
			$_SESSION['user'] = $usuario;

			header('Location: home.php');
		}
		else{
			$_SESSION['autenticado'] = 'nao';
			header('Location: index.php?login=erro');
		}
	}

	


?>