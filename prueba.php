<?php

include("panel@impacto/conexion/conexion.php");

//SORTEO
$rst_sorteo=mysql_query("SELECT * FROM iev_sorteo WHERE fecha_inicio<='$fechaActual' AND fecha_fin>='$fechaActual';", $conexion);
$fila_sorteo=mysql_fetch_array($rst_sorteo);
$num_sorteo=mysql_num_rows($rst_sorteo);

//SORTEO - VARIABLES
$sorteo_id=$fila_sorteo["id"];
$sorteo_url=$fila_sorteo["url"];


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Datepicker - Select a Date Range</title>
</head>
<body>
<p><?php echo $fechaActual; ?></p>
<?php if($num_sorteo>=1){ ?>
<div class="scsdb_item">
    
    <div class="scsdbi_cabecera">
        <a href="sorteo/<?php echo $sorteo_id."-".$sorteo_url; ?>">
        SORTEO</a></div>
        <p><?php echo $fila_sorteo["fecha_inicio"]; ?></p>
        
    
</div><!-- FIN SECTION SIDEBAR ITEM -->
<?php } ?>
</body>
</html>
