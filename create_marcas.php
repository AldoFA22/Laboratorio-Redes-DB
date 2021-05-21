<?php 
	require 'database.php';

		$f_idError = null;
		$nombreMarcaError = null;
		//$perError = null;

	if ( !empty($_POST)) {
		
		// keep track post values		
		$f_id = $_POST['f_id'];
		$nombreMarca = $_POST['nombreMarca'];
		
		// validate input
		$valid = true;
		
		if (empty($nombreMarca)) {
			echo $nombreMarca;
			$nombreMarcaError = 'Porfavor asegure agregar una marca';
			$valid = false;
		}		
		
		// insert data
		if ($valid) {
        var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="INSERT INTO marca (id_marca,nombre_marca) VALUES (null,?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($nombreMarca), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: marcas.php");
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
		   			<h3>Agregar una nueva marca</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="create_marcas.php" method="post">
				
					<div class="control-group <?php echo !empty($nombreMarcaError)?'error':'';?>">
						<label class="control-label">Marca</label>
					    <div class="controls">
					      	<input name="nombreMarca" type="text"  placeholder="marca" value="<?php echo !empty($nombreMarca)?$nombreMarca:'';?>">
					      	<?php if (($nombreMarcaError != null)) ?>
					      		<span class="help-inline"><?php echo $nombreMarcaError;?></span>						      	
					    </div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="marcas.php">Regresar</a>
					</div>

				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>