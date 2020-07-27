$(document).ready(function () {

  $('#email').blur(() => {


    let email = document.getElementById('email').value
    if (email != '') {

      $.ajax({

        type: 'GET',
        url: 'criar_conta.php',
        dataType: 'text',
        data: `email=${email}`,
        success: dados => {

          let a = []
          $('#form-email').append("<div id='valid-email'></div>")
          if (dados != a) {

            $('#valid-email').html('E-mail já cadastrado.').attr('class', 'text text-danger')
          }
          else {
            $('#valid-email').html('E-mail válido.').attr('class', 'text text-success')
          }
        },
        error: erro => {
          console.log(erro)
        }
      })
    }

  })
  var senha

  $('#pwd1').blur(() => {

    senha = document.getElementById('pwd1').value

    if (senha != '') {

      let tam = senha.length
      $('#div-pwd1').append("<div id='valid-pwd1'></div>")
      $('#valid-pwd1').html('')
      if (tam < 6) {

        $('#valid-pwd1').html('A senha deve ter no mínimo 6 caracteres.').attr('class', 'text text-danger')
      }
    }
  })

  $('#pwd2').blur(() => {

    let senha2 = document.getElementById('pwd2').value
    $('#div-pwd2').append("<div id='valid-pwd2'></div>")
    $('#valid-pwd2').html('')
    if (senha2 == '') {
      $('#valid-pwd2').html('Confirme a senha.').attr('class', 'text text-danger')
    } else if (senha2 != senha) {
      $('#valid-pwd2').html('Senhas diferentes!').attr('class', 'text text-danger')
    } else {
      $('#valid-pwd2').html('Senha válida!').attr('class', 'text text-success')
    }
  })

})