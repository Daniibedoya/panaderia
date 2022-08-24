<?php 

	include_once("conexion.php");
	include_once("funciones.php");

	if(!empty($_GET['delete'])){
		$codigo_producto=limpiar($_GET['delete']);

		mysql_query("DELETE FROM productos WHERE codigo_producto = '$codigo_producto'");

		header("Location: consultar_productos.php");
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
<?php include "menu.php"; ?>
	<table class="table table-bordered">
    	<tr class="well">
    		<td>
    			<h1 align="center">CONSULTAR PRODUCTOS</h1>
    			<center>

        			<form name="from3" method="POST" action=" ">

            			<div class="input-prepend input-append col-md-6">

                			<span class="add-on"><i class="icon-search"></i></span>
                			<input type="text" name="buscar"  autocomplete="off"  class="form-control" aria-label="Sizing example input" autofocus="" placeholder="Buscar por codigo o por nombre" >
         				</div>
            			<br>
            			<button type="submit" class="btn btn-light" name="boton">BUSCAR</button>
        			</form>
    			</center>
    		</td>
    	</tr>
    </table>
    <br>

<table class="table table-sm">
    <thead>
        <tr>
            <th scope="col">CODIGO DEL PRODUCTO</th>
            <th scope="col">NOMBRE DEL PRODUCTO</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">PRECIO</th>
        </tr>
        </thead>
        <tbody>

            <?php 
                if(!empty($_POST['buscar'])){
                    $buscar = limpiar($_POST['buscar']);
                    $pame = mysql_query("SELECT * FROM productos WHERE codigo_producto LIKE '%$buscar%' or nombre_producto LIKE '%$buscar%' ORDER BY codigo_producto");
                }else{
                    $pame = mysql_query("SELECT * FROM productos ORDER BY codigo_producto");
                }
                
                while ($row = mysql_fetch_array($pame)) {
                    $url=cadenas().encrypt($row['codigo_producto'],'URLCODIGO');
            ?>
                <tr>
                    <td><?php echo $row['codigo_producto'];?></td>
                    <td><?php echo $row['nombre_producto'];?></td>
                    <td><?php echo $row['descripcion'];?></td>
                    <td><?php echo $row['precio'];?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>