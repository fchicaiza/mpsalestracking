<?php

require_once '../config/conexion.php';

class Persona {

    public function __constructor() 
    {
        
    }

    public function insertar($dni, $nombre, $apellido, $telefono, $email, $idempresa, $idrol) 
    {
        $sql = "CALL sp_InsertarPersona('$dni','$nombre','$apellido','$telefono','$email','$idempresa', $idrol )";

        return ejecutarConsulta($sql);
    }

    public function actualizar($idpersona, $dni, $nombre, $apellido, $telefono, $email, $idempresa, $idrol) 
    {
        $sql = "CALL sp_EditarPersona($idpersona,'$dni','$nombre','$apellido','$telefono','$email','$idempresa', $idrol)";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idpersona) 
    { 
        $sql = "CALL sp_DesEstPersona($idpersona)";
        return ejecutarConsulta($sql);
    }

    public function activar($idpersona) 
    {
        $sql = "CALL sp_ActEstPersona($idpersona)";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idpersona)
    {
        $sql = "CALL sp_MostrarPersona($idpersona)";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar() 
    {
        $sql = "CALL sp_ListarPersona()";
        return ejecutarConsulta($sql);
    }
    
    public function eliminar($idpersona){
        
        $sql="CALL sp_EliminarPersona($idpersona)";
        return ejecutarConsulta($sql);
    }
    
}

?>