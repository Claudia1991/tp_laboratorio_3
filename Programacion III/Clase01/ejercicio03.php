<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 3 (Obtener el valor del medio)
    Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
    el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
    variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
    Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
    Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
    */

    $a = 1;
    $b = 2;
    $c = 3;

    if(esNumeroDelMedio($a,$b,$c) || esNumeroDelMedio($a,$c,$b)){
        printf("Opa, aparecio a la primera : %d", $a);
    }else if(esNumeroDelMedio($b,$a,$c) || esNumeroDelMedio($b,$c,$a)){
        printf("Opa, aparecio a la segunda : %d", $b);
    }else if(esNumeroDelMedio($c,$b,$a) || esNumeroDelMedio($c,$a,$b)){
        printf("Opa, aparecio a la tercera : %d", $c);
    }else{
        printf("Negativo rey, no hay numero del medio");
    }


    function esNumeroDelMedio($numero, $numeriInferior, $numeroSuperior){
        return $numero > $numeriInferior && $numero < $numeroSuperior;
    }
?>
