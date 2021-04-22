<?php

/**Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave */

require_once './Servicios/UsuarioServicePdo.php';
require_once './Modelos/Usuario.php';

$nombre = $_POST["nombre"];
$claveNueva = $_POST["claveNueva"];
$claveVieja = $_POST["claveVieja"];
$mail = $_POST["mail"];

if(isset($nombre) && isset($claveNueva) && isset($claveVieja) && isset($mail)){
    //Verifico el usuario
    $servicioUsuario = new UsuarioServicePdo();
    $usuarios = $servicioUsuario->ObtenerSegunMailYClave($mail, $claveVieja);
    if(isset($usuarios) && count($usuarios) > 0){
        $usuario = $usuarios[0];
        $usuario->clave = $claveNueva;
        $resultado = $servicioUsuario->ModificarClave($usuario);
        echo 'Se realizo el cambio: ' . $resultado;
    }else{
        echo 'No existe Usuario para modificar.';
    }
    
}else{
    echo 'Error en los datos ingresados.';
}


?>