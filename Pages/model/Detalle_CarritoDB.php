<?php
/**
 *
 */
include("Detalle_Carrito.php");
include("Carrito_ClienteDB.php");

class Detalle_CarritoDB
{
	private $contador=0;
	private $total;
	private $subtotal;
	private $IVA;

	function __construct()
	{
		# code...
	}

	public function Get_ContCarrito($usuario_id){
	 $Carrito= new Carrito_ClienteDB();
	 //$detalle= new Detalle_CarritoDB();
	 $CarritoClienteId=$Carrito->getCarritoActual($usuario_id)->getCarritoClienteId();

	 if($CarritoClienteId!=null){
	 $productDB=new ProductoDB();
	 $result= mysqli_fetch_array($this->GetProductosDetalles($CarritoClienteId));
	 $query= $this->GetProductosDetalles($CarritoClienteId);
	 $sub=0;
	 $cont=0;
	 $html='';
	 if($result>0){
		while ($key=mysqli_fetch_array($query)) {
		$cont++;
	}
}
}
return $cont;
}

	public function Get_ALLDetalles($usuario_id){
	 $Carrito= new Carrito_ClienteDB();
	 //$detalle= new Detalle_CarritoDB();
	 $CarritoClienteId=$Carrito->getCarritoActual($usuario_id)->getCarritoClienteId();

	 if($CarritoClienteId!=null){
	 $productDB=new ProductoDB();
	 $result= mysqli_fetch_array($this->GetProductosDetalles($CarritoClienteId));
	 $query= $this->GetProductosDetalles($CarritoClienteId);
	 $sub=0;
	 $cont=0;
	 $html='';
	 if($result>0){
		while ($key=mysqli_fetch_array($query)) {
	 	$product=$productDB->getProductoID($key["PRODUCTO_ID"]);
	 	$html.='<li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">'.$product->getNombre().'</h6>
                <small class="text-muted">Cantidad:'.$key["CANTIDAD"].'</small><br>
								<small class="text-muted">Total:'.$key["TOTAL"].'</small>
              </div>
              	<div>


              <button name="eliminar" type="submit" class="btn btn-secondary waves-effect m-0" value="'.$key["DETALLE_ID"].'">
				                    	Eliminar
				                    </button>
              </div>

            </li>';
            $sub+=$key["TOTAL"];
	 		$cont++;
	 }
	 }
	 }
	 $this->setContador($cont);
	 $this->setSubtotal($sub);
	 $this->setIVA($sub*0.13);
	 $this->setTotal($this->getIVA()+$sub);
	 $html.='<li class="list-group-item d-flex justify-content-between">
              <span>Subtotal (COLON)</span>
              <strong>₡'.$this->getSubtotal().'</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Impuestos (COLON)</span>
              <strong>₡'.$this->getIVA().'</strong>
            </li>

	 		<li class="list-group-item d-flex justify-content-between">
              <span>Total (COLON)</span>
              <strong>₡'.$this->getTotal().'</strong>
            </li>';

	 return $html;


	}


	public function Get_Prueba($usuario_id,$nombre,$correo,$telefono, $direccion){
	 $Carrito= new Carrito_ClienteDB();
	 //$detalle= new Detalle_CarritoDB();
	 $CarritoClienteId=$Carrito->getCarritoActual($usuario_id)->getCarritoClienteId();

	 if($CarritoClienteId!=null){
	 $productDB=new ProductoDB();
	 $result= mysqli_fetch_array($this->GetProductosDetalles($CarritoClienteId));
	 $query= $this->GetProductosDetalles($CarritoClienteId);
	 $sub=0;
	 $cont=0;
	 $html='';
	 $html = "De: $nombre \n";
	 $html .= "Correo: $correo \n";
	 $html .= "Telefono: $telefono \n";
	 $html .= "Dirección de Casa: $direccion \n";

	 if($result>0){
		while ($key=mysqli_fetch_array($query)) {
	 	$product=$productDB->getProductoID($key["PRODUCTO_ID"]);
	 	$html.=''.$product->getNombre().' '.$key["CANTIDAD"].' '.$key["TOTAL"];
            $sub+=$key["TOTAL"];
	 		$cont++;
	 }
	 }
	 }
	 $this->setContador($cont);
	 $this->setSubtotal($sub);
	 $this->setIVA($sub*0.13);
	 $this->setTotal($this->getIVA()+$sub);
	 $html.="\n".' Subtotal (COLON) ₡'.$this->getSubtotal()."\n".'Impuestos (COLON) ₡'
	 .$this->getIVA()."\n".'Total (COLON)₡'.$this->getTotal();

	 $carta = $html;
	 $destinatario = "matusrobinc@gmail.com";
	 $asunto = "Solicitud de Cotización";
	 mail($destinatario,$asunto,$carta);


	}
	public function GetProductosDetalles($CarritoClienteId){

        $sql = "SELECT * FROM DETALLE_CARRITO WHERE CARRITOCLIENTE_ID='$CarritoClienteId'AND ESTADO='1';";
          $db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
          $query = mysqli_query($db, $sql);
          mysqli_close($db);
          return $query;
	}



	public function IngresarDetalle_Carrito($CarritoClienteId,$ProductoId,$cantidad){

		$answer;
		$total= $this->total($ProductoId,$cantidad);
		$Repetido= new DetalleCarrito();
		$Repetido= $this->getProductoRepetido($CarritoClienteId,$ProductoId);

		if ($Repetido!=NULL) {
			$Cantidad= $Repetido->getCantidad()+$cantidad;
			$total= $this->total($ProductoId,$cantidad)+$Repetido->getTotal() ;
				$this->updateDetalle_Carrito($Repetido->getDetalle_Id(),$Cantidad,$total);


		}else{
		$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
		$sql= "INSERT INTO DETALLE_CARRITO (CARRITOCLIENTE_ID,PRODUCTO_ID,CANTIDAD,TOTAL,ESTADO) VALUES ('$CarritoClienteId', '$ProductoId','$cantidad','$total','1');";
			//ESTADO 1 PRODUCTO DESEADO.
		$result = mysqli_query($db,$sql);
		mysqli_close($db);
		if ($result == true) {
      	$answer= true;
   		}else{
      	$answer= false;
   		}
   	}

		return $answer;
	}
	public function total($ProductoId,$Cantidad){
	$productDB=new ProductoDB();
	$product= $productDB->getProductoID($ProductoId);
	$total= $product->getPrecio()*$Cantidad;
	return $total;
		}
	// CON ESTE METODO SE OPTINE EL (OBJETO)DETALLE CON EL PRODUCTO Y EL CARRITO DEL CLIENTE.
	public function getProductoRepetido($CarritoClienteId,$ProductoId){

	$detalle= new DetalleCarrito();
	$sql= "SELECT * FROM DETALLE_CARRITO WHERE CARRITOCLIENTE_ID ='$CarritoClienteId' AND PRODUCTO_ID='$ProductoId';";
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
 	$result = mysqli_query($db,$sql);
	mysqli_close($db);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
	if($count == 1) {
		$detalle->setDetalle_Id($row['DETALLE_ID']);
		$detalle->setCarritoClienteId($row['CARRITOCLIENTE_ID']);
		$detalle->setProductoId($row['PRODUCTO_ID']);
		$detalle->setCantidad($row['CANTIDAD']);
		$detalle->setTotal($row['TOTAL']);
		$detalle->setEstado($row['ESTADO']);

	}else{
		$detalle= NULL;
	}

	return $detalle;
	}
	public function updateDetalle_Carrito($Detalle_id,$Cantidad,$Total){
	$estado=1;//Significa Que el producto es deseado por el cliente.
	$sql= "UPDATE DETALLE_CARRITO SET CANTIDAD='$Cantidad',TOTAL='$Total',ESTADO='$estado' WHERE DETALLE_ID='$Detalle_id';";
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
	$query = mysqli_query($db, $sql);
	return $query;
	}
	public function DeleteDetalle_Carrito($Detalle_id){
	$estado=2;//Significa Que el producto es NO deseado por el cliente.
	$db = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b88864226df81a','8b9e5dce','heroku_1ed952686571f75');
	$sql= "UPDATE DETALLE_CARRITO SET ESTADO='2',CANTIDAD='0',TOTAL='0' WHERE DETALLE_ID='$Detalle_id';";
	$query = mysqli_query($db, $sql);
	mysqli_close($db);
    return $query;
	}
	public function setContador($contador){
 	$this->contador = $contador;
	}
	public function getContador(){
 	return $this->contador;
	}
	public function setTotal($total){
 	$this->total = $total;
	}
	public function getTotal(){
 	return $this->total;
	}
	public function setSubtotal($subtotal){
 	$this->subtotal = $subtotal;
	}
	public function getSubtotal(){
 	return $this->subtotal;
	}
	public function setIVA($IVA){
 	$this->IVA = $IVA;
	}
	public function getIVA(){
 	return $this->IVA;
	}

}
 ?>
