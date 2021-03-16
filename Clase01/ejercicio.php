<?php
    /*
    Profesor Villegas
    Alumna Claudia Jara
    Legajo 110050

    Enunciado:
    Aplicación No 1 (Sumar números)
    Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
    supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
    se sumaron.
    */

    $totalSuma = 0;
    $limiteTotalSuma=1000;
    $numeroASumar = 1;

    echo "<ul>";
    while ($totalSuma < $limiteTotalSuma) {
        $totalSuma += $numeroASumar;
        printf("<li> %d </li>",$numeroASumar);
        $numeroASumar +=1;
    }
    echo "</ul>";
    printf("Cantidad Numeros Sumados: %d", $numeroASumar);
?>
