<?php
    // Iniciar la sesión para utilizar variables de sesión
    session_start();

    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $correo = $_POST["correo"];

        // Conexión a la base de datos (modifica las credenciales según tu configuración)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mindverse";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar el registro del correo en la tabla "reestablecer"
        $sql = "INSERT INTO restablecer (correo) VALUES ('$correo')";

        if ($conn->query($sql) === true) {
            // Establecer el mensaje de éxito en la sesión
            $_SESSION['mensaje_exito'] = 'Se ha enviado un enlace de restablecimiento de contraseña a tu correo electrónico.';
        } else {
            // Manejo del error si la inserción falla
            echo "Error al insertar en la base de datos: " . $conn->error;
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesU.css"> <!-- Agrega la ruta correcta a tu archivo CSS -->
    <title>Has Olvidado Tu Contraseña - MindVerse</title>
</head>
<body>
    <header>
        <div class="imagen">
            <img src="./img/gradu.png" alt="MindVerse">
        </div>
    </header>

    <section class="form-registro">
        <h1>Has Olvidado Tu Contraseña</h1>

        <?php if (isset($_SESSION['mensaje_exito'])) { ?>
            <p id="mensaje-exito"><?php echo $_SESSION['mensaje_exito']; ?></p>
            <?php unset($_SESSION['mensaje_exito']); ?> <!-- Limpiar la variable de sesión después de mostrar el mensaje -->
            <a href="./index.html" class="boton">Inicio</a>
        <?php } else { ?>
            <!-- Formulario para solicitar el restablecimiento de contraseña -->
            <form method="post" action="restablecer.php">
                <input class="control" type="email" name="correo" placeholder="Correo electrónico" required>
                <input class="boton" type="submit" value="Reestablecer Contraseña">
            </form>
            <a href="./index.html" class="boton">Inicio</a>
        <?php } ?>

        <!-- Script de JavaScript para mostrar la alerta -->
        <script>
            // Función para mostrar la alerta de éxito y redirigir al inicio
            function mostrarAlertaExito() {
                var mensajeExito = document.getElementById('mensaje-exito');
                if (mensajeExito) {
                    alert(mensajeExito.innerText);
                    window.location.href = './index.html'; // Redirigir al inicio
                }
            }

            // Mostrar la alerta al cargar la página
            window.onload = mostrarAlertaExito;
        </script>
    </section>
</body>
</html>