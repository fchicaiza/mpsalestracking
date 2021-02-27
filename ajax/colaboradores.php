<?php
session_start();
require_once "../models/Colaboradores.php";

$colaboradores=new Colaboradores();

$id_col=isset($_POST["id_col"])? limpiarCadena($_POST["id_col"]):"";
$usu_col=isset($_POST["usu_col"])? limpiarCadena($_POST["usu_col"]):"";
$pass_col=isset($_POST["pass_col"])? limpiarCadena($_POST["pass_col"]):"";
switch ($_GET["op"]){
     case 'verificar':
            $logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);

		$rspta=$colaboradores->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['id_col']=$fetch->id_col;
	        $_SESSION['usu_col']=$fetch->usu_col;
                $_SESSION['id_per_col']=$fetch->id_per_col;
               
                
        }
          echo json_encode($fetch);
        break;
}