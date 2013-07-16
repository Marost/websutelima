<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES DE URL
$mensaje=$_REQUEST["msj"];
$reqId=$_REQUEST["not"];

//NOTICIA
$rst_noticia=mysql_query("SELECT * FROM ".$tabla_suf."_noticia WHERE id=$reqId;", $conexion);
$fila_noticia=mysql_fetch_array($rst_noticia);

//VARIABLES
$noticia_titulo=$fila_noticia["titulo"];

//GALERIA DE FOTOS
$rst_galeria=mysql_query("SELECT * FROM ".$tabla_suf."_noticia_slide WHERE noticia=$reqId ORDER BY orden ASC;", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Administrador</title>

<!-- ORDENAR -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.8.5/jquery-ui.min.js"></script>
<script type="text/javascript">
    var jq = jQuery.noConflict();
    jq(document).ready(function() {
        jq("#lista-galeria").sortable({
          handle : '.handle',
          update : function () {
            var order = jq('#lista-galeria').sortable('serialize');
            var noticia = <?php echo $reqId; ?>;
            jq("#info").load("s-ordenar.php?not="+noticia+"&"+order);
          }
        });
    });
</script>

<?php require_once("../../w-scripts.php"); ?>

<!-- ELIMINAR  -->
<script type="text/javascript">
function eliminarRegistro(registro, noticia) {
    if(confirm("¿Está seguro de borrar este registro?")) {
        document.location.href="s-eliminar.php?id="+registro+"&not="+noticia;
    }
}
</script>
</head>

<body>

<!-- Top line begins -->
<?php require_once("../../w-topline.php"); ?>
<!-- Top line ends -->


<!-- Sidebar begins -->
<div id="sidebar">
    
    <?php require_once("../../w-sidebarmenu.php"); ?>
    
</div><!-- Sidebar ends -->
    
<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Galeria de fotos de Noticia</span>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

        <ul class="middleNavR">
            <li><a href="f-agregar.php?not=<?php echo $reqId; ?>" title="Agregar" class="tipN">
                <img src="../../images/icons/middlenav/create.png" alt="" /></a></li>
        </ul>

        <?php if($mensaje=="ok"){ ?>
        <div class="nNote nSuccess">
            <p>El registro se guardo correctamente</p>
        </div>
        <?php }elseif($mensaje=="er"){ ?>
        <div class="nNote nFailure">
            <p>Se produjo un error</p>
        </div>
        <?php }elseif($mensaje=="el"){ ?>
        <div class="nNote nSuccess">
            <p>El registro se elimino correctamente</p>
        </div>
        <?php } ?>

        <!-- Media table sample -->
        <div class="widget">
            <div class="whead"><h6><?php echo $noticia_titulo; ?></h6></div>
            <div class="gallery">
               <ul id="lista-galeria">
                    <?php while($fila_galeria=mysql_fetch_array($rst_galeria)){
                            $galeria_id=$fila_galeria["id"];
                            $galeria_imagen=$fila_galeria["imagen"];
                            $galeria_imagen_carpeta=$fila_galeria["imagen_carpeta"];
                    ?>
                    <li id="listItem_<?php echo $galeria_id; ?>" class="alto">
                        <a href="javascript:;" title="">
                            <img src="../../../imagenes/upload/<?php echo $galeria_imagen_carpeta."thumb/".$galeria_imagen; ?>" alt="" />
                        </a>
                        <div class="actions">
                            <a href="f-editar.php?id=<?php echo $galeria_id; ?>&not=<?php echo $reqId; ?>" title="" class="edit">
                                <img src="../../images/icons/update.png" alt="" /></a>
                            <a href="s-eliminar.php?id=<?php echo $galeria_id; ?>&not=<?php echo $reqId; ?>" title="" class="remove">
                                <img src="../../images/icons/delete.png" alt="" /></a>
                            <a href="" title="" class="move handle">
                                <img src="../../images/icons/move.png" alt="" />
                            </a>
                        </div>
                    </li>
                    <?php } ?>
               </ul> 
           </div>
        </div>

    </div>
  <!-- Main content ends -->
    
</div>
<!-- Content ends -->    
   
        
</body>
</html>
