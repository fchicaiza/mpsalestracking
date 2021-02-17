<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
class Ventas{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros de ventas
	public function insertar($fec_env_ven,$tot_ven,$img_ven,$int_pvn_ven,$id_ban_ven,$id_tpa_ven,$id_ciu_ven,$id_col_ven,$id_cli_ven)
	{
		$sql="INSERT INTO tbl_venta (fec_env_ven,tot_ven,img_ven,int_pvn_ven,id_ban_ven,id_tpa_ven,id_ciu_ven,id_col_ven,id_cli_ven)
		VALUES ('$fec_env_ven','$tot_ven','$img_ven','$int_pvn_ven','$id_ban_ven','$id_tpa_ven','$id_ciu_ven','$id_col_ven','$id_cli_ven')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros de ventas
	public function editar($id_ven,$fec_env_ven,$tot_ven,$img_ven,$int_pvn_ven,$id_ban_ven,$id_tpa_ven,$id_ciu_ven,$id_col_ven,$id_cli_ven)
	{
		$sql="UPDATE tbl_venta SET fec_env_ven='$fec_env_ven',tot_ven='$tot_ven',img_ven='$img_ven',int_pvn_ven='$int_pvn_ven',id_ban_ven='$id_ban_ven',id_tpa_ven='$id_tpa_ven',id_ciu_ven='$id_ciu_ven',id_col_ven='$id_col_ven',id_cli_ven='$id_cli_ven' WHERE idarticulo='$id_ven'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar ventas
	public function desactivar($id_ven)
	{
		$sql="UPDATE tbl_venta SET est_ven='I' WHERE id_ven='$id_ven'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar ventas
	public function activar($id_ven)
	{
		$sql="UPDATE tbl_venta SET est_ven='A' WHERE id_ven='$id_ven'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_ven)
	{
		$sql="SELECT * FROM tbl_venta WHERE id_ven='$id_ven'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros de ventas
	public function listar()
	{
		$sql="SELECT v.id_ven,v.fec_env_ven,v.tot_ven,v.img_ven,v.int_pvn_ven,nom_pdv as puntoventa,id_ban_ven,nom_ban as banco,id_tpa_ven,des_tpa as tipopago,id_ciu_ven,nom_ciu as ciudad,id_col_ven,usu_col as colaborador,id_cli_ven,v.est_ven 
FROM tbl_venta v 
INNER JOIN tbl_punto_venta pv on v.int_pvn_ven=pv.id_pdv
INNER JOIN tbl_banco banco on v.id_ban_ven=banco.id_ban
INNER JOIN tbl_tipo_pago tipopago on v.id_tpa_ven=tipopago.id_tpa
INNER JOIN tbl_ciudad ciudad on v.id_ciu_ven=ciudad.id_ciu
INNER JOIN tbl_colaborador colaborador on v.id_col_ven=colaborador.id_col
INNER JOIN tbl_cliente cliente on v.id_cli_ven=cliente.id_cli";               
return ejecutarConsulta($sql);		
	}
}
?>