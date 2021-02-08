<?php 
require_once "../models/Banco.php";

$banco = new Banco();

$idbanco=isset($_POST["idbanco"])? limpiarCadena($_POST["idbanco"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idbanco)){
			$rspta=$banco->insertar($nombre);
			echo $rspta ? "Banco registrado" : "Banco no se pudo registrar";
		}
		else {
			$rspta=$banco->editar($idbanco,$nombre);
			echo $rspta ? "Banco actualizado" : "Banco no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$banco->desactivar($idbanco);
 		echo $rspta ? "Rol Desactivada" : "Rol no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$banco->activar($idbanco);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$banco->mostrar($idbanco);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $banco->eliminar($idbanco);
            echo $rspta ? "Banco eliminado": "Banco no eliminado";
            break;


	case 'listar':
		$rspta=$banco->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_ban=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ban.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_ban.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ban.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ban.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_ban.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ban.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->nom_ban,
                                    "2"=>($reg->est_ban=="A")?'<span class="label bg-green">Activado</span>':
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