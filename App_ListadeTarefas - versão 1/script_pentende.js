$(document).ready( () => {

    $.ajax({
        type: 'GET',
        url: 'controller.php',
        dataType: 'json',
        data:'status=1',
        success: dados => {
            dados.forEach( function (tarefa) {
                $('#tarefas_pendentes').append("<div class='row mb-3 d-flex align-items-center tarefa'><div id='0' class='col-sm-9'></div><div class='col-sm-3 mt-2 d-flex justify-content-between'><i id='delet' onclick='modal_deletar(this.id)' class='fas fa-trash-alt fa-lg text-danger'></i><i id='alter' onclick='editar(this.id)' class='fas fa-edit fa-lg text-info'></i><i id='ok' onclick='modal_concluir(this.id)' class='fas fa-check-square fa-lg text-success'></i></div></div> ")
                $('#0').attr('id', tarefa.id).html(tarefa.tarefa)
                $('#delet').attr('id', tarefa.id).attr('value', tarefa.id)
                $('#alter').attr('id', tarefa.id).attr('value', tarefa.id)
                $('#ok').attr('id', tarefa.id).attr('value', tarefa.id)
        });},
        error: erro => {console.log(erro)}
    })
    
})
function modal_deletar(id){	
    
    console.log('entrou no deletar')
    //Recuperando a tarefa selecionada para exclusão
    let tarefa_atual = $(`#${id}`).closest(`#${id}`).html()

    //Inserido o titulo e conteudo no modal 
    $('#modal_titulo').html('Deseja excluir a tarefa:')
    $('#modal_conteudo').html(`"${tarefa_atual}"?`)
    $('#modal_titulo_div').attr('class', 'modal-header text-danger')
    $('.modal-footer').empty()
    $('#modal-footer').append(`<button type='button' class='btn btn-danger' data-dismiss='modal' id='confirmar_btn' aria-label='Close' value=${id} onclick='deletar()'>Confirmar</button><button type='button' data-dismiss='modal' id='voltar_btn'>Voltar</button>`)
    $('#voltar_btn').attr('class', 'btn btn-dark').html('Cancelar')
    $('#modal_tarefa').modal('show')  
}

function deletar(){

    //Recuperando o 'id da tarefa que foi atribuida como 'value' do button
    let id_tarefa = document.getElementById('confirmar_btn').value
    $.ajax({
        type : 'GET',
        dataType: 'text',
        url: 'controller_tarefa.php',
        data: `op=0&id=${id_tarefa}`,
        success: dados => {
            window.location= 'home.php'
        },
        error: erro =>{
            alert('Erro')
            console.log(error)
        }
    })
}

function editar(id){

    //Recuperando a tarefa atual
    let tarefa_atual = $(`#${id}`).closest(`#${id}`).html()

    //criando um form de edição
    let form = document.createElement('form')
    form.className = 'row'
    form.style.paddingTop = '22px'

    //criar um input para entrar o texto com o valor igual a tarefa atual
    let inputTarefa = document.createElement('input')
    inputTarefa.type = 'text'
    inputTarefa.className = 'col-10 form-control'
    inputTarefa.value = tarefa_atual
    inputTarefa.id = 'tarefa_atual'

    //criar um button para chamar a função de atualizar
    let button = document.createElement('button')
    button.id = 'atualizar'
    button.className = "col-2 btn btn-dark"
    button.innerHTML = 'Atualizar'


    form.appendChild(inputTarefa)
    form.appendChild(button)

    //atribuindo a variável tarefa todos os elemento com o atrbivuto id igual ao id da tarefa selecionada
    let tarefa = document.getElementById(id)

    //Limpando o campo onde esta a tarefa
    tarefa.innerHTML = ''

    //Inclucindo o formulário como filho 
    tarefa.insertBefore(form, tarefa[0])

    $('#atualizar').click( () =>{

        //Recuperando o valor da tarefa atualizada
        let tarefa_atualizada = document.getElementById('tarefa_atual').value

        //Verificando se houve modificação na tarefa
        if(tarefa_atual != tarefa_atualizada){

            $.ajax({
                type : 'GET',
                dataType: 'text',
                url: 'controller_tarefa.php',
                data: `op=1&id=${id}&tarefa=${tarefa_atualizada}`,
                success: dados => {
                   console.log(dados)
                   $(`#${id}`).closest(`#${id}`).html(tarefa_atualizada)
                },
                error: erro =>{
                    alert('Erro')
                    console.log(erro)
                }
            })
        }
    })

}

function modal_concluir(id){
    
    let tarefa_atual = $(`#${id}`).closest(`#${id}`).html()

    //Inserido o titulo e conteudo no modal 
    $('#modal_titulo').html('Deseja concluir a tarefa:')
    $('#modal_conteudo').html(`"${tarefa_atual}"?`)
    $('#modal_titulo_div').attr('class', 'modal-header text-success')

    //Eliminando qualquer filho do elemento onde sera incluido os button's
    $('.modal-footer').empty()
    $('.modal-footer').append(`<button type='button' class='btn btn-success' data-dismiss='modal' id='confirmar_btn' aria-label='Close' value=${id} onclick='concluir()'>Confirmar</button><button type='button' data-dismiss='modal' id='voltar_btn'>Voltar</button>`)
    $('#voltar_btn').attr('class', 'btn btn-dark').html('Cancelar')
    
    $('#modal_tarefa').modal('show')  
}

function concluir(){

    let id = document.getElementById('confirmar_btn').value

    $.ajax({
        type : 'GET',
        dataType: 'text',
        url: 'controller_tarefa.php',
        data: `op=2&id=${id}`,
        success: dados => {
           console.log(dados)
        },
        error: erro =>{
            alert('Erro')
            console.log(erro)
        }
    })
    
}

