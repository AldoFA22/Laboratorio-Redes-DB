<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h3>Usuarios</h3>
        </div>
        <div class="table-responsive container-fluid">
            <p>
                <a href="index.php" class="btn btn-light">Regresar a lista de usuarios</a>
                <!-- <a href="create_usuario.php" class="btn btn-warning">Agregar un usuario</a> -->
                <!-- <a href="create_marcas.php" class="btn btn-warning">Agregar una marca</a> -->
                <!-- <a href="marcas.php" class="btn btn-info">Consultar marcas vigentes</a> -->
            </p>

            <table class="table table-striped table-bordered" class="table table-sm">
                <thead>
                    <tr>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../Database_pg.php';
                    $pdo = new Database_pg;
                    $sql = 'SELECT * FROM usuarios;';
                    $query = $pdo->prepare($sql);
                    $query->execute();
                    $usuarios = $query->fetchAll(PDO::FETCH_OBJ);
                    // print_r($usuarios);
                    foreach ($usuarios as $row) {
                        echo '<tr width=200>';
                        echo '<td>' . $row->id_usuario . '</td>';
                        echo '<td>' . $row->nombre_usuario . '</td>';
                        echo '<td>' . $row->apellido_usuario . '</td>';
                        // echo '</td>';
                        echo '<td width=250>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-success" href="update_usuario.php?id=' . $row->id_usuario . '">Actualizar</a>';
                        echo '&nbsp;';
                        // echo '<a class="btn btn-danger" href="delete_usuario.php?id=' . $row['id_modelo'] . '">Eliminar</a>';
                        // echo '&nbsp;';
                        echo '</td>';
                        echo '</tr>';
                    }
                    // Database::disconnect();
                    $pdo->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div> <!-- /container -->
</body>

</html>