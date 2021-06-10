<?php 
	
	require 'database.php';

		$id_elError = null;
		$nsError = null;
		$ceError = null;
		$id_cError = null;
		$id_eError = null;
		$id_mError = null;
		$id_uError = null;
		$id_esError = null;

		//$perError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
		$id_el = $_POST['id_el'];
		$ns = $_POST['ns'];
		$id_c = $_POST['id_c'];
		$ce = $_POST['ce'];
		$id_e = $_POST['id_e'];
		$id_m = $_POST['id_m'];
		$id_u = $_POST['id_u'];
		$id_es = $_POST['id_es'];
		
		// validate input
		$valid = true;

		if (empty($ns)) {
			$nsError = 'Por favor escriba el numero de serie';
			$valid = false;
		}	
		if (empty($id_c)) {
			$id_cError = 'Por favor seleccione una caracteristica';
			$valid = false;
		}	
		if (empty($ce)) {
			$ceError = 'Por favor escriba una caracteristica extra';
			$valid = false;
		}
		if (empty($id_e)) {
			$id_eError = 'Por favor seleccione un tipo de elemento';
			$valid = false;
		}
		if (empty($id_m)) {
			$id_mError = 'Por favor seleccione una materia';
			$valid = false;
		}
		if (empty($id_u)) {
			$id_uError = 'Por favor seleccione una ubicación';
			$valid = false;
		}
		if (empty($id_es)) {
			$id_esError = 'Por favor seleccione un estatus';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			var_dump($_POST);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$insert['first'] = $pdo->prepare("INSERT INTO elemento SET numero_serie = :numero_serie , id_caracteristica = :id_caracteristica, caracteristica_extra = :caracteristica_extra, id_tipo = :id_tipo, id_materia = :id_materia, id_ubicacion = :id_ubicacion");
			$insert['second'] = $pdo->prepare("INSERT INTO elemento_estatus SET id_elemento = :id_elemento, id_estatus = :id_estatus"); 

			$pdo->beginTransaction();

			$insert['first']->bindValue(':numero_serie', $ns);
			$insert['first']->bindValue(':id_caracteristica', $id_c);
			$insert['first']->bindValue(':caracteristica_extra', $ce);
			$insert['first']->bindValue(':id_tipo', $id_e);
			$insert['first']->bindValue(':id_materia', $id_m);
			$insert['first']->bindValue(':id_ubicacion', $id_u);
			$insert['first']->execute();

			$insert['second']->bindValue(':id_elemento', $pdo->lastInsertId());
			$insert['second']->bindValue(':id_estatus', $id_es);
			$insert['second']->execute();
			
			/*$sql = "INSERT INTO elemento ( numero_serie, id_caracteristica, caracteristica_extra, id_tipo, id_materia, id_ubicacion) values(?,?,?,?,?,?)";		
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($ns, $id_c, $ce, $id_e, $id_m, $id_u), FILTER_SANITIZE_STRING));	

			$sql. = "INSERT INTO elemento_estatus ( id_elemento, id_estatus) values(?,?)";			
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array(mysql_insert_id(), $id_es), FILTER_SANITIZE_STRING)); */
			$pdo->commit();
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Agregar un nuevo elemento</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="create.php" method="post">

					<div class="control-group <?php echo !empty($nsError)?'error':'';?>">
						<label class="control-label">Numero serie</label>
					    <div class="controls">
					      	<input name="ns" type="text"  placeholder="numero de serie" value="<?php echo !empty($ns)?$ns:'';?>">
					      	<?php if (($nsError != null)) ?>
					      		<span class="help-inline"><?php echo $nsError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($id_cError)?'error':'';?>">
				    	<label class="control-label">Caracteristica</label>
				    	<div class="controls">
	                       	<select name ="id_c">
		                        <option value="">Caracteristica</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM caracteristica';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_caracteristica']==$id_c)
		                        			echo "<option selected value='" . $row['id_caracteristica'] . "'>" .$row['nombre_largo_caracteristica']. ' -> ' .$row['descripcion']. "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_caracteristica'] . "'>" .$row['nombre_largo_caracteristica']. ' -> ' .$row['descripcion']."</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_cError) != null) ?>
					      		<span class="help-inline"><?php echo $id_cError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($ceError)?'error':'';?>">
						<label class="control-label">Caracteristica extra</label>
					    <div class="controls">
					      	<input name="ce" type="text"  placeholder="Caracteristica extra" value="<?php echo !empty($ce)?$ce:'';?>">
					      	<?php if (($ceError != null)) ?>
					      		<span class="help-inline"><?php echo $ceError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($id_eError)?'error':'';?>">
				    	<label class="control-label">Tipo de elemento</label>
				    	<div class="controls">
	                       	<select name ="id_e">
		                        <option value="">Selecciona un tipo</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM tipo';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_tipo']==$id_e)
		                        			echo "<option selected value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_eError) != null) ?>
					      		<span class="help-inline"><?php echo $id_eError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_mError)?'error':'';?>">
				    	<label class="control-label">Materia en la que se utiliza</label>
				    	<div class="controls">
	                       	<select name ="id_m">
		                        <option value="">Selecciona una materia</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM materia';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_materia']==$id_m)
		                        			echo "<option selected value='" . $row['id_materia'] . "'>" . $row['clave_materia'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_materia'] . "'>" . $row['clave_materia'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_eError) != null) ?>
					      		<span class="help-inline"><?php echo $id_mError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_uError)?'error':'';?>">
				    	<label class="control-label">Ubicación</label>
				    	<div class="controls">
	                       	<select name ="id_u">
		                        <option value="">Selecciona una ubicación</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM ubicacion';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_ubicacion']==$id_u)
		                        			echo "<option selected value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_uError) != null) ?>
					      		<span class="help-inline"><?php echo $id_uError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_esError)?'error':'';?>">
				    	<label class="control-label">Estatus</label>
				    	<div class="controls">
	                       	<select name ="id_es">
		                        <option value="">Selecciona un estatus</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM estatus';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_estatus']==$id_es)
		                        			echo "<option selected value='" . $row['id_estatus'] . "'>" . $row['nombre_estatus'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_estatus'] . "'>" . $row['nombre_estatus'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_esError) != null) ?>
					      		<span class="help-inline"><?php echo $id_esError;?></span>
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