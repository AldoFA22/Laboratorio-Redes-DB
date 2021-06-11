<?php 
	require '../database.php';
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
		$sql = 'UPDATE apartados SET entregado = true WHERE id_apartado = :ent';
        try{
			$query = $pdo->prepare($sql);
			$query->bindParam(':ent', $id, PDO::PARAM_INT);
			$query->execute();
			$pdo->close();
		}
		catch(PDOException $e) {
			echo  $e->getMessage();
		}

        //Mysql Modificar la herramienta a no disponible

		$pdo_mysql = Database::connect();
        $pdo_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql ="UPDATE elemento_estatus SET id_estatus= 1 WHERE id_elemento = ?";
        $q = $pdo_mysql->prepare($sql);
        $q->execute(filter_var_array(array($id), FILTER_SANITIZE_STRING));
        Database::disconnect();
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
			    	<h3>Dar de baja una herramienta</h3>
			    </div>
			    
			    <form class="form-horizontal" action="entregar_apartado.php" method="post">
		    		<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-warning">Esta seguro de marcar como entregado esta herramienta/material? Favor de verificar su condicion antes de marcarlo como recibido.</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Si</button>
						<a class="btn" href="index.php">No</a>
					</div>
				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>