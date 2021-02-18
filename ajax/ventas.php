<?php 
require_once "../models/Ventas.php";
$ventas=new Ventas();
$idven=isset($_POST["id_ven"])? limpiarCadena($_POST["id_ven"]):"";
$fec_env_ven=isset($_POST["fec_env_ven"])? limpiarCadena($_POST["fec_env_ven"]):"";
$tot_ven=isset($_POST["tot_ven"])? limpiarCadena($_POST["tot_ven"]):"";
$img_ven=isset($_POST["img_ven"])? limpiarCadena($_POST["img_ven"]):"";
$int_pvn_ven=isset($_POST["int_pvn_ven"])? limpiarCadena($_POST["int_pvn_ven"]):"";
$id_ban_ven=isset($_POST["id_ban_ven"])? limpiarCadena($_POST["id_ban_ven"]):"";
$id_tpa_ven=isset($_POST["id_tpa_ven"])? limpiarCadena($_POST["id_tpa_ven"]):"";
$id_ciu_ven=isset($_POST["id_ciu_ven"])? limpiarCadena($_POST["id_ciu_ven"]):"";
$id_col_ven=isset($_POST["id_col_ven"])? limpiarCadena($_POST["id_col_ven"]):"";
$id_cli_ven=isset($_POST["id_cli_ven"])? limpiarCadena($_POST["id_cli_ven"]):"";


switch ($_GET["op"]){

	case 'guardaryeditar':
        if(!file_exists($_FILES['imagen']['tmp_name']) || !is_upload_file($_FILES['imagen']['tmp_name']))
        {
        $image="";
        }else{
        $ext=explode(".",$_FILES['imagen']['name']);
        if($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/png"||$_FILES['imagen']['type']=="image/jpeg")
        {  
            $image=round(microtime(true).'.'.end($ext));
            move_upload_file($_FILES["imagen"]["tmp_name"],"../files/ventas".$img_ven);
        }
        }
		if (empty($idven)){
			$rspta=$ventas->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagene);
			echo $rspta ? "Venta registrada" : "Venta no se pudo registrar";
		}
		else {
			$rspta=$ventas->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
			echo $rspta ? "Venta actualizada" : "Venta no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ventas->desactivar($idven);
 		echo $rspta ? "Venta Desactivada" : "Venta no se pudo desactivar";
 		
	break;

	case 'activar':
		$rspta=$ventas->activar($idven);
 		echo $rspta ? "Venta  activado" : "Venta no se pudo activar";
 		
	break;

	case 'mostrar':
		$rspta=$ventas->mostrar($idven);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		
	break;

	case 'listar':
		$rspta=$ventas->listar();
 		//Vamos a declarar un array
 		$data= Array();


        
        while($reg=$rspta->fetch_object()){
            
            $data[]=array(         
                    "0" =>($reg->est_ven)?'<button class="btn btn-warning" onclick="mostrar('.$reg->id_ven.')"><i class="fa fa-pencil"></i></button>'.
                   ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_ven.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg-> id_ven.')"><i class="fa fa-pencil"></i></button>'.
                   ' <button class="btn btn-success" onclick="activar('.$reg->id_ven.')"><i class="fa fa-power-off"></i></button>',
                    "1" =>$reg->fec_env_ven,
                    "2" =>$reg->tot_ven,
                    "3" =>"<img src='../files/ventas".$reg->img_ven."' height='50px' width='50px'>",
                    "4" =>$reg->puntoventa,
                    "5" =>$reg->banco,
                    "6" =>$reg->tipopago,
                    "7" =>$reg->ciudad,
                    "8" =>$reg->colaborador,
                    "9" =>$reg->id_cli_ven,
                    "10" =>($reg->est_ven)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
                    
                    );
        }
        $results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
        case 'selectBanco':
            require_once'../models/Banco.php';
            $banco=new Banco();
            $rspta=$banco->select();
            echo '<option selected disabled>-- Selecionar Banco --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->id_ban.'>'.$reg->nom_ban.'</option>';
            }  
        break;    
        case 'selectPuntoVenta':
            require_once'../models/PuntoVenta.php';
            $pventa=new Pventa();
            $rspta=$pventa->select();
            echo '<option selected disabled>-- Selecionar Punto de Venta --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->id_pdv.'>'.$reg->nom_pdv.'</option>';
            }         
            break;
        case 'selecTipoPago':
            require_once'../models/TipoPago.php';
            $tpago=new Tpago();
            $rspta=$tpago->select();
            echo '<option selected disabled>-- Selecionar Tipo de Pago --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->id_tpa.'>'.$reg->des_tpa.'</option>';
            }                  
            break;
        case 'selectCiudad':
            require_once'../models/Ciudad.php';
            $banco=new Banco();
            $rspta=$banco->select();
            echo '<option selected disabled>-- Selecionar Ciudad --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->idbanco.'>'.$reg->nombre.'</option>';
            }                  
            break;
        case 'selectColaborador':
            require_once'../models/Colaborador.php';
            $banco=new Banco();
            $rspta=$banco->select();
            echo '<option selected disabled>-- Selecionar Colaborador --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->idbanco.'>'.$reg->nombre.'</option>';
            }                  
            break; 
         case 'selectCliente':
            require_once'../models/Cliente.php';
            $banco=new Banco();
            $rspta=$banco->select();
            echo '<option selected disabled>-- Selecionar Cliente --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->idbanco.'>'.$reg->nombre.'</option>';
            }                  
            break;
}

