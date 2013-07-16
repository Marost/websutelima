<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$nota_id=$_REQUEST["id"];
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$nombre_completo=$nombre." ".$apellidos;
$url=getUrlAmigable(eliminarTextoURL($nombre_completo));
$contenido=$_POST["contenido"];

//PUBLICAR
if ($_POST["publicar"]<>""){ $publicar=$_POST["publicar"]; }else{ $publicar=0; }

//SELECCION DE DIAS
$dia_lunes=$_POST["dia_lunes"];
$dia_martes=$_POST["dia_martes"];
$dia_miercoles=$_POST["dia_miercoles"];
$dia_jueves=$_POST["dia_jueves"];
$dia_viernes=$_POST["dia_viernes"];
$dia_sabado=$_POST["dia_sabado"];
$dia_domingo=$_POST["dia_domingo"];

//DIAS DE PUBLICACION
if($dia_lunes<>""){ $dia_lunes=1; }else{ $dia_lunes=0; }
if($dia_martes<>""){ $dia_martes=1; }else{ $dia_martes=0; }
if($dia_miercoles<>""){ $dia_miercoles=1; }else{ $dia_miercoles=0; }
if($dia_jueves<>""){ $dia_jueves=1; }else{ $dia_jueves=0; }
if($dia_viernes<>""){ $dia_viernes=1; }else{ $dia_viernes=0; }
if($dia_sabado<>""){ $dia_sabado=1; }else{ $dia_sabado=0; }
if($dia_domingo<>""){ $dia_domingo=1; }else{ $dia_domingo=0; }

//SUBIR IMAGEN
if(is_uploaded_file($_FILES['fileInput']['tmp_name'])){ 
	$fileName=$_FILES['fileInput']['name'];
	$uploadDir="../../../imagenes/columnistas/";
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
}else{
	$name=$_POST["imagen_actual"];
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_columnista SET url='$url',
	nombre='$nombre',
	apellidos='$apellidos',
	nombre_completo='$nombre_completo',
	foto='$name',
	descripcion='$contenido',
	publicar=$publicar,
	dia_lunes=$dia_lunes,
	dia_martes=$dia_martes,
	dia_miercoles=$dia_miercoles,
	dia_jueves=$dia_jueves,
	dia_viernes=$dia_viernes,
	dia_sabado=$dia_sabado,
	dia_domingo=$dia_domingo WHERE id=$nota_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>