<?php
    
    session_start();
    include_once ("conexion.php");

    $correo = $_SESSION['cod_user'];
    $tipo_usuario = $_SESSION['tipo_user'];     
?>

    <nav class="navbar navbar-expand-lg navbar-light  mb-5">
        <a class="navbar-brand" href="#">
          <?php
              if ($tipo_usuario=='administrador') {
                  ?> ADMINISTRADOR <?php  
              }else{
                  ?> CAJERO <?php 
              }
          ?>
        </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php
                    $conn = mysql_query("SELECT * FROM permisos
                                         INNER JOIN permisos_tem
                                         ON permisos.permiso = permisos_tem.codigo_permiso_tem
                                         AND permisos.usuario = '$correo'"); 

                    while ($row = mysql_fetch_array($conn)) {

                        if($row['nombre_permiso'] == 'registrar_usuarios' && $row['estado'] == 's'){
                            echo '<li class="nav-item">
                                        <a class="nav-link active" href="usuarios.php">REGISTRAR USUARIOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'registrar_productos' && $row['estado'] == 's'){
                            echo '<li class="nav-item">
                                        <a class="nav-link active" href="productos.php">REGISTRAR PRODUCTOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'registrar_inventario' && $row['estado'] == 's'){
                            echo '<li class="nav-item">
                                        <a class="nav-link active" href="inventario.php">REGISTAR INVENTARIO</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'lista_usuarios' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link" href="consultar_usuario.php">LISTA DE USUARIOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'lista_productos' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link" href="consultar_productos.php">LISTA DE PRODUCTOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'lista_inventario' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link " href="consultar_inventario.php">LISTA DE INVENTARIO</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'consultar_usuarios' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link " href="consultar_usuariosdos.php">CONSULTAR USUARIOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'consultar_productos' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link " href="cosultar_productosdos.php">CONSULTAR PRODUCTOS</a>
                                    </li>';
                        }

                        if($row['nombre_permiso'] == 'consultar_inventario' && $row['estado'] == 's'){
                            echo '<li class="nav-item active">
                                        <a class="nav-link " href="consultar_inventariodos.php">CONSULTAR INVENTARIO</a>
                                    </li>';
                        }

                    }
                ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                    <a href="cerrar_sesion.php"><span aria-hidden="true"><img src="img/logout.png"></span></a>

                    <a href="cambiar_contrasena.php"><span aria-hidden="true"><img src="img/bloquear.png"></span></a>
                </form>
        </div>
    </nav>
 
    <?php
        if ($_SESSION['tipo_user']=='') {
            header ('location:iniciar_sesion.php');
        }
    ?>

    <script src="js/jQuery.js"></script> 
    <script src="js/bootstrap.min.js"></script>
