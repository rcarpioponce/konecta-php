<?php 
class ConexionDB {
    public $conexion;
    private $server;
    private $usuario;
    private $password;
    private $db;
    public $stmt;

    function __construct(){
        $this->server = 'localhost';
        $this->usuario = 'root';
        $this->password = '';
        $this->db = 'db_productos';
        $this->crearConexion();
        return $this->conexion;
    }
    private function crearConexion(){
        $this->conexion = new mysqli($this->server,$this->usuario,$this->password, $this->db);
        $this->conexion->set_charset('utf8mb4');
    }
    public function query($sql = ''){
        $resultado = $this->conexion->query($sql);
        return $resultado;
    }
    public function executeQuery($sql = ''){
        $this->stmt = $this->conexion->prepare($sql);
        return $this->stmt;
    }
    public function cerrarConexion(){
        $this->conexion->close();
    }
}

$objConexion = new ConexionDB();