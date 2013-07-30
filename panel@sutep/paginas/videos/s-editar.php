<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$nota_id=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];
$pub_hora=$_POST["pub_hora"];
$fecha_publicacion=$pub_fecha." ".$pub_hora;

//PUBLICAR
if ($_POST["publicar"]<>""){ $publicar=$_POST["publicar"]; }else{ $publicar=0; }

//VIDEO
$video_youtube=$_POST["video_youtube"];

//IMAGEN
if($_POST['uploader_0_tmpname']<>""){
	$imagen=$_POST["uploader_0_tmpname"];
	$imagen_carpeta=fechaCarpeta()."/";	
	$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
	$thumb->adaptiveResize(620,400);
	$thumb->save("../../../imagenes/upload/".$imagen_carpeta."".$imagen."", "jpg");
}else{
	$imagen=$_POST["imagen"];
	$imagen_carpeta=$_POST["imagen_carpeta"];	
	$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
	$thumb->adaptiveResize(620,400);
	$thumb->save("../../../imagenes/upload/".$imagen_carpeta."".$imagen."", "jpg");
}

//VIDEO YOUTUBE
if($video_youtube<>""){
	$video=$video_youtube;
}elseif($video_youtube==""){
	$video="";
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_videos SET url='$url', titulo='".htmlspecialchars($titulo)."', 
	imagen='$imagen', 
	imagen_carpeta='$imagen_carpeta', 
	fecha_publicacion='$fecha_publicacion', 
	publicar=$publicar,  
	video='$video' WHERE id=$nota_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>