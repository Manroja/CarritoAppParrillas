<?php
//Con este if validamos si no hay un usuario logueado
//lo va redigir al login
if(isset($_SESSION['usuarioLogueado'])){
  header("Location: ../php-login/pages-login.php");
}

include("../model/ProductoDB.php");
include("../model/Detalle_CarritoDB.php");
include("../model/UsuarioDB.php");
session_start();
$oUsuario = new Usuario();
$oUsuario = $_SESSION['usuarioLogueado'];
//Si el usuario Logueado es un administrador lo regresa
//al mantenimiento de administrador
if(strcmp($oUsuario -> getRol(),"Admin") ===0){
  header("location: ../Admin/index.php");
}


///PRIMERO RECIBIMOS EL ID QUE NOS ENVIA LA paginarProductos
//listaProductos.php MEDIANTE EL BOTÓN EDITAR, SI EL ID ESTÁ
//VACÍO NO SE PODRÁ ACCEDER A ESTA PÁGINA
if(empty($_REQUEST['id']))
{
  //Acá se envía a la página listaProductos.php
  //si el id viene vació o si intentan ingresar mediante
  //la URL
if(!empty($_POST)) {
$Detalle_CarritoDB= new Detalle_CarritoDB();
$oCarrito= new Carrito_Cliente();
$oCarrito= $_SESSION['cart'];
$ProductoId=$_POST['agregar'];
$CarritoClienteId=$oCarrito->getCarritoClienteId();
$Cantidad=$_POST['cant'];

$Detalle_CarritoDB->IngresarDetalle_Carrito($CarritoClienteId,$ProductoId,$Cantidad);
}
header('Location: home-page.php');
}
//Acá agarramos el id que nos envía la página listaProductos.php,
//ese id es del producto

$idProducto = $_REQUEST['id'];

$oProDB = new ProductoDB();
$query = $oProDB -> consultarProductoID($idProducto);
$resultSql = mysqli_num_rows($query);

if($resultSql == 0)
{
  //Si no se encuentra el producto con el id, automáticamente
  //se redirige a la página listaProductos.php

header('Location: home-page.php');

}
else{
  //Si encontramos el producto lo metemos al while
  //para llenar los campos del formulario con la información
  //de la consulta a la base de datos
  while ($data = mysqli_fetch_array($query)) {
    // code...
    $oProducto = new Producto();

    $oProducto -> setProductoId($data['PRODUCTO_ID']);
    $oProducto -> setNombre($data['NOMBRE']);
    $oProducto -> setPrecio($data['PRECIO']);
    $oProducto -> setDescripcion($data['DESCRIPCION']);
    $oProducto -> setEstado($data['ESTADO']);
    $oProducto -> setImagen($data['IMAGEN']);
    $oProducto -> setTipoAlquiler($data['TIPOALQUILER']);
  }
}


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Alquilar Servicio</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../../css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../../css/style.min.css" rel="stylesheet">
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

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <img src="../../img/uploads/<?php echo $oProducto -> getImagen() ?>" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">


            <h1><?php echo $oProducto -> getNombre() ?></h1>
            <p class="lead">

              <span class="mr-1">
                <span>₡<?php echo $oProducto -> getPrecio() ?></span>
              </span>
              <span> <a >
                <span class="badge red mr-1">Por <?php echo $oProducto -> getTipoAlquiler() ?></span>
              </a>
            </span>
            </p>

            <p class="lead font-weight-bold">Descripcion</p>

            <p><?php echo $oProducto -> getDescripcion() ?></p>

            <form action="detalleProducto.php" method="POST" class="d-flex justify-content-left">
              <!-- Default input -->
              <input type="number" name="cant" value="1" aria-label="Search" class="form-control" style="width: 100px">
              <button class="btn btn-primary btn-md my-0 p" name="agregar" type="submit" value="<?php echo $oProducto -> getProductoId() ?>" >Agregar al Carrito
                <i class="fa fa-shopping-cart ml-1"></i>
              </button>

            </form>

          </div>
          <!--Content-->

        </div>
        <!--Grid column-->



      <!--Grid row-->
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
