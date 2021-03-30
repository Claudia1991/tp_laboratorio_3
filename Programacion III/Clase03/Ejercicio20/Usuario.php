<?php
class Usuario{
    private $nombre;
    private $clave;
    private $mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }

    public static function GuardarUsuario(Usuario $usuario){
        $nombreArchivo = 'Usuario.csv';
        $archivo = fopen($nombreArchivo, 'a+');
        $registroNuevo = $usuario->nombre . ',' . $usuario->clave . ',' . $usuario->mail . '\n';
        $exito = fwrite($archivo, $registroNuevo);
        fclose($archivo);
        return $exito;
    }
}

?>