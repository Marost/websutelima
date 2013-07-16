<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES
$id_url=$_REQUEST["id"];

//EDITAR
$rst_nota=mysql_query("SELECT * FROM ".$tabla_suf."_noticia WHERE id=$id_url;", $conexion);
$fila_nota=mysql_fetch_array($rst_nota);

//VARIABLES
$nota_nombre=$fila_nota["titulo"];
$nota_imagen=$fila_nota["imagen"];
$nota_imagen_carpeta=$fila_nota["imagen_carpeta"];
$nota_contenido=$fila_nota["contenido"];
$nota_video=$fila_nota["video"];
$nota_video_tipo=$fila_nota["tipo_video"];
$nota_categoria=$fila_nota["categoria"];
$nota_destacada=$fila_nota["destacada"];
$nota_superior1=$fila_nota["superior_1"];
$nota_superior2=$fila_nota["superior_2"];
$nota_superior3=$fila_nota["superior_3"];
$nota_superior4=$fila_nota["superior_4"];
$nota_superior5=$fila_nota["superior_5"];
$nota_superior6=$fila_nota["superior_6"];
$nota_superior7=$fila_nota["superior_7"];
$nota_superior8=$fila_nota["superior_8"];
$nota_superior9=$fila_nota["superior_9"];
$nota_publicar=$fila_nota["publicar"];

/* FECHA */
$nota_fecha_pub=explode(" ", $fila_nota["fecha_publicacion"]);
$nota_pub_fecha=$nota_fecha_pub[0];
$nota_pub_hora=$nota_fecha_pub[1];

//CATEGORIA
$rst_cat=mysql_query("SELECT * FROM ".$tabla_suf."_noticia_categoria ORDER BY categoria ASC;", $conexion);

//TAGS
$tags=explode(",", $fila_nota["tags"]);    //SEPARACION DE ARRAY CON COMAS
$rst_tags=mysql_query("SELECT * FROM ".$tabla_suf."_noticia_tags ORDER BY nombre ASC;", $conexion);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Administrador</title>

<?php require_once("../../w-scripts.php"); ?>

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
        <span class="pageTitle"><span class="icon-screen"></span>Noticias</span>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

        <form id="submit-form" class="main" method="POST" action="s-editar.php?id=<?php echo $id_url; ?>">

            <fieldset>
                <div class="widget fluid">
                    
                    <div class="whead"><h6>Editar</h6></div>
                    
                    <div class="formRow">
                        <div class="grid3"><label>Titulo:</label></div>
                        <div class="grid9"><input type="text" name="nombre" value="<?php echo $nota_nombre; ?>" /></div>
                    </div>

                    <div class="widget">
                        <div class="whead"><h6>Contenido</h6></div>
                        <textarea class="ckeditor" name="contenido" /><?php echo $nota_contenido; ?></textarea>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Imagen:</label> </div>
                        <div class="grid9">
                            <div class="floatL">
                                <a href="../../../imagenes/upload/<?php echo $nota_imagen_carpeta."".$nota_imagen; ?>" class="lightbox">
                                    <img src="../../../imagenes/upload/<?php echo $nota_imagen_carpeta."".$nota_imagen; ?>" width="100" >
                                </a>
                            </div>
                            <div class="widget floarL width60 margin1020">    
                                <div id="uploader">Tu navegador no soporta HTML5.</div>
                                <input type="hidden" name="imagen" value="<?php echo $nota_imagen; ?>">
                                <input type="hidden" name="imagen_carpeta" value="<?php echo $nota_imagen_carpeta; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Video (Youtube):</label> </div>
                        <div class="grid9">http://www.youtube.com/watch?v=
                            <input type="text" name="video_youtube" value="<?php echo $nota_video; ?>" style="width: 300px;">
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Categoria:</label></div>
                        <div class="grid9">
                            <select name="categoria" class="styled">
                                <option>Selecciona</option>
                                <?php while($fila_cat=mysql_fetch_array($rst_cat)){
                                        $cat_id=$fila_cat["id"];
                                        $cat_nombre=$fila_cat["categoria"];

                                        if ($nota_categoria==$cat_id){
                                ?>
                                <option value="<?php echo $cat_id; ?>" selected><?php echo $cat_nombre; ?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $cat_id; ?>"><?php echo $cat_nombre; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Tipo de noticia: </label></div>
                        <div class="grid9 yes_no">
                            <div class="floatL mr10">Destacada
                                <?php if($nota_destacada==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_destacada" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_destacada" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 1
                                <?php if($nota_superior1==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior1" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 2
                                <?php if($nota_superior2==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior2" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior2" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 3
                                <?php if($nota_superior3==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior3" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior3" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 4
                                <?php if($nota_superior4==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior4" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior4" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 5
                                <?php if($nota_superior5==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior5" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior5" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 6
                                <?php if($nota_superior6==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior6" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior6" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 7
                                <?php if($nota_superior7==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior7" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior7" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 8
                                <?php if($nota_superior8==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior8" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior8" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Superior 9
                                <?php if($nota_superior9==1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior9" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_superior9" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Normal
                                <?php if($nota_destacada<>1 and 
                                    $nota_superior1<>1 and 
                                    $nota_superior2<>1 and 
                                    $nota_superior3<>1 and 
                                    $nota_superior4<>1 and 
                                    $nota_superior5<>1 and 
                                    $nota_superior6<>1 and 
                                    $nota_superior7<>1 and 
                                    $nota_superior8<>1 and 
                                    $nota_superior9<>1){ ?>
                                <input type="radio" name="tipo_noticia" value="not_normal" checked /></div>
                                <?php }else{ ?>
                                <input type="radio" name="tipo_noticia" value="not_normal" /></div>
                                <?php } ?>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Etiquetas:</label></div>
                        <div class="grid9">
                            <select class="selectMultiple" multiple="multiple" tabindex="6" name="tags[]">
                                <?php while($fila_tags=mysql_fetch_array($rst_tags)){
                                        $tags_id=$fila_tags["id"];
                                        $tags_nombre=$fila_tags["nombre"];
                                        if(in_array($tags_id, $tags)){
                                ?>
                                <option value="<?php echo $tags_id; ?>" selected><?php echo $tags_nombre; ?></option>
                                <?php }else{ ?>
                                <option value="<?php echo $tags_id; ?>"><?php echo $tags_nombre; ?></option>
                                <?php }}  ?>

                            </select>  
                        </div>             
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Fecha de publicación:</label></div>
                        <div class="grid4"><input type="text" class="datepicker" name="pub_fecha" value="<?php echo $nota_pub_fecha; ?>" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Hora de publicación:</label></div>
                        <div class="grid4"><input type="text" class="timepicker" name="pub_hora" size="10" value="<?php echo $nota_pub_hora; ?>" />
                            <span class="ui-datepicker-append">Utilice la rueda del ratón y el teclado</span></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Publicar: </label></div>
                        <div class="grid9 enabled_disabled">
                            <div class="floatL mr10"><input type="checkbox" id="check4" <?php if($nota_publicar==1){ ?>checked<?php } ?> value="1" name="publicar" /></div>
                        </div>
                    </div>
                    
                    <div class="formRow">
                        <div class="body" align="center">
                            <a href="lista.php" class="buttonL bBlack">Cancelar</a>
                            <input type="submit" class="buttonL bGreen" name="btn-guardar" value="Guardar datos">
                        </div>
                    </div>
                    
                </div>
            </fieldset>

        </form>

    </div>
  <!-- Main content ends -->
    
</div>
<!-- Content ends -->    
   
        
</body>
</html>