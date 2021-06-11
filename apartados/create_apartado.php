<?php
require '../database.php';
require '../Database_pg.php';

$id_alumnoError = null;
$id_modeloError = null;

$fecha_creacion = date("Y-m-d").' 00:00:00';
$fecha_creacionError = null;
$fecha_entregaError = null;

if (!empty($_POST)) {
	print_r($_POST);
    // keep track post values		
    $id_alumno = $_POST['id_alumno'];
    $id_modelo = $_POST['id_modelo'];
	$fecha_entrega = $_POST['fecha_entrega'];
    

    // validate input
    $valid = true;

    if (empty($id_modelo)) {
        $id_modeloError = 'Porfavor asegure agregar un material o una herramienta';
        $valid = false;
    }

	if (empty($id_alumno)) {
        $id_alumnoError = 'Por favor agregue un usuario';
        $valid = false;
    }

	if (empty($fecha_entrega)) {
        $fecha_entregaError = 'Por favor agregue una fecha para la entrega del material solicitado';
        $valid = false;
    }

    // insert data
    if ($valid) {
        print_r($_POST);
		
		//Postgresql
		$pdo = new Database_pg;
		$sql = 'INSERT INTO apartados(id_herramienta,matricula_usuario,fecha_creacion,fecha_entrega,entregado) VALUES (:id_mod,:id_alumno, NOW(), :fecha,false)';
        try{
			$query = $pdo->prepare($sql);
			$query->bindParam(':id_mod', $id_modelo, PDO::PARAM_INT);
			$query->bindParam(':id_alumno', $id_alumno, PDO::PARAM_STR);
			$query->bindParam(':fecha', $fecha_entrega, PDO::PARAM_STR);
			$query->execute();
			$pdo->close();
		}
		catch(PDOException $e) {
			echo  $e->getMessage();
		}

		//Mysql Modificar la herramienta a no disponible

		$pdo_mysql = Database::connect();
        $pdo_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="UPDATE elemento_estatus SET id_estatus= 2 WHERE id_elemento = ?";
        $q = $pdo_mysql->prepare($sql);
        $q->execute(filter_var_array(array($id_modelo), FILTER_SANITIZE_STRING));
        Database::disconnect();
		
        //header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un nuevo modelo</h3>
            </div>

            <form class="form-horizontal" action="create_apartado.php" method="post">

                <div class="control-group <?php echo !empty($id_modeloError)?'error':'';?>">
				    	<label class="control-label">Material/Herramienta</label>
				    	<div class="controls">
	                       	<select name ="id_modelo">
		                        <option value="">Selecciona un instrumento</option>
		                        <?php
							   		$pdo = Database::connect();
									$query = "SELECT * FROM elemento INNER JOIN caracteristica ON elemento.id_caracteristica = caracteristica.id_caracteristica INNER JOIN elemento_estatus ON elemento.id_elemento = elemento_estatus.id_elemento INNER JOIN estatus ON elemento_estatus.id_estatus = estatus.id_estatus WHERE estatus.id_estatus = 1";
							   		
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_elemento']==$id_modelo)
		                        			echo "<option selected value='" . $row['id_elemento'] . "'>" .$row['id_elemento']. ': ' .$row['nombre_largo_caracteristica']. "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_elemento'] . "'>" .$row['id_elemento']. ': '.$row['nombre_largo_caracteristica']."</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_modeloError) != null) ?>
					      		<span class="help-inline"><?php echo $id_modeloError;?></span>
						</div>
					</div>


					<div class="control-group <?php echo !empty($id_alumnoError)?'error':'';?>">
				    	<label class="control-label">Usuario</label>
				    	<div class="controls">
	                       	<select name ="id_alumno">
		                        <option value="">Selecciona un usuario</option>
		                        <?php
							   		//Postgres
									$pdo = new Database_pg;
									$sql = 'SELECT * FROM usuarios;';
									$query = $pdo->prepare($sql);
									$query->execute();
									$apartados = $query->fetchAll(PDO::FETCH_OBJ);

							   		
			 				   		foreach ($apartados as $row) {
		                        		if ($row->id_usuario == $id_alumno)
		                        			echo "<option selected value='" . $row->id_usuario . "'>" .$row->id_usuario. ': ' .$row->nombre_usuario. "</option>";
		                        		else
		                        			echo "<option value='" . $row->id_usuario . "'>" .$row->id_usuario. ': ' .$row->nombre_usuario. "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_alumnoError) != null) ?>
					      		<span class="help-inline"><?php echo $id_alumnoError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($fecha_creacionError) ? 'error' : ''; ?>">
						<label class="control-label">Fecha de Creacion</label>
						<div class="controls">
							<input name="fecha_creacion" type="text" disabled placeholder="Fecha de creacion" value="<?php echo !empty($fecha_creacion) ? $fecha_creacion : ''; ?>">
							<?php if (($fecha_creacionError != null)) ?>
							<span class="help-inline"><?php echo $fecha_creacionError; ?></span>
						</div>
                	</div>

					<div class="control-group <?php echo !empty($fecha_entregaError) ? 'error' : ''; ?>">
						<label class="control-label">Fecha de Entrega del material</label>
						<div class="controls">
							<input name="fecha_entrega" type="date" placeholder="Fecha de Entrega" value="<?php echo !empty($fecha_entrega) ? $fecha_entrega : ''; ?>">
							<?php if (($fecha_entregaError != null)) ?>
							<span class="help-inline"><?php echo $fecha_entregaError; ?></span>
						</div>
                	</div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="index.php">Regresar</a>
                </div>

            </form>
        </div>
    </div> <!-- /container -->
</body>

</html>

