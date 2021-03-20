<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 2 (Mostrar fecha y estación)
    Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
    distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
    año es. Utilizar una estructura selectiva múltiple.
    */

    $fechaActual = new DateTime();
    $estacionDelAnio = "";
    $inicioVerano = new DateTime("21-12-2021");
    $finVerano = new DateTime("20-03-2021");
    $inicioOtonio = new DateTime("21-03-2021");
    $finOtonio = new DateTime("20-06-2021");
    $inicioInvierno = new DateTime("21-06-2021");
    $finInvierno = new DateTime("20-09-2021");

    echo "<h3>Mostrar Fecha y estacion</h3>";

    if($fechaActual >= $inicioVerano && $fechaActual <= $finVerano){
        $estacionDelAnio = "Verano";
    }
    else if($fechaActual >= $inicioOtonio && $fechaActual <= $finoOtonio){
        $estacionDelAnio = "Otoño";
    }
    else if($fechaActual >= $inicioInvierno && $fechaActual <= $finInvierno){
        $estacionDelAnio = "Invierno";
    }
    else{
        $estacionDelAnio = "Primavera";
    }

    echo $estacionDelAnio;

?>
