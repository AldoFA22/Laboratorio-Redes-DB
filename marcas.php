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
	    			<h3>Marcas</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="modelos_marcas.php" class="btn btn-light">Regresar a modelos y marcas</a>
                        <a href="create_marcas.php" class="btn btn-warning">Agregar una marca</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID Herramienta</th>
			                	<th>Marca</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM marca';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_marca'] . '</td>';
	    					  	echo '<td>'. $row['nombre_marca'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=250>';
	    					  	echo '<a class="btn btn-success" href="update_marcas.php?id='.$row['id_marca'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete_marcas.php?id='.$row['id_marca'].'">Eliminar</a>';
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