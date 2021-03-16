<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 5 (Números en letras)
    Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
    por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
    entre el 20 y el 60.
    Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
    */

$numero = 22;

if(obtenerDecimal($numero) == 2 && obtenerUnidad($numero) == 0){
    printf("El numero es {%d} ; su correspondiente letras son [%s]",$numero,obtenerDecimalLetras($numero));
}else if (obtenerDecimal($numero) == 2 && obtenerUnidad($numero) != 0) {
    printf("El numero es {%d} ; su correspondiente letras son [%s%s]",$numero,obtenerDecimalLetras($numero),obtenerUnidadLetras($numero));
}else{
    printf("El numero es {%d} ; su correspondiente letras son [%s y %s]",$numero,obtenerDecimalLetras($numero), obtenerUnidadLetras($numero));
}


function obtenerDecimal($numero)
{
    return (int)($numero / 10);
}

function obtenerUnidad($numero)
{
    return $numero - obtenerDecimal($numero) * 10;
}

function obtenerDecimalLetras($numero)
{
    $decimalLetra = "";
    $numeroDecimal = obtenerDecimal($numero);
    $numeroUnidad = obtenerUnidad($numero);
    switch ($numeroDecimal) {
        case 2:
            if($numeroUnidad == 0){
                $decimalLetra = "veinte";
            }else{
                $decimalLetra = "veinti";
            }
            break;
        case 3:
            $decimalLetra = "treinta";
            break;
        case 4:
            $decimalLetra = "cuarenta";
            break;
        case 5:
            $decimalLetra = "cincuenta";
            break;
        case 6:
            $decimalLetra = "sesenta";
            break;
        default:
            $decimalLetra = "Error en decimal letra";
            break;
    }
    return $decimalLetra;
}

function obtenerUnidadLetras($numero)
{
    $unidadLetra = "";
    $numeroUnidad = obtenerUnidad($numero);
    switch ($numeroUnidad) {
        case 0:
            $unidadLetra = "";
            break;
        case 1:
            $unidadLetra = "uno";
            break;
        case 2:
            $unidadLetra = "dos";
            break;
        case 3:
            $unidadLetra = "tres";
            break;
        case 4:
            $unidadLetra = "cuatro";
            break;
        case 5:
            $unidadLetra = "cinco";
            break;
        case 6:
            $unidadLetra = "seis";
            break;
        case 7:
            $unidadLetra = "siete";
            break;
        case 8:
            $unidadLetra = "ocho";
            break;
        case 9:
            $unidadLetra = "nueve";
            break;
        default:
            $unidadLetra = "Error en unidad letra";
            break;
    }
    return $unidadLetra;
}

?>
