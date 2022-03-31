<?php

    $mysqli= new Mysqli('localhost','root','','blog');
    
    if($mysqli->connect_error){
        die('error en la conexion'.$mysqli->connect_error);
    }

?>


