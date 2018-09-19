<?php
include("Carrito_Cliente.php");
Class 	Carrito_ClienteDB{

function __construct()
	{
		# code...
	}

	public function IngresarCarrito_Cliente($usuario_id){

		$Cliente = new Carrito_Cliente();
		$answer;
		$sql= "INSERT INTO CARRITO_CLIENTE (CARRITOCLIENTE_ID, FECHA,USUARIO_ID,CORREO,TELEFONO,UBICACION,ESTADO) VALUES (NULL, NULL,
			'$usuario_id', NULL, NULL, NULL, '1');";
			$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
			//ESTADO 1 CARRITO ACTIVO
		$result = mysqli_query($db,$sql);
		mysqli_close($db);
		if ($result == true) {
      	$answer= true;
   		}else{
      	$answer= false;
   		}

		return $answer;
	}
	public function getCarritoActual($usuario_id){
	$Cliente = new Carrito_Cliente();
	$sql = "SELECT * FROM CARRITO_CLIENTE WHERE ESTADO = 1 AND USUARIO_ID= '$usuario_id';";
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
 	$result = mysqli_query($db,$sql);
	mysqli_close($db);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);
	if($count == 1) {
         $Cliente->setCarritoClienteId($row['CARRITOCLIENTE_ID']);
         $Cliente->setFecha($row['FECHA']);
         $Cliente->setUsuario_id($row['USUARIO_ID']);
         $Cliente->setCorreo($row['CORREO']);
         $Cliente->setTelefono($row['TELEFONO']);
         $Cliente->setUbicacion($row['UBICACION']);
         $Cliente->setEstado($row['ESTADO']);
         return $Cliente;

      }else {
         return null;
      }

	}
	public function UpdateCarrito_Cliente($usuario_id,$correo,$telefono,$ubicacion){
	$Cliente = new Carrito_Cliente();
	$answer;
	$fecha_actual = date("Y-m-d");
	$estado=2;//Significa Finalizado-- Cuando se hace el update se finaliza el carrito.
	$carritocliente_id= getCarritoActual($usuario_id)->getCarritoClienteId();
	$Cliente->setFecha($fecha_actual);
	$Cliente->setUsuario_id($usuario_id);
	$Cliente->setCorreo($correo);
	$Cliente->setTelefono($telefono);
	$Cliente->setUbicacion($ubicacion);
	$Cliente->setEstado($estado);

	$sql= "UPDATE CARRITO_CLIENTE SET FECHA='$fecha_actual',USUARIO_ID='$Cliente->getUsuario_id()',CORREO='$Cliente->getCorreo()',TELEFONO='getTelefono()',UBICACION='$Cliente->getUbicacion()',ESTADO='$estado' WHERE CARRITOCLIENTE_ID= '$carritocliente_id';";

		$result = mysqli_query($db,$sql);
		mysqli_close($db);
		if ($result == true) {
      	$answer= true;
      	IngresarCarrito_Cliente($Cliente->getUsuario_id());
   		}else{
      	$answer= false;
   		}

		return $answer;




	}
	public function cantidadCarritosFinalizados(){
	$sql="SELECT COUNT(*) AS CANTIDAD FROM CARRITO_CLIENTE WHERE ESTADO='2'; ";
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');

	$query = mysqli_query($db, $sql);

	mysqli_close($db);

	return $query;
	}

}



 ?>
