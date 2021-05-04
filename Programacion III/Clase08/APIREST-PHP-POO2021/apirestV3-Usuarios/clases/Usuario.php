<?php
class Usuario
{
	public $id;
 	public $nombre;
  	public $apellido;
  	public $clave;
  	public $mail;
  	public $fecha_alta;
  	public $localidad;
  	public $ruta_foto;

  	public function BorrarUsuario()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			delete 
			from usuario 				
			WHERE id=:id");	
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
			$consulta->execute();
			return $consulta->rowCount();
	}

	
    public function ModificarUsuarioParametros()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			update usuario 
			set nombre=:nombre,
			apellido=:apellido,
			clave=:clave,
			mail=:mail,
			localidad=:localidad,
			ruta_foto=:ruta_foto
			WHERE id=:id");
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
		$consulta->bindValue(':mail',$this->mail, PDO::PARAM_INT);
		$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
		$consulta->bindValue(':ruta_foto', $this->ruta_foto, PDO::PARAM_STR);
		return $consulta->execute();
	}

	public function InsertarUsuarioParametros()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave, mail, fecha_alta, localidad, ruta_foto) values (:nombre,:apellido,:clave, :mail, :fecha_alta, :localidad, :ruta_foto)");
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		$consulta->bindValue(':clave', $this->clave, PDO::PARAM_INT);
		$consulta->bindValue(':mail',$this->mail, PDO::PARAM_STR);
		$consulta->bindValue(':fecha_alta', $this->fecha_alta, PDO::PARAM_STR);
		$consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
		$consulta->bindValue(':ruta_foto', $this->ruta_foto, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	 public function GuardarCD()
	 {
	 	if($this->id>0)
		{
			$this->ModificarUsuarioParametros();
		}else {
			$this->InsertarUsuarioParametros();
		}
	 }


  	public static function TraerTodosUsuarios()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}

	public static function TraerUsuarioSegunId($id) 
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where id = :id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT);
		$consulta->execute();
		$cdBuscado= $consulta->fetchObject('Usuario');
		return $cdBuscado;					
	}

	public function mostrarDatos()
	{
	  	return $this->nombre . ' ' . $this->apellido . ' ' . $this->localidad;
	}

}