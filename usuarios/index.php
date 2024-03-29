<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href="../css/bootstrap.min.css" rel="stylesheet">
	    <script src="../js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    		<div class="row">
	    			<h3>Lista de usuarios</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
						<a href="create_usuario.php" class="btn btn-warning">Agregar nuevo usuario</a>
						<!-- <a href="../usuarios/index.php" class="btn btn-info">Lista de Usuarios</a> -->
						<a href="usuarios.php" class="btn btn-info">Consultar usuarios</a>
						<a href="apartados/index.php" class="btn btn-info">Crear apartado</a>
					</p>
					
					<table class="table table-striped table-bordered" class="table table-sm">
			            <thead>
			                <tr>		                 
			                	<th>ID Apartado</th>
			                	<th>Herramienta</th>
	                        	<th>Usuario</th>
								<th>Fecha de Apartado</th>
								<th>Fecha de Entrega</th>
								<th>Entregado</th>
								<th>Acciones</th>
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include '../Database_pg.php';
							include '../database.php';
						   	$pdo = new Database_pg;
						   	$sql = 'SELECT * FROM apartados NATURAL JOIN usuarios;';

                            $query = $pdo->prepare($sql);
        			        $query->execute();
        			        
                    
        			        $apartados = $query->fetchAll(PDO::FETCH_OBJ);

                            $pdo_mysql = Database::connect();
							$pdo_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 				   	foreach ($apartados as $row) {
											
								$query = "SELECT * FROM elemento INNER JOIN caracteristica ON elemento.id_caracteristica = caracteristica.id_caracteristica WHERE id_elemento = ?";
								$q = $pdo_mysql->prepare($query);
								$q->execute(filter_var_array(array($row->id_herramienta),FILTER_SANITIZE_STRING));
								$data = $q->fetch(PDO::FETCH_ASSOC);	

								echo '<tr>';
								echo '<td>'. $row->id_apartado . '</td>';
	    					  	echo '<td>'. $row->id_herramienta . ' - ' . $data['nombre_largo_caracteristica']. '</td>';							   	
	    					   	echo '<td>'. $row->matricula_usuario . ' - ' . $row->nombre_usuario . ' ' . $row->apellido_usuario . '</td>';
								echo '<td>'. $row->fecha_creacion . '</td>';
								echo '<td>'. $row->fecha_entrega . '</td>';
                                echo '<td><input type="checkbox" disabled '. (($row->entregado)? 'checked' : '').'></td>';
	                            echo'</td>';

	                            echo '<td width=250>';
	    					   	echo '<a class="btn" href="read.php?id='.$row->id_apartado.'">Detalles</a>';
	    					   	echo '&nbsp;';
	    					  	echo '<a class="btn btn-success" href="update.php?id='.$row->id_apartado.'">Actualizar</a>';
	    					   	echo '&nbsp;';
	    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row->id_apartado.'">Eliminar</a>';
	    					   	echo '</td>';
							  	echo '</tr>';
						    }
							Database::disconnect();	
                            $pdo->close();
						  	?>
					    </tbody>
		            </table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>
