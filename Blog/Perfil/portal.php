<?php
session_start();
include "../Conexion/conexion.php";

if(!isset($_SESSION['usuario'])) {
        header('../index.php');
	//header("Location: login.php");
        }
        
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    
        <head>
        <title>Hola</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CCSBasico/estilosBasicos.css">
    </head>
    <body>
        <link rel="stylesheet" type="text/css" href="../CCSBasico/Main.css">
        
        <div class="FuenteYColorNav">
        <header>
        <nav>
            <ul>
                <li class="liNavL"><a class="aNav">Reddit2</a></li>
                <li class="liNavL"><a class="aNav" href="perfil.php">Perfil</a></li>
                <li class="liNavL"><a class="aNav" href="../index.php">PagPrincipal</a></li>
                <li class="liNavR"><a class="aNav" href="../Login/logout.php">cerrar seccion</a></li>
            </ul>
        </nav>
        </header>
        </div>

        <div class="RegiPrincipal">
            <form action="../FuncionesInfo/guardarPost.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="formuReg">
                <label class="form-label">tituloDelPost</label> 
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="" value="" required>
            </div>			
                    <div class="formuReg">
                <label class="form-label">Foto de Portada</label>
                <br>
                <input type="file" class="form-control" name="archivoPortada" id="archivoPortada" required>
            </div>
                

            <div class="formuReg">
                <p>
                    <label class="form-label">InfoPost</label> 
                    <textarea class="textaMain" name="post" cols="50" rows="4" id="post" required></textarea>
                </p></div>

            <div class="CentroBoton">
                <button class="btn btn-primary" type="submit">Cargar Post</button>
            </div>
            </form>
        </div>
        <div class="ImagenPrincipal">
            <img src="ImagenPrincipal/imagen.png">
        </div>
        
        
    </body>
    
</html>

