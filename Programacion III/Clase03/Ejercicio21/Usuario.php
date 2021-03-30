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

    public static function ObtenerUsuarios(){
        $arrayUsuarios = array();
        $nombreArchivo = 'Usuario.csv';
        $archivo = fopen($nombreArchivo, 'r');
        while (!feof($archivo)) {
            $linea = fgetcsv($archivo,1000 ,',');
            var_dump($linea);
            $usuario = new Usuario($linea[0], $linea[1], $linea[2]);
            array_push($arrayUsuarios,$usuario);
        }
        fclose($archivo);
        return $arrayUsuarios;
    }

    public static function MostrarUsuarios(){
        $cadena = '';
        $arrayUsuarios = Usuario::ObtenerUsuarios();
        $cadena .= '<ul>';
        foreach ($arrayUsuarios as $key => $value) {
            $cadena .= '<li>Nombre: ' . $value->nombre . ' Clave: ' . $value->clave . ' Mail: ' . $value->mail . '</li>';
        }
        $cadena .= '<ul>';
        echo $cadena;
    }
}

?>