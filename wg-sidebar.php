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

//CARTAS
$rst_cartas=mysql_query("SELECT * FROM stp_cartas WHERE estado='A' AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 5", $conexion);

//SALUDOS
$rst_saludos=mysql_query("SELECT * FROM stp_saludos WHERE id>0 AND estado_saludo='A' ORDER BY fecha DESC LIMIT 12", $conexion);

//VIDEOS
$rst_videos=mysql_query("SELECT * FROM stp_videos WHERE fecha_publicacion<='$fechaActual' AND publicar=1 ORDER BY fecha_publicacion DESC;", $conexion);

//GALERIA PRINCIPAL
$rst_galeria_prin=mysql_query("SELECT * FROM stp_galeria WHERE fecha_publicacion<='$fechaActual' AND publicar=1 ORDER BY fecha_publicacion DESC;", $conexion);

?>
<div id="section_sidebar">
    
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
            <p><a target="_blank" href="http://sutelima.blogspot.com/" class="todas_cartas">www.sutelima.blogspot.com</a></p>
            <p><a target="_blank" href="http://sutevisector.blogspot.com/" class="todas_cartas">www.sutevisector.blogspot.com</a></p>
            <p><a target="_blank" href="http://suteprovincialtrujillo.blogspot.com" class="todas_cartas">www.suteprovincialtrujillo.blogspot.com</a></p>
            <p><a target="_blank" href="http://sutepregionalarequipa.blogspot.com" class="todas_cartas">www.sutepregionalarequipa.blogspot.com</a></p>
            <p><a target="_blank" href="http://sutebrena.blogspot.com" class="todas_cartas">www.sutebrena.blogspot.com</a></p>
            <p><a target="_blank" href="http://sutevisector.blogspot.com" class="todas_cartas">www.sutevisector.blogspot.com</a></p>
            <p><a target="_blank" href="http://sutexsector.blogspot.com" class="todas_cartas">www.sutexsector.blogspot.com</a></p>
            <p><a target="_blank" href="http://www.sutexi.blogspot.com" class="todas_cartas">www.www.sutexi.blogspot.com</a></p>
            <p><a target="_blank" href="http://www.sutexiii.blogspot.com" class="todas_cartas">www.www.sutexiii.blogspot.com</a></p>
            <p><a target="_blank" href="http://sute16.blogspot.com" class="todas_cartas">www.sute16.blogspot.com</a></p>
            <p><a target="_blank" href="http://bauldocente.pe/"><img src="http://www.derrama.org.pe/RepositorioAPS/banners/29/banner_inferior_BAUL.png"></a></p>
        </div>
        
    </div>
    <!-- FIN BLOGS DE INTERES -->

    <!-- ENLACES DE INTERES -->
    <div class="scsdb_item">
        
        <div class="scsdbi_cabecera">ENLACES DE INTERES</div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_fnt12 scsdbic_lh120">
            <p><a target="_blank" href="http://www.peru.gob.pe/" class="todas_cartas">Portal de Estado Peruano</a></p>
            <p><a target="_blank" href="http://www.derrama.org.pe/principal" class="todas_cartas">Derrama Magisterial</a></p>
            <p><a target="_blank" href="http://minedu.gob.pe/" class="todas_cartas">Ministerio de Educación</a></p>
            <p><a target="_blank" href="http://www.cafae-se.com.pe/web/index.html" class="todas_cartas">CAFAE</a></p>
        </div>
        
    </div>
    <!-- FIN ENLACES DE INTERES -->
    
</div><!-- FIN SECTION SIDEBAR -->