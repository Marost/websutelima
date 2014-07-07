<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$enlace=$_POST["enlace"];

//SUBIR IMAGEN
$imagen=$_POST["uploader_0_tmpname"];
$imagen_carpeta=fechaCarpeta()."/";

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_enlace_interes (titulo, enlace, imagen, imagen_carpeta) VALUES('".htmlspecialchars($titulo)."', '$enlace', '$imagen', '$imagen_carpeta');",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>