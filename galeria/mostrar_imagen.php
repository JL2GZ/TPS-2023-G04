<?php
// Configuración de la base de datos (debes reemplazar los datos por los tuyos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datab";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la ruta de la imagen desde la base de datos
    $sql = "SELECT imagen FROM estudiantes WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imagen_path = $row['imagen'];

        // Mostrar la imagen al cliente
        header("Content-type: image/jpeg"); // Ajusta el tipo de imagen según tus necesidades (en este caso, asumimos que es una imagen JPEG)
        readfile($imagen_path);
    }
}

$conn->close();
?>