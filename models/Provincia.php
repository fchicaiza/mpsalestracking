<?php
require "../config/conexion.php";
class Provincia {
   //Implementamos nuestro constructor
	public function __construct()
	{

	}
        //Implementamos un método para insertar registros
	public function insertar($cod_pro,$nom_pro)
	{
		$sql="INSERT INTO tbl_provincia (cod_pro,nom_pro,est_pro)
		VALUES ('$cod_pro','$nom_pro','A')";
		return ejecutarConsulta($sql);
	}
        //Implementamos un método para editar registros
	public function editar($id_pro,$cod_pro,$nom_pro)
	{
		$sql="UPDATE tbl_provincia SET cod_pro='$cod_pro', nom_pro='$nom_pro' WHERE id_pro='$id_pro'";
		return ejecutarConsulta($sql);
	}
        //Implementamos un método para desactivar provincias
	public function desactivar($id_pro)
	{
		$sql="UPDATE tbl_provincia SET est_pro='I' WHERE id_pro='$id_pro'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_pro)
	{
		$sql="UPDATE tbl_provincia SET est_pro='A' WHERE id_pro='$id_pro'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_pro)
	{
		$sql="SELECT * FROM tbl_provincia WHERE id_pro='$id_pro'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tbl_provincia";
		return ejecutarConsulta($sql);		
	}
        
        public function eliminar($id_pro){
        $sql = "DELETE FROM tbl_provincia WHERE id_pro='$id_pro'";
        return ejecutarConsulta($sql);
    }
}