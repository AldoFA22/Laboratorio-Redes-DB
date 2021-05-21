<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href="css/bootstrap.min.css" rel="stylesheet">
	    <script src="js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    		<div class="row">
	    			<h3>Inventario de Laboratorio de Redes</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
						<a href="create.php" class="btn btn-info">Agregar una Herramienta</a>
						<a href="caracteristicas/caracteristicas.php" class="btn btn-info">Listas de caracteristicas</a>
						<a href="marcas.php" class="btn btn-info">Consultar marcas vigentes</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID Herramienta</th>
			                	<th>Nombre Corto</th>
	                        	<th>Nombre Largo</th>     
								<th>Número de serie</th>
								<th>Modelo</th>
								<th>Estatus</th>
								<th>Tipo</th>
								<th>Marca</th>
								<th>Cantidad</th>
								<th>Id C</th>
								<th>Acciones</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM herramienta NATURAL JOIN caracteristica NATURAL JOIN estatus NATURAL JOIN tipo NATURAL JOIN marca';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_herramienta'] . '</td>';
	    					  	echo '<td>'. $row['nombre_corto'] . '</td>';							   	
	    					   	echo '<td>'. $row['nombre_largo'] . '</td>';
								echo '<td>'. $row['numero_serie'] . '</td>';
								echo '<td>'. $row['modelo'] . '</td>';
								echo '<td>'. $row['nombre_estatus'] . '</td>';
								echo '<td>'. $row['nombre_tipo'] . '</td>';
								echo '<td>'. $row['nombre_marca'] . '</td>';
								echo '<td>'. $row['cantidad'] . '</td>';
								echo '<td>'. $row['id_caracteristica'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=250>';
	    					   	echo '<a class="btn" href="read.php?id='.$row['id_herramienta'].'">Detalles</a>';
	    					   	echo '&nbsp;';
	    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['id_herramienta'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_herramienta'].'">Eliminar</a>';
	    					   	echo '</td>';
							  	echo '</tr>';
						    }
						   	Database::disconnect();
						  	?>
					    </tbody>
		            </table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>