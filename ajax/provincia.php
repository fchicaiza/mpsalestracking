<?php 
require_once "../models/Provincia.php";

$provincia = new Provincia();

$id_pro=isset($_POST["id_pro"])? limpiarCadena($_POST["id_pro"]):"";
$cod_pro=isset($_POST["cod_pro"])? limpiarCadena($_POST["cod_pro"]):"";
$nom_pro=isset($_POST["nom_pro"])? limpiarCadena($_POST["nom_pro"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_pro)){
			$rspta=$provincia->insertar($cod_pro,$nom_pro);
			echo $rspta ? "Provincia registrado" : "La Provincia no se pudo registrar";
		}
		else {
			$rspta=$provincia->editar($id_pro,$cod_pro,$nom_pro);
			echo $rspta ? "Provincia actualizado" : "La Provincia no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$provincia->desactivar($id_pro);
 		echo $rspta ? "Provincia Desactivada" : "Provincia no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$provincia->activar($id_pro);
 		echo $rspta ? "Provincia activada" : "Provincia no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$provincia->mostrar($id_pro);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $provincia->eliminar($id_pro);
            echo $rspta ? "Provincia eliminada": "Provincia no eliminada";
            break;


	case 'listar':
		$rspta=$provincia->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_pro=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_pro.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_pro.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_pro.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_pro.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_pro.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_pro.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->cod_pro,
                                    "2"=>$reg->nom_pro,
                                    "3"=>($reg->est_pro=="A")?'<span class="label bg-green">Activado</span>':
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