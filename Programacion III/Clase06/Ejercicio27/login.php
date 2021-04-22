<?php
/**
 * Aplicación No 29( Login con bd)
*Archivo: Login.php
*método:POST
*Recibe los datos del usuario(clave,mail )por POST ,
*crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
*base de datos,
*Retorna un :
*“Verificado” si el usuario existe y coincide la clave también.
*“Error en los datos” si esta mal la clave.
*“Usuario no registrado si no coincide el mail“
*Hacer los métodos necesarios en la clase usuario.
 */
require_once './Servicios/UsuarioServicePdo.php';

$clave = $_POST["clave"];
$mail = $_POST["mail"];

if(isset($mail) && isset($clave)){
    $servicio = new UsuarioServicePdo();
    $usuario = $servicio->ObtenerSegunMailYClave($mail, $clave);
    if(isset($usuario)){
        echo 'Existe el usuario.';
    }else{
        echo 'No existe usuario ingresado.';
    }
}else{
    echo 'Error en los datos ingresados.';
}


?>