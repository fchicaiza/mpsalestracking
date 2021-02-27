<?php
require "../config/conexion.php";

Class Banco{
    //Constructor
    
    public function __contsructor()
    {
        
    }
    // método para insertar un banco 
    public function insertar($nombre){
        
        $sql ="CALL sp_InsertarBanco('$nombre')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar un banco
    
    public function editar ($idbanco, $nombre){
        $sql="CALL sp_EditarBanco($idbanco, '$nombre')";
        
        return ejecutarConsulta($sql);
    }
    // método para cambiar de estado el banco
    
    public function desactivar($idbanco){
        $sql ="CALL sp_DesEstadoBanco($idbanco)";
        return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado 
    public function activar($idbanco){
        $sql="CALL sp_ActEstadoBanco($idbanco)";
        return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar roles que se va a editar
    
    public function mostrar($idbanco){
        $sql= "CALL sp_MostrarBanco($idbanco)";
        
        return ejecutarConsultaSimpleFila($sql);
    }
    
    // implemetar metodo para listar roles
    
    public function listar(){
        $sql = "CALL sp_ListarBanco";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idbanco){
        $sql = "CALL sp_EliminarBanco($idbanco)";
        return ejecutarConsulta($sql);
    }
     public function select()
	{
		$sql="SELECT * FROM tbl_banco WHERE est_ban='A'";
		return ejecutarConsulta($sql);		
	}
}
?>