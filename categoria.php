<?php
require_once("panel@sutep/conexion/conexion.php");
require_once("panel@sutep/conexion/funciones.php");

//WIDGETS
$wg_slide=false;

//VARIABLES DE URL
$reqId=$_REQUEST["id"];
$reqUrl=$_REQUEST["url"];

$url_web=$web."seccion/".$reqId."/".$reqUrl;

//CATEGORIA
$rst_notinf_cat=mysql_query("SELECT * FROM stp_noticia_categoria WHERE id=$reqId", $conexion);
$fila_notinf_cat=mysql_fetch_array($rst_notinf_cat);

//VARIABLES
$notInfCat_titulo=$fila_notinf_cat["categoria"];

//PAGINACION
require("libs/pagination/class_pagination.php");

//INICIO DE PAGINACION
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
$rst_not_inf        = mysql_query("SELECT COUNT(*) as count FROM stp_noticia WHERE categoria=$reqId AND publicar=1 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC, id DESC", $conexion);
$fila_not_inf       = mysql_fetch_assoc($rst_not_inf);
$generated      = intval($fila_not_inf['count']);
$pagination     = new Pagination("10", $generated, $page, $url_web."&page", 1, 0);
$start          = $pagination->prePagination();
$rst_not_inf        = mysql_query("SELECT * FROM stp_noticia WHERE categoria=$reqId AND publicar=1 AND fecha_publicacion<='$fechaActual' ORDER BY fecha_publicacion DESC, id DESC LIMIT $start, 10", $conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title> <?php echo $notInfCat_titulo; ?> | <?php echo $web_nombre; ?></title>
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
                    
                    <h2><?php echo $notInfCat_titulo; ?></h2>
                    
                </div>
                
                <?php while($fila_not_inf=mysql_fetch_array($rst_not_inf)){
                    $notInf_id=$fila_not_inf["id"];
                    $notInf_url=$fila_not_inf["url"];
                    $notInf_titulo=$fila_not_inf["titulo"];
                    $notInf_contenido=soloDescripcion($fila_not_inf["contenido"], 150);
                    $notInf_imagen=$fila_not_inf["imagen"];
                    $notInf_imagen_carpeta=$fila_not_inf["imagen_carpeta"];
                    if($fila_not_inf["fecha_publicacion"]=="0000-00-00 00:00:00"){
                        $notInf_fecha=$fila_not_inf["fecha"];
                    }else{ $notInf_fecha=$fila_not_inf["fecha_publicacion"];}                    
                    $notInf_web=$web."noticia/".$notInf_id."-".$notInf_url;
                    $notInf_web_img=$web."imagenes/upload/".$notInf_imagen_carpeta."".$notInf_imagen;
                    $notInf_categoria=$fila_not_inf["categoria"];
                ?>
                <div class="box-note wmedia">

                    <span class="time-cat">
                        <em class="time"><?php echo $notInf_fecha; ?></em>
                    </span>
            
                    <div class="media-type">
                        <a href="<?php echo $notInf_web; ?>">
                            <img src="<?php echo $notInf_web_img; ?>" alt="" width="200" height="110">
                        </a>
                    </div>
            
                    <h2>
                        <a href="<?php echo $notInf_web; ?>">
                            <?php echo $notInf_titulo; ?>
                        </a>
                    </h2>
                    <p class="intro"><?php echo $notInf_contenido; ?></p>

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