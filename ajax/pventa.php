<?php 
require_once "../models/PuntoVenta.php";

$pventa = new Pventa();

$idpventa=isset($_POST["idpventa"])? limpiarCadena($_POST["idpventa"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idpventa)){
			$rspta=$pventa->insertar($nombre);
			echo $rspta ? "Banco registrado" : "Banco no se pudo registrar";
		}
		else {
			$rspta=$pventa->editar($idpventa,$nombre);
			echo $rspta ? "Banco actualizado" : "Banco no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$pventa->desactivar($idpventa);
 		echo $rspta ? "Rol Desactivada" : "Rol no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$pventa->activar($idpventa);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$pventa->mostrar($idpventa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $pventa->eliminar($idpventa);
            echo $rspta ? "Banco eliminado": "Banco no eliminado";
            break;


	case 'listar':
		$rspta=$pventa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_pdv=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_pdv.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_pdv.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_pdv.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_pdv.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_pdv.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_pdv.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->nom_pdv,
                                    "2"=>($reg->est_pdv=="A")?'<span class="label bg-green">Activado</span>':
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