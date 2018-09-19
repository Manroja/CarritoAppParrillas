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
    //Este es el segundo paso, cuando el cliente le da al
    //botón actualizar, se llama al método POST y se crea el objeto
    //este método es muy parecido al insertar producto, nada más
    //que acá se actualiza.


    //Creamos el objeto Producto
    $oProducto1 = new Producto();
    $oProducto1 -> setProductoId($_POST['id']);
    $oProducto1 -> setNombre($_POST['nombre']);
    $oProducto1 -> setPrecio($_POST['precio']);
    $oProducto1 -> setDescripcion($_POST['descripcion']);
    $oProducto1 -> setEstado($_POST['estado']);
    $oProducto1 -> setTipoAlquiler($_POST['alquiler']);

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
      $oProducto1 -> setImagen($imgPorducto);
      $src = $destino.$imgPorducto;
    }
    //Llamamos el método de la clase ProductoDB
    $oProDB = new ProductoDB();
    $mensaje = '';
    if($oProDB -> actualizarProducto($oProducto1))
    {

      if($nombreFoto != '')
      {
        move_uploaded_file($urlTemp, $src);
      }
      $mensaje = 'Producto Actualizado con Éxito';
    }
    else {
      $mensaje = 'No se pudo Actualizar el Producto';
    }
  }
}
 ?>

<?php

///PRIMERO RECIBIMOS EL ID QUE NOS ENVIA LA paginarProductos
//listaProductos.php MEDIANTE EL BOTÓN EDITAR, SI EL ID ESTÁ
//VACÍO NO SE PODRÁ ACCEDER A ESTA PÁGINA
if(empty($_REQUEST['id']))
{
  //Acá se envía a la página listaProductos.php
  //si el id viene vació o si intentan ingresar mediante
  //la URL
header('Location: listaProductos.php');
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
  header('Location: listaProductos.php');
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
                                    <h3 class="panel-title"><strong>Modificar</strong> Producto</h3>
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
                                  <input type="hidden" name="id" value="<?php echo $oProducto -> getProductoId() ?>">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Nombre del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" value="<?php echo $oProducto -> getNombre() ?>"/>
                                            </div>
                                            <span class="help-block">Nombre del Producto</span>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Precio del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="number" class="form-control" name="precio" id="precio" value="<?php echo $oProducto -> getPrecio() ?>"/>
                                            </div>
                                            <span class="help-block">Precio del Producto</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Unidad de Alquiler</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name="alquiler" id="alquiler">
                                              <?php if($oProducto -> getTipoAlquiler() == 'Persona'){
                                                //Esta validación es para asignarle al combo el dato
                                                //que tiene el producto en la base de datos
                                                ?>
                                                <option value="Hora">Hora</option>
                                                <option value="Persona" selected="selected">Pesona</option>
                                              <?php }else {
                                                ?>
                                                <option value="Hora" selected="selected">Hora</option>
                                                <option value="Persona" >Pesona</option>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block">Selecciona una opción</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Estado del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name="estado" id="estado">

                                              <?php if($oProducto -> getEstado() == 1){
                                                //Esta validación es para asignarle al combo el dato
                                                //que tiene el producto en la base de datos
                                                ?>
                                                <option value="1" >Activo</option>
                                                <option value="0">Bloqueado</option>
                                              <?php }else {
                                                ?>
                                                <option value="0" >Bloqueado</option>
                                                <option value="1" >Activo</option>

                                                <?php } ?>

                                            </select>
                                            <span class="help-block">Selecciona una opción</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Descripción del Producto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea class="form-control" rows="5" name="descripcion" id="descripcion" maxlength="300"><?php echo $oProducto -> getDescripcion() ?></textarea>
                                            <span class="help-block">Acá podrá describir los datos del Producto</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Foto</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input type="file" class="fileinput btn-primary" name="foto" id="foto" title="Subir Foto" value=""/>
                                            <span class="help-block">Archivo de Foto</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default">Limpiar Formulario</button>
                                    <button class="btn btn-primary pull-right" type="submit">Actualizar Producto</button>

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
