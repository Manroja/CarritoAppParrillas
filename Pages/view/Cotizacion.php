<?php
include("../model/ProductoDB.php");
include("../model/Detalle_CarritoDB.php");
include("../model/UsuarioDB.php");
session_start();
//Con este if validamos si no hay un usuario logueado
//lo va redigir al login
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: ../php-login/pages-login.php");
}
//Si el usuario Logueado es un administrador lo regresa
//al mantenimiento de administrador
$oUsuario = new Usuario();
$oUsuario = $_SESSION['usuarioLogueado'];
//Si el usuario Logueado es un administrador lo regresa
//al mantenimiento de administrador
if(strcmp($oUsuario -> getRol(),"Admin") ===0){
  header("location: ../Admin/index.php");
}



  $message;
  if (isset($_SESSION['user_id'])) {
  $Detalle_Carrito= new Detalle_CarritoDB();
  if(!empty($_POST)) {
  if (isset($_POST['eliminar'])) {
  $Detalle_id=$_POST['eliminar'];
  $query=$Detalle_Carrito->DeleteDetalle_Carrito($Detalle_id);
  if ($query) {
  $message= "Producto Eliminado";
  }else{
  $message= "Error al Eliminar";
}
}
//Codigo para actualizar carrito

if(isset($_POST['cotizar']))
{
  $Detalle_Carrito->Get_Prueba($_SESSION['user_id'],$_POST['nombre'],$_POST['email'],$_POST['telefono'],$_POST['direccion']);
 }


  }
  $VAR= $Detalle_Carrito->Get_ALLDetalles($_SESSION['user_id']);
  $cont= $Detalle_Carrito->getContador();


  }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Cotizacion</title>
  <!-- Font Awesome -->
  <script type="text/javascript" src="../../js/functions.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../../css/style.min.css" rel="stylesheet">
</head>

<body class="grey lighten-3">

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="home-page.php" >
        <img src="../../img/iconoParrilla.png" width="24" height="30"></img>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">

            <a class="nav-link waves-effect" href="home-page.php">Inicio
              <span class="sr-only">(current)</span>
            </a>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="Cotizacion.php" >Cotizar</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="Cotizacion.php">
              <span class="badge red z-depth-1 mr-1"> <?php echo $_SESSION['Cont'] ?> </span>
              <i class="fa fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Carrito </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger btn-sm" href="../php-login/cerrarSesion.php">Salir</a>
          </li>
          </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-5 h2 text-center">Cotización</h2>
      <br>
                            <?php if(!empty($message)): ?>
                            <p> <?= $message ?></p>
                            <?php endif; ?>

      <!--Grid row-->
      <div class="row">

        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">

            <!--Card content-->
            <form class="card-body" action="Cotizacion.php" method="POST">

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" value="<?php echo $_SESSION['name'];  ?>" name="nombre" id="firstName" class="form-control">
                    <label for="firstName" class="">Nombre</label>
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->


                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="md-form input-group pl-0 mb-5">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">@</span>
                </div>
                <input type="text" value="<?php echo $_SESSION['user_id']; ?>" class="form-control py-0" aria-describedby="basic-addon1">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" name="email1" id="email" class="form-control" placeholder="sucorreo@ejemplo.com">
                <label for="email" class="">Correo (opcional)</label>
              </div>
              <!--telefono-->
              <div class="md-form mb-5">
                <input type="text" name="telefono" class="form-control" placeholder="88-88-88-88">
                <label for="email" class="">Numero de Telefono</label>
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" name="direccion" class="form-control" placeholder="1234 Calle Principal">
                <label for="address" class="">Dirección</label>
              </div>

              <!--address-2-->

              <!--Grid row-->
              <div class="row">

                <!--Grid column-->
                <div class="col-lg-4 col-md-12 mb-4">

                  <label for="country">País</label>
                  <select class="custom-select d-block w-100" id="country" required>
                   <option value="">Elegir...</option>
                    <option>Costa Rica</option>


                  </select>
                  <div class="invalid-feedback">
                    Por favor seleccione un País válido
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="state">Provincia</label>
                  <select class="custom-select d-block w-100" id="state" required>
                    <option value="">Elegir...</option>
                    <option>Alajuela</option>
                    <option>Heredia</option>
                  </select>
                  <div class="invalid-feedback">
                    Por favor seleccione una Provincia válida
                  </div>

                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="state">Cantón</label>
                  <select class="custom-select d-block w-100" id="state" required>
                    <option value="">Elegir...</option>
                    <option>California</option>
                  </select>
                  <div class="invalid-feedback">
                    Por favor seleccione un Cantón válido
                  </div>

                </div>
                <!--Grid column-->
                <!--Grid column-->

                <div class="col-lg-4 col-md-6 mb-4">

                  <label for="zip">Codigo Zip</label>
                  <input type="text" class="form-control" id="zip" placeholder="" required>
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>

                </div>

                <!--Grid column-->
              </div>
              <!--Grid row-->

              <hr>


              <strong> Metodo de Pago</strong>

              <hr>

              <div class="d-block my-3">
                <div class="custom-control custom-radio">
                  <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                  <label class="custom-control-label" for="credit">Tarjeta de Crédito</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="debit">Tarjeta de Débito</label>
                </div>
                <div class="custom-control custom-radio">
                  <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                  <label class="custom-control-label" for="paypal">Efectivo</label>
                </div>
              </div>
              <div class="row">

                <div class="col-md-6 mb-3">


                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>

              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" name="cotizar" value="1" type="submit">Cotizar</button>

            </form>

          </div>
          <!--/.Card-->
  <form action="Cotizacion.php" method="POST">
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-4">

          <!-- Heading -->
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Carrito</span>
            <span class="badge badge-secondary badge-pill"><?php echo $cont?> </span>
          </h4>

          <!-- Cart -->
          <ul class="list-group mb-3 z-depth-1">
            <?php echo $VAR?>

          </ul>
          <!-- Cart -->
        </form>
          <!-- Promo code -->

          <!-- Promo code -->

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->
    <div class="pt-4">
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/getting-started/" target="_blank" role="button">Download MDB
        <i class="fa fa-download ml-2"></i>
      </a>
      <a class="btn btn-outline-white" href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank" role="button">Start free tutorial
        <i class="fa fa-graduation-cap ml-2"></i>
      </a>
    </div>
    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">

    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2018 Copyright:
      <a> Alquiler de Parrillas Costa Rica</a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../../js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../../js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
</body>

</html>
