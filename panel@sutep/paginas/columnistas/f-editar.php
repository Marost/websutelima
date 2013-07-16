<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES
$id_url=$_REQUEST["id"];

//EDITAR
$rst_nota=mysql_query("SELECT * FROM ".$tabla_suf."_columnista WHERE id=$id_url;", $conexion);
$fila_nota=mysql_fetch_array($rst_nota);

//VARIABLES
$nota_nombre=$fila_nota["nombre"];
$nota_apellidos=$fila_nota["apellidos"];
$nota_imagen=$fila_nota["foto"];
$nota_contenido=$fila_nota["descripcion"];
$nota_publicar=$fila_nota["publicar"];
$dia_lunes=$fila_nota["dia_lunes"];
$dia_martes=$fila_nota["dia_martes"];
$dia_miercoles=$fila_nota["dia_miercoles"];
$dia_jueves=$fila_nota["dia_jueves"];
$dia_viernes=$fila_nota["dia_viernes"];
$dia_sabado=$fila_nota["dia_sabado"];
$dia_domingo=$fila_nota["dia_domingo"];

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
        <span class="pageTitle"><span class="icon-screen"></span>Columnistas</span>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">

        <form id="submit-form" class="main" method="POST" action="s-editar.php?id=<?php echo $id_url; ?>" enctype="multipart/form-data">

            <fieldset>
                <div class="widget fluid">
                    
                    <div class="whead"><h6>Editar</h6></div>
                    
                    <div class="formRow">
                        <div class="grid3"><label>Nombre:</label></div>
                        <div class="grid9"><input type="text" name="nombre" value="<?php echo $nota_nombre; ?>" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Apellidos:</label></div>
                        <div class="grid9"><input type="text" name="apellidos" value="<?php echo $nota_apellidos; ?>" /></div>
                    </div>

                    <div class="widget">
                        <div class="whead"><h6>Descripción</h6></div>
                        <textarea class="ckeditor" name="contenido" /><?php echo $nota_contenido; ?></textarea>
                    </div>


                    <div class="formRow">
                        <div class="grid3"><label>Imagen:</label> </div>
                        <div class="grid9">
                            <div class="floatL">
                                <a href="../../../imagenes/columnistas/<?php echo $nota_imagen; ?>" class="lightbox">
                                    <img src="../../../imagenes/columnistas/<?php echo $nota_imagen; ?>" width="100" >
                                </a>
                            </div>
                            <div class="floarL width60 margin1020">    
                                <input type="file" class="styled" id="fileInput" name="fileInput" />
                                <input type="hidden" name="imagen_actual" value="<?php echo $nota_imagen; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Días de publicación: </label></div>
                        <div class="grid9 yes_no">
                            <div class="floatL mr10">Lunes
                                <?php if($dia_lunes==1){ ?>
                                <input type="checkbox" name="dia_lunes" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_lunes" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Martes
                                <?php if($dia_martes==1){ ?>
                                <input type="checkbox" name="dia_martes" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_martes" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Miercoles
                                <?php if($dia_miercoles==1){ ?>
                                <input type="checkbox" name="dia_miercoles" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_miercoles" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Jueves
                                <?php if($dia_jueves==1){ ?>
                                <input type="checkbox" name="dia_jueves" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_jueves" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Viernes
                                <?php if($dia_viernes==1){ ?>
                                <input type="checkbox" name="dia_viernes" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_viernes" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Sábado
                                <?php if($dia_sabado==1){ ?>
                                <input type="checkbox" name="dia_sabado" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_sabado" value="1" /></div>
                                <?php } ?>
                            <div class="floatL mr10">Domingo
                                <?php if($dia_domingo==1){ ?>
                                <input type="checkbox" name="dia_domingo" value="1" checked /></div>
                                <?php }else{ ?>
                                <input type="checkbox" name="dia_domingo" value="1" /></div>
                                <?php } ?>
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Publicar: </label></div>
                        <div class="grid9 enabled_disabled">
                            <div class="floatL mr10">
                                <input type="checkbox" id="check4" <?php if($nota_publicar==1){ ?>checked<?php } ?> value="1" name="publicar" />
                            </div>
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