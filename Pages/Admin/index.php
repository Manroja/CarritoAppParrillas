


<!DOCTYPE html>
<html >
    <head>
        <!-- META SECTION -->
        <title>Mantenimiento</title>

    </head>
    <body>
<?php require_once 'header.php'; ?>
<?php
include("../model/ProductoDB.php");
include("../model/Carrito_ClienteDB.php");
$fecha_actual = date("Y-m-d");
$mensaje = '';
$oCarrito = new Carrito_ClienteDB();
$oPro = new ProductoDB();
$oUs = new UsuarioDB();

//Esto se utiliza para saber la cantidad de productos en la base de datos
$resultProducto = mysqli_fetch_array($oPro -> cantidadProductos());
$queryProducto = $oPro -> cantidadProductos();
if($resultProducto > 0)
{
  while ($dataProducto = mysqli_fetch_array($queryProducto))
  {
    $cantidadProducto = $dataProducto["CANTIDAD"];
  }
}

//Esto se utiliza para saber la cantidad de clientes en la base de datos
$result = mysqli_fetch_array($oUs -> cantidadClientes());
$query = $oUs -> cantidadClientes();

if($result > 0)
{
  while ($data = mysqli_fetch_array($query))
  {
    $cantidad = $data["CANTIDAD"];
  }
}
//Esto se utiliza para saber la cantidad de cotizaciones en la base de datos
$resultCotizaciones = mysqli_fetch_array($oCarrito -> cantidadCarritosFinalizados());
$queryCotizaciones = $oCarrito -> cantidadCarritosFinalizados();
if($resultCotizaciones > 0)
{
  while ($dataCotizaciones = mysqli_fetch_array($queryCotizaciones))
  {
    $cantidadCotizaciones = $dataCotizaciones["CANTIDAD"];
  }
}

 ?>
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <!-- START WIDGETS -->
                    <div class="row">
                        <div class="col-md-3">



                            <!-- END WIDGET SLIDER -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-coffee"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $cantidadProducto ?></div>
                                    <div class="widget-title">Productos</div>
                                    <div class="widget-subtitle">Registrados</div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">

                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $cantidadCotizaciones; ?></div>
                                    <div class="widget-title">Cotizaciones</div>
                                    <div class="widget-subtitle">Nuevas</div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET MESSAGES -->

                        </div>
                        <div class="col-md-3">

                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" >
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $cantidad ?></div>
                                    <div class="widget-title">Usuarios </div>
                                    <div class="widget-subtitle">Registrados</div>
                                </div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>
                            <!-- END WIDGET REGISTRED -->

                        </div>
                        <div class="col-md-3">

                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-info widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>
                                <div class="widget-subtitle plugin-date">Cargando...</div>
                                <div class="widget-controls">
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- END WIDGET CLOCK -->

                        </div>
                    </div>
                    <!-- END WIDGETS -->

                    <div class="row">
                        <div class="col-md-9">

                            <div class="panel panel-default">
                                <div class="panel-body posts">

                                    <div class="post-item">
                                        <div class="post-title">
                                            Alquiler de Parrillas Costa Rica
                                        </div>

                                        <div class="post-text">
                                            <p><strong>Historia de la Pariila</strong>, la parrilla o asador es un utensilio de hierro con forma de rejilla que se sitúa encima del fuego y encima de él lo que se ha de asar o tostar. Se la ubica a una distancia prudencial del fuego o las brasas. Los alimentos acogen calor en forma lenta, y una vez que las carnes están a punto, se acerca un poco más la parrilla al calor y así se consigue que la parte externa de las carnes se tornen de un color más dorado, dándole una mejor presentación, además de quedar crujiente y eliminar posibles grasas residuales de la carne.</p>
                                            <img src="../../img/iconoParrilla.png" class="img-text post-image"/>
                                            <p></p>
                                            <h4>Historia</h4>
                                            <p>Se dice que la parrilla fue desarrollada cuando al colocar una cerca que rodeaba un fastuoso château, erró en el cálculo. El barón dueño de la propiedad se habría negado a pagar al fabricante el hierro sobrante y, en venganza, el herrero habría utilizado la reja sobrante como soporte para cocer carne frente al castillo. El aroma habría enloquecido al barón al punto que accedió a desembolsar los dos ducados que adeudaba, por lo que obtuvo la reja-parrilla en pugna.</p>
                                            <p>Hacia fines del siglo xix en los alrededores del Río de la Plata, se utilizaban rejillas de hierro forjado para tensar los cueros mientras se secaban. Se atribuye a los gauchos de esa época el uso de esta herramienta para asar las carnes que sobraban de los animales faenados.</p>

                                            <p>Después de una ley de amnistía dictada en 1832 en Uruguay, miles de presos comunes y prisioneros políticos vieron nuevamente la luz. En la cárcel de Colonia del Sacramento el festejo desembocó en escándalo cuando se comenzó a destruir la cárcel. En pocas horas, una banda de cuatreros amnistiados se agenció algunos vacunos de vecinos de la zona. Un convicto arrancó la puerta de su propia celda e improvisó la primera parrilla moderna, cuyos resultados compartieron liberados, policías y transeúntes.</p>

                                        </div>

                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Mantenimientos</h3>
                                    <div class="links">
                                        <a href="agregarProducto.php">Agregar Producto </a>
                                        <a href="listaProductos.php">Lista de Productos </a>

                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Desarrollador</h3>
                                    <h2>Robinson Matus</h2>
                                    <div class="links small">
                                      <a target="_blank" class="btn btn-info btn-block" href="https://www.facebook.com/robinson.matus" style="text-decoration:none;"><i class="fab fa-facebook"></i></a>
                                      <a target="_blank" class="btn btn-warning btn-block" style="text-decoration:none;" href="https://www.instagram.com/rob_matus/"><i class="fab fa-instagram"></i></a>
                                      <a target="_blank" class="btn btn-primary btn-block" style="text-decoration:none;" href="https://twitter.com/robinsonmatus"><i class="fab fa-twitter"></i></i></a>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                    <!-- START DASHBOARD CHART -->
					<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
					<div class="block-full-width">

                    </div>
                    <!-- END DASHBOARD CHART -->

                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Cerrar <strong>Sesión</strong> ?</div>
                    <div class="mb-content">
                        <p>¿Está seguro que desea salir?</p>
                        <p>Presione No si quiere cancelar.
Presione Sí para desconectarse del usuario actual.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="../php-login/cerrarSesion.php" class="btn btn-success btn-lg">Sí</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>

        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>

        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->

        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>

        <script type="text/javascript" src="js/demo_dashboard.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
