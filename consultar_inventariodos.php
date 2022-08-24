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
	

    <div id="imprimir">
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
                        $pame = mysql_query("SELECT * FROM inventario WHERE codigo_inventario LIKE '%$buscar%' or nombre_producto LIKE '%$buscar%' ORDER BY codigo_inventario");
							
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

<button onclick="imprimir()" class="btn btn-light">IMPRIMIR</button>
    </div>
    <script type="text/javascript">
        function imprimir(){
            var contenido = document.getElementById('imprimir').innerHTML;
            var contenidoOriginal = document.body.innerHTML;
            document.body.innerHTML = '<h1 align="center">CONSULTAR INVENTARIO</h1>'+contenido;
            window.print();

            document.body.innerHTML = contenidoOriginal;
        }
    </script>    
</html>
