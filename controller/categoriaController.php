<?php
require('../models/conexiondb.php');
require('../models/categoria.php');

$objCategoria = new Categoria($objConexion);
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$data = json_decode(file_get_contents("php://input"),true);

if($action == 'list'){
    echo $objCategoria->getList();
}
else if($action == 'add'){
    $nombre = isset($data['nombre']) ? $data['nombre'] : '';
    if($nombre != ''){
        echo $objCategoria->add($nombre);
    }
}