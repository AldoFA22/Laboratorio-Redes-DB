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
	    			<h3>Historial de estatus</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="index.php" class="btn btn-light">Regresar al inventario</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>ID Elemento</th>
	                        	<th>Fecha y Hora</th>
								<th>ID / Nombre Estatus Anterior</th>
								<th>ID / Nombre Estatus Actual</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM historial_estatus;';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_historial'] . '</td>';
	    					  	echo '<td>'. $row['id_elemento'] . '</td>';							   	
	    					   	echo '<td>'. $row['hora_cambio'] . '</td>';
								echo '<td>'. $row['id_estatus_old'] . ' --> ' . $row['nombre_estatus_old'] .'</td>';
								echo '<td>'. $row['id_estatus_new'] . ' --> ' . $row['nombre_estatus_new'] .'</td>';
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