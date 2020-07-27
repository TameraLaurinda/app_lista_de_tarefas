<?php

    require 'model_app.php';

    $bd = new DBServise();

    $conexao = new Conexao();

    $bd->__set('conexao', $conexao->conectar());

    if(isset($_GET['email']) && !isset($_POST['email-c'])){
        print_r( $bd->verificarEmail($_GET['email']));}

    if(isset($_POST['email-c']) && isset($_POST['psw2']) &&  isset($_POST['psw2']) && isset($_POST['username'])){

        $usuario = new Usuario();
        $usuario->__set('nome',$_POST['username'] );
        $usuario->__set('email',$_POST['email-c'] );
        $usuario->__set('senha', md5($_POST['psw2']));
        $bd->__set('usuario',  $usuario);

        $bd->criarConta();
        header('Location: index.php?cd=success');
    }

    
?>