<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$reqColum=$_REQUEST["colum"];
$nombre=$_POST["nombre"];
$url=getUrlAmigable(eliminarTextoURL($nombre));
$contenido=$_POST["contenido"];

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_columnista_columna (url, titulo, contenido, fecha, columnista) VALUES('$url', '".htmlspecialchars($nombre)."', '$contenido', '$pub_fecha', $reqColum);",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=ok");
}

?>