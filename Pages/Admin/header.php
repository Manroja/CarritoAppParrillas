<?php
include("../model/UsuarioDB.php");
session_start();
if(!isset($_SESSION['usuarioLogueado'])){
  header("Location: ../php-login/pages-login.php");
}
$oUsuario = new Usuario();
$oUsuario = $_SESSION['usuarioLogueado'];
if(strcmp($oUsuario -> getRol(),"Cliente") ===0){
  header("location: ../view/home-page.php");
}
?>
<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../css/all.min.css" >
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="css/theme-blue.css"/>
    <!-- EOF CSS INCLUDE -->
  </head>
  <body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation">
                <li class="xn-logo">
                    <a href="index.php">
                      <?php
                      $oUsuario = new Usuario();
                      $oUsuario = $_SESSION['usuarioLogueado'];
                       echo $oUsuario -> getNombreCompleto()
                      ?>
                    </a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="../../img/uploads/<?php echo $oUsuario -> getImagenusuario() ?>" alt="<?php echo $oUsuario -> getNombreCompleto() ?>"/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="../../img/uploads/<?php echo $oUsuario -> getImagenusuario() ?>" alt="<?php echo $oUsuario -> getNombreCompleto() ?>"/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?php
                            $oUsuario = new Usuario();
                            $oUsuario = $_SESSION['usuarioLogueado'];
                             echo $oUsuario -> getNombreCompleto()
                            ?></div>
                            <div class="profile-data-title">Administrador</div>
                        </div>
                        <div class="profile-controls">
                            
                        </div>
                    </div>
                </li>
                <li class="xn-title">Navegación</li>
                <li>
                    <a href="index.php"><span class="fa fa-desktop"></span> <span class="xn-text">Tablero</span></a>
                </li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Páginas</span></a>
                    <ul>

                        <li><a href="agregarProducto.php"><span class="fa fa-edit"></span> Agregar Producto</a></li>
                        <li><a href="listaProductos.php"><span class="fa fa-columns"></span>Lista de Productos</a></li>


                    </ul>
                </li>


            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                </li>
                <!-- END TOGGLE NAVIGATION -->
                <!-- SEARCH -->
                <!-- END SEARCH -->
                <!-- SIGN OUT -->
                <li class="xn-icon-button pull-right">
                    <a href="../php-login/pages-login.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                </li>
                <!-- END SIGN OUT -->
                <!-- MESSAGES -->
                <li class="xn-icon-button pull-right">

                <!-- END MESSAGES -->
                <!-- TASKS -->

                <!-- END TASKS -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->

            <!-- START BREADCRUMB -->
            <ul class="breadcrumb">

            </ul>
            <!-- END BREADCRUMB -->

  </body>
</html>
