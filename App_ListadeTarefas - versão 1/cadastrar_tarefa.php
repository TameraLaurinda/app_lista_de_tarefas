<?php
    require_once 'model_app.php';

    if(isset($_POST['nova_tarefa']) && $_POST['nova_tarefa'] != "" )
    {
        $conexao = new Conexao();

        $tarefa = new Tarefa($_POST['nova_tarefa']);

        $bd =  new DBServise();
        $bd->__set('usuario', $_SESSION['user']);
        $bd->__set('conexao', $conexao->conectar());
        $bd->__set('tarefa', $tarefa);

        print_r($bd);

        if($bd->cadastrarTarefa() == 'true'){
            header('Location: nova_tarefa.php?insert=success');
        }
        else{
            header('Location: nova_tarefa.php?insert=erro');
        }

    }else{
        header('Location: nova_tarefa.php?insert=erro');
    }




?>