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
		$marcError = null;
		
		// keep track post values
		$f_id = $_POST['f_id'];
		$marc = $_POST['marc'];
		
		/// validate input
		$valid = true;

		if (empty($marc)) {
			$marcError = 'Porfavor escribe una marca';
			$valid = false;
		}		
		
		// update data
		if ($valid) {

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// if ($ac=="S")
			// 	$sql = "UPDATE auto2  set idauto = ?, nombrec = ?, idmarca =?, ac= true WHERE idauto = ?";
			// else 
            //     $sql = "UPDATE auto2  set idauto = ?, nombrec = ?, idmarca =?, ac= false WHERE idauto = ?";
                
            $sql = "UPDATE marca set nombre_marca = ? WHERE id_marca = ?";

			
			$q = $pdo->prepare($sql);

            // $q->execute(array($f_id,$subm,$marc,$id));
            $q->execute(filter_var_array(array($marc,$id),FILTER_SANITIZE_STRING));
			
			Database::disconnect();			
			header("Location: marcas.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM marca where id_marca = ?";

		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$f_id = $data['id_marca'];
		$marc = $data['nombre_marca'];
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
		    		<h3>Actualizar marca</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update_marcas.php?id=<?php echo $id?>" method="post">
					  
					  <div class="control-group <?php echo !empty($f_idError)?'error':'';?>">

					    <label class="control-label">id</label>
					    <div class="controls">
					      	<input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($f_idError)): ?>
					      		<span class="help-inline"><?php echo $f_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($submError)?'error':'';?>">
					  
					    <label class="control-label">submarca</label>
					    <div class="controls">
					      	<input name="marc" type="text" placeholder="submarca" value="<?php echo !empty($marc)?$marc:'';?>">
					      	<?php if (!empty($marcError)): ?>
					      		<span class="help-inline"><?php echo $marcError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="marcas.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>