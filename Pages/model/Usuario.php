<?php

class Usuario{
private $usuario_id;
private $contrasenna;
private $rol;
private $estado;
private $nombreCompleto;
private $imagenusuario;
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

    /**
     * Get the value of Usuario Id
     *
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * Set the value of Usuario Id
     *
     * @param mixed usuario_id
     *
     * @return self
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    /**
     * Get the value of Nombre Completo
     *
     * @return mixed
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set the value of Nombre Completo
     *
     * @param mixed nombreCompleto
     *
     * @return self
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }


    /**
     * Get the value of Imagenusuario
     *
     * @return mixed
     */
    public function getImagenusuario()
    {
        return $this->imagenusuario;
    }

    /**
     * Set the value of Imagenusuario
     *
     * @param mixed imagenusuario
     *
     * @return self
     */
    public function setImagenusuario($imagenusuario)
    {
        $this->imagenusuario = $imagenusuario;

        return $this;
    }

}


?>
