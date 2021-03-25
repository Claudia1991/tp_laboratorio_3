<?php
abstract class FiguraGeometrica{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    public function __construct()
    {
        $this->_color = '';
        $this->_perimetro=0;
        $this->_superficie=0;
    }

    public function GetColor(){
        return $this->_color;
    }

    public function SetColor($color){
        $this->_color = $color;
    }

    public function ToString()
    {
        return 'La figura tiene color : '. $this->GetColor() .'. El perimetro es: '. $this->_perimetro .' y la superficie es: ' . $this->_superficie ;
    }

    public abstract function Dibujar();

    protected abstract  function CalcularDatos();
}
?>