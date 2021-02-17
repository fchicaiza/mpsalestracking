<?php 
require_once "../models/Ciudad.php";

$ciudad = new Ciudad();

$id_ciu=isset($_POST["id_ciu"])? limpiarCadena($_POST["id_ciu"]):"";
$cod_ciu=isset($_POST["cod_ciu"])? limpiarCadena($_POST["cod_ciu"]):"";
$nom_ciu=isset($_POST["nom_pro"])? limpiarCadena($_POST["nom_ciu"]):"";
$int_pro_ciu=isset($_POST["int_pro_ciu"])? limpiarCadena($_POST["int_pro_ciu"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_ciu)){
			$rspta=$ciudad->insertar($cod_ciu,$nom_ciu,$int_pro_ciu);
			echo $rspta ? "Ciudad registrado" : "La Ciudad no se pudo registrar";
		}
		else {
			$rspta=$ciudad->editar($id_ciu,$cod_ciu,$nom_ciu);
			echo $rspta ? "Ciudad actualizada" : "La Ciudad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ciudad->desactivar($id_ciu);
 		echo $rspta ? "Ciudad Desactivada" : "Ciudad no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$ciudad->activar($id_ciu);
 		echo $rspta ? "Ciudad activada" : "Ciudad no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$ciudad->mostrar($id_ciu);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $ciudad->eliminar($id_ciu);
            echo $rspta ? "Ciudad eliminada": "Ciuadad no eliminada";
            break;


	case 'listar':
		$rspta=$ciudad->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0 "=>($reg->est_ciu=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ciu.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_ciu.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ciu.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ciu.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_ciu.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ciu.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->cod_ciu,
                                    "2"=>$reg->nom_ciu,
                                    "3"=>$reg->int_pro_ciu,
                                    "4"=>($reg->est_ciu=="A")?'<span class="label bg-green">Activado</span>':
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