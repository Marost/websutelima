<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$fecha=$_POST["pub_fecha"];
$anio=substr($fecha,0,4);
$mes=substr($fecha,5,2);
$revista=$_POST["contenido"];

//SUBIR PORTADA
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

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_portada (imagen, fecha, numero_mes, anio, revista, imagen_carpeta) VALUES('$name', '$fecha', $mes, $anio, '$revista', '$carpeta_imagen');",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	$sql=mysql_query("SELECT * FROM ".$tabla_suf."_portada_mes_anio WHERE numero_mes=$mes AND anio=$anio;", $conexion);
	$fila_sql=mysql_fetch_array($sql);
	if($fila_sql==1){
		mysql_close($conexion);
		header("Location:lista.php?msj=ok");
	}elseif($fila_sql==0){
		mysql_query("INSERT INTO ".$tabla_suf."_portada_mes_anio (numero_mes, anio) VALUES ($mes, $anio);", $conexion);
		mysql_close($conexion);
		header("Location:lista.php?msj=ok");
	}
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>