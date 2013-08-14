<?php
require_once("panel@sutep/conexion/conexion.php");
require_once("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

$url_web=$web."rtv";

//PAGINACION
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_not_inf        = mysql_query("SELECT COUNT(*) as count FROM stp_videos WHERE publicar=1 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC, id DESC", $conexion);
$fila_not_inf       = mysql_fetch_assoc($rst_not_inf);
$generated      = intval($fila_not_inf['count']);
$pagination     = new Pagination("10", $generated, $page, $url_web."?page", 1, 0);
$start          = $pagination->prePagination();
$rst_not_inf        = mysql_query("SELECT * FROM stp_videos WHERE publicar=1 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC, id DESC LIMIT $start, 10", $conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title> SUTEP RTV | <?php echo $web_nombre; ?></title>
    <base href="<?php echo $web; ?>">
    <meta name="description" content="">

    <?php require_once("wg-header-script.php"); ?>

    <!-- PAGINACION -->
    <link rel="stylesheet" href="/libs/pagination/pagination.css" media="screen">

</head>

<body>

<?php require_once("wg-header.php"); ?>

<section class="limpiar">

    <div class="interior limpiar">

        <div id="section_news">
                
            <div class="scnw_item">
                
                <div class="scnwi_detalles_cat">
                    
                    <h2>SUTEP RTV</h2>
                    
                </div>
                
                <?php while($fila_not_inf=mysql_fetch_array($rst_not_inf)){
                    $notInf_id=$fila_not_inf["id"];
                    $notInf_url=$fila_not_inf["url"];
                    $notInf_titulo=$fila_not_inf["titulo"];
                    $notInf_video=$fila_not_inf["video"];
                    if($fila_not_inf["fecha_publicacion"]=="0000-00-00 00:00:00"){
                        $notInf_fecha=$fila_not_inf["fecha"];
                    }else{ $notInf_fecha=$fila_not_inf["fecha_publicacion"];}                    
                    $notInf_web=$web."rtv/".$notInf_id."-".$notInf_url;
                ?>
                <div class="box-note wmedia">

                    <span class="time-cat">
                        <em class="time"><?php echo $notInf_fecha; ?></em>
                    </span>
            
                    <div class="media-type">

                        <h2>
                            <a href="<?php echo $notInf_web; ?>">
                                <?php echo $notInf_titulo; ?>
                            </a>
                        </h2>

                        <iframe width="620" height="350" src="//www.youtube.com/embed/<?php echo $notInf_video; ?>?rel=0" frameborder="0" allowfullscreen></iframe>

                    </div>

                </div><!-- FIN FLUJO -->
                <?php } ?>

                <div class="boton">
                    <?php $pagination->pagination(); ?>
                </div>
                
            </div><!-- FIN SECTION NEWS ITEM -->
                        
        </div><!-- FIN SECTION NEWS -->
        
        <?php require_once("wg-sidebar.php"); ?>

    </div><!-- FIN INTERIOR -->
    
</section><!-- FIN SECTION -->

<?php require_once("wg-footer.php"); ?>

</body>

</html>