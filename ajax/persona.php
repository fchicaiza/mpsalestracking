<?php

require_once '../models/Persona.php';

$persona = new Persona();

$idpersona = isset($_POST["idpersona"]) ? limpiarCadena($_POST["idpersona"]) : "";
$dni = isset($_POST["dni"]) ? limpiarCadena($_POST["dni"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena($_POST["apellido"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$idempresa = isset($_POST["idempresa"]) ? limpiarCadena($_POST["idempresa"]) : "";
$idrol = isset($_POST["idrol"]) ? limpiarCadena($_POST["idrol"]) : "";


switch ($_GET["op"]) {

    case 'guardaryeditar':

        if (empty($idpersona)) {
            $rspta = $persona->insertar($dni, $nombre, $apellido, $telefono, $email, $idempresa, $idrol);
            echo $rspta ? "Registro Exitoso" : "Registro Fallido";
        } else {
            $rspta = $persona->actualizar($idpersona, $dni, $nombre, $apellido, $telefono, $email, $idempresa, $idrol);
            echo $rspta ? "Actualización Exitosa" : "Actualización Fallida";
        }
        break;

    case 'desactivar':
        $rspta = $persona->desactivar($idpersona);
        echo $rspta ? "Registro desactivado exitosamente" : "Registro no desactivado";
        break;

    case 'activar':
        $rspta = $persona->activar($idpersona);
        echo $rspta ? "Registro activado exitosamente" : "Registro no activado";
        break;

    case 'mostrar':
        $rspta = $persona->mostrar($idpersona);
        echo json_encode($rspta);
        break;

    
     case 'eliminar':
     $rspta = $persona->eliminar($idpersona);
        echo $rspta ? "Registro eliminado exitosamente" : "Registro no eliminado";       
        break;
    
    case 'listar':
        $rspta = $persona->listar();
        $data = Array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => ($reg->est_per == "A") ? '<button class="btn btn-primary" onclick="mostrar(' . $reg->id_per . ')"><i class="fa fa-pencil" title="Editar"></i></button>' .
                ' <button class="btn btn-success" onclick="desactivar(' . $reg->id_per . ')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>' .
                ' <button class="btn btn-danger" onclick="eliminar(' . $reg->id_per . ')"><i class="fa fa-close" title="Eliminar"></i></button>' :
                '<button class="btn btn-primary" onclick="mostrar(' . $reg->id_per . ')"><i class="fa fa-pencil" title="Editar"></i></button>' .
                ' <button class="btn btn-warning" onclick="activar(' . $reg->id_per . ')"><i class="fa fa-toggle-off" title="Activar"></i></button>' .
                ' <button class="btn btn-danger" onclick="eliminar(' . $reg->id_per . ')"><i class="fa fa-close" title="Eliminar"></i></button>',
                "1" => $reg->dni_per,
                "2" => $reg->nom_per,
                "3" => $reg->ape_per,
                "4" => $reg->rol,
                "5" => $reg->empresa,
                "6" => ($reg->est_per == "A") ? '<span class="label bg-green">Activado</span>' :
                '<span class="label bg-yellow">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho" => 1, //Información para el datatables
            "iTotalRecords" => count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

        break;

    case 'selecRol':
        require_once '../models/Rol.php';
        $rol = new Rol();
        $rspta = $rol->selecRol();
    echo '<option selected disabled>-- Seleccionar Rol --</option>';
        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id_rol. '>' . $reg->nom_rol . '</option>';
        }
        break;


    case 'selecEmpresa':
        
        require_once '../models/Empresa.php';
        $empresa = new Empresa();
        $rspta = $empresa->selecEmpresa();
        echo '<option selected disabled>-- Seleccionar Empresa--</option>';
        while ($reg = $rspta->fetch_object()) {
          
            echo'<option value=' . $reg->cod_emp. '>' . $reg->nom_emp . '</option>';
        }
   
}
?>