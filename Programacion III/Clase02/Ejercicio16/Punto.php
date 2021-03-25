<?php

class Punto {
    private $_y;
    private $_x;

    public function __construct($x, $y)
    {
        $this->_y = $y;
        $this->_x = $x;
    }

    public function GetY(){
        return $this->_y;
    }

    public function GetX(){
        return $this->_x;
    }

}


?>