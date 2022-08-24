<?php 

	include_once("conexion.php");

	$codigo_producto = "";
	$cantidad_actual = "";
	$cantidad_minima = "";
	$costo = "";

	if(!empty($_POST['codigo_producto'])){
		$codigo_producto=limpiar($_POST['codigo_producto']);
		$cantidad_actual=limpiar($_POST['cantidad_actual']);
		$cantidad_minima=limpiar($_POST['cantidad_minima']);
		$costo=limpiar($_POST['costo']);

		mysql_query("INSERT INTO inventario(codigo_producto, cantidad_actual, cantidad_minima, costo) VALUES ('$codigo_producto', '$cantidad_actual', '$cantidad_minima', '$costo')");

		echo "<script>alert('Producto registrado con exito');</script>";
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
	<article id="formulario" class="container">
		<center>
			<form action="" class="form-group col-sm-6" method="POST">
				<div class="card-header">
					<label>NOMBRE PRODUCTO:</label>
					<select class="form-control" name="codigo_producto">
				    	<?php
				    		$con=mysql_query("SELECT * FROM productos");

				    		while ($res=mysql_fetch_array($con)){

				    			echo '<option value="'.$res['codigo_producto'].'">'.$res['nombre_producto'].'</option>';
				    		}
				    	?>
					</select>
					<label>CANTIDAD ACTUAL:</label>
                	<input type="number" class="form-control" name="cantidad_actual">

                	<label>CANTIDAD MINIMA:</label>
                	<input type="number" class="form-control" name="cantidad_minima">

                	<label>COSTO</label>
			    	<input type="number" class="form-control" name="costo">
			    	<br>
                	<button class="btn btn-light">ACEPTAR</button>
				</div>
			</form>
		</center>
	</article>

	<article id="imagen">
        <div class="card-body">
            <p class="card-text">¡¡INGRESE EL INVENTARIO!!</p>
        </div>
      <img src="img/efa96fdf8d44b53079753340d321ff08.png_wh860.png" class="imagen" alt="panadero">  
    </article>

</body>
</html>