<?php
/**
 * Profesor: Villegas
 * Alumna Claudia Jara
 * 
 * Aplicación No 18 (Auto - Garage)
*Crear la clase Garage que posea como atributos privados:
*
*_razonSocial (String)
*_precioPorHora (Double)
*_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
*
*Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
*
*i. La razón social.
*ii. La razón social, y el precio por hora.
*
*Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
*que mostrará todos los atributos del objeto.
*Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
*objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
*Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
*(sólo si el auto no está en el garaje, de lo contrario informarlo).
*Ejemplo: $miGarage->Add($autoUno);
*Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
*“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
*Ejemplo: $miGarage->Remove($autoUno);
*En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
*métodos. */

require_once 'Garage.php';

$miGarage = new Garage('Don Pedro', 123);

$autoUno = new Auto('Amarillo', 2000, 'Mazda', '25-04-2021');
$autoDos = new Auto('Azul', 1000, 'Ford', '25-04-2021');
$autoTres = new Auto('Verde', 3000, 'Mazda', '25-04-2021');

$miGarage->Add($autoUno);
$miGarage->Add($autoDos);
$miGarage->Add($autoTres);

$miGarage->MostrarGarage();
$miGarage->Remove($autoUno);

echo '<br>';
$miGarage->MostrarGarage();


?>