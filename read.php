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
		$sql = "SELECT elemento.*, estatus.nombre_estatus, tipo.nombre_tipo, marca.nombre_marca, modelo.nombre_modelo, caracteristica.*, estatus.nombre_estatus, ubicacion.nombre_ubicacion, materia.clave_materia 
		FROM elemento_estatus, elemento, caracteristica, estatus, tipo, modelo, marca, ubicacion, materia 
		WHERE elemento.id_elemento = ? 
		AND caracteristica.id_modelo_marca = modelo.id_modelo 
		AND elemento.id_materia = materia.id_materia 
		AND elemento.id_ubicacion = ubicacion.id_ubicacion 
		AND modelo.id_marca = marca.id_marca 
		AND elemento.id_tipo = tipo.id_tipo 
		AND elemento_estatus.id_estatus = estatus.id_estatus
		AND elemento_estatus.id_elemento = elemento.id_elemento 
		AND elemento.id_caracteristica = caracteristica.id_caracteristica;";
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
		    		<h3>Detalles del elemento: <?php echo $data['nombre_corto'];?></h3>
		    	</div>
		    
	    		<div class="form-horizontal" >
	    		
					<div class="control-group">
						<label class="control-label">ID Elemento</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['id_elemento'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
					    <label class="control-label">Nombre corto:</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['nombre_caracteristica'];?>
						    </label>
					    </div>
					</div>
					
					<div class="control-group">
					    <label class="control-label">Nombre largo:</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['nombre_largo_caracteristica'];?>
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
								<?php echo $data['nombre_modelo'];?>
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
						<label class="control-label">Descripción:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['descripcion'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Descripción extra:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['caracteristica_extra'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Ubicación:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['nombre_ubicacion'];?>
							</label>
					    </div>
					</div>

					<div class="control-group">
						<label class="control-label">Materia en la que se utiliza:</label>
					    <div class="controls">
							<label class="checkbox">
								<?php echo $data['clave_materia'];?>
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

				    <div class="form-actions">
						<a class="btn" href="index.php">Regresar</a>
					</div>					
					 
				</div>
			</div>
		</div> <!-- /container -->
  	</body>
</html>