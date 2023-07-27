<?php
    // Aquí realizas la conexión a la base de datos
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

    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        $ncontrasena = $_POST["ncontrasena"];

        // Verificar si las contraseñas coinciden
        if ($contrasena != $ncontrasena) {
            $error = "Las contraseñas no coinciden";
        } else {
            // Insertar los datos en la tabla de registro
            $sql = "INSERT INTO registro (nombre, apellido, correo, contrasena, ncontrasena)
                    VALUES ('$nombre', '$apellido', '$correo', '$contrasena', '$ncontrasena')";

            if ($conn->query($sql) === true) {
                $mensaje = "Registro exitoso";

                // Redirigir a la página de inicio de sesión después del registro exitoso
                header("Location: iniciosesion.php");
                exit();
            } else {
                $error = "Error al registrar: " . $conn->error;
            }
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/stylesU.css">
    <title>Inicio/Registro</title>
</head>
<body>
    <header>
        <div class="imagen">
            <img src="./img/gradu.png" alt="logoDelProyecto">
            <h2 class="nombre-pagina">MindVerse</h2>
        </div>
        
        <nav>
            <a href="./index.html" class="inicio">Inicio</a>
            <a href="./iniciosesion.php" class="inicio">Inicio Sesion</a>
        </nav>
    </header>

    <section class="form-registro">
        <h1>Registro de usuario</h1>

        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } elseif (isset($mensaje)) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input class="control" type="text" name="nombre" id="nombre" placeholder="Ingrese sus nombres" required>
            <input class="control" type="text" name="apellido" id="apellido" placeholder="Ingrese sus apellidos" required>
            <input class="control" type="email" name="correo" id="correo" placeholder="Ingrese su correo electrónico" required>
            <input class="control" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>
            <input class="control" type="password" name="ncontrasena" id="ncontrasena" placeholder="Ingrese otra vez su contraseña" required>

            <p>¡No olvides rellenar todo!</p>

            <input class="boton" type="submit" value="Registrar">
        </form>

        <p><a href="./hasolvidado.php">¿Has olvidado tu clave?</a></p>
    </section>
</body>
</html>