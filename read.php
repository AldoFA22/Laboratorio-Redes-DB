<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}	
	if ( $id==null) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT herramienta.*,estatus.nombre_estatus, tipo.nombre_tipo, marca.nombre_marca, caracteristica.* FROM herramienta, estatus, tipo, marca, caracteristica where id_herramienta = ? and herramienta.id_marca = marca.id_marca and herramienta.id_tipo = tipo.id_tipo and herramienta.id_estatus = estatus.id_estatus and herramienta.id_caracteristica = caracteristica.id_caracteristica";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    		<h3>Detalles: <?php echo $data['nombre_corto'];?></h3>
		    	</div>
		    
	    		<div class="form-horizontal" >
	    		
					<div class="control-group">
						<label class="control-label">ID Herramienta</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['id_herramienta'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Nombre corto:</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['nombre_corto'];?>
						    </label>
					    </div>
					</div>
					
					<div class="control-group">
					    <label class="control-label">Nombre largo:</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['nombre_largo'];?>
						    </label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Numero de serie:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['numero_serie'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Modelo</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['modelo'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Estatus:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['nombre_estatus'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Tipo:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['nombre_tipo'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Marca:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['nombre_marca'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Cantidad:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['cantidad'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Direccion mac:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['mac'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Dirección mac 2:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['mac_opcional'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">ID: caracteristica:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['id_switch'];?>
								<?php echo $data['id_kit'];?>
								<?php echo $data['id_pinza'];?>
								<?php echo $data['id_router'];?>
								<?php echo $data['id_apoint'];?>
								<?php echo $data['id_telefono'];?>
								<?php echo $data['id_cable'];?>
								<?php echo $data['id_servidor'];?>
								<?php echo $data['id_modem'];?>
								<?php echo $data['id_camara'];?>
							</label>
					    </div>
					</div>
				    <div class="form-actions">
						<a class="btn" href="index.php">Regresar</a>
					</div>					
					 
				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>