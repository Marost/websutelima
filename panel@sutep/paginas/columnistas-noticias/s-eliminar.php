<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$reqColum=$_REQUEST["colum"];
$id=$_REQUEST["id"];

mysql_query("DELETE FROM ".$tabla_suf."_columnista_columna WHERE id=$id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=ok");
}

?>