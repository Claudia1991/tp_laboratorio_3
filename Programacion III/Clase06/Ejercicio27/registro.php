<?php
/**
 * Profesor Selente Villegas
 * Alumna Claudia Jara
 * 
 *Aplicación No 27 (Registro BD)
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

 require_once './Servicios/UsuarioServicePdo.php';
    $tipoArchivo = '';
    $destino = '';
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $localidad = $_POST["localidad"];

    $nombreActualArchivo = $_FILES["foto"]["name"];

    if(isset($clave) && isset($mail) && isset($nombre) && isset($apellido) && isset($localidad)){
        echo 'Agregando Foto...<br>';
        $tipoArchivo = pathinfo($nombreActualArchivo, PATHINFO_EXTENSION);
        $destino = "Fotos/" . $nombre . $apellido . '.' . $tipoArchivo;
        if (file_exists($destino)) {
            echo "El archivo ya existe. Verifique!!!";
        }else{
            move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);
            echo 'Agregando Usuarios...<br>';
            $usuario =  Usuario::CrearUsuario(-1,$nombre, $apellido, $clave, $mail, $destino, date('Y-m-d'), $localidad);
            $usuarioService = new UsuarioServicePdo();
            $usuarioService->Insertar($usuario);
        }
    }else{
        echo 'Error en los datos ingresados.';
    }
?>