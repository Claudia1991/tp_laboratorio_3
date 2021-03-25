<?php
require_once 'FiguraGeometrica.php';

class Triangulo extends FiguraGeometrica{
    private $_altura;
    private $_base;

    public function __construct($color, $altura,$base)
    {
        parent::__construct();
        $this->SetColor($color);
        $this->_altura = $altura;
        $this->_base = $base;
        $this->CalcularDatos();
    }

    public function CalcularDatos()
    {
        $this->_perimetro = $this->_altura + $this->_base ;
        $this->_superficie = (float)($this->_altura * $this->_base) / 2;
    }

    public function Dibujar()
    {
        $figura = '';
        for ($i=0; $i < $this->_altura; $i++) { 
            for ($j=0; $j <= $i*2; $j++) { 
                $figura .= '*';
            }
            $figura .= '<br>';
        }
        return $figura;
    }

    public function ToString()
    {
        return parent::ToString() . '. Altura : ' . $this->_altura . ' Base : ' . $this->_base;
    }
}


?>