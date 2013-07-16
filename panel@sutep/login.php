<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Administrador</title>

<?php require_once("w-scripts.php"); ?>

</head>

<body>

<!-- Top line begins -->
<div id="top">
	<div class="wrapper">    	
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="loginWrapper">

	<!-- New user form -->
    <form action="conexion/verificar.php" id="recover" method="POST">
        <div class="loginPic">
            <a href="#" title=""><img src="images/userLogin.png" alt="" /></a>
        </div>
            
        <input type="text" name="login" placeholder="Usuario" class="loginUsername" />
        <input type="password" name="password" placeholder="Contraseña" class="loginPassword" />
        
        <div class="logControl">
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

</div>
<!-- Login wrapper ends -->

</body>
</html>
