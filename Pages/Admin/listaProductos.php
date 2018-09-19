<?php
include("../model/ProductoDB.php");
$mensaje = '';

if(!empty($_POST))
{
  $mensaje = '';
  $alert = '';
  $oProDB = new ProductoDB();
  $query = $oProDB -> eliminarProducto($_POST['eliminar']);
  if($query)
  {
    $mensaje = 'Elemento Eliminado Correctamente';
  }
  else{
    $mensaje = 'Elemento No Fue Eliminado ';
  }
}
 ?>


<!DOCTYPE html>
<html >
    <head>
        <!-- META SECTION -->
        <title>Mantenimiento</title>

    </head>
    <body>

        <?php require_once 'header.php'; ?>
                <form class=""  method="post">
                  <!-- PAGE CONTENT WRAPPER -->
                  <div class="page-content-wrap">

                      <div class="row">
                          <div class="col-md-12">

                              <!-- START DEFAULT DATATABLE -->
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Productos</h3>

                                      <ul class="panel-controls">
                                        <button type="button" class="btn btn-primary" style="margin-left:10px;"><a style="text-decoration:none; color:white;" href="agregarProducto.php">Agregar Producto</a></button>
                                          <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                          <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                          <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>

                                      </ul>
                                  </div>
                                  <div class="panel-body">
                                      <table class="table datatable">
                                          <thead>
                                              <tr>
                                                  <th>ID Consecutivo</th>
                                                  <th>Nombre</th>
                                                  <th>Precio</th>
                                                  <th>Descripción</th>
                                                  <th>Estado</th>
                                                  <th>Tipo de Alquiler</th>
                                                  <th>Acciones</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                                $oProDB = new ProductoDB();
                                                $result = mysqli_fetch_array($oProDB -> obtenerProductos());
                                                $query = $oProDB -> obtenerProductos();
                                                if($result > 0){
                                                  while ($data = mysqli_fetch_array($query)) {
                                                    ?>
                                                    <tr>
                                                    <td><?php echo $data["PRODUCTO_ID"] ?></td>
                                                    <td><?php echo $data["NOMBRE"] ?></td>
                                                    <td><?php echo $data["PRECIO"] ?></td>
                                                    <td><?php echo $data["DESCRIPCION"] ?></td>
                                                    <td><?php
                                                    if($data["ESTADO"] == 1)
                                                    {
                                                      echo "Activo";
                                                    } else{
                                                      echo "Bloqueado";
                                                    }
                                                    ?></td>
                                                    <td><?php echo $data["TIPOALQUILER"] ?></td>

                                                    <td><a class="btn btn-primary" style="margin-left:10px;margin-top:2px; width:100px;text-decoration:none; color:white;" href="modificarProducto.php?id=<?php echo $data["PRODUCTO_ID"] ?>"><i class="fas fa-edit"> Editar</i></a>
                                                       <button name="eliminar" type="submit" class="btn btn-primary" style="margin-left:10px; margin-top:2px; width:100px;" value="<?php echo $data["PRODUCTO_ID"] ?>"><i class="fas fa-trash-alt"> Eliminar</i></button>
                                                    </td>
                                                  </tr>
                                                    <?php
                                                  }
                                                }
                                             ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <!-- END SIMPLE DATATABLE -->

                          </div>
                      </div>

                  </div>
                </form>
                <!-- PAGE CONTENT WRAPPER -->
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
                            <a href="../php-login/pages-login.php" class="btn btn-success btn-lg">Sí</a>
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

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->

        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

    </body>
</html>
