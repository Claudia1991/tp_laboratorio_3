<?php
/**
 * Profesor Selente Villegas
 * Alumna Claudia Jara
 * 
 *Aplicación No 23 (Registro JSON)
*Archivo: registro.php
*método:POST
*Recibe los datos del usuario(nombre, clave,mail )por POST ,
*crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
*crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
*poder hacer el alta,
*guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
*Usuario/Fotos/.
*retorna si se pudo agregar o no.
*Cada usuario se agrega en un renglón diferente al anterior.
*Hacer los métodos necesarios en la clase usuario.
 */

 require_once 'Usuario.php';
    $tipoArchivo = '';
    $destino = '';
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $nombre = $_POST["nombre"];
    $nombreActualArchivo = $_FILES["foto"]["name"];

    if(isset($clave) && isset($mail) && isset($nombre)){
        echo 'Agregando Foto...<br>';
        $tipoArchivo = pathinfo($nombreActualArchivo, PATHINFO_EXTENSION);
        $destino = "Usuario/Fotos/" . $mail . '.' . $tipoArchivo;
        if (file_exists($destino)) {
            echo "El archivo ya existe. Verifique!!!";
        }else{
            move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
            echo 'Agregando Usuarios...<br>';
            $usuario = new Usuario($nombre, $clave, $mail, $destino);
            if(Usuario::GuardarUsuarioJson($usuario)){
                echo 'Datos correctos. Se dio de alta el usuario.';
            }else{
                echo 'Ocurrio un error al guardar los datos.';
            }
        }
    }else{
        echo 'Error en los datos ingresados.';
    }
?>