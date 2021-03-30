<?php

/**
 * Profesor Selente Villegas
 * Alumna: Claudia Jara
 * 
 * Aplicación No 20 (Registro CSV)
*Archivo: registro.php
*método:POST
*Recibe los datos del usuario(nombre, clave,mail )por POST ,
*crear un objeto y utilizar sus métodos para poder hacer el alta,
*guardando los datos en usuarios.csv.
*retorna si se pudo agregar o no.
*Cada usuario se agrega en un renglón diferente al anterior.
*Hacer los métodos necesarios en la clase usuario
 */
require_once 'Usuario.php';

//Validamos que ingresen datos
$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];

if(strcmp($nombre,'') == 0 || strcmp($clave,'') == 0 || strcmp($mail,'') == 0){
    echo 'Datos Invalidos';
}else{
    $usuario = new Usuario($nombre, $clave, $mail);
    if(Usuario::GuardarUsuario($usuario)){

        echo 'Datos correctos. Se dio de alta el usuario.';
    }else{
        echo 'Ocurrio un error al guardar los datos.';
    }
}

?>