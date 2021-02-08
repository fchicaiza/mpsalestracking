<?php 
require_once "../models/Rol.php";

$rol=new Rol();

$idrol=isset($_POST["idrol"])? limpiarCadena($_POST["idrol"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idrol)){
			$rspta=$rol->insertar($nombre);
			echo $rspta ? "Rol registrado" : "Rol no se pudo registrar";
		}
		else {
			$rspta=$rol->editar($idrol,$nombre);
			echo $rspta ? "Rol actualizado" : "Rol no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$rol->desactivar($idrol);
 		echo $rspta ? "Rol Desactivada" : "Rol no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$rol->activar($idrol);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$rol->mostrar($idrol);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $rol->eliminar($idrol);
            echo $rspta ? "Rol eliminado": "Rol no eliminado";
            break;


	case 'listar':
		$rspta=$rol->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_rol=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_rol.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_rol.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_rol.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_rol.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_rol.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_rol.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->nom_rol,
                                    "2"=>($reg->est_rol=="A")?'<span class="label bg-green">Activado</span>':
                                    '<span class="label bg-yellow">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);


}
?>