<?php

class Usuario{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $mail;
    public $ruta_foto;
    public $fecha_alta;
    public $localidad;

    public function __construct()
    {
        
    }

    public static function CrearUsuario($idUsuario=0, $nombre='', $apellido='', $clave=0, $mail='', $rutaFoto='', $fechaAlta='', $localidad=''){
        $usuario = new Usuario();
        $usuario->id = $idUsuario;
        $usuario->nombre = $nombre;
        $usuario->apellido = $apellido;
        $usuario->clave = $clave;
        $usuario->mail = $mail;
        $usuario->ruta_foto = $rutaFoto;
        $usuario->fecha_alta =$fechaAlta;
        $usuario->localidad = $localidad;
        return $usuario;
    }

    public function toString(){
        $usuarioString = 'Id: '. $this->id . ' Nombre: ' . $this->nombre . ' Apellido: '. $this->apellido . ' Clave: '. $this->clave .' Mail: '. $this->mail . ' Ruta foto: '. $this->ruta_foto .' Fecha alta: '. $this->fecha_alta . ' Localidad: '. $this->localidad;
        return $usuarioString;
    }
}
?>