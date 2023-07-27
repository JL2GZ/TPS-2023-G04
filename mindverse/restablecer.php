<?php
    // Iniciar la sesión para utilizar variables de sesión
    session_start();

    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];

        // Conexión a la base de datos
        $servername = "localhost"; // Cambia esto si tu servidor de base de datos tiene un nombre diferente
        $username = "root"; // Reemplaza "tu_usuario" con tu nombre de usuario de la base de datos
        $password = ""; // Reemplaza "tu_contraseña" con tu contraseña de la base de datos
        $dbname = "mindverse";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Generar un token único para el restablecimiento de contraseña
        $token = md5(uniqid(rand(), true));

        // Obtener la fecha y hora actual en formato MySQL
        $fecha_creacion = date("Y-m-d H:i:s");

        // Insertar los datos en la tabla "restablecer"
        $sql = "INSERT INTO restablecer (correo, token, fecha_creacion)
                VALUES ('$correo', '$token', '$fecha_creacion')";

        if ($conn->query($sql) === true) {
            $_SESSION['mensaje_exito'] = "Se ha enviado un enlace de restablecimiento de contraseña a tu correo electrónico.";
        } else {
            $_SESSION['mensaje_error'] = "Error al enviar el enlace de restablecimiento de contraseña.";
        }

        $conn->close();

        // Redirigir a hasolvidado.php
        header("Location: hasolvidado.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesU.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->
    <title>Restablecer Contraseña - MindVerse</title>
</head>
<body>
    <header>
        <div class="imagen">
            <img src="./img/gradu.png" alt="MindVerse">
            <h2 class="nombre-pagina">MindVerse</h2>
        </div>
        <a href="index.html" class="inicio">Inicio</a>
    </header>

    <section class="form-registro">
        <h1>Restablecer Contraseña</h1>

        <?php if (isset($mensaje_exito)) { ?>
            <!-- Script de JavaScript para mostrar la alerta -->
            <script>
                // Función para mostrar el mensaje de éxito como alerta
                function mostrarAlerta() {
                    alert("<?php echo $mensaje_exito; ?>");
                }

                // Mostrar la alerta al cargar la página
                window.onload = mostrarAlerta;
            </script>
        <?php } else { ?>
            <!-- Formulario para solicitar el restablecimiento de contraseña -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="control" type="password" name="contrasena" placeholder="Nueva contraseña" required>
                <input class="control" type="password" name="nueva_contrasena" placeholder="Confirmar nueva contraseña" required>
                <input class="boton" type="submit" value="Restablecer contraseña">
            </form>
        <?php } ?>
    </section>
</body>
</html>