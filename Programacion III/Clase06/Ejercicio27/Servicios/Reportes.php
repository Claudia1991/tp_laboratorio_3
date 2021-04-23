<?php

require_once './AccesoDatos/AccesoDatos.php';

class Reportes{
    /**A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
    alfabéticamente de forma ascendente o descendente. */
    public static function ObtenerUsuariosOrdenados($orden){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario order by 2 " . $orden);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    /**B. Obtener los detalles completos de todos los productos y poder ordenarlos
    alfabéticamente de forma ascendente y descendente. */
    public static function ObtenerProductosOrdenados($orden){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from producto order by 2 " . $orden);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    /**C. Obtener todas las compras (¿?Ventas) filtradas entre dos cantidades. */
    public static function ObtenerVentasEntreCantidades($menor, $mayor){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from venta where cantidad between :menor and :mayor");
        $consulta->bindValue(':menor',$menor, PDO::PARAM_INT);
        $consulta->bindValue(':mayor',$mayor, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);
    }
   /** D. Obtener la cantidad total de todos los productos vendidos entre dos fechas. */
   public static function ObtenerCantidadTotalProductosEntreFechas($fechaInicial, $fechaFinal){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto, sum(cantidad) as cantidad_total_vendida from venta where fecha_venta between :fechaInicial and :fechaFinal group by id_producto");
        $consulta->bindValue(':fechaInicial',$fechaInicial, PDO::PARAM_STR);
        $consulta->bindValue(':fechaFinal',$fechaFinal, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

   }
    /**E. Mostrar los primeros “N” números de productos que se han enviado. */
    public static function ObtenerProductosVendidos($cantidadProductos){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select distinct id_producto from venta limit :cantidadProductos");
        $consulta->bindValue(':cantidadProductos',$cantidadProductos, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    /**F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.*/
    public static function ObtenerUsuarioProductoPorVenta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select v.id_producto, p.nombre, u.nombre from venta v 
        inner join producto p on p.id = v.id_producto
        inner join usuario u on u.id = v.id_usuario");	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }
    /**G. Indicar el monto (cantidad * precio) por cada una de las ventas.*/
    public static function ObtenerMontoTotalPorVenta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select v.cantidad * p.precio as monto_total from venta v
        inner join producto p on p.id = v.id_producto");		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }

    /**H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario
    (ejemplo: 104).*/
    public static function ObtenerCantidadTotalVendidaPorUsuario($idUsuario, $idProducto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select sum(cantidad) as cantitad_total from venta where id_producto = :idProducto and id_usuario = :idUsuario");
        $consulta->bindValue(':idUsuario',$idUsuario, PDO::PARAM_INT);
        $consulta->bindValue(':idProducto',$idProducto, PDO::PARAM_INT);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }

    /**I. Obtener todos los números de los productos vendidos por algún usuario filtrado por
    localidad (ejemplo: ‘Avellaneda’).*/
    public static function ObtenerProductosVendidosPorLocalidad($localidad){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select v.id_producto from venta v 
        inner join usuario u on u.id = v.id_usuario
        where u.localidad = :localidad");
        $consulta->bindValue(':localidad',$localidad, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }

    /**J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
    apellido.*/
    public static function ObtenerUsuariosSegunNombreApellido($nombre, $apellido){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuario where nombre like '%".$nombre. "%' or apellido like '%" .$apellido ."%'");	
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }

    /**K. Mostrar las ventas entre dos fechas del año.*/
    public static function ObtenerVentasEntreFechas($fechaInicial, $fechaFinal){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select id_producto, sum(cantidad) as cantidad_total_vendida from venta where fecha_venta between :fechaInicial and :fechaFinal group by id_producto");
        $consulta->bindValue(':fechaInicial',$fechaInicial, PDO::PARAM_STR);
        $consulta->bindValue(':fechaFinal',$fechaFinal, PDO::PARAM_STR);		
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_OBJ);

    }

}

?>