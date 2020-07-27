$(document).ready( () => {

    $.ajax({
        type: 'GET',
        url: 'controller.php',
        dataType: 'json',
        data:'status=0',
        success: dados => {
            
            dados.forEach( function (tarefa) {
                $('#todas_tarefas').append("<div class='row mb-3 d-flex align-items-center tarefa'><div id='0' class='col-sm-9'></div><div class='col-sm-3 mt-2 d-flex justify-content-between'><i class='fas fa-trash-alt fa-lg text-danger'></i><i class='fas fa-edit fa-lg text-info'></i><i class='fas fa-check-square fa-lg text-success'></i></div></div> ")
                
                if(tarefa.id_status == 1){
                    $('#0').attr('id', tarefa.id).html(tarefa.tarefa +' (Pendente)')
                }
                else{
                    $('#0').attr('id', tarefa.id).html(tarefa.tarefa +' (Realizado)')
                }
            });},
        error: erro => {console.log(erro)}
    })


})