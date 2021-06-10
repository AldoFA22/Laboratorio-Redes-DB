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
		$nombre_cError = null;
		$nombreLargo_cError = null;
		$id_modeloError = null;
		$descripcion_error = null;
	

		// keep track post values
		
		$id = $_POST['id'];
		$nombre_c = $_POST['nombre_c'];
		$nombreLargo_c = $_POST['nombreLargo_c'];
		$id_modelo = $_POST['id_modelo'];
		$descripcion = $_POST['descripcion'];
		
		/// validate input
		$valid = true;

		if (empty($id)) {
			$nsError = 'Por favor inserte un id';
			$valid = false;
		}
		if (empty($nombre_c)) {
			$nombre_cError = 'Por favor ingrese un nombre';
			$valid = false;
		}
		if (empty($nombreLargo_c)) {
			$nombreLargo_cError = 'Por favor escriba un nombre largo para esta caracteristica';
			$valid = false;
		}	
		if (empty($id_modelo)) {
			$id_modeloError = 'Por favor seleccione un modelo';
			$valid = false;
		}
		if (empty($descripcion)) {
			$descripcion_error = 'Por favor, ingrese una descripcion para esta caracteristica';
			$valid = false;
		}	
	
		
		
		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//Update elemento
			$sql = "UPDATE caracteristica SET nombre_caracteristica= ?, nombre_largo_caracteristica=?, id_modelo_marca=?, descripcion=? WHERE id_caracteristica= ?";
			$q = $pdo->prepare($sql);
			$q->execute(filter_var_array(array($nombre_c,$nombreLargo_c,$id_modelo, $descripcion, $id),FILTER_SANITIZE_STRING));
			Database::disconnect();

			header("Location: caracteristicas.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT id_caracteristica, nombre_caracteristica, nombre_largo_caracteristica, descripcion, modelo.id_modelo, modelo.nombre_modelo, modelo.id_marca, marca.*
                FROM `caracteristica` 
                INNER JOIN modelo ON caracteristica.id_modelo_marca = modelo.id_modelo 
                INNER JOIN marca ON modelo.id_marca = marca.id_marca
                WHERE id_caracteristica = ?;";

		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);

		$id = $data['id_caracteristica'];
		$nombre_c = $data['nombre_caracteristica'];
		$nombreLargo_c = $data['nombre_largo_caracteristica'];
		$id_modelo = $data['id_modelo'];
		$nombre_modelo = $data['nombre_modelo'];
		$nombre_marca = $data['nombre_marca'];
        $descripcion = $data['descripcion'];
		
		
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
		    		<h3>Actualizar datos de una</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update_caracteristica.php?id=<?php echo $id?>" method="post">
					  
					  <div class="control-group <?php echo !empty($id_Error)?'error':'';?>">

					    <label class="control-label">id</label>
							<div class="controls">
								<input name="id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
								<?php if (!empty($id_Error)): ?>
									<span class="help-inline"><?php echo $id_Error;?></span>
								<?php endif; ?>
							</div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($nombre_cError)?'error':'';?>">
					    <label class="control-label">Nombre</label>
					    <div class="controls">
					      	<input name="nombre_c" type="text" placeholder="Nombre" value="<?php echo !empty($nombre_c)?$nombre_c:'';?>">
					      	<?php if (!empty($nombre_cError)): ?>
					      		<span class="help-inline"><?php echo $nombre_cError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


                      <div class="control-group <?php echo !empty($nombreLargo_cError)?'error':'';?>">
					    <label class="control-label">Nombre Largo</label>
					    <div class="controls">
					      	<input name="nombreLargo_c" type="text" placeholder="Nombre Largo (50)" value="<?php echo !empty($nombreLargo_c)?$nombreLargo_c:'';?>">
					      	<?php if (!empty($nombreLargo_cError)): ?>
					      		<span class="help-inline"><?php echo $nombreLargo_cError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					
					  <div class="control-group <?php echo !empty($id_modeloError)?'error':'';?>">
					    	<label class="control-label">Marca/Modelo</label>
					    	<div class="controls">
                            	<select name ="id_modelo">
                                    <option value="">Seleccion de Modelo/Marca</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM modelo INNER JOIN marca ON modelo.id_marca = marca.id_marca';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_modelo']==$id_modelo)
                        	   						echo "<option selected value='" . $row['id_modelo'] . "'>" .$row['nombre_modelo'].' / '.$row['nombre_marca']. "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_modelo'] . "'>" .$row['nombre_modelo'].' / '.$row['nombre_marca']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_modeloError)): ?>
					      		<span class="help-inline"><?php echo $id_modeloError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

					  <div class="control-group <?php echo !empty($descripcion_Error)?'error':'';?>">
					    <label class="control-label">Descripcion</label>
					    <div class="controls">
					      	<input name="descripcion" type="text" placeholder="Descripcion" value="<?php echo !empty($descripcion)?$descripcion:'';?>">
					      	<?php if (!empty($descripcion_Error)): ?>
					      		<span class="help-inline"><?php echo $descripcion_Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="caracteristicas.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>