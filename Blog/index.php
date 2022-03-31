<?php
session_start();
include "Conexion/conexion.php";

if(!isset($_SESSION['usuario'])) {
        require_once('plantillas/MainReg.html');
	//header("Location: login.php");
?>

<!DOCTYPE html>
<html>
    
        <head>
        <title>Blog</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        
        <?php
        
        }else{
            
            //require_once('plantillas/MainLog.html');
            
            //include_once('footer.php');
        
        ?>
        
        <link rel="stylesheet" type="text/css" href="CCSBasico/Main.css">
        
        <div class="FuenteYColorNav">
        <header>
        <nav>
            <ul>
                <li class="liNavL"><a class="aNav">Reddit2</a></li>
                <li class="liNavL"><a class="aNav" href="Perfil/perfil.php">Perfil</a></li>
                <li class="liNavL"><a class="aNav" href="Perfil/portal.php">Postear</a></li>
                <li class="liNavR"><a class="aNav" href="Login/logout.php">cerrar seccion</a></li>
            </ul>
        </nav>
        </header>
        </div>
        <div class="InfoPerfil FuenteYColorNav">
            <div class="formuReg">
                <img src="ImagenPrincipal/imagen.png" height="50" width="50">
                <label><?php echo $_SESSION['usuario'];?></label> 
            </div>
            <div class="formuReg">
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Buscar Post: </b><input type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
                </form>
            </div>
            
            <?php
            
            $where = "";
	
            if(!empty($_POST))
            {
		$valor = $_POST['campo'];
		if(!empty($valor)){
			$where = "WHERE titulo LIKE '%$valor%'";
                        
                        $sqlBuscar = "SELECT * FROM poster $where";
                        $resultadoBuscar = $mysqli->query($sqlBuscar);
                        while($rowBuscar = $resultadoBuscar->fetch_array(MYSQLI_ASSOC)){
                
                        $mystring = $rowBuscar['titulo'];
                        $findme   = '@';
                        $pos = strpos($mystring, $findme);

                        if ($pos === false) { ?>
    
            <a class="formuReg DivNav" href="Perfil/postDirec.php?id=<?php echo $rowBuscar['id'];?>"><?php

                        echo $rowBuscar['titulo'];
                        
                        ?>
                        </a>
                    
                    <?php
            }}}}
            
            ?> 
            
            
        </div>

         <div class="RegiPrincipal FuenteYColorNav">
            <div class="formuReg">
                <?php
                    $Poster = "SELECT * FROM poster WHERE id >= 0 ORDER BY id DESC";
                    
                    $resultPost = $mysqli->query($Poster);
        
		while($rowPoster=$resultPost->fetch_array(MYSQLI_ASSOC)) 
                {
                    $contar = "SELECT * FROM usuarios WHERE id = '".$rowPoster['usuario']."'";
                    $resultUser = $mysqli->query($contar);
                    while($rowUser=$resultUser->fetch_array(MYSQLI_ASSOC)){
                        ?>
                    <a>Autor:<?php echo $rowUser['usuario']; ?></a>
                    <a class="liNavR"><?php echo $rowPoster['fecha_post']; ?></a>
                    
                <a class="formuReg DivNav" href="Perfil/postDirec.php?id=<?php echo $rowPoster['id'];?>"><?php echo $rowPoster['titulo']; }} ?></a>

                    

            </div>

        </div>


        
        <?php
        
        }
        ini_set('error_reporting',0);
        ?>
        
    </body>
    
</html>
