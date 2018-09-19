<?php 
/**
 * 
 */
class carrito_cliente 
{
	private $carritoClienteId;
	private $fecha;
	private $usuario_id;
	private $correo;
	private $telefono;
	private $ubicacion;
	private $estado;

	function __construct()
	{
		
	}
	 /* set value to 'private $carritoClienteId' property */
	public function setCarritoClienteId($carritoClienteId){
 	$this->carritoClienteId = $carritoClienteId;
	}

	/* get value from 'private $carritoClienteId' property */
	public function getCarritoClienteId(){
 	return $this->carritoClienteId;
	}
	 /* set value to 'private $fecha' property */
	public function setFecha($fecha){
 	$this->fecha = $fecha;
	}

	/* get value from 'private $fecha' property */
	public function getFecha(){
 	return $this->fecha;
	}

	/* set value to 'private $usuario_id' property */
	public function setUsuario_id($usuario_id){
 	$this->usuario_id = $usuario_id;
	}

	/* get value from 'private $usuario_id' property */
	public function getUsuario_id(){
 	return $this->usuario_id;
	}

	/* set value to 'private $correo' property */
	public function setCorreo($correo){
 	$this->correo = $correo;
	}

	/* get value from 'private $correo' property */
	public function getCorreo(){
 	return $this->correo;
	}

	/* set value to 'private $telefono' property */
	public function setTelefono($telefono){
 	$this->telefono = $telefono;
	}

	/* get value from 'private $telefono' property */
	public function getTelefono(){
 	return $this->telefono;
	}	

	/* set value to 'private $ubicacion' property */
	public function setUbicacion($ubicacion){
 	$this->ubicacion = $ubicacion;
	}

	/* get value from 'private $ubicacion' property */
	public function getUbicacion(){
 	return $this->ubicacion;
	}	
	/* set value to 'private $' property */
	public function setEstado($estado){
 	$this->estado = $estado;
	}

	/* get value from 'private $estado' property */
	public function getEstado(){
 	return $this->estado;
	}




}



 ?>