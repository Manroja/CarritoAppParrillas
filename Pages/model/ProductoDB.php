<?php
include("Producto.php");
$consulta = '';

     /**
      *
      */
     class ProductoDB
     {

       function __construct()
       {
         // code...
       }

       public function obtenerProductos()
       {
          $sql = "SELECT * FROM PRODUCTOS";
          $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
          $query = mysqli_query($db, $sql);
          mysqli_close($db);
          return $query;
       }

       public function insertarProducto($nombre,$precio,$descripcion,$estado,$imagen,$tipoAlquiler)
       {
         $sql = "INSERT INTO PRODUCTOS(NOMBRE,PRECIO,DESCRIPCION,ESTADO,IMAGEN,TIPOALQUILER)
         VALUES('$nombre','$precio','$descripcion','$estado','$imagen','$tipoAlquiler')";
        $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
         $query = mysqli_query($db, $sql);
         if($query){
           return 1;
         }
         else{
           return 0;
         }
         mysqli_close($db);
       }

       public function paginarProductos()
       {
         $sql = "SELECT COUNT(*) AS TOTAL_REGISTRO FROM PRODUCTOS WHERE ESTADO = 1";
         $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
         $query = mysqli_query($db, $sql);
         $resultSql = mysqli_fetch_array($sql);
         $totalRegistros = $resultSql['TOTAL_REGISTRO'];
         mysqli_close($db);
       }

       public function consultarProductoID($id)
       {
         $sql = "SELECT * FROM PRODUCTOS WHERE PRODUCTO_ID = '$id'";
         $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
         $query = mysqli_query($db, $sql);
         mysqli_close($db);
         return $query;
       }

       public function actualizarProducto($oProducto){
         $oPro = new Producto();
         $oPro = $oProducto;
         $id = $oPro -> getProductoId();
         $nombre = $oPro -> getNombre();
         $precio = $oPro -> getPrecio();
         $descripcion = $oPro -> getDescripcion();
         $estado = $oPro -> getEstado();
         $imagen = $oPro -> getImagen();
         $tipoAlquiler = $oPro -> getTipoAlquiler();
         $sql = "UPDATE PRODUCTOS SET NOMBRE = '$nombre', PRECIO = '$precio',
         DESCRIPCION = '$descripcion', ESTADO = '$estado',
         IMAGEN = '$imagen', TIPOALQUILER = '$tipoAlquiler'
         WHERE PRODUCTO_ID = '$id'" ;
         $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
         $query = mysqli_query($db, $sql);
         mysqli_close($db);
         return $query;
       }

       public function eliminarProducto($id)
       {
         $sql = "DELETE FROM PRODUCTOS WHERE PRODUCTO_ID = '$id'";
         $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
         $query = mysqli_query($db, $sql);
         mysqli_close($db);
         return $query;
       }
        function getProductoID($ProductoId){
      $product= new Producto();
      $sql= "SELECT * FROM PRODUCTOS WHERE PRODUCTO_ID='$ProductoId'; ";
      $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) {
      $product->setProductoId($row['PRODUCTO_ID']);
      $product->setNombre($row['NOMBRE']);
      $product->setPrecio($row['PRECIO']);
      $product->setDescripcion($row['DESCRIPCION']);
      $product->setEstado($row['ESTADO']);
      $product->setIVA($row['IVA']);
      $product->setImagen($row['IMAGEN']);

      }else{
      $product=NULL;
      }
      return $product;
  }

  public function cantidadProductos()
  {
  	$sql = "SELECT COUNT(*) AS CANTIDAD FROM PRODUCTOS ";
  	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
  	$query = mysqli_query($db, $sql);
  	mysqli_close($db);
  	return $query;
  }

     }


 ?>
