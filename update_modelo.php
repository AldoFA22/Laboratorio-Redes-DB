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
		$id_Error = null;
		$nom_modelo_Error = null;
        $marca_Error= null;
		
		// keep track post values
		$id = $_POST['id'];
        $nom_modelo = $_POST['nom_modelo'];
		$marc = $_POST['id_marca'];
		
		/// validate input
		$valid = true;

		if (empty($nom_modelo)) {
			$marcError = 'Porfavor escribe el nombre de un modelo';
			$valid = false;
		}		
		
		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
            $sql = "UPDATE modelo SET id_marca=?, nombre_modelo=? WHERE id_modelo = ?";

			
			$q = $pdo->prepare($sql);

            // $q->execute(array($f_id,$subm,$marc,$id));
            $q->execute(filter_var_array(array($marc,$nom_modelo,$id),FILTER_SANITIZE_STRING));
			
			Database::disconnect();			
			header("Location: modelos_marcas.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM modelo where id_modelo = ?";

		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id_modelo = $data['id_modelo'];
		$id_marca = $data['id_marca'];
        $nom_modelo = $data['nombre_modelo'];
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
		    		<h3>Actualizar Modelo</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update_modelo.php?id=<?php echo $id?>" method="post">
					  
					  <div class="control-group <?php echo !empty($f_idError)?'error':'';?>">

					    <label class="control-label">id</label>
					    <div class="controls">
					      	<input name="id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($f_idError)): ?>
					      		<span class="help-inline"><?php echo $f_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($nom_modelo_Error)?'error':'';?>">
					    <label class="control-label">Nombre del modelo</label>
					    <div class="controls">
					      	<input name="nom_modelo" type="text" placeholder="Modelo" value="<?php echo !empty($nom_modelo)?$nom_modelo:'';?>">
					      	<?php if (!empty($nom_modelo_Error)): ?>
					      		<span class="help-inline"><?php echo $nom_modelo_Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($id_tError)?'error':'';?>">
					    	<label class="control-label">Tipo de elemento</label>
					    	<div class="controls">
                            	<select name ="id_marca">
                                    <option value="">Selecciona un tipo</option>
                                        <?php
					   						$pdo = Database::connect();
					   						$query = 'SELECT * FROM marca';
				
	 				   						foreach ($pdo->query($query) as $row) {
												
	 				   							if ($row['id_marca']==$id_marca)
                        	   						echo "<option selected value='" . $row['id_marca'] . "'>" . $row['nombre_marca'] . "</option>";
                        	   					else
                        	   						echo "<option value='" . $row['id_marca'] . "'>" . $row['nombre_marca']. "</option>";
					   						}
					   						Database::disconnect();
					  					?>
                                                    
                                </select>
					      	<?php if (!empty($id_tError)): ?>
					      		<span class="help-inline"><?php echo $id_tError;?></span>
					      	<?php endif;?>
					    	</div>
					  	</div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="update_modelo.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>