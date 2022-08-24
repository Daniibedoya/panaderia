<?php  

	include_once("conexion.php");
	include_once("funciones.php");

	$codigo_producto = "";
	$nombre_producto = "";
	$descripcion = "";
	$precio = "";

	if(!empty($_GET['codigo_producto'])){
		$codigo_producto=limpiar($_GET['codigo_producto']);
		$codigo_producto=substr($codigo_producto, 10);
		$codigo_producto=decrypt($codigo_producto, 'URLCODIGO');

		$row=mysql_query("SELECT * FROM productos WHERE codigo_producto LIKE '$codigo_producto'");

		$res=mysql_fetch_array($row);
	}

	if(isset($_POST['ingresar'])){
		$nombre_producto=limpiar($_POST['nombre_producto']);
		$descripcion=limpiar($_POST['descripcion']);
		$precio=limpiar($_POST['precio']);

		mysql_query("UPDATE productos SET nombre_producto='$nombre_producto', descripcion='$descripcion', precio='$precio' WHERE codigo_producto='$codigo_producto'");

		echo "<script>alert('producto modificado con exito');
			
		</script>";

		$url=cadenas().encrypt($res['codigo_producto'],'URLCODIGO');
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
	<div class="container">
		<center>
			<form action="" class="form-group col-sm-6" method="POST">
				<label>CODIGO DEL PRODUCTO</label>
				<input disabled="" value="<?php echo $res['codigo_producto']; ?>" class="input form-control" type="number" name="codigo_producto">

				<label>NOMBRE DEL PRODUCTO</label>
				<input value="<?php echo $res['nombre_producto'];?>" class="input form-control" type="text" name="nombre_producto">


				<label>DESCRIPCION</label>
				<input value="<?php echo $res['descripcion'];?>" class="input form-control" type="text" name="descripcion">

				<label>PRECIO</label>
				<input value="<?php echo $res['precio'];?>" class="input form-control" type="number" name="precio">

				<br>
				<input class="btn btn-light" type="submit" name="ingresar" value="ACEPTAR">
			</form>
		</center>
	</div>

</body>
</html>