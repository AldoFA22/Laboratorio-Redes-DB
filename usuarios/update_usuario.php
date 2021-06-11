<?php
require_once "create_usuario.php";
if (empty($_POST['submit'])) {
    header("Location: usuarios.php");
    exit;
}
$args = array(
    'id_usuario' => FILTER_SANITIZE_STRING,
    'nombre_usuario' => FILTER_SANITIZE_STRING,
    'apellido_usuario' => FILTER_SANITIZE_STRING,
);

$post = (object)filter_input_array(INPUT_POST, $args);

if ($post->id_usuario === false) {
    header("Location: usuarios.php");
}

$pdo = new Database_pg;
// $sql = "INSERT INTO usuarios (id_usuario,nombre_usuario,apellido_usuario) values(?,?,?)";
$query = $pdo->prepare('UPDATE usuarios SET :idUsuario = ?, :nombreUsuario=?, :apellidoUsuario=? WHERE id_usuario =?)');

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
