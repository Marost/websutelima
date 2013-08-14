<?php
include("panel@sutep/conexion/conexion.php");
include("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//VARIABLES
$idnoticia=$_REQUEST["id"];
$urlnoticia=$_REQUEST["url"];

//NOTICIA
$rst_noticia=mysql_query("SELECT * FROM stp_videos WHERE id=$idnoticia AND url='$urlnoticia';", $conexion);
$fila_noticia=mysql_fetch_array($rst_noticia);
$noticia_titulo=$fila_noticia["titulo"];
$noticia_fecha=$fila_noticia["fecha_publicacion"];
$noticia_imagen=$fila_noticia["imagen"];
$noticia_imagen_carpeta=$fila_noticia["imagen_carpeta"];
$noticia_video=$fila_noticia["video"];

//TIPO NOTICIA
$noticia_tipo=$fila_noticia["destacada"];

//URLS
$noticia_web=$web."noticia/".$idnoticia."-".$urlnoticia;
$noticia_web_img=$web."imagenes/upload/".$noticia_imagen_carpeta."".$noticia_imagen;

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

        <div id="section_news">
            	
            <div class="scnw_item">
            	
                <div class="scnwi_categoria">
                	<div class="scnwic_color bgnoticias"></div>
                    <div class="scnwic_nombre clnoticias">SUTEP RTV</div>
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
                    
                    <iframe width="620" height="350" src="//www.youtube.com/embed/<?php echo $notInf_video; ?>?rel=0" frameborder="0" allowfullscreen></iframe>

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
        
        <?php require_once("wg-sidebar.php"); ?>

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