<?php
require_once 'Usuario.php';
require_once 'IApiUsable.php';

class UsuarioApi extends Usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$usuario=Usuario::TraerUsuarioSegunId($id);
     	$newResponse = $response->withJson($usuario, 200);  
    	return $newResponse;
    }

    public function TraerTodos($request, $response, $args) {
      	$usuarios=Usuario::TraerTodosUsuarios();
     	$newResponse = $response->withJson($usuarios, 200);  
    	return $newResponse;
    }

      public function CargarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
        $nombre= $ArrayDeParametros['nombre'];
        $apellido= $ArrayDeParametros['apellido'];
        $clave= $ArrayDeParametros['clave'];
        $mail= $ArrayDeParametros['mail'];
        $localidad= $ArrayDeParametros['localidad'];
        
		// $archivos = $request->getUploadedFiles();
        // $destino="./fotos/";
        // var_dump($archivos);
        // //var_dump($archivos['foto']);

        // $nombreAnterior=$archivos['foto']->getClientFilename();
        // $extension= explode(".", $nombreAnterior)  ;
        // //var_dump($nombreAnterior);
        // $extension=array_reverse($extension);
		// $fotoServidor = $destino . $nombre . '-' .$apellido .".".$extension[0];

        // $archivos['foto']->moveTo($fotoServidor);

        $nuevoUsuario = new Usuario();
        $nuevoUsuario->nombre=$nombre;
        $nuevoUsuario->apellido=$apellido;
        $nuevoUsuario->clave=$clave;
        $nuevoUsuario->mail=$mail;
        $nuevoUsuario->localidad=$localidad;
        $nuevoUsuario->fecha_alta=date('Y-m-d');
		$nuevoUsuario->ruta_foto = "prueba";
        $nuevoUsuario->InsertarUsuarioParametros();

        $response->getBody()->write("se guardo el usuario");

        return $response;
    }

	public function BorrarUno($request, $response, $args) {
		// $ArrayDeParametros = $request->getParsedBody();
		$id=$args['id'];
		$usuario= new Usuario();
		$usuario->id=$id;
		$cantidadDeBorrados=$usuario->BorrarUsuario();

		$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->cantidad=$cantidadDeBorrados;

		if($cantidadDeBorrados>0)
		{
				$objDelaRespuesta->resultado="algo borro!!!";
		}
		else
		{
			$objDelaRespuesta->resultado="no Borro nada!!!";
		}
		$newResponse = $response->withJson($objDelaRespuesta, 200); 
			
		return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $usuario = new Usuario();
	    $usuario->id=$ArrayDeParametros['id'];
	    $usuario->nombre=$ArrayDeParametros['nombre'];
	    $usuario->apellido=$ArrayDeParametros['apellido'];
	    $usuario->clave=$ArrayDeParametros['clave'];
	    $usuario->mail=$ArrayDeParametros['mail'];
	    $usuario->localidad=$ArrayDeParametros['localidad'];

	   	$resultado =$usuario->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }


}