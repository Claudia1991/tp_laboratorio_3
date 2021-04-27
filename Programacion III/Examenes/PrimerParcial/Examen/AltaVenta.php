<?php

require_once 'AccesoDatos.php';
require_once 'Pizza.php';

/**a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock . */

class AltaVenta{
    public static function VenderPizza($mail, $sabor, $tipo, $cantidad, $rutaFoto){
        //Verifico si existe
        $existePizza = Pizza::ExistePizzaSegunSaborTipo($sabor, $tipo);
        if($existePizza){
            //Verifico si hay stock
            $hayStock = Pizza::HayStock($sabor, $tipo, $cantidad);
            if($hayStock){
                //Inserto la venta en BD
                $idInsertado = AltaVenta::Insertar(date('Y-m-d'),100, $mail, $sabor, $tipo, $cantidad, $rutaFoto);
                //Actualizo el stock
                Pizza::ActualizarStockPizza($sabor, $tipo, $cantidad);
                return 'Se realizo la venta: ' . $idInsertado;
            }else{
                return 'No hay stock suficiente';
            }
        }else{
            return 'No existe la pizza que quiere vender';
        }
    }

    private static function Insertar($fecha, $numero_pedido, $mail, $sabor, $tipo, $cantidad, $rutaFoto){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ventas (fecha, numero_pedido, mail, sabor, tipo, cantidad, foto) values (:fecha, :numero_pedido, :mail, :sabor, :tipo, :cantidad, :foto)");
				$consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
				$consulta->bindValue(':numero_pedido', $numero_pedido, PDO::PARAM_INT);
				$consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
				$consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
				$consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
				$consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
				$consulta->bindValue(':foto', $rutaFoto, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
}




?>