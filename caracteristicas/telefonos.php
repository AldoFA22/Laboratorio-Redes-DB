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
	    			<h3>Telefonos</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="caracteristicas.php" class="btn btn-info">Regresar a lista de caracteristicas</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>Clave telefono</th>
			                	<th>Numero de telefono</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM caractelefono';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_telefono'] . '</td>';
                                echo '<td>'. $row['numero_telefono'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=200>';
	    					  	echo '<a class="btn btn-success" href="updatepinza.php?id='.$row['id_pinza'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="deletepinza.php?id='.$row['id_pinza'].'">Eliminar</a>';
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