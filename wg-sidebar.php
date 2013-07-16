<?php
//LIBRERIAS
include("libs/ssdtube/SSDTube.php");

//EDICION IMPRESA
$rst_edimpresa=mysql_query("SELECT * FROM iev_edicion WHERE fecha_publicacion<='$fechaActual' ORDER BY id DESC", $conexion);
$fila_edimpresa=mysql_fetch_array($rst_edimpresa);
$edimpresa_numero=$fila_edimpresa["titulo"];
$edimpresa_nombre=$fila_edimpresa["nombre_edicion"];
$edimpresa_imagen=$fila_edimpresa["imagen"];

//CARTAS
$rst_cartas=mysql_query("SELECT * FROM iev_cartas WHERE estado='A' AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 5", $conexion);

//SALUDOS
$rst_saludos=mysql_query("SELECT * FROM iev_saludos WHERE id>0 AND estado_saludo='A' ORDER BY fecha DESC LIMIT 12", $conexion);

//VIDEO TITULO
$rst_videos_sup=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);
$num_videos_sup=mysql_num_rows($rst_videos_sup);

//VIDEO TITULO
$rst_videos_inf=mysql_query("SELECT * FROM iev_videos WHERE id>0 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3;", $conexion);

//GALERIA PRINCIPAL
$rst_galeria_prin=mysql_query("SELECT * FROM iev_galeria WHERE id>0 ORDER BY id DESC;", $conexion);

//FOTOS DE GALERIA
function fotoGaleria($idgaleria, $conexion){
    $rst_query=mysql_query("SELECT * FROM iev_galeria_slide WHERE id>0 AND noticia=$idgaleria ORDER BY orden ASC;", $conexion);
    return $fila_query=mysql_fetch_array($rst_query);
}

?>
<div id="section_sidebar">
    
    <!-- EDICION DEL MES -->
  	<div class="scsdb_item">
    	
        <div class="scsdbi_cabecera">EDICIÓN DEL MES <span><a href="english_edition">ENGLISH EDITION</a></span></div>
        
        <div class="scsdbi_contenido scsdbic_fdBlanco scsdbic_txtCentro">
		<a href="/revista/<?php echo $edimpresa_numero; ?>/index.html" target="_blank"><img src="imagenes/revista/<?php echo $edimpresa_imagen; ?>" width="239" height="320" alt="Portada" title="<?php echo $edimpresa_nombre; ?>"></a></div>
        
    </div>
    
    <div class="scsdb_item">
    	
        <div class="scsdbi_cabecera"><a href="edicion_anterior">EDICIONES ANTERIORES</a></div>
        
    </div>
    <!-- FIN EDICION DEL MES -->
    
    <!-- SALUDOS -->
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
        
    </div>
    <!-- FIN SALUDOS -->
    
    <!-- GALERIA DE IMAGENES -->
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
        
    </div>
    <!-- GALERIA DE IMAGENES -->
    
    <!-- VIDEOS -->
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
						$youtube = new SSDTube();
						$youtube->identify($urlyoutube, true);
                ?>
                <li>
                    <div class="pvidii_imagen">
                        <?php if($fila_videos_inf["imagen"]==""){ ?>
                        <img src="<?php echo $youtube->thumbnail_1_url; ?>" width="85" height="70" alt="<?php echo $fila_videos_inf["titulo"]; ?>"/>
                        
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
            <p><a href="http://impactoevangelistico.net/cartas" class="todas_cartas">Todas las cartas...</a></p>
            <p class="escribe_cartas">Escribenos a: cartas@impactoevangelistico.net</p>
      	</div>
        
    </div>
    <!-- FIN NOS ESCRIBEN -->
    
</div><!-- FIN SECTION SIDEBAR -->