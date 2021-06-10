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
	    			<h3>Tabla de caracteristicas</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="/inventario/index.php" class="btn btn-light">Regresar al inventario</a>
                        <a href="/inventario/create_caracteristica.php" class="btn btn-warning">Agregar una característica</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID Elemento</th>
			                	<th>Nombre Corto</th>
	                        	<th>Nombre Largo</th>
								<th>Descripción</th>
								<th>Modelo-Marca</th>
								<th>Acciones</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT caracteristica.*, modelo.*, marca.* FROM caracteristica
						   	INNER JOIN modelo ON caracteristica.id_modelo_marca = modelo.id_modelo 
						   	INNER JOIN marca ON modelo.id_marca = marca.id_marca ORDER BY caracteristica.id_caracteristica;';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_caracteristica'] . '</td>';
	    					  	echo '<td>'. $row['nombre_caracteristica'] . '</td>';							   	
	    					   	echo '<td>'. $row['nombre_largo_caracteristica'] . '</td>';
								echo '<td>'. $row['descripcion'] . '</td>';
								echo '<td>'. $row['nombre_modelo'] . '/' . $row['nombre_marca'] .'</td>';
	                            echo'</td>';
	                            echo '<td width=200>';
	    					  	echo '<a class="btn btn-success" href="update_caracteristica.php?id='.$row['id_caracteristica'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete_caracteristica.php?id='.$row['id_caracteristica'].'">Eliminar</a>';
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