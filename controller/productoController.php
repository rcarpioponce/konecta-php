<?php
require('../models/conexiondb.php');
require('../models/producto.php');

$objProducto = new Producto($objConexion);
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$data = json_decode(file_get_contents("php://input"),true);


if($action == 'list'){
    echo $objProducto->getList();
}
else if($action == 'add'){
    $nombre     = isset($data['nombre']) ? $data['nombre'] : '';
    $referencia = isset($data['referencia']) ? $data['referencia'] : '';
    $categoria  = isset($data['categoria']) ? $data['categoria'] : '';
    $precio     = isset($data['precio']) ? $data['precio'] : '';
    $stock      = isset($data['stock']) ? $data['stock'] : '';
    if($nombre != '' && $referencia != '' && $categoria != '' && $precio != '' && $stock != ''){
        echo $objProducto->add($nombre, $referencia, $categoria, $precio, $stock);
    }
}
else if($action == 'edit'){
    $id     = isset($data['id']) ? $data['id'] : '';
    $nombre     = isset($data['nombre']) ? $data['nombre'] : '';
    $referencia = isset($data['referencia']) ? $data['referencia'] : '';
    $categoria  = isset($data['categoria']) ? $data['categoria'] : '';
    $precio     = isset($data['precio']) ? $data['precio'] : '';
    $stock      = isset($data['stock']) ? $data['stock'] : '';
    if($id > 0 && $nombre != '' && $referencia != '' && $categoria != '' && $precio != '' && $stock != ''){
        echo $objProducto->edit($id ,$nombre, $referencia, $categoria, $precio, $stock);
    }
}
else if($action == 'delete'){
    $id = isset($data['id']) ? $data['id'] : '';
    if($id > 0){
        echo $objProducto->delete($id);
    }
}