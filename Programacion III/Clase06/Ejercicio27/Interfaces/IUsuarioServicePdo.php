<?php
require_once './Modelos/Usuario.php';


interface IUsuarioServicePdo{
    public function ObtenerTodos();
    public function ObtenerPorId($id);
    public function Insertar(Usuario $usuario);
    public function Eliminar($id);
    public function Modificar(Usuario $usuario);
}



?>