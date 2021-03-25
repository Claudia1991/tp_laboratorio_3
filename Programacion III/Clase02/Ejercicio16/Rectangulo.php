<?php
require_once 'FiguraGeometrica.php';
require_once 'Punto.php';

class Rectangulo extends FiguraGeometrica{
    private $_base;
    private $_altura;
    private $_verticaUno;
    private $_verticeDos;
    private $_verticaTres;
    private $_verticaCuatro;

    public function __construct(Punto $verticeUno,Punto $verticeTres)
    {
        parent::__construct();
        $this->_verticaUno = $verticeUno;
        $this->_verticeDos = $this->CalcularVerticeDos($verticeUno, $verticeTres);
        $this->_verticeTres = $verticeTres;
        $this->_verticaCuatro = $this->CalcularVerticeCuatro($verticeUno, $verticeTres);
        $this->_base = $this->CalcularBase($this->_verticaUno,$this->_verticeDos);
        $this->_altura = $this->CalcularAltura($this->_verticaUno,$this->_verticaCuatro);
        $this->CalcularDatos();
    }


    public function Dibujar()
    {
        $figura = '';
        for ($i=0; $i < $this->_altura; $i++) { 
            for ($j=0; $j < $this->_base; $j++) { 
                $figura .= '*';
            }
            $figura .= '<br>';
        }
        return $figura;
    }

    public function CalcularDatos()
    {
        $this->_perimetro = 2 * $this->_base + 2 * $this->_altura ;
        $this->_superficie = $this->_base * $this->_altura;
    }

    private function CalcularBase(Punto $verticeUno,Punto $verticeDos){
        return $this->CalcularDistanciaEntreDosPuntos($verticeUno, $verticeDos);
    }

    private function CalcularAltura(Punto $verticeUno,Punto $verticeDos){
        return $this->CalcularDistanciaEntreDosPuntos($verticeUno, $verticeDos);
    }

    private function CalcularVerticeDos(Punto $verticeUno,Punto $verticeDos){
        $x = $verticeDos->GetX();
        $y = $verticeUno->GetY();
        return new Punto($x,$y);
    }

    private function CalcularVerticeCuatro(Punto $verticeUno,Punto $verticeDos){
        $y = $verticeDos->GetY();
        $x = $verticeUno->GetX();
        return new Punto($x,$y);
    }

    private function CalcularDistanciaEntreDosPuntos(Punto $verticeUno,Punto $verticeDos){
        return sqrt(pow($verticeDos->GetX() - $verticeUno->GetX(), 2) + pow($verticeDos->GetY() - $verticeUno->GetY(), 2));
    }

    public function ToString()
    {
        return parent::ToString() . '<br> Base: ' . $this->_base . ' Altura: ' . $this->_altura . ' ';
    }
}
?>