<?php 
session_start();
require_once("../../conexion/conexion.php");
require_once("../../conexion/funciones.php");
require_once("../../conexion/verificar_sesion.php");

//VARIABLES
$pub_fecha=date("Y-m-d");
$pub_hora=date("H:i:s");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Administrador</title>

<?php require_once("../../w-scripts.php"); ?>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script type="text/javascript">
    var jValidar = jQuery.noConflict();

    jValidar(document).on("ready", function(){
        
        jValidar("#validar-email").on("click", function(){
            jValidar.ajax({
                type: "POST",
                data: "act=email&email="+jValidar("#email").val(),
                url: "validador.php",
                success: function(responseText){
                    if(responseText==1){
                        jValidar("#notificacion").html("<div id='notificacion-validador' class='nNote nWarning'><p>El email ya existe</p></div>").text();
                    } else if (responseText==0){
                        jValidar("#notificacion").html("<div id='notificacion-validador' class='nNote nSuccess'><p>El email está disponible</p></div>").text();
                    }
                }
            });
        });

        jValidar("#validar-usuario").on("click", function(){
            jValidar.ajax({
                type: "POST",
                data: "act=usuario&usuario="+jValidar("#usuario").val(),
                url: "validador.php",
                success: function(responseText){
                    if(responseText==1){
                        jValidar("#notificacion").html("<div id='notificacion-validador' class='nNote nWarning'><p>El usuario ya existe</p></div>").text();
                    } else if (responseText==0){
                        jValidar("#notificacion").html("<div id='notificacion-validador' class='nNote nSuccess'><p>El usuario está disponible</p></div>").text();
                    }
                }
            });
        });

    });

function validate(){
    if(jValidar("#usuario").val() === ''){
        alert("Debe proporcionar un nombre usuario");
        jValidar("#usuario").focus();
        return false;
    }
    if(jValidar("#clave").val() === ''){
        alert("Debe proporcionar una contraseña");
        jValidar("#clave").focus();
        return false;
    }
    if(jValidar("#email").val() === ''){
        alert("Debe proporcionar un email");
        jValidar("#email").focus();
        return false;
    }
return true;
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

        <div id="notificacion"></div>
        
        <form id="submit-form" class="main" method="POST" action="s-guardar.php">

            <fieldset>
                <div class="widget fluid">
                    
                    <div class="whead"><h6>Agregar</h6></div>
                    <input name="do" type="hidden" value="login" />
                    
                    <div class="formRow">
                        <div class="grid3"><label>Nombre:</label></div>
                        <div class="grid9"><input type="text" name="nombre" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Apellidos:</label></div>
                        <div class="grid9"><input type="text" name="apellidos" /></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Email:</label></div>
                        <div class="grid5"><input type="email" name="email" id="email" /></div>
                        <div class="grid2"><a class="buttonS bBlue" id="validar-email">Validar email</a></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Usuario:</label></div>
                        <div class="grid5"><input type="text" name="usuario" id="usuario" /></div>
                        <div class="grid2"><a class="buttonS bBlue" id="validar-usuario">Validar usuario</a></div>
                    </div>

                    <div class="formRow">
                        <div class="grid3"><label>Contraseña:</label></div>
                        <div class="grid5"><input type="password" name="clave" id="clave" /></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="body" align="center">
                            <a href="lista.php" class="buttonL bBlack">Cancelar</a>
                            <input id="enviar-datos" type="submit" class="buttonL bGreen" name="btn-guardar" value="Guardar datos">
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
