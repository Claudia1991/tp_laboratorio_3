<?php
class Pasajero{
    private $_apellido;
    private $_nombre;
    private $_dni;
    private $_esPlus;

    public function __construct($apellido = '', $nombre='', $dni='', $esPlus = false)
    {
        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_dni = $dni;
        $this->_esPlus = $esPlus;
    }

    public function GetInfoPasajero(){
        return 'Apellido: ' . $this->_apellido . ' Nombre: ' . $this->_nombre . ' DNI: ' . $this->_dni . ' Es plus: ' . $this->_esPlus . '<br>';
    }

    public static function MostrarPasajero(Pasajero $pasajero){
        return $pasajero->GetInfoPasajero();
    }

    public function Equals(Pasajero $pasajero){
        return strcmp($this->_dni, $pasajero->_dni) == 0;
    }

    public function GetEsPlus(){
        return $this->_esPlus;
    }

}

?>