<?php
require('base.php');
class Producto extends Base {
    public $productoList;


    function getList(){
        $sql = "SELECT p.producto_id, 
                        p.producto_nombre,
                        p.producto_referencia,
                        p.categoria_id,
                        p.producto_stock,
                        p.producto_precio,
                        p.fecha_creacion,
                        p.fecha_ult_venta,
                        c.categoria_nombre 
                        FROM producto p 
                        INNER JOIN categoria c
                        ON p.categoria_id = c.categoria_id 
                        ORDER BY producto_nombre";
        $resultado = $this->conexiondb->query($sql);

        $this->productoList = array();
        while($producto = $resultado->fetch_assoc()){
            
            $this->productoList[] = $producto;
        }
        echo json_encode($this->productoList);
        
    }
    function add($nombre = '', $referencia = '', $categoria, $precio, $stock){
        $fecha= date('Y-m-d H:i:s');
        $sql = "INSERT INTO producto (producto_nombre,
        producto_referencia,
        categoria_id,
        producto_precio,
        producto_stock,
        fecha_creacion) values (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexiondb->executeQuery($sql);
        $stmt->bind_param('ssiiis',$nombre,$referencia, $categoria, $precio, $stock, $fecha);
        $stmt->execute();
        $stmt->close();        
        echo json_encode(array('success'=>true, 'msg'=>'acción satisfactoria'));        
    }
    function edit($id = 0, $nombre = '', $referencia = '', $categoria, $precio, $stock){
        $fecha= date('Y-m-d H:i:s');
        $sql = "UPDATE producto SET producto_nombre = ?,
        producto_referencia = ?,
        categoria_id = ?,
        producto_precio = ?,
        producto_stock = ? WHERE producto_id = ?";
        $stmt = $this->conexiondb->executeQuery($sql);
        $stmt->bind_param('ssiiii',$nombre,$referencia, $categoria, $precio, $stock, $id);
        $stmt->execute();
        $stmt->close();        
        echo json_encode(array('success'=>true, 'msg'=>'acción satisfactoria'));        
    }    
    function delete($id = 0){
        $sql= "DELETE FROM producto WHERE producto_id  = ?";
        $stmt = $this->conexiondb->executeQuery($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();        
        echo json_encode(array('success'=>true, 'msg'=>'acción satisfactoria'));         
    }
}