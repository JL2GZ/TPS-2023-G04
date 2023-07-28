<?php
// Configuración de la base de datos (debes reemplazar los datos por los tuyos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datab"; // Nombre de la base de datos correcto

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si se ha proporcionado un número de identificación para descargar la imagen
if (isset($_GET['n_identificacion'])) {
    $n_identificacion = $_GET['n_identificacion'];

    // Obtener la información de la imagen del estudiante desde la base de datos
    $sql = "SELECT imagen FROM estudiantes WHERE n_identificacion = '$n_identificacion'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ruta_imagen = $row['imagen'];

        // Establecer el tipo de contenido según la extensión de la imagen
        $content_type = mime_content_type($ruta_imagen);

        // Establecer las cabeceras para forzar la descarga de la imagen
        header("Content-Type: $content_type");
        header("Content-Disposition: attachment; filename=\"$n_identificacion." . pathinfo($ruta_imagen, PATHINFO_EXTENSION) . "\"");
        header("Content-Length: " . filesize($ruta_imagen));

        // Leer y enviar la imagen al navegador
        readfile($ruta_imagen);
        exit;
    } else {
        echo "Imagen no encontrada.";
    }
}

$conn->close();
?>