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
	$destacada=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2;
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
}elseif($tipo_noticia=="not_superior1" OR 
	$tipo_noticia=="not_superior2" OR 
	$tipo_noticia=="not_superior3" OR 
	$tipo_noticia=="not_superior4" OR 
	$tipo_noticia=="not_superior5" OR 
	$tipo_noticia=="not_superior6" OR 
	$tipo_noticia=="not_superior7" OR 
	$tipo_noticia=="not_superior8" OR 
	$tipo_noticia=="not_superior9"){

	if($tipo_noticia=="not_superior1"){ $superior1=1; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior2"){ $superior2=1; $superior1=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior3"){ $superior3=1; $superior1=2; $superior2=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior4"){ $superior4=1; $superior1=2; $superior2=2; $superior3=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior5"){ $superior5=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior6"){ $superior6=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior7=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior7"){ $superior7=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior8=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior8"){ $superior8=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior9=2; }
	elseif($tipo_noticia=="not_superior9"){ $superior9=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; }

	$destacada=2;
	if($upload_imagen<>""){
		$imagen=$upload_imagen;
		$imagen_carpeta=fechaCarpeta()."/";	
		$mostrar_imagen=1;
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(310,174);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=""; $imagen_carpeta="";
	}	

}elseif($tipo_noticia=="not_normal"){
	$destacada=2; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2;
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
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_noticia (url, titulo, contenido, imagen, imagen_carpeta, fecha_publicacion, publicar, destacada, superior_1, superior_2, superior_3, superior_4, superior_5, superior_6, superior_7, superior_8, superior_9, categoria, tags, video, tipo_video, mostrar_video, carpeta_video) VALUES('$url', '".htmlspecialchars($nombre)."', '$contenido', '$imagen', '$imagen_carpeta', '$fecha_publicacion', $publicar, $destacada, $superior1, $superior2, $superior3, $superior4, $superior5, $superior6, $superior7, $superior8, $superior9, $categoria, '0,$union_tags,0', '$video', '$tipo_video', '$mostrar_video', '$video_carpeta');",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>