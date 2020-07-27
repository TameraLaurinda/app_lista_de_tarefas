<?php

require 'model_app.php';

$conexao = new Conexao();
 
$bd = new DBServise();
$bd->__set('conexao', $conexao->conectar());
$bd->__set('usuario', $_SESSION['user']);



if(isset($_GET['status']) || $_GET['status'] == 1 || $_GET['status'] == 0){
    
    if($_GET['status'] == 1){

        echo json_encode ($bd->listarTarefasP());
    }
    else if($_GET['status'] == 0){

        echo json_encode ($bd->listarTarefas());
    }
    
}

?>