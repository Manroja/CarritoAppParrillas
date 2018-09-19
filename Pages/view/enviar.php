<?php

public function Get_Prueba($usuario_id){
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
  $html.=''.$product->getNombre().' '.$key["CANTIDAD"].' '.$key["TOTAL"].;
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

 return $html;


}

 ?>
