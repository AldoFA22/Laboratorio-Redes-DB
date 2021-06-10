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
						<a href="create.php" class="btn btn-info">Agregar nuevo elemento</a>
						<a href="caracteristicas/caracteristicas.php" class="btn btn-info">Listas de caracteristicas</a>
						<a href="modelos_marcas.php" class="btn btn-info">Consultar modelos y marcas vigentes</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID Elemento</th>
			                	<th>Nombre Corto</th>
	                        	<th>Nombre Largo</th>
								<th>Marca</th>
								<th>Ubicacion</th>
								<th>Estatus</th>
								<th>Acciones</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT elemento.id_elemento ,nombre_caracteristica, nombre_largo_caracteristica, descripcion, nombre_marca, nombre_ubicacion, nombre_estatus FROM elemento_estatus 
								INNER JOIN elemento ON elemento_estatus.id_elemento = elemento.id_elemento
								INNER JOIN estatus ON estatus.id_estatus = elemento_estatus.id_estatus 
								INNER JOIN ubicacion ON elemento.id_ubicacion = ubicacion.id_ubicacion 
								INNER JOIN caracteristica ON elemento.id_caracteristica = caracteristica.id_caracteristica 
								INNER JOIN modelo ON caracteristica.id_modelo_marca = modelo.id_modelo
								INNER JOIN marca ON modelo.id_marca = marca.id_marca
								ORDER BY elemento.id_elemento ASC;';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_elemento'] . '</td>';
	    					  	echo '<td>'. $row['nombre_caracteristica'] . '</td>';							   	
	    					   	echo '<td>'. $row['nombre_largo_caracteristica'] . '</td>';
								echo '<td>'. $row['nombre_marca'] . '</td>';
								echo '<td>'. $row['nombre_ubicacion'] . '</td>';
								echo '<td>'. $row['nombre_estatus'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=250>';
	    					   	echo '<a class="btn" href="read.php?id='.$row['id_elemento'].'">Detalles</a>';
	    					   	echo '&nbsp;';
	    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['id_elemento'].'">Actualizar</a>';
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
