<?php
require_once 'FiguraGeometrica.php';

class Rectangulo extends FiguraGeometrica{
    private $_ladoUno;
    private $_ladoDos;

    public function __construct($color,$ladoUno, $ladoDos)
    {
        parent::__construct();
        $this->_ladoUno = $ladoUno;
        $this->_ladoDos = $ladoDos;
        $this->SetColor($color);
        $this->CalcularDatos();
    }


    public function Dibujar()
    {
        $figura = '';
        for ($i=0; $i < $this->_ladoUno; $i++) { 
            for ($j=0; $j < $this->_ladoDos; $j++) { 
                $figura .= '*';
            }
            $figura .= '<br>';
        }
        return $figura;
    }

    public function CalcularDatos()
    {
        $this->_perimetro = 2 * $this->_ladoUno + 2 * $this->_ladoDos ;
        $this->_superficie = $this->_ladoUno * $this->_ladoDos;
    }

    public function ToString()
    {
        return parent::ToString() . 'Lado uno: ' . $this->_ladoUno . 'Lado dos: ' . $this->_ladoDos;
    }
}
?>