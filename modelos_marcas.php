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
	    			<h3>Modelos y Marcas</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="index.php" class="btn btn-info">Regresar al inventario</a>
                        <a href="create_modelo.php" class="btn btn-info">Agregar un modelo</a>
                        <a href="create_marcas.php" class="btn btn-info">Agregar una marca</a>
                        <a href="marcas.php" class="btn btn-info">Consultar marcas vigentes</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID</th>
			                	<th>Modelo</th>
			                	<th>Marca</th>
			                	<th>Accion</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT id_modelo, nombre_modelo, nombre_marca FROM modelo 
						   	INNER JOIN marca ON marca.id_marca = modelo.id_marca 
						   	ORDER BY modelo.id_modelo;';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_modelo'] . '</td>';
	    					  	echo '<td>'. $row['nombre_modelo'] . '</td>';
	    					  	echo '<td>'. $row['nombre_marca'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=250>';
	    					  	echo '<a class="btn btn-success" href="update_modelo.php?id='.$row['id_modelo'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete_modelo.php?id='.$row['id_modelo'].'">Eliminar</a>';
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