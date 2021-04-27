<?php

require_once 'AccesoDatos.php';
/**(3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas
b- el listado de ventas entre dos fechas ordenado por sabor.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un sabor ingresado */

/** Alumna Claudia Jara - Legajo 110050 */

$tipoReporte = $_GET["tipoReporte"];

if (isset($tipoReporte)) {
    switch ($tipoReporte) {
        case 'A':
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		    $consulta =$objetoAccesoDato->RetornarConsulta("select count(*) as total_ventas from ventas ");		
		    $consulta->execute();			
		    echo json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
            break;
        case 'B':
            $fechaMinima = $_GET["fechaMinima"];
            $fechaMaxima = $_GET["fechaMaxima"];
            if(isset($fechaMinima) && isset($fechaMaxima)){
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas where fecha between :fechaMinima and :fechaMaxima order by sabor asc");	
                $consulta->bindValue(':fechaMinima',$fechaMinima, PDO::PARAM_STR);
                $consulta->bindValue(':fechaMaxima',$fechaMaxima, PDO::PARAM_STR);
                $consulta->execute();			
                echo json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'C':
            $usuario = $_GET["usuario"];
            if(isset($usuario)){
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas where mail = :mail");	
                $consulta->bindValue(':mail',$usuario, PDO::PARAM_STR);
                $consulta->execute();			
                echo json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;
        case 'D':
            $sabor = $_GET["sabor"];
            if(isset($sabor)){
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("select * from ventas where sabor = :sabor");	
                $consulta->bindValue(':sabor',$sabor, PDO::PARAM_STR);
                $consulta->execute();			
                echo json_encode($consulta->fetchAll(PDO::FETCH_OBJ));
            }else{
                echo 'Error en los parametros ingresados.';
            }
            break;

        default:
            echo 'Error tipo de reporte deseado.';
            break;
    }
} else {
    echo 'Error en los datos ingresados.';
}


?>