

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Panaderia</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/miestilo.css">
</head>
<body>
<?php include "menu.php"; ?>
<?php  

    include_once ("conexion.php");

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
            echo "<script>alert('... el usuario ya existe...');</script>";
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

        echo "<script>alert('Usuario registrado con exito');</script>";

        $conn = mysql_query("SELECT * FROM permisos_tem");

        if($tipo_usuario == 'administrador'){

            while($row = mysql_fetch_array($conn)) {
                $codigo_permiso = $row['codigo_permiso_tem'];

                mysql_query("INSERT INTO permisos (permiso,usuario,estado)
                        VALUES ('$codigo_permiso','$correo','s')");
                
            }
        }else{

            while($row = mysql_fetch_array($conn)) {
                $codigo_permiso = $row['codigo_permiso_tem'];

                if($row['nombre_permiso'] == 'registrar_usuarios'){
                    mysql_query("INSERT INTO permisos (permiso,usuario,estado)
                        VALUES ('$codigo_permiso','$correo','s')");
                }else{
                    if($row['nombre_permiso'] == 'consultar_usuarios'){
                        mysql_query("INSERT INTO permisos (permiso,usuario,estado)
                            VALUES ('$codigo_permiso','$correo','s')");
                    }else{
                        if($row['nombre_permiso'] == 'consultar_productos'){
                            mysql_query("INSERT INTO permisos (permiso,usuario,estado)
                                VALUES ('$codigo_permiso','$correo','s')");
                        }else{
                            mysql_query("INSERT INTO permisos (permiso,usuario,estado)
                                VALUES ('$codigo_permiso','$correo','n')");
                        }
                    }
                }  
            }
        }   
    }
}     
?>
    <article id="formulario" class="container">
        <center>
            <form action="" class="form-group col-sm-6" method="POST">                
                <div class="card-header">
                    <label class="card-text">IDENTIFICACION DEL USUARIO:</label>
                    <input type="number" class="form-control" name="id_usuario"> 
                    
                    <label class="card-text">NOMBRES DEL USUARIO:</label>
                    <input type="text" class="form-control" name="nombres"> 
                  
                    <label class="card-text">APELLIDOS DEL USUARIO:</label>
                    <input type="text" class="form-control" name="apellidos"> 
                    
                    <label class="card-text">DIRECCION DEL USUARIO:</label>
                    <input type="text" class="form-control" name="direccion"> 
                  
                    <label class="card-text">TELEFONO DEL USUARIO:</label>
                    <input type="text" class="form-control" name="telefono"> 
                    
                    <label class="card-text">CORREO DEL USUARIO:</label>
                    <input type="email" class="form-control" name="correo"> 
                   
                    <label class="card-text">CONTRASEÑA:</label>
                    <input type="password" class="form-control" name="contraseña"> 
                   
                    <label class="card-text">ESTADO:</label>
                    <select type="text" class="form-control" name="estado">
                        <option value="s">ACTIVO</option>
                        <option value="n">INACTIVO</option>
                    </select>
                 
                    <label class="card-text">TIPO DE USUARIO:</label>
                    <select type="text" class="form-control" name="tipo_usuario">
                        <option value="administrador">ADMINISTRADOR</option>
                        <option value="cajero">CAJERO</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-light">ACEPTAR</button>
                </div>
            </form>
        </center>
    </article> 

    <article id="imagen">
        <div class="card-body">
            <p class="card-text">¡¡BIENVENIDO!!</p>
        </div>
      <img src="img/panadero.png" class="panadero" alt="panadero">  
    </article>

    <script src="js/cloudflare.js"></script>
    <script src="js/jQuery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>