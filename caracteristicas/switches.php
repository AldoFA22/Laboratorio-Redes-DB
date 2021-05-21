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
	    			<h3>Switches</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="caracteristicas.php" class="btn btn-info">Regresar a lista de caracteristicas</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>Clave switch</th>
			                	<th>Sistema Operativo</th>
                                <th>Memoria flash</th>
			                	<th>Puertos FastEthernet</th>
                                <th>Puertos GigabitEthernet</th>
			                	<th>Velocidad minima de datos</th>
                                <th>Velocidad maxima de datos</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM caracswitch';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_switch'] . '</td>';
                                echo '<td>'. $row['sistemaop_switch'] . '</td>';
                                echo '<td>'. $row['flash'] . '</td>';
                                echo '<td>'. $row['num_puertos_fe'] . '</td>';
                                echo '<td>'. $row['num_puertos_ge'] . '</td>';
                                echo '<td>'. $row['velocidad_min'] . '</td>';
                                echo '<td>'. $row['velocidad_max'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=200>';
	    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['id_caracteristica'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_caracteristica'].'">Eliminar</a>';
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