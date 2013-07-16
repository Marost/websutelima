<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");
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

        <form id="submit-form" class="main" method="POST" action="s-guardar.php" enctype="multipart/form-data">

            <fieldset>
                <div class="widget fluid">
                    
                    <div class="whead"><h6>Agregar</h6></div>
                    
                    <div class="formRow">
                        <div class="grid3"><label>Nombre:</label></div>
                        <div class="grid9"><input type="text" name="nombre" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Apellidos:</label></div>
                        <div class="grid9"><input type="text" name="apellidos" /></div>
                    </div>

                    <div class="widget">
                        <div class="whead"><h6>Descripción</h6></div>
                        <textarea class="ckeditor" name="contenido" /></textarea>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Imagen:</label> </div>
                        <div class="grid9">
                            <input type="file" class="styled" id="fileInput" name="fileInput" />
                        </div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Días de publicación: </label></div>
                        <div class="grid9 yes_no">
                            <div class="floatL mr10">Lunes
                                <input type="checkbox" name="dia_lunes" value="1" /></div>
                            <div class="floatL mr10">Martes
                                <input type="checkbox" name="dia_martes" value="1" /></div>
                            <div class="floatL mr10">Miercoles
                                <input type="checkbox" name="dia_miercoles" value="1" /></div>
                            <div class="floatL mr10">Jueves
                                <input type="checkbox" name="dia_jueves" value="1" /></div>
                            <div class="floatL mr10">Viernes
                                <input type="checkbox" name="dia_viernes" value="1" /></div>
                            <div class="floatL mr10">Sábado
                                <input type="checkbox" name="dia_sabado" value="1" /></div>
                            <div class="floatL mr10">Domingo
                                <input type="checkbox" name="dia_domingo" value="1" /></div>
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
