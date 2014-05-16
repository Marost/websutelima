<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//LISTA DE GALERIA DE FOTOS
$rst_listagaleria=mysql_query("SELECT * FROM stp_galeria ORDER BY fecha_publicacion DESC", $conexion);

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Galería de Fotos | <?php echo $web_nombre; ?></title>
<base href="<?php echo $web; ?>" />

<?php require_once("wg-header-script.php"); ?>

</head>

<body>

<?php require_once("wg-header.php"); ?>

<section class="limpiar">

	<div class="interior limpiar">

        <div id="section_news" class="galeria-fotos galeria">
            	
            <div class="scnw_item">

                <div class="scnwi_categoria">
                    <h2>Galería de Fotos</h2>
                </div>
            	
                <div class="scnwi_contenido galeria-lista">

                    <?php while($fila_listagaleria=mysql_fetch_array($rst_listagaleria)){
                            $LGaleria_id=$fila_listagaleria["id"];
                            $LGaleria_url=$fila_listagaleria["url"];
                            $LGaleria_titulo=$fila_listagaleria["titulo"];

                            //GALERIA DE FOTOS NOTICIA
                            $rst_FLG=mysql_query("SELECT * FROM stp_galeria_slide WHERE noticia=$LGaleria_id AND orden=0;", $conexion);
                            $fila_FLG=mysql_fetch_array($rst_FLG);
                            $FLG_imagen=$fila_FLG["imagen"];
                            $FLG_imagen_carpeta=$fila_FLG["imagen_carpeta"];

                            //URLs
                            $GalLista_Url=$web."galeria/".$LGaleria_id."-".$LGaleria_url;
                            $GalLista_UrlImg=$web."imagenes/galeria/".$FLG_imagen_carpeta."".$FLG_imagen;
                    ?>
                    <article>
                        <div class="img"><img src="<?php echo $GalLista_UrlImg; ?>"></div>
                        <div class="detalles"><h3><a href="<?php echo $GalLista_Url; ?>"><?php echo $LGaleria_titulo; ?></a></h3></div>
                    </article>
                    <?php } ?>
                    
                </div>
                
            </div><!-- FIN SECTION NEWS ITEM -->
                        
        </div><!-- FIN SECTION NEWS -->

	</div><!-- FIN INTERIOR -->
    
</section><!-- FIN SECTION -->

<?php require_once("wg-footer.php"); ?>

<!-- ROYAL SLIDER JS -->
<script src="libs/royalslider/jquery-1.8.3.min.js"></script>
<script src="libs/royalslider/jquery.royalslider.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#galeria-noticia').royalSlider({
        fullscreen: {
          enabled: false
        },
        controlNavigation: 'thumbnails',
        autoScaleSlider: true, 
        autoScaleSliderWidth: 960,     
        autoScaleSliderHeight: 850,
        loop: true,
        imageScaleMode: 'fit-if-smaller',
        navigateByClick: true,
        numImagesToPreload:2,
        arrowsNav:true,
        arrowsNavAutoHide: true,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: false,
        thumbs: {
          appendSpan: true,
          firstMargin: true,
          paddingBottom: 4
        }
    });
});
</script>

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

<!-- DISQUS -->
<script>
var disqus_shortname = 'sutep';
(function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = '//' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
}());
</script>

</body>
</html>