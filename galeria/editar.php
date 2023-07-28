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

// Procesar la solicitud para editar el registro
if (isset($_POST["id"]) && isset($_POST["n_identificacion"])) {
    $id = $_POST["id"];
    $n_identificacion = $_POST["n_identificacion"];

    // Actualizar el registro en la base de datos
    $sql = "UPDATE estudiantes SET n_identificacion='$n_identificacion' WHERE id=$id";

    if ($conn->query($sql) !== TRUE) {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

// Obtener todos los registros de la base de datos después de editar
$sql = "SELECT id, n_identificacion FROM estudiantes";
$result = $conn->query($sql);

$registrosHTML = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $n_identificacion = $row['n_identificacion'];

        $registrosHTML .= "<div>";
        $registrosHTML .= "<h3>Número de Identificación: " . $n_identificacion . "</h3>";
        $registrosHTML .= "<img src='mostrar_imagen.php?id=$id' alt='Imagen del estudiante' style='width: 200px; height: 200px;'>";
        $registrosHTML .= "<button onclick=\"eliminarRegistro($id)\">Eliminar</button>";
        $registrosHTML .= "<button onclick=\"editarRegistro($id, '$n_identificacion')\">Editar</button>";
        $registrosHTML .= "</div>";
    }
} else {
    $registrosHTML .= "<p>No hay registros existentes.</p>";
}

echo $registrosHTML;

$conn->close();
?>