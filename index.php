<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//NOTICIA INFERIOR
$rst_noticia_inferior=mysql_query("SELECT * FROM iev_noticia WHERE noticia=1 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Impacto Evangelistico</title>



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
			$noticiaInf_imagen_carpeta=$fila_noticia_inferior["carpeta_imagen"];
			
			//FECHA PUBLICACION
			$fechaPubNoticiaInf=$fila_noticia_inferior["fecha_publicacion"];
			$fechaNoticia=explode(" ", $fechaPubNoticiaInf);
			$fechaExpNoticia=explode("-", $fechaNoticia[0]);
						
			//CATEOGRIA
			$rst_noticia_cateogia=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id=$noticiaInf_categoria;", $conexion);
			$fila_noticia_categoria=mysql_fetch_array($rst_noticia_cateogia);
			
			//VARIABLES CATEGORIA
			$categoriaInf_id=$fila_noticia_categoria["id"];
			$categoriaInf_url=$fila_noticia_categoria["url"];
			$categoriaInf_titulo=$fila_noticia_categoria["categoria"];
            ?>
            	
            <div class="scnw_item">
            	
                <div class="scnwi_categoria">
                	<div class="scnwic_color bg<?php echo $categoriaInf_url; ?>"></div>
                    <div class="scnwic_nombre cl<?php echo $categoriaInf_url; ?>"><span>[</span> <?php echo $categoriaInf_titulo; ?> <span>]</span></div>
                </div>
                
                <div class="scnwi_detalles">
                	
                    <h2><a href="noticia/<?php echo $noticiaInf_id."-".$noticiaInf_url; ?>"><?php echo $noticiaInf_titulo; ?></a></h2>
                    <?php echo cortarTextoRH($noticiaInf_contenido,1,0,400); ?>
                    
                </div>
                
                <div class="scnwi_imagen">
                	<a href="noticia/<?php echo $noticiaInf_id."-".$noticiaInf_url; ?>">
                    	<img src="imagenes/upload/<?php echo $noticiaInf_imagen_carpeta."thumb/".$noticiaInf_imagen; ?>" alt="Imagen"></a>
                </div>
                
                <div class="scnwi_fecha_social">
                	
                    <div class="scnwifsc_fecha">
                    	<?php echo nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]); ?>
                    </div>
                    
                    <div class="scnwifsc_social">
                    	
                        <div class="scnwifscs_twitter">
                            
                            <a href="https://twitter.com/share" 
                            class="twitter-share-button" 
                            data-url="http://impactoevangelistico.net/noticia/<?php echo $noticiaSup_id."-".$noticiaSup_url; ?>" 
                            data-text="Impacto Evangelístico" 
                            data-lang="es" data-hashtags="Impacto_Evangel">Twittear</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            
                        </div><!-- NOTWEB TWITTER -->
                        
                        <div class="scnwifscs_facebook">
                            
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=217179171676130";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
    
                            <div class="fb-like" 
                            data-href="http://impactoevangelistico.net/noticia/<?php echo $noticiaSup_id."-".$noticiaSup_url; ?>" 
                            data-send="false" 
                            data-layout="button_count" 
                            data-width="120" data-show-faces="false"></div>
                            
                        </div><!-- NOTWEB FACEBOOK -->
                    
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