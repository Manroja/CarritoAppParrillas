<?php
include("../model/ProductoDB.php");
include("../model/UsuarioDB.php");
include("../model/Detalle_CarritoDB.php");
include_once "../model/Carrito_ClienteDB.php";

  session_start();
  //Con este if validamos si no hay un usuario logueado
  //lo va redigir al login

  if(!isset($_SESSION['usuarioLogueado'])){
    header("Location: ../php-login/pages-login.php");
  }

  $oUsuario = new Usuario();
  $oUsuario = $_SESSION['usuarioLogueado'];
  //Si el usuario Logueado es un administrador lo regresa
  //al mantenimiento de administrador
  if(strcmp($oUsuario -> getRol(),"Admin") ===0){
    header("location: ../Admin/index.php");
  }
   $deta= new Detalle_CarritoDB();
     $_SESSION['GetDetalles']= $deta->Get_ALLDetalles($_SESSION['user_id']);
     $_SESSION['Cont']= $deta->Get_ContCarrito($_SESSION['user_id']);
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $_SESSION['user_id']; ?></title>
  <!-- Bootstrap core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../../css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/all.min.css" >
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }
  </style>
</head>

<body>

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

  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('../../img/pp.jpg');
        background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Alquiler de Parrillas Costa Rica</strong>
              </h1>

              <p>
                <strong>La mejor excusa para pasarla entre compas, familia y más...</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Cobertura: Alajuela, Heredia </strong><br>
                <strong><a href="tel:+50688452836"><i class="fab fa-whatsapp"></i> 8845-2836</a></strong><br>
                <a href="tel:+50688413762"><strong><i class="fab fa-whatsapp"></i> 8841-3762</strong></a>

              </p>

            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('../../img/ParrillaAmigos.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Alquiler de Parrillas Costa Rica </strong>
              </h1>

              <p>
                <strong>Cocine tranquilo y no se preocupe por limpiar</strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Siempre una parrilla lista para usar </strong>
              </p>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Second slide-->

      <!--Third slide-->
      <div class="carousel-item">
        <div class="view" style="background-image: url('../../img/ParrillaGas.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong>Alquiler de Parrillas Costa Rica</strong>
              </h1>

              <p>
                <strong>La parrilla, el gas, los accesorios </strong>
              </p>

              <p class="mb-4 d-none d-md-block">
                <strong>Hasta la carne y el chef si asi lo requiere a solo un click</strong>
              </p>
              <!--
              <a target="_blank" href="https://mdbootstrap.com/bootstrap-tutorial/" class="btn btn-outline-white btn-lg">Acerca de nosotros...
                <i class="fa fa-graduation-cap ml-2"></i>
              </a>
            -->
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->

  <!--Main layout-->
  <main>
    <div class="container">

      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categoría</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Parrillas,Cortes, Chef
                <span class="sr-only">(current)</span>
              </a>
            </li>



          </ul>
          <!-- Links
          <form class="form-inline">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
            </div>
          </form>
        </div>
         Collapsible content -->

      </nav>

            <!--Section: Products v.3-->
            <section class="text-center mb-4">

              <!--Grid row-->
              <div class="row wow fadeIn">

                <!--Grid column-->


              <?php
                  $oProDB = new ProductoDB();
                  $result = mysqli_fetch_array($oProDB -> obtenerProductos());
                  $query = $oProDB -> obtenerProductos();
                  if($result > 0){
                    while ($data = mysqli_fetch_array($query))
                    {

                      ?>


               <div class="col-lg-3 col-md-6 mb-4">

                 <!--Card-->
                 <div class="card">

                   <!--Card image-->
                   <div class="view overlay">
                     <img src="../../img/uploads/<?php echo $data["IMAGEN"] ?>" class="card-img-top" alt="" width="100" height="150">
                     <a>
                       <div class="mask rgba-white-slight"></div>
                     </a>
                   </div>
                   <!--Card image-->

                   <!--Card content-->
                   <div class="card-body text-center">
                     <!--Category & Title-->
                     <a href="" class="grey-text">
                       <h5></h5>
                     </a>
                     <h5>
                       <strong>
                         <a  class="dark-grey-text"><?php echo $data["NOMBRE"] ?>

                         </a><br>

                       </strong>
                     </h5>

                     <h4 class="font-weight-bold blue-text">
                       <strong>₡<?php echo $data["PRECIO"] ?></strong>


                         <a class="btn btn-primary btn-md my-0 p waves-effect waves-light" style="text-decoration:none; color:white;" href="detalleProducto.php?id=<?php echo $data["PRODUCTO_ID"] ?>"> <i class="fa fa-shopping-cart ml-1"></i> Agregar al Carrito</a>


                     </h4>

                   </div>
                   <!--Card content-->

                 </div>
                 <!--Card-->

               </div>
              <?php

            }
          }
               ?>
             </div>
            </section>
            <!--Section: Products v.3-->



          </div>
        </main>
        <!--Main layout-->

        <!--Footer-->
        <footer class="page-footer text-center font-small mt-4 wow fadeIn">

          <!--Call to action-->
          <div class="pt-4">
            <a class="btn btn-outline-white" href="home-page.php" target="_blank" role="button">Productos
              <i class="fa fa-download ml-2"></i>
            </a>
            <a class="btn btn-outline-white" href="Cotizacion.php" target="_blank" role="button">Cotizar
              <i class="fa fa-graduation-cap ml-2"></i>
            </a>
          </div>
          <!--/.Call to action-->

          <hr class="my-4">

          <!-- Social icons -->
          <div class="pb-4">
            <a href="https://www.facebook.com/mdbootstrap" target="_blank">
              <i class="fa fa-facebook mr-3"></i>
            </a>

            <a href="https://twitter.com/MDBootstrap" target="_blank">
              <i class="fa fa-twitter mr-3"></i>
            </a>

            <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
              <i class="fa fa-youtube mr-3"></i>
            </a>

            <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
              <i class="fa fa-google-plus mr-3"></i>
            </a>

            <a href="https://dribbble.com/mdbootstrap" target="_blank">
              <i class="fa fa-dribbble mr-3"></i>
            </a>

            <a href="https://pinterest.com/mdbootstrap" target="_blank">
              <i class="fa fa-pinterest mr-3"></i>
            </a>

            <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
              <i class="fa fa-github mr-3"></i>
            </a>

            <a href="http://codepen.io/mdbootstrap/" target="_blank">
              <i class="fa fa-codepen mr-3"></i>
            </a>
          </div>
          <!-- Social icons -->

          <!--Copyright-->
          <div class="footer-copyright py-3">
            © 2018 Copyright:
            <a href="https://mdbootstrap.com/bootstrap-tutorial/" target="_blank"> Alquiler de Parrillas Costa Rica</a>
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
