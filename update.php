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

		// keep track post values

		$f_id = $_POST['id_h'];
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
		
		/// validate input
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
		
		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE herramienta set id_herramienta = ?, nombre_corto = ?, nombre_largo = ?, numero_serie = ?, modelo = ?, id_caracteristica = ?, mac = ?, mac_opcional = ?, id_estatus = ?, id_tipo = ?, id_marca = ?, cantidad = ?  where id_herramienta = ?";
			
			$q = $pdo->prepare($sql);

			//$q->execute(array($f_id,$subm,$marc,$id));
			$q->execute(filter_var_array(array($f_id,$nc,$nl,$ns,$mod,$id_c,$mac,$mac2,$id_e,$id_t,$id_m,$cant,$id),FILTER_SANITIZE_STRING));

			Database::disconnect();			
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM herramienta where id_herramienta = ?";

		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$f_id = $data['id_herramienta'];
		//$id_h = $_data['id_herramienta'];
		$nc = $_data['nombre_corto'];
		$nl = $_data['nombre_largo'];
		$ns = $_data['numero_serie'];
		$mod = $_data['modelo'];
		$mac = $_data['mac'];
		$mac2 = $_data['mac_opcional'];
		$cant = $_data['cantidad'];
		$id_c = $_data['id_caracteristica'];
		$id_e = $_data['id_estatus'];
		$id_t = $_data['id_tipo'];
		$id_m = $_data['id_marca'];
		
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
					  
					  <div class="control-group <?php echo !empty($ncError)?'error':'';?>">
					    <label class="control-label">Nombre corto</label>
					    <div class="controls">
					      	<input name="nc" type="text" placeholder="submarca" value="<?php echo !empty($nc)?$nc:'';?>">
					      	<?php if (!empty($ncError)): ?>
					      		<span class="help-inline"><?php echo $ncError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($nlError)?'error':'';?>">
					    <label class="control-label">Nombre largo</label>
					    <div class="controls">
					      	<input name="nl" type="text" placeholder="submarca" value="<?php echo !empty($nl)?$nl:'';?>">
					      	<?php if (!empty($nlError)): ?>
					      		<span class="help-inline"><?php echo $nlError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($nsError)?'error':'';?>">
					    <label class="control-label">Numero serie</label>
					    <div class="controls">
					      	<input name="ns" type="text" placeholder="submarca" value="<?php echo !empty($ns)?$ns:'';?>">
					      	<?php if (!empty($nsError)): ?>
					      		<span class="help-inline"><?php echo $nsError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($modError)?'error':'';?>">
					    <label class="control-label">Modelo</label>
					    <div class="controls">
					      	<input name="mod" type="text" placeholder="submarca" value="<?php echo !empty($mod)?$mod:'';?>">
					      	<?php if (!empty($modError)): ?>
					      		<span class="help-inline"><?php echo $modError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($macError)?'error':'';?>">
					    <label class="control-label">Mac</label>
					    <div class="controls">
					      	<input name="mac" type="text" placeholder="submarca" value="<?php echo !empty($mac)?$mac:'';?>">
					      	<?php if (!empty($macError)): ?>
					      		<span class="help-inline"><?php echo $macError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($mac2Error)?'error':'';?>">
					    <label class="control-label">Mac 2</label>
					    <div class="controls">
					      	<input name="mac2" type="text" placeholder="submarca" value="<?php echo !empty($mac2)?$mac2:'';?>">
					      	<?php if (!empty($mac2Error)): ?>
					      		<span class="help-inline"><?php echo $mac2Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($cantError)?'error':'';?>">
					    <label class="control-label">Cantidad</label>
					    <div class="controls">
					      	<input name="cant" type="text" placeholder="submarca" value="<?php echo !empty($cant)?$cant:'';?>">
					      	<?php if (!empty($cantError)): ?>
					      		<span class="help-inline"><?php echo $cantError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


						<div class="control-group <?php echo !empty($id_cError)?'error':'';?>">
					    	<label class="control-label">Caracteristica</label>
					    	<div class="controls">
                            	<select name ="id_c">
                                    <option value="">Selecciona una marca</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM caracteristica';
	 				   						foreach ($pdo->query($query) as $row) {
	 				   							if ($row['id_caracteristica']==$id_c)
                        	   						echo "<option selected value='" . $row['id_caracteristica'] . "'>" .$row['id_switch'].$row['id_kit'].$row['id_pinza'].$row['id_router'].$row['id_apoint'].$row['id_telefono'].$row['id_cable'].$row['id_servidor'].$row['id_modem'].$row['id_camara']. "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_caracteristica'] . "'>" .$row['id_switch'].$row['id_kit'].$row['id_pinza'].$row['id_router'].$row['id_apoint'].$row['id_telefono'].$row['id_cable'].$row['id_servidor'].$row['id_modem'].$row['id_camara']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_cError)): ?>
					      		<span class="help-inline"><?php echo $id_cError;?></span>
					      	<?php endif;?>
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
					      	<?php if (!empty($id_eError)): ?>
					      		<span class="help-inline"><?php echo $id_eError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

						  <div class="control-group <?php echo !empty($id_tError)?'error':'';?>">
					    	<label class="control-label">marca</label>
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
					      	<?php if (!empty($id_tError)): ?>
					      		<span class="help-inline"><?php echo $id_tError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

						  <div class="control-group <?php echo !empty($id_mError)?'error':'';?>">
					    	<label class="control-label">Marca</label>
					    	<div class="controls">
                            	<select name ="id_m">
                                    <option value="">Selecciona una marca</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM marca';
	 				   						foreach ($pdo->query($query) as $row) {
	 				   							if ($row['id_marca']==$id_m)
                        	   						echo "<option selected value='" . $row['id_marca'] . "'>" . $row['nombre_marca'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_marca'] . "'>" . $row['nombre_marca'] . "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_mError)): ?>
					      		<span class="help-inline"><?php echo $id_mError;?></span>
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