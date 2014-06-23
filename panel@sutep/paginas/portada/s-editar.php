<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$id=$_REQUEST["id"];
$fecha=$_POST["pub_fecha"];
$anio=substr($fecha,0,4);
$mes=substr($fecha,5,2);
$revista=$_POST["contenido"];
$pdf=$_POST["pdf"];
$pdf_carpeta=$_POST["pdf_carpeta"];
$imagen=$_POST["imagen"];
$imagen_carpeta=$_POST["imagen_carpeta"];

//SUBIR PORTADA
if($_FILES['fileInput']['name']!=""){
	if(is_uploaded_file($_FILES['fileInput']['tmp_name'])){ 
		$fileName=$_FILES['fileInput']['name'];
		$uploadDir="../../../imagenes/upload/".fechaCarpeta()."/";
		$uploadFile=$uploadDir.$fileName;
		$num = 0;
		$name = $fileName;
		$extension = end(explode('.',$fileName));     
		$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
		while(file_exists($uploadDir.$name))
		{
			$num++;         
			$name = $onlyName."".$num.".".$extension; 
		}
		$uploadFile = $uploadDir.$name; 
		move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile);  
		$name;
		$carpeta_imagen=fechaCarpeta()."/";
	}
}else{
	$name=$imagen;
	$carpeta_imagen=$imagen_carpeta;
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_portada SET imagen='$name', fecha='$fecha', numero_mes=$mes, anio=$anio, revista='$revista', imagen_carpeta='$carpeta_imagen' WHERE id=$id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>