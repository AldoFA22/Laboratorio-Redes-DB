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
	    			<h3>Router</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
                        <a href="caracteristicas.php" class="btn btn-info">Regresar a lista de caracteristicas</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>Clave router</th>
			                	<th>Sistema Operativo</th>
			                	<th>Puertos FastEthernet</th>
                                <th>Puertos GigabitEthernet</th>
                                <th>Puertos Seriales</th>
			                	<th>Numero de Modulos VPN</th>
                                <th>Puertos USB</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM caracrouter';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr width=200>';
								echo '<td>'. $row['id_router'] . '</td>';
                                echo '<td>'. $row['sistemaop_router'] . '</td>';
                                echo '<td>'. $row['numero_puertos_fe'] . '</td>';
                                echo '<td>'. $row['numero_puertos_ge'] . '</td>';
                                echo '<td>'. $row['numero_puertos_seriales'] . '</td>';
                                echo '<td>'. $row['numero_modulosVPN'] . '</td>';
                                echo '<td>'. $row['numero_puertos_usb'] . '</td>';
	                            echo'</td>';
	                            echo '<td width=200>';
	    					  	echo '<a class="btn btn-success" href="update.php?id='.$row['id_router'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_router'].'">Eliminar</a>';
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