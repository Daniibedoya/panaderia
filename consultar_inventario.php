<?php 
	include_once "conexion.php";
	include_once "funciones.php";

	if(!empty($_GET['delete'])){
		$codigo_inventario=limpiar($_GET['delete']);

		mysql_query("DELETE FROM inventario WHERE codigo_inventario = '$codigo_inventario'");

		header("Location: consultar_inventario.php");
	}

    if(!empty($_GET['echo'])){
        echo "EL INVENTARIO SE ELIMINO CORRECTAMENTE";
    }
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Panaderia</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/miestilo.css">
</head>
<body>
<div class="container" ></div>
<?php include "menu.php"; ?>
	<table class="table table-bordered">
    	<tr class="well">
    		<td>
    			<h1 align="center">LISTA DE INVENTARIO</h1>
    			<center>

        			<form name="from3" method="POST" action=" ">

            			<div class="input-prepend input-append col-md-6">

                			<span class="add-on"><i class="icon-search"></i></span>
                			<input type="text" name="buscar"  autocomplete="off"  class="form-control" aria-label="Sizing example input" autofocus="" placeholder="Buscar por codigo del inventario o del producto" >
         				</div>
            			<br>
            			<button type="submit" class="btn btn-light" name="boton">BUSCAR</button>
        			</form>
    			</center>
    		</td>
    	</tr>
    </table>

		<div align="right">
		 <a class="btn" href="facturas.php" title="Crear factura"><i class="icon-plus"></i></a>
		</div>
		<br/>
		<br>

    <div class="container">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">CODIGO DEL INVENTARIO</th>
                    <th scope="col">NOMBRE DEL PRODUCTO</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">COSTO</th>
                </tr>
            </thead>
            <tbody>
				<?php 
					$total=0;
					$total2=0;
					
					if(!empty($_POST['buscar'])){
                        $buscar = limpiar($_POST['buscar']);
                        $pame = mysql_query("SELECT * FROM productos INNER JOIN inventario ON productos.codigo_producto = 
						inventario.codigo_producto WHERE inventario.codigo_inventario ='$buscar' OR productos.nombre_producto LIKE '%$buscar%'  ORDER BY inventario.codigo_inventario");
							
					}else{
						$pame = mysql_query("SELECT * FROM productos INNER JOIN inventario ON productos.codigo_producto = 
						inventario.codigo_producto ORDER BY inventario.codigo_inventario");
					}
					while ($row = mysql_fetch_array($pame)) {
                        $url=cadenas().encrypt($row['codigo_inventario'],'URLCODIGO');
				?>
 
							<tr>
							 	<td><?php echo $row['codigo_inventario'];?></td>
                    			<td><?php echo $row['nombre_producto'];?></td>
                    			<td><?php echo $row['cantidad_actual'];?></td>
                    			<td><?php echo $row['costo'];?></td>
							 	
							</tr>

							<?php } ?>
						

					</table>
			</div>
		
	</div>
	</body>
</html>
