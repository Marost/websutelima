<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES DE URL
$usuario=$_POST["usuario"];
$email=$_POST["email"];
$accion=$_POST["act"];

if($accion=="email"){
	$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE email='$email';", $conexion);
	$num_query=mysql_num_rows($rst_query);

	if($num_query>=1){
		echo 1;
	}elseif($num_query==0){
		echo 0;
	}
}

if($accion=="usuario"){
	$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE usuario='$usuario';", $conexion);
	$num_query=mysql_num_rows($rst_query);

	if($num_query>=1){
		echo 1;
	}elseif($num_query==0){
		echo 0;
	}
}

?>