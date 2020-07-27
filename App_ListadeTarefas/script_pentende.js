$(document).ready( () => {

    $.ajax({
        type: 'GET',
        url: 'controller.php',
        dataType: 'json',
        data:'status=1',
        success: dados => {

            console.log(dados)
            if (dados.length == 0) { $('#tarefas_pendentes').append("<div class='content'> <div class='row justify-content-center'><div col-6> <h5>Você não tem tarefas pendentes no momento. </h5> </p> </div></div></div>")}
            else{
                dados.forEach( function (tarefa) {
                    $('#tarefas_pendentes').append("<div id='div' class='row mb-3 d-flex align-items-center tarefa'><div id='0' class='col-7 col-md-9'></div><div class='col-4 col-md-3 mt-2 d-flex justify-content-between'><i id='delet' onclick='modal_deletar(this.id)' class='fas fa-trash-alt fa-lg text-danger'></i><i id='alter' onclick='editar(this.id)' class='fas fa-edit fa-lg text-info'></i><i id='ok' onclick='modal_concluir(this.id)' class='fas fa-check-square fa-lg text-success'></i></div></div> ")
                    $('#div').attr('id', `div-${tarefa.id}`)
                    $('#0').attr('id', `text-${tarefa.id}`).html(tarefa.tarefa)
                    $('#delet').attr('id', tarefa.id).attr('value', tarefa.id)
                    $('#alter').attr('id', tarefa.id).attr('value', tarefa.id)
                    $('#ok').attr('id', tarefa.id).attr('value', tarefa.id)
            })}
        ;},
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
    //let tarefa_atual = $(`#${id}`).closest(`#${id}`).html()
    let tarefa_atual = $(`#text-${id}`).html()
    

    //criando um form de edição
   /* let form = document.createElement('form')
    form.className = 'row'
    form.style.paddingTop = '22px'*/

    //criar um input para entrar o texto com o valor igual a tarefa atual
    let inputTarefa = document.createElement('input')
    inputTarefa.type = 'text'
    inputTarefa.className = 'form-control'
    inputTarefa.value = tarefa_atual
    inputTarefa.id = 'tarefa_atual'

    //criar um button para chamar a função de atualizar
    let button = document.createElement('button')
    button.id = 'atualizar'
    button.type = 'submit'
    button.className = "btn btn-dark"
    button.innerHTML = 'Atualizar'


    //incluo a input preenchido com a atarefa atual e o button para disparar a função atualizar
   // form.appendChild(inputTarefa)
    //form.appendChild(button)

    //atribuindo a variável tarefa todos os elemento com o atributo id igual ao id da tarefa selecionada
    let tarefa = document.getElementById(`div-${id}`)

    //Limpando o campo onde esta a tarefa
    tarefa.innerHTML = ''

    /*let div_form_group = document.createElement('div')
    div_form_group.className = 'form-group d-flex flex-row'
    div_form_group.id = 'div-editar'*/

    let div_input_group = document.createElement('div')
    div_input_group.className = 'input-group'
    div_input_group.id = `div-editar-${id}`

    let div_group = document.createElement('div')
    div_group.className = 'input-group-append'

    //div_form_group.appendChild(div_input_group)
    div_input_group.appendChild(inputTarefa)
    div_input_group.appendChild(div_group)
    div_group.appendChild(button)
    
   

    while (tarefa.firstChild) {
        tarefa.removeChild(elemento.firstChild);
    }

    //Inclucindo o formulário como filho 
    tarefa.insertBefore(div_input_group, tarefa[0])

    $('#atualizar').click( () =>{
        console.log('atualizar')
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
                },
                error: erro =>{
                    alert('Erro')
                    console.log(erro)
                }
            })
        }
        
        $(`#div-editar-${id}`).remove()
        /*while (div_id.firstChild) {
            div_id.removeChild(div_editar);
        }*/
        console.log(id)
        $(`#div-${id}`).append(`<div id=text-${id} class='col-7 col-md-9'></div><div class='col-4 col-md-3 mt-2 d-flex justify-content-between'><i id=${id} onclick='modal_deletar(this.id)' class='fas fa-trash-alt fa-lg text-danger'></i><i id=${id} onclick='editar(this.id)' class='fas fa-edit fa-lg text-info'></i><i id=${id} onclick='modal_concluir(this.id)' class='fas fa-check-square fa-lg text-success'></i></div> `)
        $(`#text-${id}`).html(tarefa_atualizada)
        
    })

}

function modal_concluir(id){
    
    //Função closest para pegar o ansestral a cima com o mesmo id do elemento selecionado
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
           window.location='home.php'
        },
        error: erro =>{
            alert('Erro')
            console.log(erro)
        }
    })
    
}

