<?php 
require_once "../models/Empresa.php";

$empresa = new Empresa();

$idempresa=isset($_POST["idempresa"])? limpiarCadena($_POST["idempresa"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$ruc=isset($_POST["ruc"])? limpiarCadena($_POST["ruc"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idempresa)){
			$rspta=$empresa->insertar($ruc,$nombre, $direccion, $telefono );
			echo $rspta ? "Empresa registrada" : "Empresa no se pudo registrar";
		}
		else {
			$rspta=$empresa->editar($idempresa,$nombre);
			echo $rspta ? "Empresa actualizada" : "Empresa no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$empresa->desactivar($idempresa);
 		echo $rspta ? "Empresa Desactivada" : "Empresa no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$empresa->activar($idempresa);
 		echo $rspta ? "Empresa activada" : "Empresa no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$empresa->mostrar($idempresa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $empresa->eliminar($idempresa);
            echo $rspta ? "Empresa eliminado": "Empresa no eliminado";
            break;


	case 'listar':
		$rspta=$empresa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_emp=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_emp.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_emp.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_emp.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_emp.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_emp.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_emp.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->cod_emp,
                                    "2"=>$reg->ruc_emp,
                                    "3"=>$reg->nom_emp,
                                    "4"=>($reg->est_emp=="A")?'<span class="label bg-green">Activado</span>':
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