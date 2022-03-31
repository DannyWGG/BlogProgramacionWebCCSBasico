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
        <link rel="stylesheet" href="../CCSBasico/Perfil.css">
    </head>
    <body>
        <div class="FuenteYColorNav">
        <header>
        <nav>
            <ul>
                <li class="liNavL"><a class="aNav">Reddit2</a></li>
                <li class="liNavR"><a class="aNav" href="../Login/logout.php">cerrar seccion</a></li>
                <li class="liNavL"><a class="aNav" href="../index.php">PaginaInicial</a></li>
            </ul>
        </nav>
        </header>
        </div>

        <div class="InfoPerfil FuenteYColorNav">
            <div class="formuReg">
                <?php
                
                    $ruta='../files/'.$_SESSION['id'].'/'; // Indicar la ruta
                    $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                    while ($file = readdir($filehandle)) {
                    if ($file != "." && $file != "..") {
                    ?> 
                    <img class="ImagenPComent" <?php echo "src='$ruta$file'" ?>>
                    <?php
                
                    } 
                    } 
                    closedir($filehandle); // Fin lectura archivos
?>
                <label class="form-label"><?php echo $_SESSION['usuario']; ?></label> 
            </div>
            
            <div class="formuReg">
                <a href="../FuncionesInfo/ModificarPerfil.php?id=<?php echo $_SESSION['id']; ?>">Editar Perfil</a>
            </div>
            <div class="formuReg">
                <a href="../Perfil/portal.php?id=<?php echo $_SESSION['id']; ?>">Publicar Post</a>
            </div>
            
            <?php if($_SESSION['superu'] != '0'){ ?>
            <div class="formuReg">
                <a href="../FuncS/ListUsers.php?id=<?php echo $_SESSION['id']; ?>">Gestionar Usuarios</a>
            </div>
            <div class="formuReg">
                <a href="../FuncS/ListPost.php?id=<?php echo $_SESSION['id']; ?>">Gestionar Publicaciones</a>
            </div>
            <?php } ?>
        </div>
        
        <div class="RegiPrincipal FuenteYColorNav">
            <div class="formuReg">
                <?php
                
                $query = "SELECT * FROM poster WHERE usuario = '".$_SESSION['id']."' ORDER BY id DESC";

                $resultado = $mysqli->query($query);
                while($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                    ?> 
            </div>
            
            <div>
                <a class="formuReg DivNav" href="postDirec.php?id=<?php echo $row['id'];?>"><?php echo $row['titulo']; ?></a>
                <a class="formuReg DivNav liNavR" href="../FuncionesInfo/ModificarPost.php?id=<?php echo $row['id'];?>">Modificar Post</a>
                <a class="formuReg DivNav liNavR" href="../FuncionesInfo/EliminarPost.php?id=<?php echo $row['id'];?>">Eliminar Post</a>
                
                    <?php } ?>
            
            </div>
            
        </div>
        
    </body>
    
</html>