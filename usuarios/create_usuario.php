<?php
require_once '../Database_pg.php';

//$perError = null;

if (!empty($_POST)) {

    $f_idError = null;
    $idUsuarioError = null;
    $nombreUsuarioError = null;
    $apellidoUsuarioError = null;

    // keep track post values		
    $f_id = $_POST['f_id'];
    $idUsuario = $_POST['idUsuario'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $apellidoUsuario = $_POST['apellidoUsuario'];

    // validate input
    $valid = true;

    if (empty($idUsuario)) {
        echo $idUsuario;
        $idUsuarioError = 'Porfavor asegure agregar su matricula';
        $valid = false;
    }

    if (empty($nombreUsuario)) {
        echo $nombreUsuario;
        $nombreUsuarioError = 'Porfavor asegure agregar su nombre';
        $valid = false;
    }

    if (empty($apellidoUsuario)) {
        echo $apellidoUsuario;
        $apellidoUsuarioError = 'Porfavor asegure agregar su apellido';
        $valid = false;
    }

    // insert data
    if ($valid) {

        // var_dump($_POST);
        $pdo = new Database_pg;
        // $sql = "INSERT INTO usuarios (id_usuario,nombre_usuario,apellido_usuario) values(?,?,?)";
        $query = $pdo->prepare('SELECT createUser(:idUsuario, :nombreUsuario, :apellidoUsuario)');

        try {
            // $q = $pdo->prepare($sql);
            $query->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
            $query->bindParam(':nombreUsuario', $nombreUsuario, PDO::PARAM_STR);
            $query->bindParam(':apellidoUsuario', $apellidoUsuario, PDO::PARAM_STR);
            // echo $idUsuario;
            // echo $nombreUsuario;
            // echo $apellidoUsuario;

            $query->execute();
            $pdo->close();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        header("Location: usuarios.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Agregar un usuario</h3>
            </div>

            <form class="form-horizontal" action="create_usuario.php" method="post">

                <div class="control-group <?php echo !empty($idUsuarioError) ? 'error' : ''; ?>">
                    <label class="control-label">Matricula de usuario</label>
                    <div class="controls">
                        <input name="idUsuario" type="text" placeholder="matricula" require minlength="9" value="<?php echo !empty($idUsuario) ? $idUsuario : ''; ?>">
                        <?php if (($idUsuarioError != null)) ?>
                        <span class="help-inline"><?php echo $idUsuarioError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($nombreUsuarioError) ? 'error' : ''; ?>">
                    <label class="control-label">Usuario</label>
                    <div class="controls">
                        <input name="nombreUsuario" type="text" placeholder="nombre" value="<?php echo !empty($nombreUsuario) ? $nombreUsuario : ''; ?>">
                        <?php if (($nombreUsuarioError != null)) ?>
                        <span class="help-inline"><?php echo $nombreUsuarioError; ?></span>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($apellidoUsuarioError) ? 'error' : ''; ?>">
                    <label class="control-label">Apellido</label>
                    <div class="controls">
                        <input name="apellidoUsuario" type="text" placeholder="apellido" value="<?php echo !empty($apellidoUsuario) ? $apellidoUsuario : ''; ?>">
                        <?php if (($apellidoUsuarioError != null)) ?>
                        <span class="help-inline"><?php echo $apellidoUsuarioError; ?></span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a class="btn" href="usuarios.php">Regresar</a>
                </div>

            </form>
        </div>
    </div> <!-- /container -->
</body>

</html>