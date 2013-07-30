<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//VARIABLES
$idnoticia=$_REQUEST["id"];
$urlnoticia=$_REQUEST["url"];

//NOTICIA
$rst_noticia=mysql_query("SELECT * FROM stp_galeria WHERE id=$idnoticia AND url='$urlnoticia';", $conexion);
$fila_noticia=mysql_fetch_array($rst_noticia);
$noticia_titulo=$fila_noticia["titulo"];
$noticia_fecha=$fila_noticia["fecha_publicacion"];

//GALERIA DE FOTOS NOTICIA
$rst_fotos_noticia=mysql_query("SELECT * FROM stp_galeria_slide WHERE noticia=$idnoticia ORDER BY orden ASC;", $conexion);
$num_fotos_noticia=mysql_num_rows($rst_fotos_noticia);

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

<!-- ROYAL SLIDER CSS -->
<link href="libs/royalslider/royalslider.css" rel="stylesheet">
<link href="libs/royalslider/skins/default/rs-default.css" rel="stylesheet">

</head>

<body>

<?php require_once("wg-header.php"); ?>

<section class="limpiar">

	<div class="interior limpiar">

        <div id="section_news" class="galeria">
            	
            <div class="scnw_item">

                <div class="scnwi_categoria">
                    <div class="scnwic_color bggaleria"></div>
                    <div class="scnwic_nombre clgaleria">Galería de Fotos</div>
                </div>
            	
                <div class="scnwi_detalles">
                	
                    <h2><?php echo $noticia_titulo; ?></h2>
                    
                </div>
                
                <div class="scnwi_fecha_social">
                	
                    <div class="scnwifsc_fecha">
                    	<?php echo nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]); ?>
                    </div>
                    
                </div><!-- FIN SECTION NEWS ITEM FECHA SOCIAL -->
                
                <div class="scnwi_imagen">
                    
                    <div id="galeria-noticia" class="royalSlider rsDefault">
                        <?php while($fila_fotos=mysql_fetch_array($rst_fotos_noticia)){
                                $slide_imagen=$fila_fotos["imagen"];
                                $slide_imagen_carpeta=$fila_fotos["imagen_carpeta"];
                        ?>
                        <a class="rsImg" href="imagenes/galeria/<?php echo $slide_imagen_carpeta."".$slide_imagen; ?>">
                            <img width="96" height="72" class="rsTmb" src="imagenes/galeria/<?php echo $slide_imagen_carpeta."thumb/".$slide_imagen; ?>">
                        </a>
                        <?php } ?>
                    </div>

                </div>

                <div class="scnwi_contenido">

                    <div id="disqus_thread"></div>
                    <script type="text/javascript">
                        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                        var disqus_shortname = 'sutep'; // required: replace example with your forum shortname

                        /* * * DON'T EDIT BELOW THIS LINE * * */
                        (function() {
                            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    
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