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

// Procesar la solicitud para eliminar el registro
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM estudiantes WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
}

// Obtener todos los registros de la base de datos después de eliminar
$sql = "SELECT id, n_identificacion FROM estudiantes";
$result = $conn->query($sql);

$registrosHTML = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $n_identificacion = $row['n_identificacion'];

        $registrosHTML .= "<div>";
        $registrosHTML .= "<h3>Número de Identificación: " . $n_identificacion . "</h3>";
        $registrosHTML .= "<button onclick=\"eliminarRegistro($id)\">Eliminar</button>";
        $registrosHTML .= "</div>";
    }
} else {
    $registrosHTML .= "<p>No hay registros existentes.</p>";
}

echo $registrosHTML;

$conn->close();
?>