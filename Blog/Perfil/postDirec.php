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

        <div class="FuenteYColorNav">
            <div class="formuReg">
                <?php
                
                $IDpost=$_GET['id'];
                
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
        </div>
        
        <div class="disHori FuenteYColorNav">
            <?php
            $Poster = "SELECT * FROM poster WHERE id = $IDpost";
                    
            $resultPost = $mysqli->query($Poster);
        
		$rowPoster=$resultPost->fetch_array(MYSQLI_ASSOC);
                
                    ?>
                    <div>
                        <?php
                        $UserAutor = "SELECT * FROM usuarios WHERE id = $rowPoster[usuario]";
                    
                        $resultAutor = $mysqli->query($UserAutor);
        
                        $rowAutor=$resultAutor->fetch_array(MYSQLI_ASSOC);
                                ?>
                        <div class="DivNav FuenteYColorNav">
                        <h1 class="formuReg"><?php echo $rowPoster['titulo']; ?></h1>
                        </div>
                        <?php
                
                            $ruta='../docs/portada/'.$IDpost.'/'; // Indicar la ruta
                            $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                            
                            while ($file = readdir($filehandle)) {
                            if ($file != "." && $file != "..") {
                            ?>
                        <div class="DivNav FuenteYColorNav">
                    <img class="formuReg" <?php echo "src='$ruta$file'" ?>>
                        </div>
                    <?php
                
        } 
                            }
closedir($filehandle); // Fin lectura archivos
?>
                        
                        <h1 class="formuReg">Autor:<?php echo $rowAutor['usuario']; ?></h1>
                        
                    <div class="formuReg DivNav FuenteYColorNav">
                    <a><?php
                    
                                            echo $rowPoster['post'];
                    
                    ?></a>
                    </div>
                    </div>
                        <?php
                
                ?>
        </div>
        
<div class="DivNav FuenteYColorNav">
            <a class="formuReg">Publica lo que piensas</a>

<form name="form1" method="post" action="">
  <label for="textarea"></label>
  <center>
    <p>
        <textarea class="textaMain" name="comentario" cols="50" rows="4" id="textarea"><?php if(isset($_GET['user'])) { ?>@<?php echo $_GET['user']; ?><?php } ?> </textarea>
    </p>
    <p>
      <input type="submit"name="comentar" value="Comentar">
    </p>
  </center>
</form>
</div>

<?php
	if(isset($_POST['comentar'])) {
		$sql = "INSERT INTO comentarios (comentario,usuario,fecha,post_id) value ('".$_POST['comentario']."','".$_SESSION['id']."',NOW(),'".$IDpost."')";	
		$query = $mysqli->query($sql);
                if($query) { 
                    header("Location: postDirec.php?id=".$IDpost."");
                }
	}
?>

<?php
	if(isset($_POST['reply'])) {
		$sql = "INSERT INTO comentarios (comentario,usuario,fecha,reply,post_id) value ('".$_POST['comentario']."','".$_SESSION['id']."',NOW(),'".$_GET['id']."','".$IDpost."')";	
		$query = $mysqli->query($sql);
                if($query) { header("Location: postDirec.php?id=".$IDpost.""); }
	}
?>
        
        <div class="DivRightMain RegiPrincipal">
	<div id="container">
    	<ul id="comments">
        
<?php
		
                $comentarios = "SELECT * FROM comentarios WHERE reply = 0 AND post_id = '".$IDpost."' ORDER BY id DESC";
		$result = $mysqli->query($comentarios);
                
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
			
			$usuario = "SELECT * FROM usuarios WHERE id = '".$row['usuario']."'";
                        $result2 = $mysqli->query($usuario);
                        $user = $result2->fetch_array(MYSQLI_ASSOC);
		?>
        	<li class="cmmnt">
            	<div class="avatar">
                <img src="<?php echo $user['avatar']; ?>" height="55" width="55">
                </div>
                <div class="cmmnt-content">
                	<header>
                    <a class="userlink"><?php echo $user['usuario']; ?></a> - <span class="pubdate"><?php echo $row['fecha']; ?></span>
                    <a href="../FuncionesInfo/EliminarComnt.php?id=<?php echo $row['id'];?>&post=<?php echo $IDpost;?>" class="userlink"><?php
                    
                    if($user['id']==$_SESSION['id']){
                    
                    echo 'Eliminar comentario'; }?></a>
                    </header>
                    <p>
                    <?php echo $row['comentario']; ?>
                    </p>
                </div>

                <?php } ?>
                
                
            </li>        
        
        </ul>
    </div> 
</div>
        
    </body>
    
</html>

