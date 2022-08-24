<?php  

	include_once("conexion.php");
	include_once("funciones.php");

	$codigo_inventario = "";
	$codigo_producto = "";
	$cantidad_actual = "";
	$cantidad_minima = "";
	$costo = "";

	if(!empty($_GET['codigo_inventario'])){
		$codigo_inventario=limpiar($_GET['codigo_inventario']);
		$codigo_inventario=substr($codigo_inventario, 10);
		$codigo_inventario=decrypt($codigo_inventario, 'URLCODIGO');

		$row=mysql_query("SELECT * FROM inventario WHERE codigo_inventario = '$codigo_inventario'");

		$res=mysql_fetch_array($row);
	}

	if(isset($_POST['ingresar'])){
		$cantidad_actual=limpiar($_POST['cantidad_actual']);
		$cantidad_minima=limpiar($_POST['cantidad_minima']);
		$costo=limpiar($_POST['costo']);

		mysql_query("UPDATE inventario SET cantidad_actual='$cantidad_actual', cantidad_minima='$cantidad_minima', costo='$costo' WHERE codigo_inventario='$codigo_inventario'");

		echo "<script>alert('inventario modificado con exito');
			
		</script>";

		$url=cadenas().encrypt($res['codigo_inventario'],'URLCODIGO');
		
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
				<label>CODIGO DEL INVENTARIO</label>
				<input disabled="" value="<?php echo $res['codigo_inventario']; ?>" class="input form-control" type="number" name="codigo_inventario">

				<label>CODIGO DEL PRODUCTO</label>
				<input disabled="" value="<?php echo $res['codigo_producto'];?>" class="input form-control" type="number" name="codigo_producto">

				<label>CANTIDAD ACTUAL</label>
				<input value="<?php echo $res['cantidad_actual'];?>" class="input form-control" type="number" name="cantidad_actual">

				<label>CANTIDAD MINIMA</label>
				<input value="<?php echo $res['cantidad_minima'];?>" class="input form-control" type="text" name="cantidad_minima">

				<label>COSTO</label>
				<input value="<?php echo $res['costo'];?>" class="input form-control" type="number" name="costo">

				<br>
				<input class="btn btn-light" type="submit" name="ingresar" value="ACEPTAR">
			</form>
		</center>
	</div>

</body>
</html>