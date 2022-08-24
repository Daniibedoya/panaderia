<?php 
  
    $conexion=mysql_connect("localhost","root","");

    mysql_select_db("panaderia",$conexion);

    mysql_set_charset('utf8mb4');

    

    function limpiar($tags){
  	    $tags=strip_tags($tags);
  	    $tags=stripslashes($tags);
  	   // $tags=htmlentities($tags);

  	return $tags;
  }

 ?>