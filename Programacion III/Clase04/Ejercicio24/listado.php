<?php
/**
 * Profesor Selente Villegas
 * Alumna Claudia Jara
 * 
 *Aplicación No 24 ( Listado JSON y array de usuarios)
*Archivo: listado.php
*método:GET
*Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
*usuarios).
*En el caso de usuarios carga los datos del archivo usuarios.json.
*se deben cargar los datos en un array de usuarios.
*Retorna los datos que contiene ese array en una lista
*<ul>
*<li>apellido, nombre,foto</li>
*<li>apellido, nombre,foto</li>
*</ul>
*Hacer los métodos necesarios en la clase usuario
 */

 require_once 'Usuario.php';
    $listado = $_GET["listado"];

    if(isset($listado)){
        echo 'Buscando Listado...<br>';
        Usuario::MostrarUsuariosFromJson();
    }else{
        echo 'Error en los datos ingresados. No se puede mostrar el listado.';
    }
?>