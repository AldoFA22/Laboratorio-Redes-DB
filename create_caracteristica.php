<?php 
	
	require 'database.php';

		$id_hError = null;
		$ncError = null;
		$nlError = null;
		$nsError = null;
		$modError = null;
		$macError = null;
		$mac2Error = null;
		$cantError = null;
		$id_cError = null;
		$id_eError = null;
		$id_tError = null;
		$id_mError = null;

		//$perError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
		$id_h = $_POST['id_h'];
		$nc = $_POST['nc'];
		$nl = $_POST['nl'];
		$ns = $_POST['ns'];
		$mod = $_POST['mod'];
		$mac = $_POST['mac'];
		$mac2 = $_POST['mac2'];
		$cant = $_POST['cant'];
		$id_c = $_POST['id_c'];
		$id_e = $_POST['id_e'];
		$id_t = $_POST['id_t'];
		$id_m = $_POST['id_m'];

		
		// validate input
		$valid = true;
		
		if (empty($nc)) {
			$ncError = 'Porfavor escribe el nombre corto de la herramienta';
			$valid = false;
		}
		if (empty($nl)) {
			$nlError = 'Porfavor escribe el nombre completo de la herramienta';
			$valid = false;
		}
		if (empty($ns)) {
			$nsError = 'Porfavor escribe el numero de serie';
			$valid = false;
		}	
		if (empty($mod)) {
			$modError = 'Porfavor escribe el modelo';
			$valid = false;
		}
		if (empty($mac)) {
			$macError = 'Porfavor escribe la direccion mac o N/A si no existe';
			$valid = false;
		}
		if (empty($mac2)) {
			$mac2Error = 'Porfavor escribe la direccion mac o N/A si no existe';
			$valid = false;
		}	
		if (empty($cant)) {
			$cantError = 'Porfavor indique la cantidad de esta herramienta';
			$valid = false;
		}
		if (empty($id_c)) {
			$id_cError = 'Porfavor seleccione la clave de caracteristicas';
			$valid = false;
		}	
		if (empty($id_e)) {
			$id_eError = 'Porfavor seleccione un estatus';
			$valid = false;
		}
		if (empty($id_t)) {
			$id_tError = 'Porfavor seleccione el tipo de herramienta';
			$valid = false;
		}
		if (empty($id_m)) {
			$id_mError = 'Porfavor seleccione una marca';
			$valid = false;
		}	
		
		// insert data
		if ($valid) {
			var_dump($_POST);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "INSERT INTO herramienta ( nombre_corto, nombre_largo, numero_serie, modelo, mac, mac_opcional, cantidad, id_caracteristica, id_estatus, id_tipo, id_marca) values(?,?,?,?,?,?,?,?,?,?,?)";			
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
				
					<div class="control-group <?php echo !empty($ncError)?'error':'';?>">
						<label class="control-label">Nombre corto</label>
					    <div class="controls">
					      	<input name="nc" type="text"  placeholder="nombre corto" value="<?php echo !empty($nc)?$nc:'';?>">
							  <?php echo '<script>console.log($nc)</script>';?>
					      	<?php if (($ncError != null)) ?>
					      		<span class="help-inline"><?php echo $ncError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($nlError)?'error':'';?>">
						<label class="control-label">Nombre largo</label>
					    <div class="controls">
					      	<input name="nl" type="text"  placeholder="nombre largo" value="<?php echo !empty($nl)?$nl:'';?>">
					      	<?php if (($nlError != null)) ?>
					      		<span class="help-inline"><?php echo $nlError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($nsError)?'error':'';?>">
						<label class="control-label">Numero serie</label>
					    <div class="controls">
					      	<input name="ns" type="text"  placeholder="numero de serie" value="<?php echo !empty($ns)?$ns:'';?>">
					      	<?php if (($nsError != null)) ?>
					      		<span class="help-inline"><?php echo $nsError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($modError)?'error':'';?>">
						<label class="control-label">Modelo</label>
					    <div class="controls">
					      	<input name="mod" type="text"  placeholder="Modelo" value="<?php echo !empty($mod)?$mod:'';?>">
					      	<?php if (($modError != null)) ?>
					      		<span class="help-inline"><?php echo $modError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($macError)?'error':'';?>">
						<label class="control-label">Mac (Opcional) </label>
					    <div class="controls">
					      	<input name="mac" type="text"  placeholder="Direccion Mac" value="<?php echo !empty($mac)?$mac:'';?>">
					      	<?php if (($macError != null)) ?>
					      		<span class="help-inline"><?php echo $macError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($mac2Error)?'error':'';?>">
						<label class="control-label">Mac 2 (Opcional)</label>
					    <div class="controls">
					      	<input name="mac2" type="text"  placeholder="Dirección Mac 2" value="<?php echo !empty($mac2)?$mac2:'';?>">
					      	<?php if (($mac2Error != null)) ?>
					      		<span class="help-inline"><?php echo $mac2Error;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($cantError)?'error':'';?>">
						<label class="control-label">Cantidad</label>
					    <div class="controls">
					      	<input name="cant" type="text"  placeholder="Cantidad" value="<?php echo !empty($cant)?$cant:'';?>">
					      	<?php if (($cantError != null)) ?>
					      		<span class="help-inline"><?php echo $cantError;?></span>						      	
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

					<div class="control-group <?php echo !empty($id_eError)?'error':'';?>">
				    	<label class="control-label">Estatus</label>
				    	<div class="controls">
	                       	<select name ="id_e">
		                        <option value="">Selecciona un estatus</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM estatus';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_estatus']==$id_e)
		                        			echo "<option selected value='" . $row['id_estatus'] . "'>" . $row['nombre_estatus'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_estatus'] . "'>" . $row['nombre_estatus'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_eError) != null) ?>
					      		<span class="help-inline"><?php echo $id_eError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_tError)?'error':'';?>">
				    	<label class="control-label">Tipo de herramienta</label>
				    	<div class="controls">
	                       	<select name ="id_t">
		                        <option value="">Selecciona un tipo</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM tipo';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_tipo']==$id_t)
		                        			echo "<option selected value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo'] . "</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_eError) != null) ?>
					      		<span class="help-inline"><?php echo $id_tError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_mError)?'error':'';?>">
				    	<label class="control-label">Marca</label>
				    	<div class="controls">
	                       	<select name ="id_m">
		                        <option value="">Selecciona un modelo</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM modelo';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_modelo']==$id_m)
		                        			echo "<option selected value='" . $row['id_modelo'] . "'>" . $row['nombre_modelo'] . "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_modelo'] . "'>" . $row['nombre_modelo'] . "</option>";
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