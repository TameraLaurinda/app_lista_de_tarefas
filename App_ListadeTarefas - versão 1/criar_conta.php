<?php

    require 'model_app.php';

    $bd = new DBServise();

    $conexao = new Conexao();

    $bd->__set('conexao', $conexao->conectar());

    if(isset($_GET['email'])){
        print_r( $bd->verificarEmail($_GET['email']));}

    else if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['senha']) && $_POST['senha'] != '' && $_POST['nome'] != '' && isset($_POST['nome'])){

       /* $usuario = new Usuario();
        $usuario->__set('email',$_POST['email'] );
        $usuario->__set('senha', md5($_POST['senha']));
        $bd->__set('usuario',  $usuario);*/

        echo 'entrou aqui caraio';
    }

    
?>