<?php
class Base{
    public $conexiondb;
    public $resultado;

    public function __construct($conexiondb){
        $this->conexiondb = $conexiondb;
    }
}