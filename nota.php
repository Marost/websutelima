<?php
include("panel@impacto/conexion/conexion.php");
include("panel@impacto/conexion/funciones.php");
require_once("libs/youtube/youtube.class.php");

//VARIABLES
$idnoticia=$_REQUEST["id"];
$urlnoticia=$_REQUEST["url"];

//VIDEO TITULO
$rst_videos_sup=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);
$num_videos_sup=mysql_num_rows($rst_videos_sup);

//VIDEO TITULO
$rst_videos_inf=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);

//FUNCION CARGAR TEXTO VIDEO
function multVideo($idnoticia, $conexion){
	$rst_query=mysql_query("SELECT * FROM iev_noticia WHERE id=".$idnoticia."", $conexion);
	$fila_query=mysql_fetch_array($rst_query);
	if($fila_query["mostrar_video"]==1){ $texto="Video - ";}
	return $texto;
}

function multFotos($idnoticia, $conexion){
	$rst_query=mysql_query("SELECT * FROM iev_noticia_slide WHERE noticia=".$idnoticia."", $conexion);
	$num_query=mysql_num_rows($rst_query);
	if($num_query>0){ $texto="Fotos - ";}
	return $texto;
}

//CARTAS
$rst_cartas=mysql_query("SELECT * FROM iev_cartas WHERE estado='A' AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 5", $conexion);

//SALUDOS
$rst_saludos=mysql_query("SELECT * FROM iev_saludos WHERE id>0 AND estado_saludo='A' ORDER BY fecha DESC LIMIT 12", $conexion);

//GALERIA PRINCIPAL
$rst_galeria_prin=mysql_query("SELECT * FROM iev_galeria WHERE id>0 ORDER BY id DESC;", $conexion);

//FOTOS DE GALERIA
function fotoGaleria($idgaleria, $conexion){
	$rst_query=mysql_query("SELECT * FROM iev_galeria_slide WHERE id>0 AND noticia=$idgaleria ORDER BY orden ASC;", $conexion);
	return $fila_query=mysql_fetch_array($rst_query);
}

//MENU
$rst_menu_superior=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id>0 AND id<>11 AND id<>12 ORDER BY orden ASC;", $conexion);

//NOTICIA
$rst_noticia=mysql_query("SELECT * FROM iev_noticia WHERE id=$idnoticia AND url='$urlnoticia';", $conexion);
$fila_noticia=mysql_fetch_array($rst_noticia);
$noticia_titulo=$fila_noticia["titulo"];
$noticia_categoria=$fila_noticia["categoria"];
$noticia_fecha=$fila_noticia["fecha_publicacion"];
$noticia_contenido=$fila_noticia["contenido"];
$noticia_imagen=$fila_noticia["imagen"];
$noticia_imagen_carpeta=$fila_noticia["carpeta_imagen"];
$noticia_imagen_mostrar=$fila_noticia["mostrar_imagen"];
$noticia_video=$fila_noticia["video"];
$noticia_video_mostrar=$fila_noticia["mostrar_video"];
$noticia_video_carpeta=$fila_noticia["carpeta_video"];
$noticia_video_tipo=$fila_noticia["tipo_video"];
$noticia_comentarios=$fila_noticia["comentarios"];
$num_noticia=mysql_num_rows($rst_noticia);
if($num_noticia==0){ header("Location: ".$web);}

//GALERIA DE FOTOS NOTICIA
$rst_fotos_noticia=mysql_query("SELECT * FROM iev_noticia_slide WHERE noticia=$idnoticia ORDER BY orden ASC;", $conexion);
$num_fotos_noticia=mysql_num_rows($rst_fotos_noticia);

//COMENTARIO NOTICIA
$rst_comentario=mysql_query("SELECT * FROM iev_noticia_comentario WHERE noticia=$idnoticia AND estado_comentario='A'", $conexion);
$num_comentario=mysql_num_rows($rst_comentario);

//COMENTAR NOTICIA
$proceso=$_POST["proceso"];
if($proceso=="comentar"){
	$id_comentario=$_POST["identificador"];
	$nombres_comentario=$_SESSION["userimpevnmweb_nombre"]." ".$_SESSION["userimpevnmweb_apellidos"];
	$email_comentario=$_SESSION["userimpevnmweb_email"];
	$comentario=eliminarTexto($_POST["mensaje"]);
	$fecha_comentario=date('Y-m-d');
	$hora_comentario= date('H:i');
	$est_comment="I";
	$rst_guradar_comentario=mysql_query("INSERT INTO iev_noticia_comentario (nombre, email, comentario, fecha, hora, noticia, estado_comentario) VALUES ('$nombres_comentario', '$email_comentario', '$comentario', '$fecha_comentario', '$hora_comentario', $id_comentario, '$est_comment')", $conexion);	
	header("Location: ".$web."noticia/".$idnoticia."-".$urlnoticia);
}

//CONTADOR DE VISITAS
$contador_noticia=$fila_noticia["identificador"];
$ip_usuario=getRealIP();
$fecha_usuario=date("Y-m-d");
$hora_usuario=date("H:i");
$horau_usuario=date("H");
$diau_usuario=date("z");
$rst_contador=mysql_query("SELECT * FROM iev_noticia_contador WHERE noticia='$contador_noticia' LIMIT 1;", $conexion);
$fila_contador=mysql_fetch_array($rst_contador);
$num_contador=$fila_contador["contador"] + 1;
$visita_cantidad=$fila_noticia["cantidad_visitas"];
if($fila_contador["ip"]!="$ip_usuario" || $fila_contador["horau"]!=$horau_usuario || $fila_contador["diau"]!=$diau_usuario){
	$visita_aumentar=$visita_cantidad + 1;
	mysql_query("UPDATE iev_noticia_contador SET ip='$ip_usuario', fecha='$fecha_usuario', hora='$hora_usuario', horau=$horau_usuario, diau=$diau_usuario, contador=$num_contador 
	WHERE noticia='$contador_noticia';", $conexion);
	mysql_query("UPDATE iev_noticia SET cantidad_visitas=$visita_aumentar WHERE id=$idnoticia", $conexion);
}

//EDICION IMPRESA
$rst_edimpresa=mysql_query("SELECT * FROM iev_edicion WHERE fecha_publicacion<='$fechaActual' ORDER BY id DESC", $conexion);
$fila_edimpresa=mysql_fetch_array($rst_edimpresa);
$edimpresa_numero=$fila_edimpresa["titulo"];
$edimpresa_nombre=$fila_edimpresa["nombre_edicion"];
$edimpresa_imagen=$fila_edimpresa["imagen"];

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<title><?php echo stripslashes($noticia_titulo); ?> | Impacto Evangelistico</title>
<base href="<?php echo $web; ?>" />
<link rel="image_src" href="<?php echo $web."imagenes/upload/".$noticia_imagen_carpeta."".$noticia_imagen; ?>" >
<link href="css/estilos_v312.css" rel="stylesheet" type="text/css">
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/clases.css" rel="stylesheet" type="text/css">

<!-- SLIDER -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="libs/bxslider/jquery.bxSlider.min.js"></script><script type="text/javascript">
var jbx = jQuery.noConflict();
jbx(document).ready(function(){
	jbx('#wg_cartas').bxSlider({
		auto: true,
		pause: 15000
	});
	jbx('.scsdbic_ctdSaludos').bxSlider({
		auto: true,
		pause: 10000,
		displaySlideQty: 3,
		moveSlideQty: 3,
		mode: 'vertical'
	});
});
</script>

<!-- WIDGET COMENTARIOS VISITAS -->
<script src="js/jquery.tools.min.1.2.5.js"></script>
<script type="text/javascript">
var jcv = jQuery.noConflict();
jcv(function(){
	jcv("#scsdbic_video_items ul").tabs("#scsdbic_video_select > div", {effect: 'fade', fadeOutSpeed: 400});
});
</script>

<!-- VIDEOS -->
<script src="js/flowplayer-3.2.6.min.js"></script>

<!-- GALERIA DE FOTOS -->
<link rel="stylesheet" href="css/svwp_style.css" type="text/css" media="screen" />
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script> 
<script src="js/jquery.slideViewerPro.1.0.js" type="text/javascript"></script>
<script type="text/javascript">
var jgalweb = jQuery.noConflict();
jgalweb(document).ready(function(){
    jgalweb("div#pgaleria").slideViewerPro({
		thumbs: 3, 
		thumbsPercentReduction: 20,
		thumbsTopMargin: 5,
		thumbsRightMargin: 5,
		thumbsBorderWidth: 2,
		thumbsActiveBorderColor: "red",
		thumbsActiveBorderOpacity: 0.5,
		thumbsBorderOpacity: 0,
		buttonsTextColor: "#000",
		typo: true
	});
});
</script>

<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/html5.js"></script>
    <link href="css/ie.css" rel="stylesheet" type="text/css">
<![endif]-->

<!-- GOOGLE -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20229980-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</head>

<body>

<header class="limpiar">

	<div class="interior limpiar">
    
        <div id="header_superior">
        
            <div id="hds_logo">
            	<h1><a>Impacto Evangelistico</a></h1>
            </div>
            
            <div id="hds_social">
            	<ul>
                	<li><a target="_blank" href="http://impactoevangelistico.net/rss" class="hdssc_rss">RSS</a></li>
                    <li><a target="_blank" href="http://www.youtube.com/user/bethelcomunicaciones" class="hdssc_youtube">Youtube</a></li>
                    <li><a target="_blank" href="http://www.facebook.com/impactoevangelistico" class="hdssc_facebook">Facebook</a></li>
                </ul>
            </div>
            
        </div><!-- FIN HEADER SUPERIOR -->
        
        <div id="header_menu">
        
            <nav>
                <ul>
                    <li><a href="/home" title="Inicio">Inicio</a></li>
                    <li><a href="categoria/11/portada">Portada</a></li>
                    <li><a href="categoria/12/noticias">Noticias</a></li>
                    <li><a href="editorial">Editorial</a></li>
                    <?php while($fila_menu_superior=mysql_fetch_array($rst_menu_superior)){
                            $url_categoria=$fila_menu_superior["url"];
                            $id_categoria=$fila_menu_superior["id"];
                            $nombre_categoria=$fila_menu_superior["categoria"];
                    ?>
                    <li><a href="categoria/<?php echo $id_categoria."/".$url_categoria ?>" title="<?php echo $nombre_categoria; ?>">
                        <?php echo $nombre_categoria; ?></a></li>
                    <?php } ?>
                </ul>
            </nav>
        
        </div><!-- FIN HEADER MENU -->
                
    </div><!-- FIN INTERIOR -->
    
</header><!-- FIN HEADER -->

<section class="limpiar">

	<div class="interior limpiar">

        <div id="section_news">
        	
            <?php
			//FECHA PUBLICACION
			$fechaPubNoticiaInf=$noticia_fecha;
			$fechaNoticia=explode(" ", $fechaPubNoticiaInf);
			$fechaExpNoticia=explode("-", $fechaNoticia[0]);
						
			//CATEOGRIA
			$rst_noticia_cateogia=mysql_query("SELECT * FROM iev_noticia_categoria WHERE id=$noticia_categoria;", $conexion);
			$fila_noticia_categoria=mysql_fetch_array($rst_noticia_cateogia);
			
			//VARIABLES CATEGORIA
			$categoriaInf_id=$fila_noticia_categoria["id"];
			$categoriaInf_url=$fila_noticia_categoria["url"];
			$categoriaInf_titulo=$fila_noticia_categoria["categoria"];
            ?>
            	
            <div class="scnw_item">
            	
                <div class="scnwi_categoria">
                	<div class="scnwic_color bg<?php echo $categoriaInf_url; ?>"></div>
                    <div class="scnwic_nombre cl<?php echo $categoriaInf_url; ?>"><span>[</span> <?php echo $categoriaInf_titulo; ?> <span>]</span></div>
                </div>
                
                <div class="scnwi_detalles">
                	
                    <h2><?php echo $noticia_titulo; ?></h2>
                    
                </div>
                
                <div class="scnwi_fecha_social">
                	
                    <div class="scnwifsc_fecha">
                    	<?php echo nombreFechaTotal($fechaExpNoticia[0],$fechaExpNoticia[1],$fechaExpNoticia[2]); ?>
                    </div>
                    
                    <div class="scnwifsc_social">
                    	
                        <div class="scnwifscs_twitter">
                            
                            <a href="https://twitter.com/share" 
                            class="twitter-share-button" 
                            data-url="http://impactoevangelistico.net/noticia/<?php echo $idnoticia."-".$urlnoticia; ?>" 
                            data-text="Impacto Evangelístico" 
                            data-lang="es" data-hashtags="Impacto_Evangel">Twittear</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            
                        </div><!-- NOTWEB TWITTER -->
                        
                        <div class="scnwifscs_facebook">
                            
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=217179171676130";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
    
                            <div class="fb-like" 
                            data-href="http://impactoevangelistico.net/noticia/<?php echo $idnoticia."-".$urlnoticia; ?>" 
                            data-send="false" 
                            data-layout="button_count" 
                            data-width="120" data-show-faces="false"></div>
                            
                        </div><!-- NOTWEB FACEBOOK -->
                        
                        <div class="scnwifscs_facebook">
                        	<a href="http://www.facebook.com/sharer.php?u=http://impactoevangelistico.net/noticia/<?php echo $idnoticia."-".$urlnoticia; ?>&t=<?php echo $noticia_titulo; ?>" target="blank"><img src="imagenes/compartirfb.jpg" width="82" height="18" alt="Compartir"></a>
                        </div><!-- NOTWEB FACEBOOK -->
                    
                    </div>
                    
                </div><!-- FIN SECTION NEWS ITEM FECHA SOCIAL -->
                
                <div class="scnwi_imagen">
                    	<img src="imagenes/upload/<?php echo $noticia_imagen_carpeta."".$noticia_imagen; ?>" width="99%" alt="<?php echo $noticia_titulo; ?>">
                </div>
                
                <div class="scnwi_contenido padding_b10 texto_t12 texto_8C272D">
                    <?php echo cortarTextoRH($noticia_contenido,1,0,150); ?>
                </div>
                
                <div class="scnwi_contenido">
                    <?php echo cortarTextoRH($noticia_contenido,0,1,0); ?>
                </div>
                
            </div><!-- FIN SECTION NEWS ITEM -->
                        
        </div><!-- FIN SECTION NEWS -->
        
        <div id="section_sidebar">
        	
          	<div class="scsdb_item">
            	
                <div class="scsdbi_cabecera">EDICIÓN DEL MES</div>
                
                <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
				<a href="/revista/<?php echo $edimpresa_numero; ?>/index.html" target="_blank"><img src="imagenes/revista/<?php echo $edimpresa_imagen; ?>" width="239" height="320" alt="Portada" title="<?php echo $edimpresa_nombre; ?>"></a></div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
            <div class="scsdb_item">
            	
                <div class="scsdbi_cabecera">
                	<a href="edicion_anterior">
                    EDICIONES ANTERIORES</a></div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
            <div class="scsdb_item">
            	
                <div class="scsdbi_cabecera">ENVIA TUS SALUDOS</div>
                
              	<div class="scsdbi_contenido scsdbic_ancho290 scsdbic_pTop0 scsdbic_pLeft0 scsdbic_pBottom0 scsdbic_pRight0">
				
                <div id="wg_saludos">
                    <div class="scsdbic_ctdSaludos">
                        <?php while($fila_saludos=mysql_fetch_array($rst_saludos)){ ?>
                        <div>
                            <p><strong><?php echo $fila_saludos["nombre"]; ?>:</strong> <?php echo $fila_saludos["contenido"]; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                    
                <div class="scsdbic_btnSaludos"><a href="http://impactoevangelistico.net/saludos">Clic aquí</a></div>
                    
                </div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
            <div class="scsdb_item">
            	
              	<div class="scsdbi_cabecera">GALERÍA DE IMAGENES</div>
                
              	<div class="scsdbi_contenido scsdbic_ancho290 scsdbic_pTop0 scsdbic_pLeft0 scsdbic_pBottom0 scsdbic_pRight0">
                	<div id="pgaleria" class="svwp">
                        <ul>
                            <?php while($fila_galeria_prin=mysql_fetch_array($rst_galeria_prin)){
                                    $fotoGaleria=fotoGaleria($fila_galeria_prin["id"], $conexion);
                            ?>
                            <li><a href="galeria/<?php echo $fila_galeria_prin["id"]."-".$fila_galeria_prin["url"]; ?>" title="<?php echo $fila_galeria_prin["titulo"]; ?>">
                                <img width="290" height="210" src="imagenes/galeria/<?php echo $fotoGaleria["carpeta"]."thumb/".$fotoGaleria["imagen"]; ?>" alt="<?php echo $fila_galeria_prin["titulo"]; ?>" /></a></li>
                            <?php } ?>
                        </ul>
                    </div><!-- GALERIA WEB GALERIA -->
                </div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
            <div class="scsdb_item">
            	
              	<div class="scsdbi_cabecera">VIDEOS</div>
                
           	  	<div class="scsdbi_contenido scsdbic_ancho290 scsdbic_pTop0 scsdbic_pLeft0 scsdbic_pBottom0 scsdbic_pRight0">
                    
                    <div id="scsdbic_video_select">
						<?php while($fila_videos_sup=mysql_fetch_array($rst_videos_sup)){ ?>
                            <div>
                                <div class="pvids_imagen">
                                <style type="text/css">
                                    .player{ width:290px; height:193px; float:left; cursor:pointer;}
                                    .player img{ margin-left:105px; margin-top:56px; }
                                </style>
                                <?php echo 
                                    tipoVideo($fila_videos_sup["tipo_video"], 
                                    $fila_videos_sup["carpeta_video"],
                                    $fila_videos_sup["video"],
                                    $fila_videos_sup["imagen"],
                                    $fila_videos_sup["carpeta_imagen"]."thumb/",
                                    $fila_videos_sup["id"], 290, 193, $web) ?>
                                  </div>
                                  <div class="pvids_descripcion">
                                    <p><?php echo stripslashes($fila_videos_sup["titulo"]); ?></p>
                                  </div>
                            </div><!-- PANEL VIDEO ITEM LISTA-->
                        <?php } ?>
                    </div>
                    
                  <div id="scsdbic_video_items">
                      
                      <ul>
						<?php while($fila_videos_inf=mysql_fetch_array($rst_videos_inf)){
                                $video_inf=$fila_videos_inf["video"];
                                $urlyoutube="http://www.youtube.com/watch?v=".$video_inf;
                                $youtube = new Youtube($urlyoutube);
                        ?>
                        <li>
                            <div class="pvidii_imagen">
                                <?php if($fila_videos_inf["imagen"]==""){ ?>
                                <img src="<?php echo $youtube->getImageUrl(0)?>" width="85" height="70" alt="<?php echo $fila_videos_inf["titulo"]; ?>" />
                                <?php }else{ ?>
                              <img src="imagenes/upload/<?php echo $fila_videos_inf["carpeta_imagen"]."thumb/".$fila_videos_inf["imagen"] ?>" width="85" height="70" alt="<?php echo $fila_videos_inf["titulo"]; ?>" />
                                <?php } ?>
                          </div>
                                
                          <div class="pvidii_contenido">
                                <p><?php echo $fila_videos_inf["titulo"]; ?></p>
                          </div>
                        </li>
                        <?php } ?>
                        
                    </ul>
                      
                      
                 </div>
                    
              	</div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
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
                    <p><a href="http://impactoevangelistico.net/cartas" class="todas_cartas">Todas las cartas...</a></p>
                    <p class="escribe_cartas">Escribenos a: cartas@impactoevangelistico.net</p>
              	</div>
                
            </div><!-- FIN SECTION SIDEBAR ITEM -->
            
        </div><!-- FIN SECTION SIDEBAR -->

	</div><!-- FIN INTERIOR -->
    
</section><!-- FIN SECTION -->

<footer class="limpiar">
	
    <div class="interior limpiar">
    	
        <div id="footer_izq">
        	
            <p>MOVIMIENTO MISIONERO MUNDIAL INC. || Copyright © 2011</p>
            <p>P.O. BOX 363644 || E-mail : escribanos@impactoevangelistico.net</p>
            <p>San Juan, Puerto Rico 00936-3644</p>
            <p>Telf. (787) 761-8806 | 761-8805 | 7618903</p>
            <p>&nbsp;</p>
            <p>Resolución Recomendada 1024x768</p>
            <p>&nbsp;</p>
            <p>© 2012. Todos los derechos reservados.</p>
            
        </div><!-- FIN FOOTER IZQUIERDA -->
        
        <div id="footer_der">
        	
            <div class="ftd_item"> <a href="http://www.betheltv.tv/" target="_blank"><img src="imagenes/paginas/bethel-television.png" width="136" height="100" alt="Movimiento Mundial Misionero"></a>
                <p><a href="http://www.betheltv.tv/" target="_blank">PAGINA OFICIAL DE BETHEL TELEVISIÓN</a></p>
       	  </div><!-- FIN FOOTER DERECHA ITEM -->
            
            <div class="ftd_item"> <a href="http://www.bethelradio.fm/index.php" target="_blank"><img src="imagenes/paginas/bethel-radio.png" width="127" height="100" alt="Movimiento Mundial Misionero"></a>
                <p><a href="http://www.bethelradio.fm/index.php" target="_blank">PAGINA OFICIAL DE BETHEL RADIO</a></p>
       	  </div><!-- FIN FOOTER DERECHA ITEM -->
            
        </div><!-- FIN FOOTER DERECHA  -->
        
    </div><!-- FIN INTERIOR -->
    
</footer><!-- FIN FOOTER -->
</body>
</html>