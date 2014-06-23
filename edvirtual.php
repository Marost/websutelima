<?php
require_once("panel@sutep/conexion/conexion.php");
require_once("panel@sutep/conexion/funciones.php");

//PORTADA
$idportada=$_REQUEST["id"];
$fecha=$_REQUEST["url"];
$rst_query=mysql_query("SELECT * FROM stp_portada WHERE id=$idportada AND url='$fecha'", $conexion);
$fila_query=mysql_fetch_array($rst_query);
$num_query=mysql_num_rows($rst_query);
if($num_query==0){header("Location: $web");}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Revista Virtual - Sute Lima</title>
  <base href="<?php echo $web; ?>" />
  <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
</head>
<body>
  <?php 
  if($fila_query["revista"]==""){
    echo "<p align='center' style='padding:10px'><strong>ERROR EN EL SERVIDOR. ESTAMOS SOLUCIONANDO EL PROBLEMA.<br/>DISCULPE LAS MOLESTIAS.<br/>SUTE LIMA</strong></p>";
  }else{
    echo $fila_query["revista"];
  } ?>

</body>
</html>