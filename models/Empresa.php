<?php
require "../config/conexion.php";

class Empresa {
    public function __contsructor()
    {
        
    }
    // método para insertar una empresa 
    public function insertar($ruc,$nombre, $direccion, $telefono){
        
        $sql ="CALL sp_InsertarEmpresa('$ruc', '$nombre', '$direccion', '$telefono')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar un banco
    
    public function editar ($idemp,$ruc,$nombre, $direccion, $telefono){
        $sql="CALL sp_EditarEmpresa($idemp,'$ruc','$nombre', $direccion', '$telefono')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el banco
    
    public function desactivar($idemp){
        $sql ="CALL sp_DesEstadoEmpresa($idemp)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idemp){
        $sql="CALL sp_ActEstadoEmpresa($idemp)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idemp){
        $sql= "CALL sp_MostrarEmpresa($idemp)";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarEmpresa";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idemp){
        $sql = "CALL sp_EliminarEmpresa($idemp)";
        return ejecutarConsulta($sql);
    }
}
?>