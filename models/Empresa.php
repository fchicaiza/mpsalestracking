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
    
    public function editar ($idempresa,$ruc,$nombre, $direccion, $telefono){
        $sql="CALL sp_EditarEmpresa($idempresa,'$ruc','$nombre', $direccion', '$telefono')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el banco
    
    public function desactivar($idempresa){
        $sql ="CALL sp_DesEstadoEmpresa($idempresa)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idempresa){
        $sql="CALL sp_ActEstadoEmpresa($idempresa)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idempresa){
        $sql= "CALL sp_MostrarEmpresa($idempresa)";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarEmpresa()";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idempresa){
        $sql = "CALL sp_EliminarEmpresa($idempresa)";
        return ejecutarConsulta($sql);
    }
    
    //funcion para llemar combobox de empresas
    public function selecEmpresa()
    {
        $sql="CALL sp_SelecEmpresa()";
        return ejecutarConsulta($sql);
    }
    
}
?>