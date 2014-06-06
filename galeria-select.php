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

//LISTA DE GALERIA DE FOTOS
$rst_listagaleria=mysql_query("SELECT * FROM stp_galeria WHERE id<>$idnoticia ORDER BY fecha_publicacion DESC", $conexion);

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?php echo stripslashes($noticia_titulo); ?> | <?php echo $web_nombre; ?></title>
<base href="<?php echo $web; ?>" />

<?php require_once("wg-header-script.php"); ?>

<!-- CUTE SLIDER -->
<link rel="stylesheet" href="libs/cuteslider/style/slider-style.css" type="text/css" />
<style>
.wrapper{
    margin:0 auto;
    width:950px;
    position: relative;
}
</style>

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
                    
                    <div class="wrapper" id="wrapper">
                        <div id="slider" class="cute-slider" data-width="610" data-height="400" data-force="" data-shuffle="false">
                            <ul data-type="slides">

                                <?php while($fila_fotos=mysql_fetch_array($rst_fotos_noticia)){
                                    $slide_titulo=$fila_fotos["titulo"];
                                    $slide_imagen=$fila_fotos["imagen"];
                                    $slide_imagen_carpeta=$fila_fotos["imagen_carpeta"];
                                    $slide_imagen_orden=$fila_fotos["orden"];

                                    //URL
                                    $Slider_UrlImg=$web."imagenes/galeria/".$slide_imagen_carpeta."".$slide_imagen;
                                    $Slider_UrlImgThumb=$web."imagenes/galeria/".$slide_imagen_carpeta."thumb/".$slide_imagen;
                                ?>
                                    <?php if($slide_imagen_orden==0){ ?>
                                    <li data-delay="4" data-trans3d="tr4,tr21,tr62" data-trans2d="tr5,tr23,tr30">
                                        <img src="<?php echo $Slider_UrlImg; ?>" data-thumb="<?php echo $Slider_UrlImgThumb; ?>"/>
                                        <div data-type="info" data-align="bottom" class="info1">
                                            <?php echo $slide_titulo; ?>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <?php if($slide_imagen_orden>0){ ?>
                                    <li data-delay="4" data-trans3d="tr4,tr21,tr62" data-trans2d="tr5,tr23,tr30">
                                        <img src="libs/cuteslider/cute-theme/blank.jpg" data-src="<?php echo $Slider_UrlImg; ?>" data-thumb="<?php echo $Slider_UrlImgThumb; ?>"/>
                                        <div data-type="info" data-align="bottom" class="info1">
                                            <?php echo $slide_titulo; ?>
                                        </div>
                                    </li>
                                    <?php } ?>
                                <?php } ?>

                            </ul>
                            <ul data-type="controls">           
                                <li data-type="bartimer"> </li>
                                <li data-type="slideinfo"> </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="scnwi_contenido galeria-lista">

                    <h2>Lista de Galerías de Fotos</h2>

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

<!-- CUTE SLIDER -->
<script src="libs/cuteslider/js/modernizr.js" ></script>
<script src="libs/cuteslider/js/cute/cute.slider.js" ></script>
<script src="libs/cuteslider/js/cute/cute.transitions.all.js" ></script>
<script src="libs/cuteslider/js/cute/cute.gallery.plugin.js" ></script>
<script>
    var slider = new Cute.Slider();
    var gallery = new Cute.CuteGallery();
    
    slider.setup("slider" , "wrapper"); 
    gallery.setup(slider);
    
    slider.pause();
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