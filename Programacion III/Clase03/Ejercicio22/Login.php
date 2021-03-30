<?php
/**
 * Profesor Selente Villegas
 * Alumna Claudia Jara
 * 
 * Aplicación No 22 ( Login)
    *Archivo: Login.php
    *método:POST
    *Recibe los datos del usuario(clave,mail )por POST ,
    *crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
    *Retorna un :
    *“Verificado” si el usuario existe y coincide la clave también.
    *“Error en los datos” si esta mal la clave.
    *“Usuario no registrado si no coincide el mail“
    *Hacer los métodos necesarios en la clase usuario
 */

 require_once 'Usuario.php';

$clave = $_POST["clave"];
$mail = $_POST["mail"];

if(isset($clave) && isset($mail)){
echo 'Verificando datos...<br>';
    if(Usuario::ExisteUsuario($clave, $mail)){
        echo 'Usuario existente';
    }else{
        echo 'Usuario no existente';
    }
}else{
    echo 'Error en los datos ingresados.';
}
?>