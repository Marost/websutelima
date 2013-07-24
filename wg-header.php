<?php
//SLIDE SUPERIOR
$rst_slide_superior=mysql_query("SELECT * FROM stp_slide_superior WHERE id>0 ORDER BY orden ASC LIMIT 4;", $conexion);

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
            	<h1><a>SUTEP</a></h1>
            </div>

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
                        <li><a class="cat-destac" href="#">SUTEP RTV</a></li>
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
        	
            <div id="slider-principal" class="royalSlider">

                <div>
                    <img width="990" height="460" class="rsImg" src="imagenes/upload/imagen1.jpg" alt="" />
                    <figure class="rsCaption">Cras pulvinar sociis ac, odio amet, tortor scelerisque. Ut velit, mauris nisi, placerat penatibus vel phasellus pulvinar sagittis habitasse etiam? Risus?</figure>
                </div>

                <div>
                    <img width="990" height="460" class="rsImg" src="imagenes/upload/imagen2.jpg" alt="" />
                    <figure class="rsCaption">This caption text will be used.</figure>
                </div>

                <div>
                    <img width="990" height="460" class="rsImg" src="imagenes/upload/imagen3.jpg" alt="" />
                    <figure class="rsCaption">This caption will be used.</figure>
                </div>

                <div>
                    <img width="990" height="460" class="rsImg" src="imagenes/upload/imagen4.jpg" alt="" />
                    <figure class="rsCaption">This caption be used.</figure>
                </div>               

            </div>
            
        </div><!-- FIN HEADER SLIDE -->

        <?php } ?>
        
    </div><!-- FIN INTERIOR -->
    
</header><!-- FIN HEADER -->