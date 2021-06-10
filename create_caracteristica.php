<?php 
	
	require 'database.php';

		$id_elError = null;
		$ncError = null;
		$nlError = null;
		$id_m_mError = null;
		$id_dError = null;

		//$perError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
		$id_el = $_POST['id_el'];
		$nc = $_POST['nc'];
		$nl = $_POST['nl'];
		$id_m_m = $_POST['id_m_m'];
		$id_d = $_POST['id_d'];
		
		// validate input
		$valid = true;

		if (empty($nc)) {
			$ncError = 'Por favor escriba el nombre corto de la caracteristica';
			$valid = false;
		}	
		if (empty($nl)) {
			$nlError = 'Por favor escriba el nombre corto de la caracteristica';
			$valid = false;
		}	
		if (empty($id_m_m)) {
			$id_m_mError = 'Por favor seleccione un modelo';
			$valid = false;
		}	
		if (empty($id_d)) {
			$id_dError = 'Por favor agregue una descripción';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			var_dump($_POST);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$insert['first'] = $pdo->prepare("INSERT INTO caracteristica SET nombre_caracteristica = :nombre_caracteristica , nombre_largo_caracteristica = :nombre_largo_caracteristica, id_modelo_marca = :id_modelo_marca, descripcion = :descripcion"); 		

			$insert['first']->bindValue(':nombre_caracteristica', $nc);
			$insert['first']->bindValue(':nombre_largo_caracteristica', $nl);
			$insert['first']->bindValue(':id_modelo_marca', $id_m_m);
			$insert['first']->bindValue(':descripcion', $id_d);
			$insert['first']->execute();
			/*
			$sql = "INSERT INTO elemento ( numero_serie, id_caracteristica, caracteristica_extra, id_tipo, id_materia, id_ubicacion) values(?,?,?,?,?,?)";		
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($ns, $id_c, $ce, $id_e, $id_m, $id_u), FILTER_SANITIZE_STRING));	

			$sql. = "INSERT INTO elemento_estatus ( id_elemento, id_estatus) values(?,?)";			
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array(mysql_insert_id(), $id_es), FILTER_SANITIZE_STRING)); */
			
			Database::disconnect();
			header("Location: caracteristicas/caracteristicas.php");
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
		   			<h3>Agregar una caracteristica</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="create_caracteristica.php" method="post">

					<div class="control-group <?php echo !empty($ncError)?'error':'';?>">
						<label class="control-label">Nombre corto</label>
					    <div class="controls">
					      	<input name="nc" type="text"  placeholder="nombre corto" value="<?php echo !empty($nc)?$nc:'';?>">
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

					<div class="control-group <?php echo !empty($id_m_mError)?'error':'';?>">
				    	<label class="control-label">Modelo</label>
				    	<div class="controls">
	                       	<select name ="id_m_m">
		                        <option value="">Selecciona un modelo</option>
		                        <?php
							   		$pdo = Database::connect();
							   		$query = 'SELECT * FROM modelo, marca WHERE modelo.id_marca = marca.id_marca';
			 				   		foreach ($pdo->query($query) as $row) {
		                        		if ($row['id_modelo']==$id_m_m)
		                        			echo "<option selected value='" . $row['id_modelo'] . "'>" .$row['nombre_marca']. ' -> ' .$row['nombre_modelo']. "</option>";
		                        		else
		                        			echo "<option value='" . $row['id_modelo'] . "'>" .$row['nombre_marca']. ' -> '.$row['nombre_modelo']."</option>";
			   						}
			   						Database::disconnect();
			  					?>
                            </select>
					      	<?php if (($id_m_mError) != null) ?>
					      		<span class="help-inline"><?php echo $id_m_mError;?></span>
						</div>
					</div>

					<div class="control-group <?php echo !empty($id_dError)?'error':'';?>">
						<label class="control-label">Descripción</label>
					    <div class="controls">
					      	<input name="id_d" type="text"  placeholder="Agregue una descripción" value="<?php echo !empty($id_d)?$id_d:'';?>">
					      	<?php if (($id_dError != null)) ?>
					      		<span class="help-inline"><?php echo $id_dError;?></span>						      	
					    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="caracteristicas/caracteristicas.php">Regresar</a>
					</div>

				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>