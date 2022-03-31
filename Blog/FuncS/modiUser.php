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
                
                $id = $_GET['id'];
	
                $sql = "SELECT * FROM usuarios WHERE id = '$id'";
                $resultado = $mysqli->query($sql);
        
                $row = $resultado->fetch_array(MYSQLI_ASSOC);
                
                
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
                <label><?php echo $_SESSION['usuario']; ?></label> 
            </div>
            
        </div>
        
        <div class="RegiPrincipal FuenteYColorNav">
            <div class="formuReg">
                
                <form method="POST" action="../FuncionesInfo/UpdatePerfil.php?id=<?php echo $id;?>" autocomplete="off" enctype="multipart/form-data">
				
                                <div>
					<label for="nombre">Usuario</label>
					<div class="formuReg">
						<input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['usuario']; ?>" required>
					</div>
				</div>
                                <div>
					<label for="nombre">Contraseña</label>
					<div class="formuReg">
                                            <input type="password" id="pass1" name="pass1" placeholder="pass" value="" required>
					</div>
				</div>
                                <div>
					<label for="nombre">Confirmar Contraseña</label>
					<div class="formuReg">
                                            <input type="password" id="pass2" name="pass2" placeholder="pass" value="" required>
					</div>
				</div>
				
				
                                <div class="col-sm-6">
                                    <label class="form-label">Archivo</label> 
                                    <input type="file" class="form-control" name="archivo" id="archivo" required>
                                    <?php
                                    
                                        $path="../files/".$id;
                                        if(file_exists($path)){
                                            $directorio= opendir($path);
                                            while ($archivo = readdir($directorio)) {
                                                if (!is_dir($archivo)) {
                                                    
                                                    echo "<div data='".$path."/".$archivo."'><a href='".$path."/".$archivo."' title='Ver Archivo Adjunto'>Ver</a>";
                                                    echo "$archivo </div>"; 
                                                    
                                                    ?>
                                    <?php
                                                    echo "<img src='../files/$id/$archivo' width='300' />";
                                                //accion($id, $archivo);
                                                }
                                            }
                                        }
                                    ?>
                                    </div>

<?php
    /* 
    function accion($var_id, $var_file){
        echo "Foto Eliminada";
    unlink("../files/$var_id/$var_file");
  }
     * 
     */
  
  ?>

                                
				<div>
					<div>
						<a href="../index.php">Regresar</a>
						<button type="submit">Guardar</button>
					</div>
				</div>
                                
			</form>
                
            </div>
            
            
        </div>
        
    </body>
    
</html>

