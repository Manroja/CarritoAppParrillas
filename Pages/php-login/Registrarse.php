<?php
include("config.php");
include("../model/UsuarioDB.php");
include("../model/Carrito_ClienteDB.php");
session_start();
$message;
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $usudb = new UsuarioDB();
  $myusername = $_POST['email'];
  $nombre= $_POST['nombre'];
  $mypassword = $_POST['password'];
  $mypassword1 = $_POST['password1'];
  if($mypassword==$mypassword1){
    $valor= $usudb->Registrar($myusername,$mypassword,$nombre);
    $carrito= new Carrito_ClienteDB();
    $carrito->IngresarCarrito_Cliente($myusername);
    if($valor!=false){
      header("location:pages-login.php");
    }else{

      $message="No se registro hay un error";
    }

  }else{
    $message="La contrasena debe estar exactamente igual.";
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
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Registro</strong> <br>Ingrese sus datos</div>
                    <br>
                            <?php if(!empty($message)): ?>
                            <p> <?= $message ?></p>
                            <?php endif; ?>
                    <form action="Registrarse.php" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control" placeholder="Usuario"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre Completo"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="password1" class="form-control" placeholder="Repetir Contraseña"/>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                          <a href="pages-login.php" class="btn btn-link btn-block">Iniciar Sesión</a>
                      </div>
                        <div class="col-md-6">

                            <button type="submit" class="btn btn-info btn-block">
                            Registrarse</button>
                        </div>
                    </div>
                    </form>
                </div>
                 <div class="login-footer">
                    <div class="pull-left">
                        &copy;2018 Alquiler Parrillero
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
