<?php
require "../config/conexion.php";
class ciudad {

   //Implementamos nuestro constructor
	public function __construct()
	{

	}
        //Implementamos un método para insertar registros
	public function insertar($id_ciu,$cod_ciu,$nom_ciu,$int_pro_ciu)
	{
		$sql="INSERT INTO tbl_ciudad (id_ciu,cod_ciu,nom_ciu,int_pro_ciu)
		VALUES ('$id_ciu','$codigo','$cod_ciu','$nom_ciu','$int_pro_ciu)";
		return ejecutarConsulta($sql);
	}
        //Implementamos un método para editar registros
	public function editar($id_ciu,$cod_ciu,$nom_ciu)
	{
		 $sql="UPDATE tbl_ciudad SET id_ciu='$id_ciu',cod_ciu='$cod_ciu',nomb_ciu='$nom_ciu'";
		return ejecutarConsulta($sql);
	}
        //Implementamos un método para desactivar provincias
	public function desactivar($id_ciu)
	{
		$sql="UPDATE tbl_ciudad SET condicion='I' WHERE id_ciu='$id_ciu'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_ciu)
	{
		$sql="UPDATE tbl_ciudad SET condicion='A' WHERE id_ciu='$id_ciu'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ciu)
	{
		$sql="SELECT * FROM tbl_ciudad WHERE id_ciu='$id_ciu'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT c.id_ciu,c.id_pro,p.nom_pro as provincia,c.cod_ciu,c.nom_ciu,c.int_pro_ciu,p.int_pro_ciu 
                FROM ciudad c INNER JOIN provincia p on c.id_pro=c.id_pro";	
		return ejecutarConsulta($sql);		
	}
        
        public function eliminar($id_pro){
             $sql = "CALL sp_Eliminarprovincia($id_pro)";
            return ejecutarConsulta($sql);
    }
}

