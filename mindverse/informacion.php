<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/stylesCR.css">
    <title>Informacion. 📃</title>
</head>
<body>
    <header>
        <div class="imagen">
            <img src="./img/gradu.png" alt="logoDelProyecto">
            <h2 class="nombre-pagina">MindVerse</h2>
        </div>

        <nav>
            <a href="./index.html" type="_blank" class="links">Inicio</a>
            <a href="./registroS.php" class="links">Usuario</a>
        </nav>
    </header>
</body>
</html>

<?php
$servername = "localhost"; // Cambia esto si tu servidor de base de datos tiene un nombre diferente
$username = "root"; // Reemplaza "tu_usuario" con tu nombre de usuario de MySQL
$password = ""; // Reemplaza "tu_contraseña" con tu contraseña de MySQL (si tienes una)
$dbname = "mindverse"; // Reemplaza "mindverse" con el nombre de tu base de datos

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Función para agregar un nuevo artículo
function agregarArticulo($titulo, $contenido, $fecha_publicacion) {
  global $conn;
  $sql = "INSERT INTO articulos (titulo, contenido, fecha_publicacion) VALUES ('$titulo', '$contenido', '$fecha_publicacion')";
  return $conn->query($sql);
}

// Obtener y mostrar todos los artículos
$resultado = $conn->query("SELECT * FROM articulos ORDER BY fecha_publicacion DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = $_POST['titulo'];
  $contenido = $_POST['contenido'];
  $fecha_publicacion = date('Y-m-d H:i:s');
  
  // Agregar el artículo
  if (agregarArticulo($titulo, $contenido, $fecha_publicacion)) {
    echo "Artículo agregado exitosamente.";
  } else {
    echo "Error al agregar el artículo.";
  }
} else {
  if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
      echo "<div>";
      echo "<h2>" . htmlspecialchars($fila['titulo']) . "</h2>";
      echo "<p>" . htmlspecialchars($fila['contenido']) . "</p>";
      echo "<p>Fecha de publicación: " . htmlspecialchars($fila['fecha_publicacion']) . "</p>";
      echo "<a href='#'>Leer más</a>";
      echo "</div>";
    }
  } else {
    echo "No hay artículos disponibles.";
  }
}
?>