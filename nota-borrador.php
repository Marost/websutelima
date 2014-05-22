<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//NOTICIA
$rst_noticia=mysql_query("SELECT * FROM stp_secciones WHERE id=2;", $conexion);
$fila_noticia=mysql_fetch_array($rst_noticia);
$noticia_titulo=$fila_noticia["titulo"];
$noticia_categoria=$fila_noticia["categoria"];
$noticia_fecha=$fila_noticia["fecha_publicacion"];
$noticia_contenido=$fila_noticia["contenido"];
$noticia_imagen=$fila_noticia["imagen"];
$noticia_imagen_carpeta=$fila_noticia["imagen_carpeta"];
$noticia_imagen_mostrar=$fila_noticia["mostrar_imagen"];
$noticia_video=$fila_noticia["video"];
$noticia_video_mostrar=$fila_noticia["mostrar_video"];
$noticia_video_carpeta=$fila_noticia["carpeta_video"];
$noticia_video_tipo=$fila_noticia["tipo_video"];
$noticia_comentarios=$fila_noticia["comentarios"];

//FECHA PUBLICACION
$fechaPubNoticiaInf=$noticia_fecha;
$fechaNoticia=explode(" ", $fechaPubNoticiaInf);
$fechaExpNoticia=explode("-", $fechaNoticia[0]);

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?php echo stripslashes($noticia_titulo); ?> | <?php echo $web_nombre; ?></title>
<base href="<?php echo $web; ?>" />

<?php require_once("wg-header-script.php"); ?>

</head>

<body>

<?php require_once("wg-header.php"); ?>

<section class="limpiar">

	<div class="interior limpiar">

        <div id="section_news">
            	
            <div class="scnw_item all">
            	
                <div class="scnwi_detalles">
                	
                    <h2><?php echo $noticia_titulo; ?></h2>
                    
                </div>
                                
                <div class="scnwi_contenido">
                    <?php echo $noticia_contenido; ?>
                </div>
                
            </div><!-- FIN SECTION NEWS ITEM -->
                        
        </div><!-- FIN SECTION NEWS -->
        
	</div><!-- FIN INTERIOR -->
    
</section><!-- FIN SECTION -->

<?php require_once("wg-footer.php"); ?>

<!-- AddThis -->
<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51eac0200239baf4"></script>
<script>
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    }
  });
</script>

</body>
</html>