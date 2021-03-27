<?php

require_once 'Pasajero.php';

class Vuelo{
    private $fecha;
    private $empresa;
    private $precio;
    var $listaPasajeros;
    private $cantMaxima;

    public function __construct($fecha = '', $empresa = '', $precio = 0, $cantMaxima=0)
    {
        $this->fecha = $fecha;
        $this->empresa = $empresa;
        $this->precio = $precio;
        $this->listaPasajeros = array();
        $this->cantMaxima = $cantMaxima == 0 ? 100 : $cantMaxima;
    }

    private function GetInfoVuelo(){
        $cadenaInfo = 'Fecha:' . $this->fecha . ' Empresa: ' . $this->empresa . ' Precio: ' . $this->precio . ' Cantidad Pasajeros Maximo: ' . $this->cantMaxima . '<br>';
        foreach ($this->listaPasajeros as $key => $value) {
            $cadenaInfo .= $value->GetInfoPasajero();
        }
        return $cadenaInfo;
    }

    public function MostrarVuelo(){
        echo $this->GetInfoVuelo();
    }

    private function Equals(Pasajero $pasajero){
        $estaEnElVuelo = false;
        foreach ($this->listaPasajeros as $key => $value) {
            if($value->Equals($pasajero)){
                $estaEnElVuelo = true;
                break;
            }
        }
        return $estaEnElVuelo;
    }

    public function AgregarPasajero(Pasajero $pasajero){
        if($this->cantMaxima <= count($this->listaPasajeros) || $this->Equals($pasajero)){
            echo 'El pasajero ya esta en el Vuelo o no hay mas lugar we.<br>';
        }else{
            array_push($this->listaPasajeros,$pasajero);
            echo 'Se agrego el pasajero.<br>';
        }
    }

    private function ObtenerDineroRecaudado(Vuelo $vuelo){
        $dinero = 0;
        foreach ($vuelo->listaPasajeros as $key => $value) {
            if($value->GetEsPlus()){
                $dinero += (float)$vuelo->precio * 0.8;
            }else{
                $dinero += $vuelo->precio;
            }
        }
        return (float)$dinero;
    }

    public static function Add(Vuelo $vueloUno, Vuelo $vueloDos){
        return $vueloUno->ObtenerDineroRecaudado($vueloUno) + $vueloDos->ObtenerDineroRecaudado($vueloDos);
    }
 
    public function Remove(Pasajero $pasajero){
        if(!$this->Equals($pasajero)){
            echo 'El pasajero <strong>NO</strong> esta en el Vuelo.<br>';
        }else{
            $key = array_search($pasajero, $this->listaPasajeros);
            unset($this->listaPasajeros[$key]);
            $this->listaPasajeros = array_values($this->listaPasajeros);
            echo 'Se elimino el pasajero.<br>';
        }
    }

}

?>