<?php

include("config.php");
include("../model/UsuarioDB.php");
include("../model/Carrito_ClienteDB.php");


   if(!empty($_POST)) {
     session_start();
      $usudb = new UsuarioDB();
      $myusername = $_POST['email'];
      $mypassword = $_POST['password'];
      $answer= $usudb->Acceder($myusername,$mypassword);

      if($answer!= null) {
        $_SESSION['user_id'] = $answer->getUsuario_id();
        $_SESSION['name'] =$answer->getNombreCompleto();
        //GUARDAMOS EL OBJETO USUARIO EN UNA
        //VARIABLE DE SESIÓN.
        $oCarritoClienteDB= new Carrito_ClienteDB();
        $carrito=$oCarritoClienteDB->getCarritoActual($_SESSION['user_id']);
        $_SESSION['cart'] = $carrito;
        $_SESSION['usuarioLogueado'] = $answer;

        $oUsuario = new Usuario();
        $oUsuario = $_SESSION['usuarioLogueado'];
        if(strcmp($oUsuario -> getRol(),"Admin") ===0){
          header("location: ../Admin/index.php");
        }
         else{

           header("location: ../view/home-page.php");
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
        <title>Inicio de Sesión</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="../Admin/css/theme-blue.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

        <div class="login-container">

            <div class="login-box animated fadeInDown">
                <div class="login-logo" ></img></div>
                <div class="login-body">
                    <div class="login-title"><strong>Bienvenido</strong>, Inicie Sesión</div>
                    <?php if(!empty($message)): ?>
                    <p> <?= $user ?></p>
                    <p> <?= $message ?></p>
                    <?php endif; ?>
                    <form action="" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Usuario" name="email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
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
                        &copy; 2018 Alquiler Parrillero
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
