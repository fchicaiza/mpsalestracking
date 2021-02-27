<?php
require "../config/Conexion.php";
class Colaboradores {
     public function __construct() {
        
    }
       public function verificar($usuario,$clave)
    {
        $sql="CALL sp_VerificarColaborador('$usuario','$clave')";    	
        return ejecutarConsulta($sql);  
    }
}
