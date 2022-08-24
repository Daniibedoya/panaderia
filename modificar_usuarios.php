<?php  

	include_once("conexion.php");
	include_once("funciones.php");

	$id_usuario = "";
	$nombres = "";
	$apellidos = "";
	$direccion = "";
	$telefono = "";
	$correo = "";
	$estado = "";
	$tipo_usuario = "";
	$tipo = "";

	if(!empty($_GET['id_usuario'])){
		$id_usuario=limpiar($_GET['id_usuario']);
		$id_usuario=substr($id_usuario, 10);
		$id_usuario=decrypt($id_usuario, 'URLCODIGO');

		$row=mysql_query("SELECT * FROM usuario WHERE id_usuario = '$id_usuario'");

		while($res=mysql_fetch_array($row)){
			$tipo = $res['tipo_usuario'];
		}
	}

	if(isset($_POST['registrar'])){
		$nombres=limpiar($_POST['nombres']);
		$apellidos=limpiar($_POST['apellidos']);
		$direccion=limpiar($_POST['direccion']);
		$telefono=limpiar($_POST['telefono']);
		$correo=limpiar($_POST['correo']);
		$estado=limpiar($_POST['estado']);
		$tipousuario=limpiar($_POST['tipo_usuario']);

		mysql_query("UPDATE usuario SET nombres='$nombres', apellidos='$apellidos', direccion='$direccion', telefono='$telefono', correo='$correo', estado='$estado', tipo_usuario='$tipo_usuario' WHERE id_usuario='$id_usuario'");

		echo "<script>alert('usuario modificado con exito');
			
		</script>";


		$url=cadenas().encrypt($res['id_usuario'],'URLCODIGO');
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
			<label>IDENTIFICACION DEL USUARIO:</label>
			<input disabled="" value="<?php echo $nombres; ?>" class="input form-control" type="number" name="id_usuario">

			<label>NOMBRES DEL USUARIO:</label>
			<input value="<?php echo ($nombres)?>" class="input form-control" type="text" name="nombres">

			<label>APELLIDOS DEL USUARIO:</label>
			<input value="<?php echo $res['apellidos'];?>" class="input form-control" type="text" name="apellidos">

			<label>DIRECCION DEL USUARIO:</label>
			<input value="<?php echo $res['direccion'];?>" class="input form-control" type="text" name="direccion">

			<label>TELEFONO DEL USUARIO:</label>
			<input value="<?php echo $res['telefono'];?>" class="input form-control" type="number" name="telefono">

			<label>CORREO DEL USUARIO:</label>
			<input value="<?php echo $res['correo'];?>" class="input form-control" type="text" name="correo">

			<label>ESTADO:</label>
			<select type="text" class="form-control" name="estado">
                <option value="s">ACTIVO</option>
                <option value="n">INACTIVO</option>
            </select>

            <label class="card-text">TIPO DE USUARIO:</label>
            <select type="text" class="form-control" name="tipo_usuario">
            	<?php 
            		if (isset($tipo)) {
            			if($tipo == "administrador"){
            				echo '<option value="administrador" selected>administrador</option>
            				 	  <option value="cajero">Cajero</option>';
            			}else{
            				echo '<option value="administrador">administrador</option>
	            				 	  <option value="cajero" selected>Cajero</option>';
            			}
            		}else{
            			echo '<option value="administrador">administrador</option>
            		 		  <option value="cajero">Cajero</option>';
            		}
            	?>            
            </select>

			<br>
			<input class="btn btn-light" type="submit" name="registrar" value="aceptar">
		</form>
	</center>
</div>

</body>
</html>