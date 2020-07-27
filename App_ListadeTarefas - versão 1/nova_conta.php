
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>App Lista Tarefas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script scr="criar_conta.js"></script>
        <link rel="stylesheet" href="css/estilo.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>

    <body>
    <nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
				<ul class="navbar-nav">
       				 <li class="nav-item">
         				 <a class="btn btn-dark" href="index.php">Voltar</a>
        			</li>
     			 </ul>
			</div>
		</nav>
        <div class="container">
            <h2>Crie sua conta!</h2>
            <p>Para criar sua conta não é necessário um endereço de e-mail válido e não sera enviado nenhum tipo de mensagem de confirmação para o seu e-mail.</p>
            <form action='criar_conta.php' method='POST' id="form-cad" class="needs-validation" >
                
                <div class="field-group">
                    <label for="uname">Nome:</label>
                    <input type="text" class="form-control" id="uname" placeholder="Digite seu Nome" name="uname" required>
                   
                </div>
                <div class="form-group" id='form-email'>
                    <label for="uname">E-mail:</label>
                    <input type="text" class="form-control" id="email" placeholder="Digite seu e-mail" name="email" required>
                  
                </div>
                <div class="form-group" id='div-pwd1'>
                    <label for="pwd">Senha:</label>
                    <input type="password" class="form-control" id="pwd1" placeholder="Digite a senha" name="pswd" value='' required>
                  
                </div>
                <div class="form-group" id='div-pwd2'>
                    <label for="pwd">Confirme a senha:</label>
                    <input type="password" class="form-control" id="pwd2" placeholder="Confirme a senha" name="pswd" value='' required>
                    
                </div>
                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Check this checkbox to continue.</div>
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                
            </form>
        </div>
        <script>
            // Disable form submissions if there are invalid fields
            $(document).ready( function() {
               
                $('#email').blur( () =>{
                        

                    let email = document.getElementById('email').value
                        if(email != ''){

                            $.ajax({
                            
                                type: 'GET',
                                url: 'criar_conta.php',
                                dataType: 'text',
                                data: `email=${email}`,
                                success: dados => {
                                    console.log(dados)
                                    let a = []
                                    $('#form-email').append("<div id='valid-email'></div>")
                                    if(dados != a){
                                        
                                        $('#valid-email').html('E-mail já cadastrado.').attr('class', 'text text-danger')
                                    }
                                    else{
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
                
                $('#pwd1').blur(() =>{

                    senha = document.getElementById('pwd1').value

                    if(senha != ''){

                        let tam = senha.length
                        $('#div-pwd1').append("<div id='valid-pwd1'></div>")
                        $('#valid-pwd1').html('')
                        if(tam < 6){
                            
                            $('#valid-pwd1').html('A senha deve ter no mínimo 6 caracteres.').attr('class', 'text text-danger')
                        }
                    }
                })

                $('#pwd2').blur( () =>{

                    let senha2 = document.getElementById('pwd2').value
                    $('#div-pwd2').append("<div id='valid-pwd2'></div>")
                    $('#valid-pwd2').html('')
                    if(senha2 == ''){
                        $('#valid-pwd2').html('Confirme a senha.').attr('class', 'text text-danger')
                    }else if(senha2 != senha){
                        $('#valid-pwd2').html('Senhas diferentes!').attr('class', 'text text-danger')
                    }else{
                        $('#valid-pwd2').html('Senha válida!').attr('class', 'text text-success')
                    }
                })

            })

           
        </script>
    </body>

    

