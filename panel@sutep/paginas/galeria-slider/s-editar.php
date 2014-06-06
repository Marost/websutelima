<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../js/plugins/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$id=$_REQUEST["id"];
$titulo=htmlspecialchars($_POST["titulo"]);
$noticia=$_REQUEST["not"];

//IMAGEN
if($_POST['uploader_galeria_0_tmpname']==""){
	$imagen=$_POST["imagen"];
	$carpeta=$_POST["imagen_carpeta"];
}else{
	$carpeta=fechaCarpeta()."/";
	$imagen=$_POST['uploader_galeria_0_tmpname'];
	$thumb=PhpThumbFactory::create("../../../imagenes/galeria/".$imagen_carpeta."".$imagen."");
	$thumb->adaptiveResize(110,110);
	$thumb->save("../../../imagenes/galeria/".$imagen_carpeta."thumb/".$imagen."", "jpg");
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_galeria_slide SET titulo='$titulo', imagen='$imagen', imagen_carpeta='$imagen_carpeta',	noticia=$noticia WHERE id=$id", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: <strong>".mysql_errno()."</strong> - ". mysql_error();
	mysql_close($conexion);
	header("Location:lista.php?not=$noticia&msj=er");
} else {
	mysql_close($conexion);
	header("Location:lista.php?not=$noticia&msj=ok");
}

?>