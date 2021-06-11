<?php 

	require '../Database_pg.php';
    require '../database.php';

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
        $fecha_entrega = $_POST['fecha_entrega'];
        
		
		/// validate input
		$valid = true;

		
		// update data
		if ($valid) {
            $pdo = new Database_pg;

            // Postgresql
		    $pdo = new Database_pg;
		    $sql = 'UPDATE apartados SET fecha_entrega = :fecha_entrega WHERE id_apartado = :ent';
            try{
                $query = $pdo->prepare($sql);
                $query->bindParam(':ent', $id, PDO::PARAM_INT);
                $query->bindParam(':fecha_entrega', $fecha_entrega, PDO::PARAM_STR);
                $query->execute();
                $pdo->close();
            }
            catch(PDOException $e) {
                echo  $e->getMessage();
            }
			
			header("Location: index.php");
		}
	} else {
		//Postgres
        $pdo = new Database_pg;
        $sql = 'SELECT * FROM apartados INNER JOIN usuarios ON apartados.matricula_usuario = usuarios.id_usuario WHERE apartados.id_apartado = :id ORDER BY id_apartado DESC;';
        $query = $pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $pdo->close();
        $apartados = $query->fetchAll(PDO::FETCH_OBJ);
        //print_r($apartados[0]);
        $id_herramienta = $apartados[0]->id_herramienta;
        $fecha_creacion = $apartados[0]->fecha_creacion;
        $fecha_entrega = $apartados[0]->fecha_entrega;
        $nombre_usuario = $apartados[0]->matricula_usuario . ': ' . $apartados[0]->nombre_usuario . ' ' . $apartados[0]->apellido_usuario;
        
        //Mysql
        $pdo_mysql = Database::connect();
		$pdo_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query_mysql = "SELECT * FROM elemento INNER JOIN caracteristica ON elemento.id_caracteristica = caracteristica.id_caracteristica WHERE id_elemento = ?";
		$q = $pdo_mysql->prepare($query_mysql);
		$q->execute(filter_var_array(array($id_herramienta),FILTER_SANITIZE_STRING));
		$data = $q->fetch(PDO::FETCH_ASSOC);
        $herramienta = $data['nombre_largo_caracteristica'];
        //print_r($herramienta);
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
		    		<h3>Actualizar Modelo</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update_apartado.php?id=<?php echo $id?>" method="post">
					  
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
					    <label class="control-label">Material/Herramienta</label>
					    <div class="controls">
					      	<input name="herramienta" type="text" placeholder="Nombre de la herramienta" disabled value="<?php echo !empty($herramienta)?$herramienta:'';?>">
					      	<?php if (!empty($nom_modelo_Error)): ?>
					      		<span class="help-inline"><?php echo $nom_modelo_Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($nom_modelo_Error)?'error':'';?>">
					    <label class="control-label">Fecha de creación</label>
					    <div class="controls">
					      	<input name="nom_modelo" type="text" placeholder="Nombre de la herramienta" disabled value="<?php echo !empty($fecha_creacion)?$fecha_creacion:'';?>">
					      	<?php if (!empty($nom_modelo_Error)): ?>
					      		<span class="help-inline"><?php echo $nom_modelo_Error;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

                      <div class="control-group <?php echo !empty($nom_modelo_Error)?'error':'';?>">
					    <label class="control-label">Fecha de entrega</label>
					    <div class="controls">
					      	<input name="fecha_entrega" type="date" placeholder="Nombre de la herramienta" value="<?php echo !empty($fecha_entrega)?explode(" ",$fecha_entrega, )[0]:'';?>">
					      	<?php if (!empty($nom_modelo_Error)): ?>
					      		<span class="help-inline"><?php echo $nom_modelo_Error;?></span>
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