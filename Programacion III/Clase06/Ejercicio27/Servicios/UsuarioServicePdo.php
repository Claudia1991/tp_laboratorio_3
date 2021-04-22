<?php
require_once './Interfaces/IUsuarioServicePdo.php';
require_once './AccesoDatos/AccesoDatos.php';

class UsuarioServicePdo implements IUsuarioServicePdo{

	public function ObtenerSegunMailYClave($mail, $clave){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where clave = :clave and mail = :mail");
		$consulta->bindValue(':mail',$mail, PDO::PARAM_STR);		
		$consulta->bindValue(':clave',$clave, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
    }

    public function ObtenerTodos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
    }

    public function ObtenerPorId($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id = :id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
    }

    public function Insertar(Usuario $usuario){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre, apellido, clave, mail, fecha_alta, localidad, ruta_foto) values (:nombre, :apellido, :clave, :mail, :fecha_alta, :localidad, :ruta_foto)");
				$consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail', $usuario->mail, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_alta', $usuario->fecha_alta, PDO::PARAM_STR);
				$consulta->bindValue(':localidad', $usuario->localidad, PDO::PARAM_STR);
				$consulta->bindValue(':ruta_foto', $usuario->ruta_foto, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function Eliminar($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuario 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
    }

    public function Modificar(Usuario $usuario){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set 
                nombre=:nombre,
				apellido=:apellido,
				clave=:clave,
                mail=:mail,
				localidad=:localidad,
                ruta_foto=:rutafoto
				WHERE id=:id");
                $consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);	
                $consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
				$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
				$consulta->bindValue(':mail', $usuario->mail, PDO::PARAM_STR);
				$consulta->bindValue(':localidad', $usuario->localidad, PDO::PARAM_STR);
				$consulta->bindValue(':ruta_foto', $usuario->ruta_foto, PDO::PARAM_STR);
			return $consulta->execute();
    }

	public function ModificarClave(Usuario $usuario){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set 
				clave=:clave
				WHERE id=:id");
                $consulta->bindValue(':id',$usuario->id, PDO::PARAM_INT);	
				$consulta->bindValue(':clave', $usuario->clave, PDO::PARAM_STR);
			return $consulta->execute();
    }
}


?>