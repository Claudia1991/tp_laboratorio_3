<?php
abstract class FiguraGeometrica{
    protected $_perimetro;
    protected $_superficie;

    public function __construct()
    {
        $this->_perimetro=0;
        $this->_superficie=0;
    }

    public function ToString()
    {
        return ' El perimetro es: '. $this->_perimetro .' y la superficie es: ' . $this->_superficie . ' ';
    }

    public abstract function Dibujar();

    protected abstract  function CalcularDatos();
}
?>