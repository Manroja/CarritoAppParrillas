<?php

include("Usuario.php");

class UsuarioDB
{

	function __construct()
	{
		# code...
	}
public function Acceder($id,$pass){
	$usu = new Usuario();
 	$sql = "SELECT * FROM USUARIOS WHERE USUARIO_ID = '$id' AND  CONTRASENNA =
   '$pass'";
   $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
 	$result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);
			mysqli_close($db);
	if($count == 1) {
         $usu->setUsuario_id($row['USUARIO_ID']);
         $usu->setContrasenna($row['CONTRASENNA']);
         $usu->setRol($row['ROL']);
         $usu->setEstado($row['ESTADO']);
				 $usu -> setNombreCompleto($row['NOMBRECOMPLETO']);
				 $usu -> setImagenusuario($row['IMAGENUSUARIO']);
         return $usu;

      }else {
         return null;
      }
}
public function Registrar($id,$pass,$nombre){
   $usu = new Usuario();
   $answer;
   $Existente = "SELECT * FROM USUARIOS WHERE USUARIO_ID = '$id'";
	 $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
   //$db = mysqli_connect('127.0.0.1','root','123456','parrillas_db');
   $result1 = mysqli_query($db,$Existente);
   $row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result1);

   if($count != 1) {
   $sql = "INSERT INTO USUARIOS (USUARIO_ID,CONTRASENNA,ROL,ESTADO,NOMBRECOMPLETO) VALUES ('$id','$pass','Cliente','1','$nombre');";
   $result = mysqli_query($db,$sql);
   if ($result == true) {
      $answer= true;
   }else{
     $answer= false;
   }

   }else{
      $answer= false;
   }
return $answer;
}

public function cantidadClientes()
{
	$sql = "SELECT COUNT(*) AS CANTIDAD FROM usuarios WHERE ROL = 'CLIENTE'";
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
	$query = mysqli_query($db, $sql);
	mysqli_close($db);
	return $query;
}

}


?>
