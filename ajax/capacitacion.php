<?php 
require_once "../models/Capacitacion.php";

$capacitacion = new Capacitacion();

$id_cap=isset($_POST["id_cap"])? limpiarCadena($_POST["id_cap"]):"";
$des_cap=isset($_POST["des_cap"])? limpiarCadena($_POST["des_cap"]):"";
$nom_cap=isset($_POST["nom_cap"])? limpiarCadena($_POST["nom_cap"]):"";
$enl_cap=isset($_POST["enl_cap"])? limpiarCadena($_POST["enl_cap"]):"";
$mat_cap=isset($_POST["mat_cap"])? limpiarCadena($_POST["mat_cap"]):"";
$fec_cap=isset($_POST["fec_cap"])? limpiarCadena($_POST["fec_cap"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_cap)){
			$rspta=$capacitacion->insertar($des_cap,$nom_cap,$enl_cap,$mat_cap,$fec_cap);
			echo $rspta ? "Capacitacion Registrada" : "Capacitacion no se pudo registrar";
		}
		else {
			$rspta=$capacitacion->editar($id_cap,$des_cap,$nom_cap,$enl_cap,$mat_cap,$fec_cap);
                        
                        
                        
			echo $rspta ? "Capacitacion actualizada" : "Capacitacion no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$capacitacion->desactivar($id_cap);
 		echo $rspta ? "Capacitacion Desactivado" : "Capacitacion no se puede desactivar";
 		break;

	case 'activar':
		$rspta=$capacitacion->activar($id_cap);
 		echo $rspta ? "Capacitacion activada" : "Capacitacion no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$capacitacion->mostrar($id_cap);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $capacitacion->eliminar($id_cap);
            echo $rspta ? "Capacitacion eliminada": "Capacitacion no eliminada";
            break;


	case 'listar':
		$rspta=$capacitacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_cap=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_cap.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					'<button class="btn btn-success" onclick="desactivar('.$reg->id_cap.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        '<button class="btn btn-danger" onclick="eliminar('.$reg->id_cap.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_cap.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					'<button class="btn btn-warning" onclick="activar('.$reg->id_cap.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        '<button class="btn btn-danger" onclick="eliminar('.$reg->id_cap.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->des_cap,
                                    "2"=>$reg->nom_cap,
                                    "3"=>$reg->enl_cap,
                                    "4"=>$reg->mat_cap,
                                    "5"=>$reg->fec_cap,
                                    "6"=>($reg->est_cap=="A")?'<span class="label bg-green">Activado</span>':
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