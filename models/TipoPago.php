<?php
require "../config/conexion.php";

Class Tpago{
    //Constructor
    
    public function __contsructor()
    {
        
    }
    // método para insertar un banco 
    public function insertar($descripcion){
        
        $sql ="CALL sp_InsertarTipoPago('$descripcion')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar un banco
    
    public function editar ($idtpago, $descripcion){
        $sql="CALL sp_EditarTipoPago($idtpago, '$descripcion')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el banco
    
    public function desactivar($idtpago){
        $sql ="CALL sp_DesactivarTipoPago($idtpago)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idtpago){
        $sql="CALL sp_ActivarTipoPago($idtpago)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idtpago){
        $sql= "CALL sp_MostrarTipoPago($idtpago)"; 
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarTipoPago";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idtpago){
        $sql = "CALL sp_EliminarTipoPago($idtpago)";
        return ejecutarConsulta($sql);
    }
     public function select()
    {
	$sql="SELECT * FROM tbl_tipo_pago WHERE est_tpa='A'";
	return ejecutarConsulta($sql);		
    }
}
?>