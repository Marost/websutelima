<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$nombre=$_POST["nombre"];
$url=getUrlAmigable(eliminarTextoURL($nombre));
$contenido=$_POST["contenido"];
$categoria=$_POST["categoria"];
$tipo_noticia=$_POST["tipo_noticia"];
//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];
$pub_hora=$_POST["pub_hora"];
$fecha_publicacion=$pub_fecha." ".$pub_hora;
$publicar=1;

//TAGS
$tags=$_POST["tags"];
if($tags==""){ $union_tags=0; }
elseif($tags<>""){ $union_tags=implode(",", $tags);}

//SUBIR IMAGEN
$upload_imagen=$_POST["uploader_0_tmpname"];

//SUBIR VIDEO
$video_youtube=$_POST["video_youtube"];
$video_upload=$_POST["uploader_video_0_tmpname"];

//IMAGEN
if ($tipo_noticia=="not_destacada") {
	$destacada=1; 
	if($upload_imagen<>""){
		$imagen=$upload_imagen;
		$imagen_carpeta=fechaCarpeta()."/";	
		$mostrar_imagen=1;
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(480,220);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=""; $imagen_carpeta="";
	}
}elseif($tipo_noticia=="not_normal"){
	$destacada=2;
	if($upload_imagen<>""){
		$imagen=$upload_imagen;
		$imagen_carpeta=fechaCarpeta()."/";	
		$mostrar_imagen=1;
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(200,110);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=""; $imagen_carpeta="";
	}
}

//VIDEO YOUTUBE
if($video_youtube<>""){
	$mostrar_video=1;
	$tipo_video="youtube";
	$video=$video_youtube;
	$video_carpeta="";
}elseif($video_youtube==""){
	$mostrar_video=0;
	$tipo_video="";
	$video="";
	$video_carpeta="";
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_noticia (url, titulo, contenido, imagen, imagen_carpeta, fecha_publicacion, publicar, destacada, categoria, tags, video, tipo_video, mostrar_video, carpeta_video) VALUES('$url', '".htmlspecialchars($nombre)."', '$contenido', '$imagen', '$imagen_carpeta', '$fecha_publicacion', $publicar, $destacada, $categoria, '0,$union_tags,0', '$video', '$tipo_video', '$mostrar_video', '$video_carpeta');",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>