<?php
class GeneradorId{

    public static function ObtenerId(){
        $nombreArchivo = 'Id.txt';
        $archivo = fopen($nombreArchivo, 'r');
        $idActual = (int)fread($archivo, filesize($nombreArchivo));
        fclose($archivo);
        $archivo = fopen($nombreArchivo, 'w');
        $nuevoId = $idActual +1;
        fwrite($archivo, $nuevoId);
        fclose($archivo);
        return $idActual;
    }

}


?>