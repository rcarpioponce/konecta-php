<?php
require('base.php');
class Categoria extends Base {
    private $nombre;
    public $categoriaList;


    function getList(){
        $sql = "SELECT categoria_id, categoria_nombre FROM categoria ORDER BY categoria_nombre";
        $resultado = $this->conexiondb->query($sql);

        $this->categoriaList = array();
        while($categoria = $resultado->fetch_assoc()){
            
            $this->categoriaList[] = array(
                'value' => $categoria['categoria_id'],
                'text' => $categoria['categoria_nombre'],
            );
        }
        echo json_encode($this->categoriaList);
        
    }
    function add($nombre = ''){
        $sql = "INSERT INTO categoria (categoria_nombre) values (?)";
        $stmt = $this->conexiondb->executeQuery($sql);
        $stmt->bind_param('s',$nombre);
        $stmt->execute();
        $stmt->close();        
        echo json_encode(array('success'=>true, 'msg'=>'acción satisfactoria'));        
    }
}