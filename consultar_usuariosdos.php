<?php 

	include_once("conexion.php");
	include_once("funciones.php");

	if(!empty($_GET['delete'])){
		$id_usuario=limpiar($_GET['delete']);

		mysql_query("DELETE FROM usuario WHERE id_usuario='$id_usuario'");

		header('location:consultar_usuario.php');
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
				<h1 align="center">COSULTAR USUARIOS</h1>
				<center>
					<form name="from3" method="POST" action=" ">
            			<div class="input-prepend input-append col-md-6">
                			<span class="add-on"><i class="icon-search"></i></span>
                			<input type="text" name="buscar"  autocomplete="off"  class="form-control" aria-label="Sizing example input" autofocus="" placeholder="Buscar por documento o por nombre" >
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
					<th class="col">IDENTIFICACION DEL USUARIO</th>
					<th class="col">NOMBRES</th>
					<th class="col">APELLIDOS</th>
					<th class="col">DIRECCION</th>
					<th class="col">TELEFONO</th>
					<th class="col">CORREO</th>
					<th class="col">CONTRASEÑA</th>
					<th class="col">ESTADO</th>
					<th class="col">TIPO DE USUARIO</th>
				</tr>
			</thead>

			<tbody>
				<?php 
                if(!empty($_POST['buscar'])){
                    $buscar = limpiar($_POST['buscar']);
                    $pame = mysql_query("SELECT * FROM usuario WHERE id_usuario LIKE '%$buscar%' or nombres LIKE '%$buscar%' ORDER BY id_usuario");
                }else{
                    $pame = mysql_query("SELECT * FROM usuario ORDER BY id_usuario");
                }
                
                while ($row = mysql_fetch_array($pame)) {
                    $url=cadenas().encrypt($row['id_usuario'],'URLCODIGO');
            ?>
                <tr>
                    <td><?php echo $row['id_usuario'];?></td>
                    <td><?php echo $row['nombres'];?></td>
                    <td><?php echo $row['apellidos'];?></td>
                    <td><?php echo $row['direccion'];?></td>
                    <td><?php echo $row['telefono'];?></td>
                    <td><?php echo $row['correo'];?></td>
                    <td><?php echo $row['contraseña'];?></td>
                    <td><?php echo $row['estado'];?></td>
                    <td><?php echo $row['tipo_usuario'];?></td>
                </tr>
            <?php } ?>
			</tbody>
		</table>
</body>
</html>