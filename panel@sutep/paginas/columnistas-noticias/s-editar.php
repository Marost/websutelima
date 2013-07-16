<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$reqColum=$_REQUEST["colum"];
$nota_id=$_REQUEST["id"];
$nombre=$_POST["nombre"];
$url=getUrlAmigable(eliminarTextoURL($nombre));
$contenido=$_POST["contenido"];

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_columnista_columna SET url='$url', titulo='".htmlspecialchars($nombre)."', contenido='$contenido', fecha='$pub_fecha' WHERE id=$nota_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?colum=$reqColum&msj=ok");
}

?>