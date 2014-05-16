<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//NOTICIA INFERIOR
$rst_noticia_inferior=mysql_query("SELECT * FROM stp_noticia WHERE fecha_publicacion<='$fechaActual' AND destacada<>1 AND publicar=1 ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?php echo $web_nombre; ?></title>

<?php require_once("wg-header-script.php"); ?>

</head>

<body>

<?php require_once("wg-header.php"); ?>

<section class="limpiar">

	<div class="interior limpiar">

        <div id="section_news">
        	
            <?php while($fila_noticia_inferior=mysql_fetch_array($rst_noticia_inferior)){ ?>
            <?php
			//VARIABLES NOTICIA
			$noticiaInf_id=$fila_noticia_inferior["id"];
			$noticiaInf_url=$fila_noticia_inferior["url"];
			$noticiaInf_categoria=$fila_noticia_inferior["categoria"];
			$noticiaInf_titulo=$fila_noticia_inferior["titulo"];
			$noticiaInf_contenido=$fila_noticia_inferior["contenido"];
			$noticiaInf_imagen=$fila_noticia_inferior["imagen"];
			$noticiaInf_imagen_carpeta=$fila_noticia_inferior["imagen_carpeta"];
			
			//FECHA PUBLICACION
			$fechaPubNoticiaInf=$fila_noticia_inferior["fecha_publicacion"];
			$fechaNoticia=explode(" ", $fechaPubNoticiaInf);
			$fechaExpNoticia=explode("-", $fechaNoticia[0]);
						
			//CATEOGRIA
			$rst_noticia_cateogia=mysql_query("SELECT * FROM stp_noticia_categoria WHERE id=$noticiaInf_categoria;", $conexion);
			$fila_noticia_categoria=mysql_fetch_array($rst_noticia_cateogia);
			
			//VARIABLES CATEGORIA
			$categoriaInf_id=$fila_noticia_categoria["id"];
			$categoriaInf_url=$fila_noticia_categoria["url"];
			$categoriaInf_titulo=$fila_noticia_categoria["categoria"];

            //URLS
            $noticiaInf_urlWeb=$web."noticia/".$noticiaInf_id."-".$noticiaInf_url;
            $noticiaInf_urlImg=$web."imagenes/upload/".$noticiaInf_imagen_carpeta."".$noticiaInf_imagen;
            ?>
            	
            <div class="scnw_item">
            	
                <div class="scnwi_categoria">
                	<div class="scnwic_color bg<?php echo $categoriaInf_url; ?>"></div>
                    <div class="scnwic_nombre cl<?php echo $categoriaInf_url; ?>"><?php echo $categoriaInf_titulo; ?></div>
                </div>
                
                <div class="scnwi_detalles">
                    <h2>
                        <a href="<?php echo $noticiaInf_urlWeb; ?>">
                            <?php echo $noticiaInf_titulo; ?>
                        </a>
                    </h2>                    
                </div>
                
                <div class="scnwi_imagen">
                	<a href="<?php echo $noticiaInf_urlWeb; ?>">
                    	<img src="<?php echo $noticiaInf_urlImg; ?>" alt="<?php echo $noticiaInf_titulo; ?>">
                    </a>
                </div>

                <div class="scnwi_contenido">
                    <?php echo primerParrafo($noticiaInf_contenido); ?>
                </div>
                
                <div class="scnwi_fecha_social">
                	
                    <div class="scnwifsc_fecha">
                    	<?php echo nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]); ?>
                    </div>
                    
                    <div class="scnwifsc_social">
                    	
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style "
                            addthis:url="<?php echo $noticiaInf_urlWeb; ?>"
                            addthis:title="<?php echo $noticiaInf_titulo; ?>" >
                        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                        <a class="addthis_button_tweet"></a>
                        <a class="addthis_counter addthis_pill_style"></a>
                        </div>
                        <script>var addthis_config = {"data_track_addressbar":true};</script>
                        <script>var addthis_config = {"data_track_clickback": false};</script>
                        <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51eac0200239baf4"></script>
                        <!-- AddThis Button END -->
                    
                    </div>
                    
                </div>
                
            </div><!-- FIN SECTION NEWS ITEM -->
            
            <?php } ?>
                        
        </div><!-- FIN SECTION NEWS -->
        
        <?php require_once("wg-sidebar.php"); ?>

	</div><!-- FIN INTERIOR -->
    
</section><!-- FIN SECTION -->

<?php require_once("wg-footer.php"); ?>

</body>
</html>