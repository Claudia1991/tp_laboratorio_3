<?php
/*
    Profesor Villegas
    Alumna Claudia Jara

    Enunciado:
    Aplicación No 4 (Calculadora)
    Escribir un programa que use la variable $operador que pueda almacenar los símbolos
    matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
    símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
    resultado por pantalla.
    */

$operador = "+";
$numeroUno = 1;
$numeroDos = 2;
$resultado ;

switch ($operador) {
    case '+':
        $resultado = $numeroDos + $numeroUno;
        break;
    case '-':
        $resultado = $numeroDos - $numeroUno;
        break;
    case '*':
        $resultado = $numeroDos * $numeroUno;
        break;
    case '/':
        if($numeroDos != 0){
            $resultado = $numeroUno / $numeroDos;
        }
        break;

    default:
        printf("Error en el operador ingresado.");
        break;
}
if($resultado != null){

    printf("Resultado de la operacion %s es %2f", $operador,$resultado);
}else{
    printf("No se puede realizar la operacion");
}

?>
