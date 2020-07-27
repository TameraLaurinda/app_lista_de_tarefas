<?php

    require 'model_app.php';

    $conexao = new Conexao();
     
    $bd = new DBServise();
	$bd->__set('conexao', $conexao->conectar());
	$bd->__set('usuario', $_SESSION['user']);

    //A variável GET['op'] existirá somente quando as opções de excluir, concluir ou alterar forem selecionadas
    if(isset($_GET['op'])){
       
        if($_GET['op'] == '0'){

            echo $bd->deletarTarefa($_GET['id']);
        }
        else if($_GET['op'] == '1'){

            $tarefa = new Tarefa();
            $tarefa->__set('id', $_GET['id']);
            $tarefa->__set('tarefa', $_GET['tarefa']);
            $bd->__set('tarefa', $tarefa);
     
            echo $bd->editarTarefa();
        }
        else if($_GET['op'] == '2'){

            $tarefa = new Tarefa;
            $tarefa->__set('id', $_GET['id']);
            $bd->__set('tarefa', $tarefa);

            echo $bd->concluirTarefa();
        }
    }
    //A variável POST['nova_tarefa] 
    else if(isset($_POST['nova_tarefa']) && $_POST['nova_tarefa'] != "" )
    {
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['nova_tarefa']);
        $bd->__set('tarefa', $tarefa);

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