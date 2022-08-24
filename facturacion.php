<?php 
	session_start();
	include_once "conexion.php";
	include_once "funciones.php";

	
?>


<!DOCTYPE html>
<html>
<head>

	<title>consulta facturas</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 
</head>
<body style="background-image: url(img/fondo.jpg); background-size: cover;">

	<?php include_once "menu.php"; ?>    
	<div class="container">
		<table class="table table-bordered">
		 <tr class="well">
		  <td>
		   <h1 align="center">LISTADO DE FACTURAS</h1>
		    <center>
		      <form name="from3" method="POST" action=" ">
		       <div class="input-prepend input-append">
		        <span class="add-on"><i class="icon-search"></i></span>
		       </div>
		       </br>
		      <select class="form-control" name="buscar" >
		        <option value="0">Seleccione</option>
		          <?php 
		            $consulta=mysql_query("SELECT * FROM factura");
		            while ($fila=mysql_fetch_array($consulta)) {
		            echo '<option value="'.$fila[nombre].'">'.$fila['nombre'].'</option>';
		            }

		          ?>
		      </select>
		      <br>
		       <button type="submit" class="btn" name="boton">Buscar</button>
		      </form>
		     </center>
		  </td>
		 </tr>
		</table>

		<div align="right">
		 <a class="btn" href="facturas.php" title="Crear factura"><i class="icon-plus"></i></a>
		</div>
		<br/>
		<div id="imprimir">
			<table class="table">
				<thead class="thead-light">
					<tr>
					    <th>Id factura</th>
					    <th>Nombre</th>
					    <th>fecha</th>
					    <th>pago</th>
					    <th>cuanto debe</th>
					    <th>queda debiendo</th>
					    <th></th>
					</tr>
				</thead>
				<?php 
					$total=0;
					$total2=0;
					
					if (!empty($_POST['buscar'])) {
						$buscar = limpiar ($_POST['buscar']);
						$pame = mysql_query("SELECT * FROM factura WHERE id_factura LIKE '%$buscar%' or  nombre LIKE '%$buscar%' ORDER BY nombre");
							
					}else{
						$pame=mysql_query("SELECT * FROM factura");
					}
					while ($row=mysql_fetch_array($pame)){
					$url=cadenas().encrypt($row['id_factura'],'URLCODIGO');
					$total=$row['total'];
					$total2=$total+$total2;

				?>


						<tbody class="table "> 
							<tr>
							 	<td><?php echo $row['id_factura']; ?></td>
							 	<td><?php echo $row['nombre']?></td>
								<td><?php echo $row['fecha']; ?></td>
								<td><?php echo $row['pago'];?></td>
								<td><?php echo $row['debe']; ?></td>
							 	<td><?php echo $row['total']; ?></td>
							 	<td><img src="https://img.icons8.com/color/48/000000/print.png" onclick="imprimir()"></td>
							</tr>

							<?php } ?>
						</tbody>

					</table>
			</div>
		<div class="alert alert-info w-50 m-auto"><h4 class="text-center">TOTAL_<?php echo $total2 ?></h4></div>
	</div>
	</body>
<script type="text/javascript">
        function imprimir(){
            var contenido = document.getElementById('imprimir').innerHTML;
            var contenidoOriginal = document.body.innerHTML;
            document.body.innerHTML = '<h1 align="center">LISTADO DE FACTURAS</h1>'+contenido;
            window.print();

            document.body.innerHTML = contenidoOriginal;
        }
    </script>
</html>
<!--para pegar iconos en vez de botones
https://iconos8.es/icon/pack/free-icons/color-->