<?php
//include("../model/UsuarioDB.php");
include("../model/ProductoDB.php");
$mensaje = '';
//session_start();

if(!empty($_POST)){

  $alert = '';
  //Validamos que los campos no vengan vacíos
  if(empty($_POST['nombre']) || empty($_POST['precio']) || empty($_POST['descripcion'])){
    $alert = '<p class="msg_error"> Todos los campos son obligatorios. </p>';
  }else {
    //Creamos el objeto Producto
    $oProducto = new Producto();
    $oProducto -> setNombre($_POST['nombre']);
    $oProducto -> setPrecio($_POST['precio']);
    $oProducto -> setDescripcion($_POST['descripcion']);
    $oProducto -> setEstado($_POST['estado']);
    $oProducto -> setTipoAlquiler($_POST['alquiler']);

    //ACA AGARRAMOS EL ARCHIVO FILE QUE NOS ENVIA EL POST
    $foto = $_FILES['foto'];
    $nombreFoto = $foto['name'];
    $tipoFoto = $foto['type'];
    $urlTemp = $foto['tmp_name'];

    $imgPorducto = 'img_producto.png';
    if($nombreFoto != '')
    {
      $destino = '../../img/uploads/';
      $imgNombre = 'img_'.md5(date('d-m-y H:m:s'));
      $imgPorducto = $imgNombre.'.jpg';
      $oProducto -> setImagen($imgPorducto);
      $src = $destino.$imgPorducto;
    }
    //Llamamos el método de la clase ProductoDB
    $oProDB = new ProductoDB();
    $mensaje = '';
    if($oProDB -> insertarProducto($oProducto -> getNombre(), $oProducto -> getPrecio(), $oProducto -> getDescripcion(),  $oProducto -> getEstado(),$oProducto -> getImagen(), $oProducto -> getTipoAlquiler()) == 1)
    {

      if($nombreFoto != '')
      {
        move_uploaded_file($urlTemp, $src);
      }
      $mensaje = 'Producto Insertado con Éxito';
    }
    else {
      $mensaje = 'No se pudo Insertar el Producto';
    }
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
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Agregar</strong> Producto</h3>
                                    <?php if($mensaje != ''){

                                    ?>
                                    <br><br>
                                    <h3 class="panel-title"><strong><?php  echo $mensaje ?></strong> </h3>
                                    <?php } ?>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <p>En esta sección podrá agregar los productos con su respectiva información y foto.</p>
                                </div>
                                <div class="panel-body">

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Nombre del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30"/>
                                            </div>
                                            <span class="help-block">Nombre del Producto</span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Precio del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="number" class="form-control" name="precio" id="precio"/>
                                            </div>
                                            <span class="help-block">Precio del Producto</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Unidad de Alquiler</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name="alquiler" id="alquiler">

                                                <option value="Hora">Hora</option>
                                                <option value="Persona">Pesona</option>
                                            </select>
                                            <span class="help-block">Selecciona una opción</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Estado del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name="estado" id="estado">
                                                <option value="1">Activo</option>
                                                <option value="0">Bloqueado</option>
                                            </select>
                                            <span class="help-block">Selecciona una opción</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Descripción del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion" maxlength="100"></textarea>
                                            <span class="help-block">Acá podrá describir los datos del Producto</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Foto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="file" class="fileinput btn-primary" name="foto" id="foto" title="Subir Foto"/>
                                            <span class="help-block">Archivo de Foto</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default">Limpiar Formulario</button>
                                    <button class="btn btn-primary pull-right" type="submit">Guardar Producto</button>

                                </div>
                            </div>
                            </form>

                        </div>
                    </div>

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

        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->

        <!-- START TEMPLATE -->
        <!-- <script type="text/javascript" src="js/settings.js"></script> -->


        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
