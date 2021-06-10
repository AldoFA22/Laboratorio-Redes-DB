<?php
require 'database.php';

$f_idError = null;
$nombreModelorror = null;
//$perError = null;

if (!empty($_POST)) {

    // keep track post values		
    $f_id = $_POST['f_id'];
    $nombreModelo = $_POST['nombreModelo'];
    $idMarca = $_POST['idMarca'];

    // validate input
    $valid = true;

    if (empty($nombreModelo)) {
        echo $nombreModelo;
        $nombreModeloError = 'Porfavor asegure agregar una marca';
        $valid = false;
    }

    // insert data
    if ($valid) {
        var_dump($_POST);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO modelo (id_marca,nombre_modelo) VALUES (?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(filter_var_array(array($idMarca, $nombreModelo), FILTER_SANITIZE_STRING));
        Database::disconnect();
        header("Location: modelos_marcas.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un nuevo modelo</h3>
            </div>

            <form class="form-horizontal" action="create_modelo.php" method="post">

                <div class="control-group <?php echo !empty($nombreModeloError) ? 'error' : ''; ?>">
                    <label class="control-label">Modelo</label>
                    <div class="controls">
                        <input name="nombreModelo" type="text" placeholder="modelo" value="<?php echo !empty($nombreModelo) ? $nombreModelo : ''; ?>">
                        <?php if (($nombreModeloError != null)) ?>
                        <span class="help-inline"><?php echo $nombreModeloError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($id_mError) ? 'error' : ''; ?>">
                    <label class="control-label">Marca</label>
                    <div class="controls">
                        <select name="idMarca">
                            <option value="">Selecciona una marca</option>
                            <?php
                            $pdo = Database::connect();
                            $query = 'SELECT * FROM marca';
                            foreach ($pdo->query($query) as $row) {
                                if ($row['id_marca'] == $idMarca)
                                    echo "<option selected value='" . $row['id_marca'] . "'>" . $row['nombre_marca'] . "</option>";
                                else
                                    echo "<option value='" . $row['id_marca'] . "'>" . $row['nombre_marca'] . "</option>";
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <?php if (($id_mError) != null) ?>
                        <span class="help-inline"><?php echo $id_mError; ?></span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="modelos_marcas.php">Regresar</a>
                </div>

            </form>
        </div>
    </div> <!-- /container -->
</body>

</html>