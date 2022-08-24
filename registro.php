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

        echo "<script>alert('usuario creado con exito');</script>";

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

header('location: iniciar_sesion.php');  
?>