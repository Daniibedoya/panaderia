<?php  

    session_start();
    include_once("conexion.php");
    include_once("funciones.php");
    

    $id_usuario = "";
    $nombres = "";
    $apellidos = "";
    $direccion = "";
    $telefono = "";
    $correo = "";
    $contraseña = "";
    $estado = "";
    $tipo_usuario = "";

    if(!empty($_POST['id_usuario'])){
        $id_usuario=limpiar($_POST['id_usuario']);

        $con = mysql_query("SELECT id_usuario FROM usuario WHERE id_usuario = '$id_usuario'");

        if($row=mysql_fetch_array($con)){
            echo "...El usuario ya existe...";
        }else{

        $nombres=limpiar($_POST['nombres']);
        $apellidos=limpiar($_POST['apellidos']);
        $direccion=limpiar($_POST['direccion']);
        $telefono=limpiar($_POST['telefono']);
        $correo=limpiar($_POST['correo']);
        $contraseña=limpiar($_POST['contraseña']);
        $estado=limpiar($_POST['estado']);
        $tipo_usuario=limpiar($_POST['tipo_usuario']);

        mysql_query("INSERT INTO usuario (id_usuario, nombres, apellidos, direccion, telefono, correo, contraseña, estado, tipo_usuario) VALUES ('$id_usuario', '$nombres', '$apellidos', '$direccion', '$telefono', '$correo', '$contraseña', '$estado', '$tipo_usuario')");

        }

        if($tipo_usuario=='administrador'){

        $con = mysql_query("SELECT * FROM permisos_tem");

        while($row = mysql_fetch_array($con)){

            $permiso=$row['codigo_permiso_tem'];

            mysql_query("INSERT INTO permisos (permiso,usuario,estado) VALUES ('$permiso','$correo','s')");
        }

        }else if($tipo_usuario=='cajero'){

        $cont = mysql_query("SELECT * FROM permisos_tem");

        while($rows = mysql_fetch_array($cont)){

            $permiso=$rows['codigo_permiso_tem'];
            
            mysql_query("INSERT INTO permisos (permiso,usuario,estado) VALUES ('$permiso','$correo','s')");
            mysql_query($cont,"INSERT INTO permisos(permiso,usuario,estado)VALUES('1','$correo','s')");
            mysql_query($cont,"INSERT INTO permisos(permiso,usuario,estado)VALUES('7','$correo','s')");
            mysql_query($cont,"INSERT INTO permisos(permiso,usuario,estado)VALUES('8','$correo','s')");


        }
    }

    header("location:iniciar_sesion.php");
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Panaderia</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/miestilo.css">
</head>
<body>

    <div class="container">

        <center>
            <h1>INICIAR SESIÓN</h1>
            <img src="img/629574-banner.w1024.png" width="300" height="300">
                    <form action="" class="form-group col-sm-4" method="POST">

                        <?php
                            if (!empty($_POST['correo']) and !empty($_POST['contraseña'])) {
                            $correo=limpiar($_POST['correo']);
                            $contraseña=limpiar($_POST['contraseña']);

                            $con=mysql_query("SELECT * FROM usuario WHERE usuario.correo='$correo' AND usuario.contraseña='$contraseña'");

                            if($row=mysql_fetch_array($con)){
                                if ($row['estado']=='s') {
                                    $usuario=$row['nombres'];
                                    $usuario=explode(" ",$usuario);
                                    $usuario=$usuario[0];
                                    $_SESSION['user_name']=$usuario;
                                    $_SESSION['tipo_user']=$row['tipo_usuario'];
                                    $_SESSION['cod_user']=$correo;

                                    if ($row['tipo_usuario']=='administrador' ) {
                                        echo ('BIENVENIDO ADMINISTRADOR<br>'.$row['nombres'].''.$row['apellidos']);
                                        echo"<div class='alert alert-success'></div>";
                                        echo '<meta http-equiv="refresh" content="2;url=usuarios.php">';

                                    }else if ($row['tipo_usuario']=='cajero') {

                                        echo ('BIENVENIDO CAJERO<br>'.$row['nombres'].''.$row['apellidos']);
                                        echo"<div class='alert alert-success'></div>";
                                        echo '<meta http-equiv="refresh" content="2;url=usuarios.php">';
                                    }
                                    }else{

                                        echo"<div class='alert alert-success'>NO SE ENCUENTRA HABILITADO</div>";
                                        echo '<center><a href="iniciar_sesion.php" class="btn"><strong>Intentar de  Nuevo</strong></a></center>';
                                    }
                                    }else{
                                        echo"<div class='alert alert-success'>EL USUARIO Y LA CONTRASEÑA NO COINCIDEN</div>";
                                        echo '<center><a href="iniciar_sesion.php" class="btn"><strong>Intentar de Nuevo</strong></a></center>';
                                    }    
                                    }else{
                                        echo '<div class="card-header">
                                                <label>CORREO:</label>
                                                <input type="email" class="form-control" name="correo">
                                                <label>CONTRASEÑA:</label>
                                                 <input type="password" class="form-control" name="contraseña">
                                                <br>
                                                <button type="submit" class="btn btn-light">ACEPTAR</button>
                                                <button data-toggle="modal" data-target="#exampleModal" type="button" class="btn btn-light" btn-responsive">REGISTRAR
                                                </button>
                                            </div>';      
                                    }                                                                                                               
                        ?>

                    </form>

                    <div>
                        
                    </div>
    </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title titulo_mo" id="exampleModalLabel">LLENAR FORMULARIO</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="registro.php">
                        <div class="form-group has-feedback">                      
                                <label class="card-text">IDENTIFICACION DEL USUARIO:</label>
                                <input type="number" class="form-control" name="id_usuario"> 
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">NOMBRES DEL USUARIO:</label>
                    <input type="text" class="form-control" name="nombres">
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">APELLIDOS DEL USUARIO:</label>
                    <input type="text" class="form-control" name="apellidos">
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">DIRECCION DEL USUARIO:</label>
                    <input type="text" class="form-control" name="direccion">
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">TELEFONO DEL USUARIO:</label>
                    <input type="text" class="form-control" name="telefono">
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">CORREO DEL USUARIO:</label>
                    <input type="email" class="form-control" name="correo"> 
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">CONTRASEÑA:</label>
                    <input type="password" class="form-control" name="contraseña">
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">ESTADO:</label>
                    <select type="text" class="form-control" name="estado">
                        <option value="s">ACTIVO</option>
                        <option value="n">INACTIVO</option>
                    </select>
                            </div>
                            <div class="form-group has-feedback">
                                <label class="card-text">TIPO DE USUARIO:</label>
                    <select type="text" class="form-control" name="tipo_usuario">
                        <option value="administrador">ADMINISTRADOR</option>
                        <option value="cajero">CAJERO</option>
                    </select>
                            </div>
                            <button type="submit" class="btn btn-secondary">REGISTRAR</button>
                            <button type="submit" class="btn btn-info btn-responsive" data-dismiss="modal">CANCELAR</button>
                        </form>
          
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
        </center>
    </div>

</body>
</html>