<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Lista de Tarefas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      .card-login {
        padding: 30px 0 0 0;
        width: 350px;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar">
      <div class="navbar-brand" >
        <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        App Lista de Tarefas
      </a>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-login">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <form action ="validar_login.php" method = "POST">
                <div class="form-group">
                  <input name="email" type="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input name="senha" type="password" class="form-control" placeholder="Senha">
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
                <a href="nova_conta.php"> Criar uma nova conta</a>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>