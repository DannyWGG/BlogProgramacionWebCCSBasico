<?php
session_start();
include "../Conexion/conexion.php";

if(isset($_SESSION['usuario'])) {
	header("Location: index.php");
}

ini_set('error_reporting',0);
?>

<!DOCTYPE html>
<html>
    
        <head>
        <title>Hola</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CCSBasico/estilosBasicos.css">
    </head>
    <body>
        <div class="DivNav">
        <header>
        <nav>
            <ul>
                <li class="liNav"><a class="aNav">Nombre de la Pagina</a></li>
                <li class="liNav"><a class="aNav" href="../index.php">Pagina Principal</a></li>
                <li class="liNav"><a class="aNav" href="#">Acerca de:</a></li>
            </ul>
        </nav>
        </header>
        </div>
        <div class="RegiPrincipal">
            
            <form action="#" method="POST">

            <div class="formuReg">
              <label class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
            </div>
            <div class="formuReg">
                <label class="form-label">Contraseña</label> 
                <input type="password" class="form-control" name="pass" id="pass" placeholder="" value="" required>
            </div>
            <div class="CentroBoton">
                <input type="submit" name="Inicio" id="button" value="Iniciar" />
            </div>
            </form>
        </div>
        <div class="ImagenPrincipal">
            <img src="../ImagenPrincipal/60d2611d72314.jpeg" width="500" height="500">
        </div>
        <div class="PieDPagina">
            <footer>Informacion de pie de pagina</footer>
        </div>
        
    </body>
    
</html>

<?php
if($_POST['Inicio']) {

	$email = $_POST['email'];
	$contrasena = $_POST['pass'];
	
	$query = "SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'";

	$resultado = $mysqli->query($query);
	
	if ($resultado != 0) {
	
		while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
		
			if($email == $row['email'] && $contrasena == $row['contrasena']) 
			
			{
			
				$_SESSION['usuario'] = $row['usuario'];
				
				$_SESSION['id'] = $row['id'];
				
				$_SESSION['superu'] = $row['superu'];
				
				header("Location: ../index.php");
				
			}
			
		} 
		
	} else { echo "El nombre de usuario y/o contrasena no coinciden"; }
	
}
?>