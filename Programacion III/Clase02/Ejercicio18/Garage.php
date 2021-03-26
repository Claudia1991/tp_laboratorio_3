<?php

require_once 'Auto.php';

class Garage{
    private $razonSocial;
    private $precioPorHora;
    private $autos = [];

    public function __construct($razonSocial = '', $precioPorHora = 0)
    {
        $this->razonSocial = $razonSocial;
        $this->precioPorHora = $precioPorHora;
    }

    public function MostrarGarage(){
        echo 'Razon Social: ' . $this->razonSocial . ' Precio por hora: ' . $this->precioPorHora .'<hr>';
        foreach ($this->autos as $key => $value) {
            echo Auto::MostrarAuto($value);
        }
    }

    public function Equals(Auto $auto){
        $estaEnElGarage = false;
        foreach ($this->autos as $key => $value) {
            if($value->Equals($auto)){
                $estaEnElGarage = true;
                break;
            }
        }
        return $estaEnElGarage;
    }

    public function Add(Auto $auto){
        if($this->Equals($auto)){
            echo 'El auto ya esta en el Garage.<br>';
        }else{
            array_push($this->autos,$auto);
            echo 'Se agrego el auto.<br>';
        }
    }
 
    public function Remove(Auto $auto){
        if(!$this->Equals($auto)){
            echo 'El auto <strong>NO</strong> esta en el Garage.<br>';
        }else{
            $key = array_search($auto, $this->autos);
            unset($this->autos[$key]);
            $this->autos = array_values($this->autos);
            echo 'Se elimino el auto.<br>';
        }
    }

}

?>