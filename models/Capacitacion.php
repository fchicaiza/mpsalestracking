<?php
require "../config/conexion.php";
class Capacitacion {
        public function __contsructor()
    {
        
            
    }
    // método para insertar una capacitacion
    public function insertar($des_cap,$nom_cap,$enl_cap,$mat_cap,$fec_cap)
	{
		$sql="CALL sp_InsertarCapacitacion('$des_cap','$nom_cap','$enl_cap','$mat_cap','$fec_cap')";
		return ejecutarConsulta($sql);
	}
        //Implementamos un método para editar capacitacion
   	public function editar($id_cap,$des_cap,$nom_cap,$enl_cap,$mat_cap,$fec_cap)
	{
		$sql="CALL sp_EditarCapacitacion($id_cap,'$des_cap','$nom_cap','$enl_cap','$mat_cap','$fec_cap')";
		return ejecutarConsulta($sql);
	}
        	//Implementamos un método para desactivar capacitacion
	public function desactivar($id_cap)
	{
		$sql="CALL sp_DesactivarCapacitacion($id_cap)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_cap)
	{
		$sql="CALL sp_ActivarCapacitacion($id_cap)";
		return ejecutarConsulta($sql);
	}
        //Implemetamos un mewtodo para mostrar capacitaciones
        public function mostrar($id_cap)
	{
		$sql="CALL sp_MostrarCapacitacion($id_cap)";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar las capacitaciones
	public function listar()
	{
        $sql="CALL sp_ListarCapacitacion";
        return ejecutarConsulta($sql);	
	}
        public function eliminar($id_cap){
         $sql="CALL sp_EliminarCapacitacion($id_cap)";
        return ejecutarConsulta($sql);
    }
}