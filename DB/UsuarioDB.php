<?php 

include("Usuario.php");
include("../Pages/php-login/config.php");
class UsuarioDB 
{
	
	function __construct()
	{
		# code...
	}
public function Acceder($id,$pass){
	$usu = new Usuario();
 	$sql = "SELECT * FROM USUARIOS WHERE USUARIO_ID = '$id' AND  CONTRASENNA = '$pass'";
 	$result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);
	if($count == 1) {         
         $usu->setUsuario_id($row['USUARIO_ID']);
         $usu->setContrasenna($row['CONTRASENNA']);
         $usu->setRol($row['ROL']);
         $usu->setEstado($row['ROL']);
         return $usu;
         
      }else {
         return null;
      }
}


}


?>