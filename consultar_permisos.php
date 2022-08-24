<?php 

    include_once "conexion.php";
    include_once "funciones.php";
    
    if(isset($_GET['activar'])){
        $id = $_GET['activar'];
        $correo = $_GET['id'];

        $conn = mysql_query ("UPDATE permisos 
                SET estado = 's'   
                WHERE codigo_permiso = '$id'");

        mysql_query($conn);
    }

    if(isset($_GET['inactivar'])){
        $id = $_GET['inactivar'];
        $correo = $_GET['id'];

        $conn = "UPDATE permisos  
                SET estado = 'n'    
                WHERE codigo_permiso = '$id'";

        mysql_query($conn);
    }
?>    
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Panaderia</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/miestilo.css">
  </head>
  <body>

    <?php include_once "menu.php"; ?>

        <table class="table table-bordered">
            <tr class="well">
                <td>
                   <h1 align="center">PERMISOS</h1>
                </td>
            </tr>
        </table>


        <form name="from3" method="POST" action=" ">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">CODIGO DEL PERMISO</th>
                    <th scope="col">NOMBRE PERMISO</th>
                    <th scope="col">ESTADO</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $correo = $_GET['id'];

                $index = 1;

                $conn = mysql_query("SELECT * FROM permisos
                        INNER JOIN permisos_tem
                        ON permisos.permisos_tem = permiso.codigo_permiso_tem
                        AND permisos.usuario = '$correo'"); 
                
                while($row = mysql_fetch_array($conn)) {
                    if($row['estado'] == 's'){
                        echo    '<tr>
                                    <th scope="row">'.$index.'</th>
                                    <td>'.$row['nombre_permiso'].'</td>
                                    <td>
                                        <a class="btn btn-success" href="?id='.$correo.'&inactivar='.$row['codigo_permiso'].'">activo</a>
                                    </td>
                                </tr>';
                    }else{
                        echo    '<tr>
                                    <th scope="row">'.$index.'</th>
                                    <td>'.$row['nombre_permiso'].'</td>
                                    <td>
                                        <a class="btn btn-danger" href="?id='.$correo.'&activar='.$row['codigo_permiso'].'">inactivo</a>
                                    </td>
                                </tr>';
                    }

                    $index += 1;
                }
            ?>
            </tbody>
        </table>
        </form>

    <script src="js/jQuery.js"></script>
  </body>