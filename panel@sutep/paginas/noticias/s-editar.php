<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$nota_id=$_REQUEST["id"];
$nombre=$_POST["nombre"];
$url=getUrlAmigable(eliminarTextoURL($nombre));
$contenido=$_POST["contenido"];
$categoria=$_POST["categoria"];
$tipo_noticia=$_POST["tipo_noticia"];
$tags=$_POST["tags"];

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];
$pub_hora=$_POST["pub_hora"];
$fecha_publicacion=$pub_fecha." ".$pub_hora;

//TAGS
$tags=$_POST["tags"];
if($tags==""){ $union_tags=0; }
elseif($tags<>""){ $union_tags=implode(",", $tags);}

//PUBLICAR
if ($_POST["publicar"]<>""){ $publicar=$_POST["publicar"]; }else{ $publicar=0; }

//VIDEO
$video_youtube=$_POST["video_youtube"];
//$video_upload=$_POST["uploader_video_0_tmpname"];

//IMAGEN
if ($tipo_noticia=="not_destacada") {
	$destacada=1; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2;
	if($_POST['uploader_0_tmpname']<>""){
		$imagen=$_POST["uploader_0_tmpname"];
		$imagen_carpeta=fechaCarpeta()."/";	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(480,220);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=$_POST["imagen"];
		$imagen_carpeta=$_POST["imagen_carpeta"];	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(480,220);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
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
	if($_POST['uploader_0_tmpname']<>""){
		$imagen=$_POST["uploader_0_tmpname"];
		$imagen_carpeta=fechaCarpeta()."/";	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(310,174);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=$_POST["imagen"];
		$imagen_carpeta=$_POST["imagen_carpeta"];	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(310,174);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}

}elseif($tipo_noticia=="not_normal"){
	$destacada=2; $superior1=2; $superior2=2; $superior3=2; $superior4=2; $superior5=2; $superior6=2; $superior7=2; $superior8=2; $superior9=2;
	if($_POST['uploader_0_tmpname']<>""){
		$imagen=$_POST["uploader_0_tmpname"];
		$imagen_carpeta=fechaCarpeta()."/";	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(200,110);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	}else{
		$imagen=$_POST["imagen"];
		$imagen_carpeta=$_POST["imagen_carpeta"];	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$imagen_carpeta."".$imagen."");
		$thumb->adaptiveResize(200,110);
		$thumb->save("../../../imagenes/upload/".$imagen_carpeta."thumb/".$imagen."", "jpg");
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
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_noticia SET url='$url', titulo='".htmlspecialchars($nombre)."', 
	contenido='$contenido', 
	imagen='$imagen', 
	imagen_carpeta='$imagen_carpeta', 
	fecha_publicacion='$fecha_publicacion', 
	publicar=$publicar, 
	superior_1=$superior1, 
	superior_2=$superior2, 
	superior_3=$superior3, 
	superior_4=$superior4, 
	superior_5=$superior5, 
	superior_6=$superior6, 
	superior_7=$superior7, 
	superior_8=$superior8, 
	superior_9=$superior9, 
	destacada=$destacada, 
	categoria=$categoria, 
	tags='0,$union_tags,0', 
	video='$video', 
	tipo_video='$tipo_video', 
	mostrar_video=$mostrar_video, 
	carpeta_video='$video_carpeta' WHERE id=$nota_id;", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>