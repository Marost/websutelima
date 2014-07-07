<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$nota_id=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$enlace=$_POST["enlace"];

//IMAGEN
if($_POST['uploader_0_tmpname']<>""){
	$imagen=$_POST["uploader_0_tmpname"];
	$imagen_carpeta=fechaCarpeta()."/";	
}else{
	$imagen=$_POST["imagen"];
	$imagen_carpeta=$_POST["imagen_carpeta"];	
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_enlace_blog SET url='$url', titulo='".htmlspecialchars($titulo)."', 
	enlace='$enlace', 
	imagen='$imagen', 
	imagen_carpeta='$imagen_carpeta' WHERE id=$nota_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>