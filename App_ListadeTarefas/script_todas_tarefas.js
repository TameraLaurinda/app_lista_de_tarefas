$(document).ready( () => {

    $.ajax({
        type: 'GET',
        url: 'controller.php',
        dataType: 'json',
        data:'status=0',
        success: dados => {
            
            if(dados.length == 0){$('#todas_tarefas').append("<div class='content'> <div class='row justify-content-center'><div col-6> <h5>Você não possui tarefas cadastradas. </h5> </p> </div></div></div>")}
            else{
                dados.forEach( function (tarefa) {
                    $('#todas_tarefas').append("<div id='div' class='row mb-3 d-flex align-items-center tarefa'><div id='0' class='col-7 col-md-9'></div><div class='col-4 col-md-3 mt-2 d-flex justify-content-between'><i id='delet' onclick='modal_deletar(this.id)' class='fas fa-trash-alt fa-lg text-danger'></i><i id='alter' onclick='editar(this.id)' class='fas fa-edit fa-lg text-info'></i><i id='ok' onclick='modal_concluir(this.id)' class='fas fa-check-square fa-lg text-success'></i></div></div> ")
                    $('#div').attr('id', `div-${tarefa.id}`)
                    $('#0').attr('id', `text-${tarefa.id}`).html(tarefa.tarefa)
                    $('#delet').attr('id', tarefa.id).attr('value', tarefa.id)
                    $('#alter').attr('id', tarefa.id).attr('value', tarefa.id)
                    $('#ok').attr('id', tarefa.id).attr('value', tarefa.id)
                    
                    if(tarefa.id_status == 1){
                        $('#0').attr('id', tarefa.id).html(tarefa.tarefa +' (Pendente)')
                    }
                    else{
                        $('#0').attr('id', tarefa.id).html(tarefa.tarefa +' (Realizado)')
                    }
                }) 
            }
        ;},
        error: erro => {console.log(erro)}
    })


})