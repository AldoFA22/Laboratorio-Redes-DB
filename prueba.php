<?php
// Below is optional, remove if you have already connected to your database.

include 'database.php';
$pdo = Database::connect();

$mysqli = mysqli_connect('localhost', 'root', 'root', 'laboratorio');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('id_elemento','numero_serie','caracteristica_extra');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT * FROM elemento ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>PHP & MySQL Table Sorting by CodeShack</title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
			<style>
			html {
				font-family: Tahoma, Geneva, sans-serif;
				padding: 10px;
			}
			table {
				border-collapse: collapse;
				width: 500px;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: cursive;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
			</style>
		</head>
		<body>
			<table>
				<tr>
					<th><a href="prueba.php?column=id_elemento&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'id_elemento' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="prueba.php?column=numero_serie&order=<?php echo $asc_or_desc; ?>">Numero Serie<i class="fas fa-sort<?php echo $column == 'numero_serie' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="prueba.php?column=caracteristica_extra&order=<?php echo $asc_or_desc; ?>">Caracteristicae<i class="fas fa-sort<?php echo $column == 'caracteristica_extra' ? '-' . $up_or_down : ''; ?>"></i></a></th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'id_elemento' ? $add_class : ''; ?>><?php echo $row['id_elemento']; ?></td>
					<td<?php echo $column == 'numero_serie' ? $add_class : ''; ?>><?php echo $row['numero_serie']; ?></td>
					<td<?php echo $column == 'caracteristica_extra' ? $add_class : ''; ?>><?php echo $row['caracteristica_extra']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		</body>
	</html>
	<?php
	$result->free();
}
	Database::disconnect();
?>