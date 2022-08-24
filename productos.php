<?php  

	include_once("conexion.php");

	$codigo_producto = "";
	$nombre_producto = "";
	$descripcion = "";
	$precio = 0;

	if(!empty($_POST['codigo_producto'])){
		$codigo_producto=limpiar($_POST['codigo_producto']);

		$con = mysql_query("SELECT codigo_producto FROM productos WHERE codigo_producto = '$codigo_producto'");

		if($row=mysql_fetch_array($con)){
            echo "...El producto ya existe...";
        }else{

		$nombre_producto=limpiar($_POST['nombre_producto']);
		$descripcion=limpiar($_POST['descripcion']);
		$precio=limpiar($_POST['precio']);

		mysql_query("INSERT INTO productos(codigo_producto, nombre_producto, descripcion, precio) VALUES ('$codigo_producto', '$nombre_producto', '$descripcion', '$precio')");

		echo "<script>alert('Producto registrado con exito');</script>";

	}
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
				<label>CODIGO DEL PRODUCTO:</label>
				<input class="input form-control" type="number" name="codigo_producto">

				<label>NOMBRE DEL PRODUCTO:</label>
				<input class="input form-control" type="text" name="nombre_producto">


				<label>DESCRIPCION:</label>
				<input class="input form-control" type="text" name="descripcion">

				<label>PRECIO:</label>
				<input class="input form-control" type="number" name="precio">

				<br>
				<input class="btn btn-light" type="submit" value="aceptar">
			</form>
		</center>
	</article>
	 <article id="imagen">
        <div class="card-body">
            <p class="card-text">¡¡INGRESE EL PRODUCTO!!</p>
        </div>
      <img src="img/panes_canasta.png" class="imagen" alt="panadero">  
    </article>

</body>
</html>