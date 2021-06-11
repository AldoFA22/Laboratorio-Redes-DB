<?php 
    require '../database_pg.php';
	$id = 0;	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];		
	}
	
	if ( !empty($_POST)) {
		// keep track post values	
		$id = $_POST['id'];		


		// Postgresql
		$pdo = new Database_pg;
		$sql = 'DELETE FROM apartados WHERE id_apartado = :ent';
        try{
			$query = $pdo->prepare($sql);
			$query->bindParam(':ent', $id, PDO::PARAM_INT);
			$query->execute();
			$pdo->close();
		}
		catch(PDOException $e) {
			echo  $e->getMessage();
		}

        
		header("Location: index.php");		
	} 	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"../css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"../js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">	    
	    	<div class="span10 offset1">
	    		<div class="row">
			    	<h3>Eliminar un registro del sistema de apartados</h3>
			    </div>
			    
			    <form class="form-horizontal" action="delete_apartado.php" method="post">
		    		<input name="id" type="hidden" value="<?php echo $id;?>"/>
					<p class="alert alert-error">Esta seguro que usted desea eliminar este apartado? Este registro no se podrá recuperar una vez borrado...</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Si</button>
						<a class="btn" href="index.php">No</a>
					</div>
				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>