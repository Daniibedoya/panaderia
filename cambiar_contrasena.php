<?php

    include_once "conexion.php";
    include_once "funciones.php";

    
  
?>
<!DOCTYPE html>
<html lang="es" class="html1">
<head>
    <meta charset="utf-8">
    <title>Panaderia</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/miestilo.css">
</head> 
<body>
    <?php 
    include_once "menu.php"; 
    	$contra = '';
    $c1 = '';
    $c2 = '';

    if(!empty($_POST['c1']) AND !empty($_POST['c2']) AND !empty($_POST['contra'])){

        if($_POST['c1']==$_POST['c2']){
            $correo = $_SESSION['cod_user'];
            $contra = limpiar($_POST['contra']);
            $c1 = limpiar($_POST['c1']);
            $c2 = limpiar($_POST['c2']);

            $can=mysql_query("SELECT * FROM usuario WHERE correo='".$correo."' and contraseña='".$contra."'");

            if($dato=mysql_fetch_array($can)){

                $sql="UPDATE usuarios SET contraseña='".$c2."'  WHERE id_usuario = '".$correo."'";

                mysql_query($sql);
                echo " ";
                echo ("CONTRASEÑA ACTUALIZADA CON EXITO");
                echo " ";
            }else{
                echo " ";
                echo ("LA CONTRASEÑA DIGITADA NO COINCIDE CON LA ANTIGUA");
                echo " ";
            }
        }else{
            echo " ";
            echo ("LAS DOS CONSTRASEÑAS DIGITADAS NO COINCIDEN");
            echo " ";
        }
    }
     ?>

    <div class="container">

        <center>
            <h1>CAMBIAR CONTRASEÑA</h1>
            <img src="img/lock-2.png" width="300" height="300">
                <form action="" class="form-group col-sm-4" method="POST">
            <div class="form-group">
                <label>CONTRASEÑA ANTIGUA:</label>
                <input class="form-control" type="password" name="contra" id="contra">
            </div>
            <div class="form-group">
                <label>NUEVA CONTRASEÑA:</label>
                <input class="form-control" type="password" name="c1" id="c1" required>
            </div>
            <div class="form-group">
                <label>CONFIRMACIÓN DE CONTRASEÑA:</label>
                <input class="form-control" type="password" name="c2" id="c2" required>
            </div>
            <div class="clearfix"></div>
            <button type="submit" class="btn btn-light btn-responsive" value="Cambiar Contraseña">CAMBIAR CONTRASEÑA</button>
        </center>
        </form>
    </div>

    <script src="js/jQuery.js"></script>

</body>
</html>

