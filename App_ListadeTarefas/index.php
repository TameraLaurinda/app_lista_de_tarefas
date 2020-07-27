<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Lista de Tarefas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script_cadastro.js"></script>
  </head>

  <body>

    <nav class="navbar">
      <div class="navbar-brand" >
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Lista de Tarefas
      </div>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login col-9 col-md-4">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <form action ="validar_login.php" method = "POST">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail" value="">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha" value="">
                </div>

                <?php if(isset($_GET['login']) && $_GET['login'] == 'erro'){ ?>
                
                  <div class='text-danger'> E-mail ou senha incorreto(s)! </div>
                <?php }
                if(isset($_GET['login']) && $_GET['login'] == 'erro2') { ?>
                    <div class='text-danger'> Usuário desconectado! </div>
                <?php } ?>
                <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
              </form>
              <div>

                <div class="row justify-content-center">

                    <div class="col-4">
                        <button class="btn btn-outline-success" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Cadastre-se</button>
                    </div>
                    
                </div>
                
                <!-- Modal do cadastro -->
                <div id="id01" class="modal">
                    <form class="modal-content animate " action="criar_conta.php" method="POST">
                        <div class="divcontainer">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <h4>Cadastre-se!</h4>
                            <h6>A senha deve ter no mínimo 6 caracteres.</h6>
                            <h6>Todos os campos abaixo devem ser preenchidos.</h6>

                        </div>

                        <div class="container">
                              <label for="name"><b>Nome:</b></label>
                              <input class="form-control" id="username" type="text" placeholder="Digite o nome" name="username" value="" required>

                              <label for="email"><b>E-mail:</b></label>
                              <input id="email-c" type="text" class="form-control " placeholder="E-mail" name="email-c" value="" required>
                              <div class="valid-feedback"> E-mail valido!</div>

                              <label for="uname"><b>Senha:</b></label>
                              <input id="psw1" type="password" class="form-control" placeholder="Senha" name="psw1" value="" required>

                              <label for="psw"><b>Confirme a senha:</b></label>
                              <input id="psw2" type="password" class="form-control" placeholder="Confirme a senha" name="psw2" value="" required>
                        </div>

                        <div class="container" style="background-color:#f1f1f1">

                            <div class="row justify-content-around">

                              <div class="row"> 
                                <div class="col-3">
                                  <button class="btn btn-success" type="submit" disabled="disabled" id="btn-cadastrar" >Cadastrar</button>
                                </div>
                              </div>
                              <div class="row"> 
                                <div class="col-3">
                                  <button class="btn btn-danger" type="button" onclick="document.getElementById('id01').style.display='none'" >Cancelar</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if(isset($_GET['cd']) && $_GET['cd'] == 'success') { ?> <script> alert('Cadastro realizado com sucesso!') </script> <?php } ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>