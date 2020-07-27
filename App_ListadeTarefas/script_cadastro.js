
            // Disable form submissions if there are invalid fields
$(document).ready( () => {

    var valid = [false, false, false, false]

    var psw = false

    let input_email = document.getElementById('email-c')

    input_email.addEventListener( 'blur', function(evento){

            let input = evento.target;
            let email = evento.target.value

            console.log(email)

            if(email != ''){

                $.ajax({

                    type: 'GET',
                    url: 'criar_conta.php',
                    dataType: 'text',
                    data: `email=${email}`,
                    success: dados => {

                        let array_empty = []

                        if(dados != array_empty){
                            input.classList.remove('--has-success')
                            input.classList.add('--has-error')
                            valid[1]=false
                            habilitar_btn(validacao())
                        }
                        else{
                            input.classList.remove('--has-error')
                            input.classList.add('--has-success')
                            valid[1]=true
                            habilitar_btn(validacao())
                        }
                    },
                    error: erro => { console.log(erro)}
                })
            }
            console.log(valid )
      })
   
    var input_senha1 = document.getElementById('psw1')

    input_senha1.addEventListener('blur', function(evento){

        var senha1 = evento.target.value
        var input_pws1 = evento.target

        tam = senha1.length
        let psw2 = document.getElementById('psw2').value

        if(!psw){
            if(tam < 6){
                input_pws1.classList.remove('--has-success')
                input_pws1.classList.add('--has-error')
                valid[2] = false
                habilitar_btn(validacao())
            }
            else{
                input_pws1.classList.remove('--has-error')
                input_pws1.classList.add('--has-success')
                valid[2] = true
                habilitar_btn(validacao())
            }
        }else{
            
            if(senha1 != psw2){
                input_pws1.classList.remove('--has-success')
                input_pws1.classList.add('--has-error')
                valid[2] = false
                habilitar_btn(validacao())
            }else{
                input_pws1.classList.remove('--has-error')
                input_pws1.classList.add('--has-success')
                valid[2] = true
                habilitar_btn(validacao())
            }
        }
        
        
    })


    let input_senha2 = document.getElementById('psw2')

    input_senha2.addEventListener('blur', function(evento){

        let senha1 = document.getElementById('psw1').value
        let senha2 = evento.target.value
        let input_pws2 = evento.target

        if(senha2 != senha1){
            input_pws2.classList.remove('--has-success')
            input_pws2.classList.add('--has-error')
            valid[3] = false
            psw = false
            habilitar_btn(validacao())
        }else{
            input_pws2.classList.remove('--has-error')
            input_pws2.classList.add('--has-success')
            valid[3] = true
            psw = true
            habilitar_btn(validacao())
        }

        
    })

    

    let username = document.getElementById('username')

    username.addEventListener('blur', function(evento){

        let nome = evento.target.value
        let input_name = evento.target
        

         if(nome === ""){
            valid[0] = false
            input_name.classList.remove('--has-success')
            input_name.classList.add('--has-error')
            habilitar_btn(validacao())
          }else{
            valid[0] = true
            input_name.classList.remove('--has-error')
            input_name.classList.add('--has-success')
            habilitar_btn(validacao())
          }
         

    })
   

    function validacao(){
       
       if(valid.indexOf(false) == -1){
            return true
       }else{
            return false
       }
    }

    function habilitar_btn(validacao){

        if(validacao){
            document.getElementById('btn-cadastrar').disabled = false
        }else{
              document.getElementById('btn-cadastrar').disabled = true
        }
    }
     
})
               
    
 
                 

            