<?php
require "../config/conexion.php";

Class Rol{
    //Constructor
    
    public function __contsructor()
    {
        
    }
    // método para insertar un rol
    public function insertar($nombre){
        
        $sql ="CALL sp_InsertarRol('$nombre')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar un rol
    
    public function editar ($idrol, $nombre){
        $sql="CALL sp_EditarRol ($idrol,'$nombre')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el rol
    
    public function desactivar($idrol){
        $sql ="CALL sp_DesEstado($idrol)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idrol){
        $sql="CALL sp_ActEstado($idrol)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idrol){
       // $sql= "SELECT * FROM tbl_rol WHERE id_rol = '$idrol'";
      $sql= "CALL sp_MostrarRol($idrol)";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarRol";
        return ejecutarConsulta($sql);
    }
    
    // implementar un método para eliminar físicamente un rol
    
    public function eliminar($idrol){
        $sql="CALL sp_EliminarRol($idrol)";
        return ejecutarConsulta($sql);
    }
}
?> 