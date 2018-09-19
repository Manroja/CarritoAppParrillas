<?php 
/**
 * 
 */
class DetalleCarrito 
{
	private $Detalle_Id;
	private $CarritoClienteId;
	private $ProductoId;
	private $Cantidad;
	private $Total;
	private $Estado;

	function __construct()
	{ 
		# code...
	}
/* set value to 'private $Detalle_Id' property */
	public function setDetalle_Id($Detalle_Id){
 	$this->Detalle_Id = $Detalle_Id;
	}

	/* get value from 'private $DetalleCarritoId' property */
	public function getDetalle_Id(){
 	return $this->Detalle_Id;
	}
	/* set value to 'private $CarritoClienteId' property */
	public function setCarritoClienteId($CarritoClienteId){
 	$this->CarritoClienteId = $CarritoClienteId;
	}

	/* get value from 'private $CarritoClienteId' property */
	public function getCarritoClienteId(){
 	return $this->CarritoClienteId;
	}
	/* set value to 'private $ProductoId' property */
	public function setProductoId($ProductoId){
 	$this->ProductoId = $ProductoId;
	}

	/* get value from 'private $ProductoId' property */
	public function getProductoId(){
 	return $this->ProductoId;
	}
	/* set value to 'private $Cantidad' property */
	public function setCantidad($Cantidad){
 	$this->Cantidad = $Cantidad;
	}

	/* get value from 'private $Cantidad' property */
	public function getCantidad(){
 	return $this->Cantidad;
	}
	/* set value to 'private $Total' property */
	public function setTotal($Total){
 	$this->Total = $Total;
	}

	/* get value from 'private $Total' property */
	public function getTotal(){
 	return $this->Total;
	}
	/* set value to 'private $Estado' property */
	public function setEstado($Estado){
 	$this->Estado = $Estado;
	}

	/* get value from 'private $Estado' property */
	public function getEstado(){
 	return $this->Estado;
	}


}

 ?>