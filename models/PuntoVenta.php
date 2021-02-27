<?php
require "../config/conexion.php";

Class Pventa{
    //Constructor
    
    public function __contsructor()
    {
        
    }
    // método para insertar un banco 
    public function insertar($nombre){
        
        $sql ="CALL sp_InsertarPuntoVenta('$nombre')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar un banco
    
    public function editar ($idpventa, $nombre){
        $sql="CALL sp_EditarPuntoVenta($idpventa, '$nombre')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el banco
    
    public function desactivar($idpventa){
        $sql ="CALL sp_DesactivarPuntoVenta($idpventa)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idpventa){
        $sql="CALL sp_ActivarPuntoVenta($idpventa)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idpventa){
        $sql= "CALL sp_MostrarPuntoVenta($idpventa)";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarPuntoVenta";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idpventa){
        $sql = "CALL sp_EliminarPuntoVenta($idpventa)";
        return ejecutarConsulta($sql);
    }
    public function select()
    {
	$sql="SELECT * FROM tbl_punto_venta WHERE est_pdv='A'";
	return ejecutarConsulta($sql);		
    }
}
?>