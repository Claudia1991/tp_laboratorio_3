<?php
require_once './Interfaces/IVentaServicePdo.php';
require_once './AccesoDatos/AccesoDatos.php';

class VentaServicePdo implements IVentaServicePdo{

    public function ObtenerTodos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from venta");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");	
    }

    public function ObtenerPorId($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from venta where id = :id");
		$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
    }

    public function Insertar(Venta $venta){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto, id_usuario, cantidad, fecha_venta) values (:id_producto, :id_usuario, :cantidad, :fecha_venta)");
				$consulta->bindValue(':id_producto',$venta->id_producto, PDO::PARAM_INT);
				$consulta->bindValue(':id_usuario', $venta->id_usuario, PDO::PARAM_INT);
				$consulta->bindValue(':cantidad', $venta->cantidad, PDO::PARAM_INT);
				$consulta->bindValue(':fecha_venta', $venta->fecha_venta, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function Eliminar($id){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from venta 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
    }

    public function Modificar(Venta $venta){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuario 
				set 
                id_producto=:id_producto,
				id_usuario=:id_usuario,
				cantidad=:cantidad,
                fecha_venta=:fecha_venta
				WHERE id=:id");
                $consulta->bindValue(':id',$venta->id, PDO::PARAM_INT);	
				$consulta->bindValue(':id_producto',$venta->id_producto, PDO::PARAM_INT);
				$consulta->bindValue(':id_usuario', $venta->id_usuario, PDO::PARAM_INT);
				$consulta->bindValue(':cantidad', $venta->cantidad, PDO::PARAM_INT);
				$consulta->bindValue(':fecha_venta', $venta->fecha_venta, PDO::PARAM_STR);
			return $consulta->execute();
    }
}


?>