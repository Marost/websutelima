<?php
//LIBRERIAS
include("libs/ssdtube/SSDTube.php");

//EDICION IMPRESA
$rst_edimpresa=mysql_query("SELECT * FROM stp_portada WHERE fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC", $conexion);
$fila_edimpresa=mysql_fetch_array($rst_edimpresa);
$edimpresa_titulo=$fila_edimpresa["titulo"];
$edimpresa_edicion=$fila_edimpresa["num_edicion"];
$edimpresa_imagen=$fila_edimpresa["imagen"];

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
    	
        <div class="scsdbi_cabecera">La Voz del Magisterio</div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
    		<a href="/revista/<?php echo $edimpresa_edicion; ?>/index.html" target="_blank">
                <img src="imagenes/revista/<?php echo $edimpresa_imagen; ?>" width="270" alt="Portada" title="<?php echo $edimpresa_titulo; ?>">
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
    
    <!-- NOS ESCRIBEN -->
    <div class="scsdb_item">
    	
      	<div class="scsdbi_cabecera">NOS ESCRIBEN</div>
        
   	  	<div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_fnt12 scsdbic_lh120">
        	<div id="wg_cartas">
            	<?php while($fila_cartas=mysql_fetch_array($rst_cartas)){ ?>
            	<div>
                	<p><strong><?php echo $fila_cartas["titulo"]; ?></strong></p>
                    <p><?php echo $fila_cartas["contenido"]; ?></p>
                </div>
                <?php } ?>
            </div>
            <p><a href="cartas" class="todas_cartas">Todas las cartas...</a></p>
            <p class="escribe_cartas">Escribenos a: cartas@sutep.org.pe</p>
      	</div>
        
    </div>
    <!-- FIN NOS ESCRIBEN -->
    
</div><!-- FIN SECTION SIDEBAR -->