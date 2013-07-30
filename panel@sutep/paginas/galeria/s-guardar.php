<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
$imagen_carpeta=fechaCarpeta()."/";

//FECHA Y HORA
$pub_fecha=$_POST["pub_fecha"];
$pub_hora=$_POST["pub_hora"];
$fecha_publicacion=$pub_fecha." ".$pub_hora;
$publicar=1;

//SUBIR
$cont=0;
while($_POST['uploader_galeria_'.$cont.'_tmpname']<>""){
	$imagen=$_POST['uploader_galeria_'.$cont.'_tmpname'];
	$thumb{$cont}=PhpThumbFactory::create("../../../imagenes/galeria/".$imagen_carpeta."".$imagen."");
	$thumb{$cont}->adaptiveResize(110,110);
	$thumb{$cont}->save("../../../imagenes/galeria/".$imagen_carpeta."thumb/".$imagen."", "jpg");
	$imagen=$_POST['uploader_galeria_'.$cont.'_tmpname'];
	mysql_query("INSERT INTO ".$tabla_suf."_galeria_slide(imagen, imagen_carpeta, orden, noticia) VALUES ('$imagen', '$imagen_carpeta', $cont, $noticia)",$conexion);
	$cont++;
}


//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_galeria (url, titulo, fecha_publicacion, publicar) VALUES('$url', '".htmlspecialchars($titulo)."', '$fecha_publicacion', $publicar);",$conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?msj=ok");
}

?>