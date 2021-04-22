<?php
require_once './Interfaces/IProductoServicePdo.php';
require_once './AccesoDatos/AccesoDatos.php';

class ProductoServicePdo implements IProductoServicePdo{

    public function ObtenerTodos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");	
    }

    public function ObtenerPorId($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto where id = :id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
    }

	public function ObtenerPorCodigoBarras($codigoBarras){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto where codigo_barras = :codigo_barras");
		$consulta->bindValue(':codigo_barras',$codigoBarras, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
    }

    public function Insertar(Producto $producto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (codigo_barras, fecha_creacion, fecha_modificacion, nombre, precio, stock, tipo) values (:codigo_barras, :fecha_creacion, :fecha_modificacion, :nombre, :precio, :stock, :tipo)");
				$consulta->bindValue(':codigo_barras',$producto->codigo_barras, PDO::PARAM_INT);
				$consulta->bindValue(':fecha_creacion', $producto->fecha_creacion, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_modificacion', $producto->fecha_modificacion, PDO::PARAM_STR);
				$consulta->bindValue(':nombre', $producto->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':precio', $producto->precio, PDO::PARAM_INT);
				$consulta->bindValue(':stock', $producto->stock, PDO::PARAM_INT);
				$consulta->bindValue(':tipo', $producto->tipo, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function Eliminar($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from producto 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
    }

    public function Modificar(Producto $producto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto 
				set 
                codigo_barras=:codigo_barras,
				fecha_creacion=:fecha_creacion,
				fecha_modificacion=:fecha_modificacion,
                nombre=:nombre,
				precio=:precio,
                stock=:stock,
                tipo=:tipo
				WHERE id=:id");
                $consulta->bindValue(':id',$producto->id, PDO::PARAM_INT);	
				$consulta->bindValue(':codigo_barras',$producto->codigo_barras, PDO::PARAM_INT);
				$consulta->bindValue(':fecha_creacion', $producto->fecha_creacion, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_modificacion', $producto->fecha_modificacion, PDO::PARAM_STR);
				$consulta->bindValue(':nombre', $producto->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':precio', $producto->precio, PDO::PARAM_INT);
				$consulta->bindValue(':stock', $producto->stock, PDO::PARAM_INT);
				$consulta->bindValue(':tipo', $producto->tipo, PDO::PARAM_STR);
			return $consulta->execute();
    }
	
    public function ModificarPorCodigoBarras(Producto $producto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update producto 
				set 
				fecha_creacion=:fecha_creacion,
				fecha_modificacion=:fecha_modificacion,
                nombre=:nombre,
				precio=:precio,
                stock=:stock,
                tipo=:tipo
				WHERE id=:id");
                $consulta->bindValue(':id',$producto->id, PDO::PARAM_INT);	
				$consulta->bindValue(':fecha_creacion', $producto->fecha_creacion, PDO::PARAM_STR);
				$consulta->bindValue(':fecha_modificacion', $producto->fecha_modificacion, PDO::PARAM_STR);
				$consulta->bindValue(':nombre', $producto->nombre, PDO::PARAM_STR);
				$consulta->bindValue(':precio', $producto->precio, PDO::PARAM_INT);
				$consulta->bindValue(':stock', $producto->stock, PDO::PARAM_INT);
				$consulta->bindValue(':tipo', $producto->tipo, PDO::PARAM_STR);
			return $consulta->execute();
    }
}


?>