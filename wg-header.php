<?php
//NOTICIA DESTACADA
$rst_nota_dest=mysql_query("SELECT * FROM stp_noticia WHERE fecha_publicacion<='$fechaActual' AND destacada=1 AND publicar=1 ORDER BY fecha_publicacion DESC LIMIT 4", $conexion);

//MENU
$rst_menu_superior=mysql_query("SELECT * FROM stp_noticia_categoria WHERE id>0 AND id<>11 AND id<>12 ORDER BY orden ASC;", $conexion);

?>
<header class="limpiar">

    <div class="header-datos">

        <div class="interior limpiar">
            
            <ul>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Contáctanos</a></li>
                <li><a href="#">Correos</a></li>
                <li>SUTEP: Jr. Camaná 550 - Lima Centro | Telf.: 427-66-77</li>
            </ul>

        </div>
        
    </div><!-- FIN HEADER DATOS -->

	<div class="interior limpiar">
    
        <div id="header_superior">
        
            <div id="hds_logo">
            	<h1><a href="/">SUTEP</a></h1>
            </div>

            <div id="header_menu">
        
                <nav>
                    <ul>
                        <li><a href="/" title="Inicio">Inicio</a></li>
                        <li><a href="#">Noticias</a></li>
                        <li><a href="#">Pedagógicos</a></li>
                        <li><a href="galeria-fotos">Galería</a></li>
                        <li><a href="institucional">Institucional</a></li>
                    </ul>
                </nav>
            
            </div><!-- FIN HEADER MENU -->
            
            <div id="hds_social">
            	<ul>
                	<li><a target="_blank" href="http://???/rss" class="hdssc_rss">RSS</a></li>
                    <li><a target="_blank" href="http://www.youtube.com/user/" class="hdssc_youtube">Youtube</a></li>
                    <li><a target="_blank" href="http://www.facebook.com/" class="hdssc_facebook">Facebook</a></li>
                </ul>
            </div>
            
        </div><!-- FIN HEADER SUPERIOR -->
        
        <?php if($wg_slide==true){ ?>

        <div id="header_slide">

            <a href="javascript:;" id="slider-prev">Prev</a>
            <a href="javascript:;" id="slider-next">Next</a>
        	
            <div id="slider-principal" class="royalSlider">
                
                <?php while($fila_nota_dest=mysql_fetch_array($rst_nota_dest)){
                        $notDest_id=$fila_nota_dest["id"];
                        $notDest_url=$fila_nota_dest["url"];
                        $notDest_titulo=$fila_nota_dest["titulo"];
                        $notDest_contenido=soloDescripcion($fila_nota_dest["contenido"]);
                        $notDest_imagen=$fila_nota_dest["imagen"];
                        $notDest_imagen_carpeta=$fila_nota_dest["imagen_carpeta"];

                        //URL
                        $notDest_urlWeb=$web."noticia/".$notDest_id."-".$notDest_url;
                        $notDest_urlImg=$web."imagenes/upload/".$notDest_imagen_carpeta."".$notDest_imagen;
                ?>

                <div>
                    <img width="990" height="460" class="rsImg" src="<?php echo $notDest_urlImg; ?>" alt="<?php echo $notDest_titulo; ?>" />
                    <figure class="rsCaption">
                        <a href="<?php echo $notDest_urlWeb; ?>" title="<?php echo $notDest_titulo; ?>">
                            <?php echo $notDest_titulo; ?></a>
                        <p><?php echo $notDest_contenido; ?></p>
                    </figure>
                </div>

                <?php } ?>
                
            </div>
            
        </div><!-- FIN HEADER SLIDE -->

        <?php } ?>
        
    </div><!-- FIN INTERIOR -->
    
</header><!-- FIN HEADER -->