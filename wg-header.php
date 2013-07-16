<?php
//SLIDE SUPERIOR
$rst_slide_superior=mysql_query("SELECT * FROM iev_slide_superior WHERE id>0 ORDER BY orden ASC LIMIT 4;", $conexion);

//MENU
$rst_menu_superior=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id>0 AND id<>11 AND id<>12 ORDER BY orden ASC;", $conexion);

?>
<header class="limpiar">

	<div class="interior limpiar">
    
        <div id="header_superior">
        
            <div id="hds_logo">
            	<h1><a>SUTEP</a></h1>
            </div>
            
            <div id="hds_social">
            	<ul>
                	<li><a target="_blank" href="http://???/rss" class="hdssc_rss">RSS</a></li>
                    <li><a target="_blank" href="http://www.youtube.com/user/" class="hdssc_youtube">Youtube</a></li>
                    <li><a target="_blank" href="http://www.facebook.com/" class="hdssc_facebook">Facebook</a></li>
                </ul>
            </div>
            
        </div><!-- FIN HEADER SUPERIOR -->
        
        <div id="header_menu">
        
            <nav>
                <ul>
                    <li><a href="/" title="Inicio">Inicio</a></li>
                    <li><a href="#">Institucional</a></li>
                    <li><a href="#">Sala de Prensa</a></li>
                    <li><a href="#">Comunicaciones</a></li>
                    <li><a href="#">Defensa</a></li>
                    <li><a href="#">Pedagógicos</a></li>
                    <li><a href="#">Galería</a></li>
                    <li><a href="#">SUTEP RTV</a></li>
                </ul>
            </nav>
        
        </div><!-- FIN HEADER MENU -->
        
        <div id="header_slide">
        	
            <div id="slider1">
            	<?php while($fila_slide_superior=mysql_fetch_array($rst_slide_superior)){
						$titulo_slidesup=$fila_slide_superior["titulo"];
						$imagen_slidesup=$fila_slide_superior["imagen"];
						$carpeta_slidesup=$fila_slide_superior["carpeta_imagen"];
				?>
                <div><img src="../imagenes/upload/<?php echo $carpeta_slidesup."".$imagen_slidesup; ?>" width="990" height="230" alt="<?php echo $titulo_slidesup; ?>"></div>
                <?php } ?>         
           </div>
            
        </div><!-- FIN HEADER SLIDE -->
        
    </div><!-- FIN INTERIOR -->
    
</header><!-- FIN HEADER -->