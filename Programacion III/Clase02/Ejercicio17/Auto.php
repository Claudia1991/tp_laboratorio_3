<?php
class Auto{
    private $_color;
    private $_precio;
    private $_marca;
    private $_fecha;

    public function __construct($color = '', $precio=0, $marca='', $fecha = '')
    {
        $this->_color = $color;
        $this->_precio = $precio;
        $this->_marca = $marca;
        $this->_fecha = $fecha == '' ? date('d-F-Y') : $fecha;
    }

    public function AgregarImpuestos($impuestos){
        $this->_precio += $impuestos;
    }

    public static function MostrarAuto(Auto $auto){
        return 'Color: ' . $auto->_color . ' Precio: ' . $auto->_precio . ' Marca: ' . $auto->_marca . ' Fecha: ' . $auto->_fecha;
    }

    public function Equals(Auto $autoUno){
        return $autoUno->_marca == $this->_marca;
    }

    public static function Add(Auto $autoUno, Auto $autoDos){
        if($autoUno->Equals($autoDos) && $autoUno->_color == $autoDos->_color){
            return (float)($autoUno->_precio + $autoDos->_precio);
        }
    }
}

?>