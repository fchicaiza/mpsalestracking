<?php 
require_once "../models/TipoPago.php";

$tpago = new Tpago();

$idtpago=isset($_POST["idtpago"])? limpiarCadena($_POST["idtpago"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idtpago)){
			$rspta=$tpago->insertar($descripcion);
			echo $rspta ? "Tipo de pago registrado" : "Tipo de pago no se pudo registrar";
		}
		else {
			$rspta=$tpago->editar($idtpago,$descripcion);
			echo $rspta ? "Tipo de pago actualizado" : "Tipo de pago no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tpago->desactivar($idtpago);
 		echo $rspta ? "Tipo de pago desactivado" : "Tipo de pago no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$tpago->activar($idtpago);
 		echo $rspta ? "Tipo de pago activado" : "Tipo de pago no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$tpago->mostrar($idtpago);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $tpago->eliminar($idtpago);
            echo $rspta ? "Tipo de pago eliminado": "Tipo de pago no eliminado";
            break;


	case 'listar':
		$rspta=$tpago->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_tpa=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_tpa.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_tpa.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_tpa.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_tpa.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_tpa.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_tpa.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->des_tpa,
                                    "2"=>($reg->est_tpa=="A")?'<span class="label bg-green">Activado</span>':
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