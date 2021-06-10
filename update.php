<?php 

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$f_idError = null;
		$nsError = null;
		$c_idError = null;
		$id_cError = null;
		$ce_Error = null;
		$id_tError = null;
		$id_matError = null;
		$id_ubError = null;
		$id_estError = null;
	

		// keep track post values
		
		$f_id = $_POST['f_id'];
		$ns = $_POST['ns'];
		$id_c = $_POST['id_c'];
		$ce = $_POST['ce'];
		$id_t = $_POST['id_t'];
		$id_mat = $_POST['id_mat'];
		$id_ub = $_POST['id_ub'];
		$id_est = $_POST['id_est'];
		
		
		/// validate input
		$valid = true;

		if (empty($ns)) {
			$nsError = 'Por favor escribe el numero de serie de la herramienta';
			$valid = false;
		}
		if (empty($id_c)) {
			$id_cError = 'Por favor selecciona una caracteristica de la herramienta';
			$valid = false;
		}
		if (empty($ce)) {
			$ce_Error = 'Por favor escriba una caracteristica extra';
			$valid = false;
		}	
		if (empty($id_t)) {
			$id_tError = 'Por favor seleccione el tipo de elemento';
			$valid = false;
		}
		if (empty($id_mat)) {
			$id_matError = 'Porfavor escribe la materia en donde se utiliza este elemento o N/A si no existe';
			$valid = false;
		}
		if (empty($id_ub)) {
			$id_ubError = 'Porfavor seleccione la ubicacion de este elemento';
			$valid = false;
		}	
		if (empty($id_est)) {
			$id_estError = 'Por favor seleccione el status de este equipo';
			$valid = false;
		}
		
		
		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//Update elemento
			$sql = "UPDATE `elemento` SET numero_serie = ?,id_caracteristica= ?,caracteristica_extra= ?,id_tipo= ?, id_materia=?, id_ubicacion= ? WHERE id_elemento = ?";
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($ns,$id_c,$ce,$id_t,$id_mat,$id_ub,$id),FILTER_SANITIZE_STRING));
			Database::disconnect();

			//Update Estatus
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE elemento_estatus SET id_estatus= ? WHERE id_elemento = ?";
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($id_est,$id),FILTER_SANITIZE_STRING));

			Database::disconnect();			
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT elemento.id_elemento, numero_serie, elemento.id_caracteristica, elemento.caracteristica_extra, elemento.id_tipo, elemento.id_materia, elemento.id_ubicacion, elemento_estatus.id_estatus  FROM elemento_estatus 
		INNER JOIN elemento ON elemento_estatus.id_elemento = elemento.id_elemento
		INNER JOIN estatus ON estatus.id_estatus = elemento_estatus.id_estatus
		WHERE elemento.id_elemento = ?;";

		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		echo '<pre>'; print_r($data); echo '</pre>';

		$f_id = $data['id_elemento'];
		$ns = $data['numero_serie'];
		$id_c = $data['id_caracteristica'];
		$ce = $data['caracteristica_extra'];
		$id_t = $data['id_tipo'];
		$id_mat = $data['id_materia'];
		$id_ub = $data['id_ubicacion'];
		$id_est = $data['id_estatus'];
		
		Database::disconnect();
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
		    		<h3>Actualizar datos de un auto</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  
					  <div class="control-group <?php echo !empty($f_idError)?'error':'';?>">

					    <label class="control-label">id</label>
							<div class="controls">
								<input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
								<?php if (!empty($f_idError)): ?>
									<span class="help-inline"><?php echo $f_idError;?></span>
								<?php endif; ?>
							</div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($nsError)?'error':'';?>">
					    <label class="control-label">Numero de serie</label>
					    <div class="controls">
					      	<input name="ns" type="text" placeholder="Numero de Serie" value="<?php echo !empty($ns)?$ns:'';?>">
					      	<?php if (!empty($nsError)): ?>
					      		<span class="help-inline"><?php echo $nsError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					
					  <div class="control-group <?php echo !empty($id_cError)?'error':'';?>">
					    	<label class="control-label">Caracteristica</label>
					    	<div class="controls">
                            	<select name ="id_c">
                                    <option value="">Selecciona una caracteristica</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM caracteristica';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_caracteristica']==$id_c)
                        	   						echo "<option selected value='" . $row['id_caracteristica'] . "'>" .$row['nombre_largo_caracteristica'].' -> '.$row['descripcion']. "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_caracteristica'] . "'>" .$row['nombre_largo_caracteristica'].' -> '.$row['descripcion']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_cError)): ?>
					      		<span class="help-inline"><?php echo $id_cError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

					  <div class="control-group <?php echo !empty($ce_Error)?'error':'';?>">
					    <label class="control-label">Característica extra</label>
					    <div class="controls">
					      	<input name="ce" type="text" placeholder="submarca" value="<?php echo !empty($ce)?$ce:'';?>">
					      	<?php if (!empty($ce_Error)): ?>
					      		<span class="help-inline"><?php echo $ce_Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($id_tError)?'error':'';?>">
					    	<label class="control-label">Tipo de elemento</label>
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
                        	   						echo "<option value='" . $row['id_tipo'] . "'>" . $row['nombre_tipo']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_tError)): ?>
					      		<span class="help-inline"><?php echo $id_tError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

					  
						  <div class="control-group <?php echo !empty($id_matError)?'error':'';?>">
					    	<label class="control-label">Materia en la que se utiliza</label>
					    	<div class="controls">
                            	<select name ="id_mat">
                                    <option value="">Selecciona una materia</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM materia';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_materia']==$id_mat)
                        	   						echo "<option selected value='" . $row['id_materia'] . "'>" . $row['clave_materia'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_materia'] . "'>" . $row['clave_materia']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_matError)): ?>
					      		<span class="help-inline"><?php echo $id_matError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

						  <div class="control-group <?php echo !empty($id_ubError)?'error':'';?>">
					    	<label class="control-label">Ubicación</label>
					    	<div class="controls">
                            	<select name ="id_ub">
                                    <option value="">Selecciona una ubicación</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM ubicacion';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_ubicacion']==$id_ub)
                        	   						echo "<option selected value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_ubicacion'] . "'>" . $row['nombre_ubicacion']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_ubError)): ?>
					      		<span class="help-inline"><?php echo $id_ubError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

						  <div class="control-group <?php echo !empty($id_estError)?'error':'';?>">
					    	<label class="control-label">Estatus</label>
					    	<div class="controls">
                            	<select name ="id_est">
                                    <option value="">Selecciona una estatus</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM estatus';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_estatus']==$id_est)
                        	   						echo "<option selected value='" . $row['id_estatus'] . "'>" . $row['id_estatus'] . ' -> ' . $row['nombre_estatus'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_estatus'] . "'>" . $row['id_estatus'] . ' -> ' . $row['nombre_estatus']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_estError)): ?>
					      		<span class="help-inline"><?php echo $id_estError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>


						


						  

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>