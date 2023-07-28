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

// Procesar el formulario y guardar la imagen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n_identificacion = $_POST["n_identificacion"];

    // Verificar si se ha subido una imagen
    if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];
        $nombre_imagen = $_FILES["imagen"]["name"];

        // Mover la imagen al directorio deseado (ajusta la ruta según tu configuración)
        $ruta_destino = "directorio_destino/" . $nombre_imagen;
        move_uploaded_file($imagen_tmp, $ruta_destino);

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO estudiantes (imagen, n_identificacion) VALUES ('$ruta_destino', '$n_identificacion')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro guardado exitosamente.";
        } else {
            echo "Error al guardar el registro: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

// Mostrar los registros existentes
$sql = "SELECT id, imagen, n_identificacion FROM estudiantes";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $n_identificacion = $row['n_identificacion'];
            $imagen = $row['imagen'];

            echo "<div>";
            echo "<h3>Número de Identificación: " . $n_identificacion . "</h3>";
            echo "<img src='$imagen' alt='Imagen del estudiante' style='width: 200px; height: 200px;' class='img-thumbnail'>";
            echo "<button onclick=\"eliminarRegistro($id)\">Eliminar</button>";
            echo "<button onclick=\"editarRegistro($id, '$n_identificacion')\">Editar</button>";
            echo "</div>";
        }
    } else {
        echo "<p>No hay registros existentes.</p>";
    }
} else {
    echo "Error al consultar la base de datos: " . $conn->error;
}

$conn->close();
?>