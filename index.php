<?php
// Below is optional, remove if you have already connected to your database.

$mysqli = mysqli_connect('localhost', 'root', 'root', 'laboratorio');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('id_elemento','nombre_caracteristica','nombre_largo_caracteristica','nombre_marca','nombre_ubicacion','nombre_estatus');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT * from elemento_resumen ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Inventario de Laboratorio de Redes</title>
	    <meta 	charset="utf-8">
	    <link   href="css/bootstrap.min.css" rel="stylesheet">
	    <script src="js/bootstrap.min.js"></script>
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 900px;
			}
			th {
				background-color: #f9fafb;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #90cbff;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #000000;
				font-size: 14px;
			}
			th a i {
				margin-left: 2px;
				color: rgba(0,0,0,1);
			}
			td {
				padding: 10px;
				color: #000000;
				border: 1px solid #cccccc;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #dddddd;
			}
			</style>
	</head>

	<body>
	    <div class="container">
	    		<div class="row">
	    			<h3>Inventario de Laboratorio de Redes</h3>
	    		</div>
				<div class="table-responsive container-fluid">
					<p>
						<a href="create.php" class="btn btn-warning">Agregar nuevo elemento</a>
						<a href="caracteristicas/caracteristicas.php" class="btn btn-info">Lista de caracteristicas</a>
						<a href="modelos_marcas.php" class="btn btn-info">Consultar modelos y marcas vigentes</a>
						<a href="apartados/index.php" class="btn btn-info">Lista de apartados</a>
						<a href="historial_estatus.php" class="btn btn-primary">Historial de estatus</a>
					</p>
					
					<table>
				<tr>
					<th><a href="index.php?column=id_elemento&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'id_elemento' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="index.php?column=nombre_caracteristica&order=<?php echo $asc_or_desc; ?>">Nombre Corto<i class="fas fa-sort<?php echo $column == 'nombre_caracteristica' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="index.php?column=nombre_largo_caracteristica&order=<?php echo $asc_or_desc; ?>">Nombre Largo<i class="fas fa-sort<?php echo $column == 'nombre_largo_caracteristica' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="index.php?column=nombre_marca&order=<?php echo $asc_or_desc; ?>">Marca<i class="fas fa-sort<?php echo $column == 'nombre_marca' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="index.php?column=nombre_ubicacion&order=<?php echo $asc_or_desc; ?>">Ubicación<i class="fas fa-sort<?php echo $column == 'nombre_ubicacion' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="index.php?column=nombre_estatus&order=<?php echo $asc_or_desc; ?>">Estatus<i class="fas fa-sort<?php echo $column == 'nombre_estatus' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a> Acciones </a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'id_elemento' ? $add_class : ''; ?>><?php echo $row['id_elemento']; ?></td>
					<td<?php echo $column == 'nombre_caracteristica' ? $add_class : ''; ?>><?php echo $row['nombre_caracteristica']; ?></td>
					<td<?php echo $column == 'nombre_largo_caracteristica' ? $add_class : ''; ?>><?php echo $row['nombre_largo_caracteristica']; ?></td>
					<td<?php echo $column == 'nombre_marca' ? $add_class : ''; ?>><?php echo $row['nombre_marca']; ?></td>
					<td<?php echo $column == 'nombre_ubicacion' ? $add_class : ''; ?>><?php echo $row['nombre_ubicacion']; ?></td>
					<td<?php echo $column == 'nombre_estatus' ? $add_class : ''; ?>><?php echo $row['nombre_estatus']; ?></td>
					<td width=250 <?php echo $column == 'acciones' ? $add_class : '';?>><?php
				   	echo '<a class="btn" href="read.php?id='.$row['id_elemento'].'">Detalles</a>';
				   	echo '&nbsp;';
				  	echo '<a class="btn btn-success" href="update.php?id='.$row['id_elemento'].'">Actualizar</a>';
				   	echo '&nbsp;';
				   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_elemento'].'">Eliminar</a>';
				    ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>
<?php
	$result->free();
}
?>