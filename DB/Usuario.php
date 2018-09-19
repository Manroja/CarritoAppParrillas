<?php 
class Usuario{

private $usuario_id;
private $contrasenna;
private $rol;
private $estado;
// <constructor>
function __construct() {

   }
//!</fin del constructor>!
//<Inicia Set y Gets>
//set y get usuario_id
public function setUsuario_id($usuario_id){
$this->usuario_id=$usuario_id;
}

public function getUsuario_id(){

	return $this->usuario_id;
}
//set y get Contrasenna
public function getContrasenna(){

	return $this->contrasenna;
}
public function setContrasenna($contrasenna){
	$this->contrasenna = $contrasenna;
}
//set y get Rol Usuario
public function getRol(){

	return $this->rol;
}
public function setRol($rol){
	$this->rol = $rol;
}
//set y get Estado
public function getEstado(){

	return $this->estado;
}
public function setEstado($estado){
	$this->estado = $estado;
}
//!</Finaliza Set y Gets>!
}


?>