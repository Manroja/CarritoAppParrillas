<?php

/**
 *
 */
class Producto
{
  private $productoId;
  private $nombre;
  private $precio;
  private $descripcion;
  private $estado;
  private $IVA;
  private $imagen;
  private $tipoAlquiler;
  function __construct()
  {
    // code...
  }

  /* set value to 'private $name' property */
public function setProductoId($productoId){
 $this->productoId = $productoId;
}

/* get value from 'private $name' property */
public function getProductoId(){
 return $this->productoId;
}


public function setNombre($nombre){
 $this->nombre = $nombre;
}
public function getNombre(){
 return $this->nombre;
}

public function setPrecio($precio){
 $this->precio = $precio;
}
public function getPrecio(){
 return $this->precio;
}

public function setDescripcion($descripcion){
 $this->descripcion = $descripcion;
}
public function getDescripcion(){
 return $this->descripcion;
}

public function setEstado($estado){
 $this->estado = $estado;
}
public function getEstado(){
 return $this->estado;
}

public function setIVA($IVA){
 $this->IVA = $IVA;
}
public function getIVA(){
 return $this->IVA;
}


public function setImagen($imagen){
 $this->imagen = $imagen;
}
public function getImagen(){
 return $this->imagen;
}


    /**
     * Get the value of Tipo Alquiler
     *
     * @return mixed
     */
    public function getTipoAlquiler()
    {
        return $this->tipoAlquiler;
    }

    /**
     * Set the value of Tipo Alquiler
     *
     * @param mixed tipoAlquiler
     *
     * @return self
     */
    public function setTipoAlquiler($tipoAlquiler)
    {
        $this->tipoAlquiler = $tipoAlquiler;

        return $this;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @param mixed name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }



}
 ?>
