<?php
//require_once 'GeneradorId.php';

class Usuario{
    public $idUsuario;
    public $nombre;
    public $clave;
    public $mail;
    public $rutaFoto;
    public $fechaAlta;

    public function __construct($idUsuario, $nombre, $clave, $mail, $rutaFoto)
    {
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->rutaFoto = $rutaFoto;
        $this->fechaAlta = date("d-F-Y");
    }

    public static function GuardarUsuario(Usuario $usuario){
        $nombreArchivo = 'Usuario.csv';
        $archivo = fopen($nombreArchivo, 'a+');
        $registroNuevo = $usuario->nombre . ',' . $usuario->clave . ',' . $usuario->mail . '\n';
        $exito = fwrite($archivo, $registroNuevo);
        fclose($archivo);
        return $exito;
    }

    public static function GuardarUsuarioJson(Usuario $usuario){
        $nombreArchivo = 'Usuario.json';
        $stringUsuario = json_encode($usuario);
        $archivo = fopen($nombreArchivo, 'a');
        fwrite($archivo,$stringUsuario.PHP_EOL);
        fclose($archivo);
        return true;
    }

    public function GetClave(){
        return $this->clave;
    }

    public function GetMail(){
        return $this->mail;
    }

    public function GetId(){
        return $this->idUsuario;
    }

    public static function ObtenerUsuarios(){
        $arrayUsuarios = array();
        $nombreArchivo = 'Usuario.csv';
        $archivo = fopen($nombreArchivo, 'r');
        while (!feof($archivo)) {
            $linea = fgetcsv($archivo,1000 ,',','"','\n');
            $usuario = new Usuario($linea[0], $linea[1], $linea[2], $linea[3], $linea[4]);
            array_push($arrayUsuarios,$usuario);
        }
        fclose($archivo);
        return $arrayUsuarios;
    }

    public static function ObtenerUsuariosJson(){
        $nombreArchivo = './Archivos/Usuario.json';
        $arrayUsuarios = array();
        $archivo = fopen($nombreArchivo, 'r');
        while(!feof($archivo)){
            $linea = fgets($archivo);
            if($linea !== false){
                $usuario = json_decode($linea, true);
                array_push($arrayUsuarios, new Usuario($usuario["idUsuario"], $usuario["nombre"], $usuario["clave"], $usuario["mail"], $usuario["rutaFoto"]));
            }
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

    public static function MostrarUsuariosFromJson(){
        $cadena = '';
        $arrayUsuarios = self::ObtenerUsuariosJson();
        $cadena .= '<ul>';
        foreach ($arrayUsuarios as $value) {
            $cadena .= '<li>Id: ' . $value["idUsuario"]. ' Nombre: ' . $value["nombre"] . ' Clave: ' . $value["clave"] . ' Mail: ' . $value["mail"] . 
            '<br><img src="'.$value["rutaFoto"] .'" /></li>';
        }
        $cadena .= '<ul>';
        echo $cadena;
    }

    public static function ExisteUsuario($clave, $mail){
        $existeUsuario = false;
        $arrayUsuarios = Usuario::ObtenerUsuarios();
        foreach ($arrayUsuarios as $key => $value) {
            if(strcmp($value->GetClave(), $clave) == 0 && strcmp($value->GetMail(), $mail) == 0){
                $existeUsuario = true;
                break;
            }
        }
        return $existeUsuario;

    }

    public static function ExisteUsuarioPorId($idUsuario){
        $existeUsuario = false;
        $arrayUsuarios = Usuario::ObtenerUsuariosJson();
        foreach ($arrayUsuarios as $key => $value) {
            if($value->GetId() == $idUsuario){
                $existeUsuario = true;
                break;
            }
        }
        return $existeUsuario;

    }
}

?>