
<?php
include("config.php");
include("../model/UsuarioDB.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $usudb = new UsuarioDB();
      $myusername = $_POST['email'];
      $mypassword = $_POST['password'];
      $answer= $usudb->Acceder($myusername,$mypassword);

      if($answer!= null) {
        $_SESSION['user_id'] = $answer->getUsuario_id();

        //GUARDAMOS EL OBJETO USUARIO EN UNA
        //VARIABLE DE SESIÓN.
        $_SESSION['usuarioLogueado'] = $answer;

        $oUsuario = new Usuario();
        $oUsuario = $_SESSION['usuarioLogueado'];
        if(strcmp($oUsuario -> getRol(),"Admin") ===0){
          header("location: ../Admin/form-layouts-one-column.php");
        }
         else{

           header("location: ../home-page.php");
         }
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Iniciar Sesion</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="../../img/logo.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="../../css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <div class="login-container">

            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Bienvenido Inicie su sesion.</strong></div>
                    <br>
                            <?php if(!empty($message)): ?>
                            <p> <?= $user ?></p>
                            <p> <?= $message ?></p>
                            <?php endif; ?>
                    <form action="login.php" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control" placeholder="Usuario"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Olvido la Contraseña?</a>
                            <a href="Registrarse.php" class="btn btn-link btn-block">Registrarse</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info btn-block">Ingresar</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 420Studio Systems
                    </div>
                    <div class="pull-right">
                        <a href="#">Acerca de...</a> |
                        <a href="#">Privacidad</a> |
                        <a href="#">Contactenos</a>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>
