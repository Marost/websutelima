<?php
//LIBRERIAS
include("libs/ssdtube/SSDTube.php");

//EDICION IMPRESA
$rst_edimpresa=mysql_query("SELECT * FROM stp_portada ORDER BY id DESC", $conexion);
$fila_edimpresa=mysql_fetch_array($rst_edimpresa);
$edimpresa_id=$fila_edimpresa["id"];
$edimpresa_url=$fila_edimpresa["url"];
$edimpresa_titulo=$fila_edimpresa["titulo"];
$edimpresa_edicion=$fila_edimpresa["num_edicion"];
$edimpresa_imagen=$fila_edimpresa["imagen"];
$edimpresa_imagen_carpeta=$fila_edimpresa["imagen_carpeta"];

//URLS
$edimpresa_web=$web."edicion/virtual/".$edimpresa_id."/".$edimpresa_url;
$edimpresa_Img=$web."imagenes/upload/".$edimpresa_imagen_carpeta."".$edimpresa_imagen;

//VIDEOS
$rst_videos=mysql_query("SELECT * FROM stp_videos WHERE fecha_publicacion<='$fechaActual' AND publicar=1 ORDER BY fecha_publicacion DESC;", $conexion);

//GALERIA PRINCIPAL
$rst_galeria_prin=mysql_query("SELECT * FROM stp_galeria WHERE fecha_publicacion<='$fechaActual' AND publicar=1 ORDER BY fecha_publicacion DESC;", $conexion);

//BLOG DE LOS SECTORES
$rst_enlace_blog=mysql_query("SELECT * FROM stp_enlace_blog ORDER BY id ASC;", $conexion);

//ENLACES DE INTERES
$rst_enlace_interes=mysql_query("SELECT * FROM stp_enlace_interes ORDER BY id ASC;", $conexion);

?>
<div id="section_sidebar">

    <!-- EDICION DEL MES -->
    <div class="scsdb_item">

        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
            <a href="http://issuu.com/sute_lima/docs/sutep-lima-noviembre" target="_blank">
                <img class="borde-portada-imagen" width="270" src="/imagenes/revista/revista-04.jpg" alt="Portada">
            </a>
        </div>

    </div>

    <!-- EDICION DEL MES -->
    <div class="scsdb_item">

        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
            <a href="http://issuu.com/sute_lima/docs/sute_libro" target="_blank">
                <img class="borde-portada-imagen" width="270" src="/imagenes/revista/revista-02.jpg" alt="Portada">
            </a>
        </div>

    </div>

    <!-- EDICION DEL MES -->
  	<div class="scsdb_item">

        <!-- POPUP -->
        <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
        <script>
            var jPortada = jQuery.noConflict();
            jPortada(document).on("ready", init);

            function init(){
                jPortada("#portada-imagen").on("click", function(){
                    window.open("<?php echo $edimpresa_web; ?>","revista","width=1000,height=625");
                })
            }
        </script>
    	
        <div class="scsdbi_cabecera">La Voz del Magisterio</div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
            <a href="javascript:;" id="portada-imagen">
                <img class="borde-portada-imagen" width="270" src="<?php echo $edimpresa_Img; ?>" alt="Portada">
            </a>
        </div>
        
    </div>
    <!-- FIN EDICION DEL MES -->
        
    <!-- GALERIA DE IMAGENES -->
    <div class="scsdb_item">
    	
      	<div class="scsdbi_cabecera">GALERÍA DE IMAGENES</div>
        
      	<div class="scsdbi_contenido scsdbic_ancho290 scsdbic_pTop0 scsdbic_pLeft0 scsdbic_pBottom0 scsdbic_pRight0">

            <a href="javascript:;" class="galarrow-prev" id="galimg-prev">Prev</a>
            <a href="javascript:;" class="galarrow-next" id="galimg-next">Next</a>

        	<div id="galeria-img" class="galeria-sidebar royalSlider rsDefault visibleNearby">
                
                <?php while($fila_galeria_prin=mysql_fetch_array($rst_galeria_prin)){
                        $galeriPrin_id=$fila_galeria_prin["id"];
                        $galeriPrin_url=$fila_galeria_prin["url"];
                        $galeriPrin_titulo=$fila_galeria_prin["titulo"];
                        $galeriPrin_urlWeb=$web."galeria/".$galeriPrin_id."-".$galeriPrin_url;
                        
                        //SELECCION DE IMAGEN
                        $rst_galImg=mysql_query("SELECT * FROM stp_galeria_slide WHERE noticia=$galeriPrin_id AND orden=0", $conexion);
                        $fila_galImg=mysql_fetch_array($rst_galImg);

                        $galeriPrin_imagen=$fila_galImg["imagen"];
                        $galeriPrin_imagen_carpeta=$fila_galImg["imagen_carpeta"];
                ?>

                <div>
                    <img class="rsImg" src="imagenes/galeria/<?php echo $galeriPrin_imagen_carpeta."".$galeriPrin_imagen; ?>" alt="<?php echo $galeriPrin_titulo; ?>" />
                    <figure class="rsCaption">
                        <a href="<?php echo $galeriPrin_urlWeb; ?>" title="">
                            <?php echo $galeriPrin_titulo; ?>
                        </a>
                    </figure>
                </div>
                
                <?php } ?>

            </div>
        </div>
        
    </div>
    <!-- GALERIA DE IMAGENES -->
    
    <!-- VIDEOS -->
    <div class="scsdb_item">
    	
      	<div class="scsdbi_cabecera">VIDEOS</div>
        
   	  	<div class="scsdbi_contenido scsdbic_ancho290 scsdbic_pTop0 scsdbic_pLeft0 scsdbic_pBottom0 scsdbic_pRight0">

            <a href="javascript:;" class="galarrow-prev" id="galvid-prev">Prev</a>
            <a href="javascript:;" class="galarrow-next" id="galvid-next">Next</a>
            
            <div id="galeria-vid" class="galeria-sidebar royalSlider rsDefault visibleNearby" >
                
                <?php while($fila_videos=mysql_fetch_array($rst_videos)){
                        $galeriPrin_titulo=$fila_videos["titulo"];
                        $galeriPrin_video=$fila_videos["video"];
                        $galeriPrin_imagen=$fila_videos["imagen"];
                        $galeriPrin_imagen_carpeta=$fila_videos["imagen_carpeta"];                        
                ?>

                <div>
                    <img class="rsImg" src="imagenes/upload/<?php echo $galeriPrin_imagen_carpeta."".$galeriPrin_imagen; ?>" 
                    alt="<?php echo $galeriPrin_titulo; ?>"
                    data-rsVideo="http://www.youtube.com/watch?v=<?php echo $galeriPrin_video; ?>"/>
                    <figure class="rsCaption"><?php echo $galeriPrin_titulo; ?></figure>
                </div>
                
                <?php } ?>

            </div>
            
      	</div>
        
    </div>
    <!-- FIN VIDEOS -->

    <!-- BLOGS DE INTERES -->
    <div class="scsdb_item">
        
        <div class="scsdbi_cabecera">BLOGS DE LOS SECTORES</div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_fnt12 scsdbic_lh120">
            <?php while($fila_enlace_blog=mysql_fetch_array($rst_enlace_blog)){
                    $blog_titulo=$fila_enlace_blog["titulo"];
                    $blog_enlace=$fila_enlace_blog["enlace"];
                    $blog_imagen=$fila_enlace_blog["imagen"];
                    $blog_imagen_carpeta=$fila_enlace_blog["imagen_carpeta"];
                    $blog_UrlImg=$web."imagenes/upload/".$blog_imagen_carpeta."".$blog_imagen;
            ?>
            <?php if($blog_imagen==""){ ?>
            <p><a target="_blank" href="<?php echo $blog_enlace; ?>" class="todas_cartas"><?php echo $blog_titulo; ?></a></p>
            <?php }else{ ?>
            <p><a target="_blank" href="<?php echo $blog_enlace; ?>"><img src="<?php echo $blog_UrlImg; ?>" alt="<?php echo $blog_titulo; ?>"></a></p>
            <?php } } ?>            
        </div>
        
    </div>
    <!-- FIN BLOGS DE INTERES -->

    <!-- ENLACES DE INTERES -->
    <div class="scsdb_item">
        
        <div class="scsdbi_cabecera">ENLACES DE INTERES</div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_fnt12 scsdbic_lh120">
            <?php while($fila_enlace_interes=mysql_fetch_array($rst_enlace_interes)){
                    $interes_titulo=$fila_enlace_interes["titulo"];
                    $interes_enlace=$fila_enlace_interes["enlace"];
                    $interes_imagen=$fila_enlace_interes["imagen"];
                    $interes_imagen_carpeta=$fila_enlace_interes["imagen_carpeta"];
                    $interes_UrlImg=$web."imagenes/upload/".$interes_imagen_carpeta."".$interes_imagen;
            ?>
            <?php if($interes_imagen==""){ ?>
            <p><a target="_blank" href="<?php echo $interes_enlace; ?>" class="todas_cartas"><?php echo $interes_titulo; ?></a></p>
            <?php }else{ ?>
            <p><a target="_blank" href="<?php echo $interes_enlace; ?>"><img src="<?php echo $interes_UrlImg; ?>" alt="<?php echo $interes_titulo; ?>"></a></p>
            <?php } } ?>            
        </div>
        
    </div>
    <!-- FIN ENLACES DE INTERES -->
    
</div><!-- FIN SECTION SIDEBAR -->