<?php
/**
 * Profesor: Villegas
 * Alumna Claudia Jara
 * 
 * Aplicación No 19 (Pasajero - Vuelo)
*Dadas las siguientes clases:
*Pasajero
*Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean)
*Crear un constructor capaz de recibir los cuatro parámetros.
*Crear el método de instancia “Equals” que permita comparar dos objetos Pasajero. Retornará
*TRUE cuando los _dni sean iguales.
*Agregar un método getter llamado GetInfoPasajero, que retornará una cadena de caracteres
*con los atributos concatenados del objeto.
*
*Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página.
*Vuelo
*Atributos privados: _fecha (DateTime), _empresa (string) _precio (double), _listaDePasajeros
*(array de tipo Pasajero), _cantMaxima (int; con su getter). Tanto _listaDePasajero como
*_cantMaxima sólo se inicializarán en el constructor.
*Crear el constructor capaz de que de poder instanciar objetos pasándole como parámetros:
*i. La empresa y el precio.
*ii. La empresa, el precio y la cantidad máxima de pasajeros.
*
*Agregar un método getter, que devuelva en una cadena de caracteres toda la información de
*un vuelo: fecha, empresa, precio, cantidad máxima de pasajeros, y toda la información de
*todos los pasajeros.
*Crear un método de instancia llamado AgregarPasajero, en el caso que no exista en la lista,
*se agregará (utilizar Equals). Además tener en cuenta la capacidad del vuelo. El valor de
*retorno de este método indicará si se agregó o no.
*Agregar un método de instancia llamado MostrarVuelo, que mostrará la información de un
*vuelo.
*Crear el método de clase “Add” para que permita sumar dos vuelos. El valor devuelto deberá
*ser de tipo numérico, y representará el valor recaudado por los vuelos. Tener en cuenta que si
*un pasajero es Plus, se le hará un descuento del 20% en el precio del vuelo.
*Crear el método de clase “Remove”, que permite quitar un pasajero de un vuelo, siempre y
*cuando el pasajero esté en dicho vuelo, caso contrario, informarlo. El método retornará un
*objeto de tipo Vuelo. */

require_once 'Vuelo.php';

$pasajeroUno = new Pasajero('Jara', 'Claudia', '123',true);
$pasajeroDos = new Pasajero('Jara', 'Claudia', '123',false);
$pasajeroTres = new Pasajero('Lopez', 'Cinthia', '123456789',false);
$pasajeroCuatro = new Pasajero('Perez', 'Juan', '321',true);

$vueloUno = new Vuelo('26/03/2021','Destino Final Uno', 1000, 5);
$vueloDos = new Vuelo('03/26/2021','Destino Final Dos', 100, 2);

echo 'Pasajeros iguales - ';
echo $pasajeroUno->Equals($pasajeroDos);
echo '<hr>';
echo 'Pasajeros no iguales - ';
echo $pasajeroUno->Equals($pasajeroTres);
echo '<hr>';

echo 'Agregando pasajeros vuelo uno - ';
$vueloUno->AgregarPasajero($pasajeroUno);
$vueloUno->AgregarPasajero($pasajeroDos);
$vueloUno->AgregarPasajero($pasajeroTres);
$vueloUno->AgregarPasajero($pasajeroCuatro);
echo '<hr>';

echo 'Removiendo pasajeros vuelo uno - ';
$vueloUno->Remove($pasajeroCuatro);
echo '<hr>';

echo 'Agregando pasajeros vuelo dos - ';
$vueloDos->AgregarPasajero($pasajeroUno);
$vueloDos->AgregarPasajero($pasajeroDos);
$vueloDos->AgregarPasajero($pasajeroTres);
$vueloDos->AgregarPasajero($pasajeroCuatro);
echo '<hr>';

echo 'Sumando vuelos - ';
echo Vuelo::Add($vueloUno, $vueloDos);
echo '<hr>';

echo 'Mostrar vuelos <br>';
$vueloUno->MostrarVuelo();
echo '<hr>';

echo 'Mostrar vuelos <br>';
$vueloDos->MostrarVuelo();
?>