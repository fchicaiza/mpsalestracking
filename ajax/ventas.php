<?php 
require_once "../models/Ventas.php";
$ventas=new Ventas();
$id_ven=isset($_POST["id_ven"])? limpiarCadena($_POST["id_ven"]):"";
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
        if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
        $img_ven=$_POST["imagenactual"];
        }else{
        $ext=explode(".",$_FILES['imagen']['name']);
        if($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/png"||$_FILES['imagen']['type']=="image/jpeg")
        {  
            $img_ven=round(microtime(true).'.'.end($ext));
            move_uploaded_file($_FILES["imagen"]["tmp_name"],"../files/ventas".$img_ven);
        }
        }
		if (empty($id_ven)){
			$rspta=$ventas->insertar($fec_env_ven,$tot_ven,$img_ven,$int_pvn_ven,$id_ban_ven,$id_tpa_ven,$id_ciu_ven,$id_col_ven,$id_cli_ven);
			echo $rspta ? "Venta registrada" : "Venta no se pudo registrar";
		}
		else {
			$rspta=$ventas->editar($id_ven,$fec_env_ven,$tot_ven,$img_ven,$int_pvn_ven,$id_ban_ven,$id_tpa_ven,$id_ciu_ven,$id_col_ven,$id_cli_ven);
			echo $rspta ? "Venta actualizada" : "Venta no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ventas->desactivar($id_ven);
 		echo $rspta ? "Venta Desactivada" : "Venta no se pudo desactivar";
 		
	break;

	case 'activar':
		$rspta=$ventas->activar($id_ven);
 		echo $rspta ? "Venta  activado" : "Venta no se pudo activar";
 		
	break;

	case 'mostrar':
		$rspta=$ventas->mostrar($id_ven);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		
	break;

	case 'listar':
		$rspta=$ventas->listar();
 		//Vamos a declarar un array
 		$data= Array();


        
        while($reg=$rspta->fetch_object()){
            
            $data[]=array(         
                    "0" =>($reg->est_ven=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ven.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_ven.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ven.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_ven.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_ven.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_ven.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                    "1" =>$reg->fec_env_ven,
                    "2" =>$reg->tot_ven,
                    "3" =>"<img src='../files/ventas".$reg->img_ven."' height='50px' width='50px'>",
                    "4" =>$reg->puntoventa,
                    "5" =>$reg->banco,
                    "6" =>$reg->tipopago,
                    "7" =>$reg->ciudad,
                    "8" =>$reg->colaborador,
                    "9" =>$reg->id_cli_ven,
                    "10" =>($reg->est_ven=="A")?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
                    
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

