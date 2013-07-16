<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES
$id_url=$_REQUEST["id"];

//EDITAR
$rst_nota=mysql_query("SELECT * FROM ".$tabla_suf."_usuario WHERE usuario='$id_url';", $conexion);
$fila_nota=mysql_fetch_array($rst_nota);

//VARIABLES
$nota_nombre=$fila_nota["nombre"];
$nota_apellidos=$fila_nota["apellidos"];
$nota_email=$fila_nota["email"];
$nota_usuario=$fila_nota["usuario"];
$nota_clave=$fila_nota["clave"];

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
    
    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            <div class="secTop">
                <div class="balance">                    
                </div>
            </div>
            
            <div class="divider"><span></span></div>
            
            <!-- Sidebar subnav -->
            <ul class="subNav">
                <li><a href="../empresa/lista.php" title=""><span class="icos-frames"></span>Empresa</a></li>
                <li><a href="../entrevistas/lista.php" title=""><span class="icos-frames"></span>Entrevistas</a></li>
                <li><a href="../galeria/lista.php" title=""><span class="icos-frames"></span>Galería de Fotos</a></li>
                <li><a href="../jugadores/lista.php" title=""><span class="icos-frames"></span>Jugadores</a></li>
                <li><a href="../nosotros/lista.php" title=""><span class="icos-frames"></span>Nosotros</a></li>
                <li><a href="../noticias/lista.php" title=""><span class="icos-frames"></span>Noticias</a></li>
                <li><a href="../posiciones/lista.php" title="" ><span class="icos-frames"></span>Posiciones</a></li>
                <li><a href="lista.php" class="this" title="" ><span class="icos-frames"></span>Usuarios</a></li>
                <li><a href="../videos/lista.php" title="" ><span class="icos-frames"></span>Videos</a></li>
            </ul>
            
            <div class="divider"><span></span></div>
                    
        </div> 
    </div>
</div>
<!-- Sidebar ends -->    
	
    
<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Usuarios</span>
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
                        <div class="grid3"><label>Nombre:</label></div>
                        <div class="grid9"><input type="text" name="nombre" value="<?php echo $nota_nombre; ?>" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Apellidos:</label></div>
                        <div class="grid9"><input type="text" name="apellidos" value="<?php echo $nota_apellidos; ?>" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Email:</label></div>
                        <div class="grid9"><input type="email" name="email" value="<?php echo $nota_email; ?>" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Usuario:</label></div>
                        <div class="grid9"><input type="text" name="usuario" value="<?php echo $nota_usuario; ?>" readonly="readonly" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Contraseña:</label></div>
                        <div class="grid9"><input type="password" name="clave" value="<?php echo $nota_clave; ?>" /></div>
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