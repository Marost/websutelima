<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];
$pub_hora=$_POST["pub_hora"];
$fecha_publicacion=$pub_fecha." ".$pub_hora;
$publicar=1;

//SUBIR IMAGEN
$upload_imagen=$_POST["uploader_0_tmpname"];

//SUBIR VIDEO
$video_youtube=$_POST["video_youtube"];

//IMAGEN
if($upload_imagen<>""){
	$imagen=$upload_imagen;
	$imagen_carpeta=fechaCarpeta()."/";	
	$mostrar_imagen=1;
	$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
	$thumb->adaptiveResize(620,400);
	$thumb->save("../../../imagenes/upload/".$imagen_carpeta."".$imagen."", "jpg");
}else{
	$imagen=""; $imagen_carpeta="";
}


//VIDEO YOUTUBE
if($video_youtube<>""){
	$video=$video_youtube;
}elseif($video_youtube==""){
	$video="";
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_videos (url, titulo, imagen, imagen_carpeta, fecha_publicacion, publicar, video) VALUES('$url', '".htmlspecialchars($titulo)."', '$imagen', '$imagen_carpeta', '$fecha_publicacion', $publicar, '$video');",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>