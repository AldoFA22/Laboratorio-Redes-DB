<?php 
	
	require 'database.php';

		$id_eError = null;
		$nsError = null;
		$modError = null;
		$id_cError = null;
		$id_eError = null;
		$id_tError = null;
		$id_mError = null;

		//$perError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
		$id_e = $_POST['id_e'];
		$ns = $_POST['ns'];
		$id_c = $_POST['id_c'];
		$mod = $_POST['mod'];
		$id_e = $_POST['id_e'];
		$id_t = $_POST['id_t'];
		$id_m = $_POST['id_m'];
		
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
		if (empty($mod)) {
			$modError = 'Por favor escriba una caracteristica extra';
			$valid = false;
		}
		if (empty($id_e)) {
			$id_eError = 'Por favor seleccione un tipo de elemento';
			$valid = false;
		}
		if (empty($id_t)) {
			$id_tError = 'Por favor seleccione una materia';
			$valid = false;
		}
		if (empty($id_m)) {
			$id_mError = 'Por favor seleccione una ubicación';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			var_dump($_POST);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "INSERT INTO elemento ( numero_serie, id_caracteristica, caracteristica_extra, id_tipo, id_materia, id_ubicacion) values(?,?,?,?,?,?)";			
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($nc, $nl, $ns, $mod, $mac, $mac2, $cant, $id_c, $id_e, $id_t, $id_m), FILTER_SANITIZE_STRING));			
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
		                        <option value="">Nombre/clave caracteristica</option>
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

					<div class="control-group <?php echo !empty($modError)?'error':'';?>">
						<label class="control-label">Caracteristica extra</label>
					    <div class="controls">
					      	<input name="mod" type="text"  placeholder="Caracteristica extra" value="<?php echo !empty($mod)?$mod:'';?>">
					      	<?php if (($modError != null)) ?>
					      		<span class="help-inline"><?php echo $modError;?></span>						      	
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

					<div class="control-group <?php echo !empty($id_tError)?'error':'';?>">
				    	<label class="control-label">Materia en la que se utiliza</label>
				    	<div class="controls">
	                       	<select name ="id_t">
		                        <option value="">Selecciona una materia</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM materia';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_materia']==$id_t)
		                        			echo "<option selected value='" . $row['id_tipo'] . "'>" . $row['clave_materia'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_tipo'] . "'>" . $row['clave_materia'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_eError) != null) ?>
					      		<span class="help-inline"><?php echo $id_tError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_mError)?'error':'';?>">
				    	<label class="control-label">Ubicación</label>
				    	<div class="controls">
	                       	<select name ="id_m">
		                        <option value="">Selecciona una ubicación</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM ubicacion';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_ubicacion']==$id_m)
		                        			echo "<option selected value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_mError) != null) ?>
					      		<span class="help-inline"><?php echo $id_mError;?></span>
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