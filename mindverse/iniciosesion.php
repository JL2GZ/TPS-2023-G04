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
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];

        // Realizar la consulta para verificar el inicio de sesión
        $sql = "SELECT * FROM registro WHERE correo = '$correo' AND contrasena = '$contrasena'";

        // Ejecutar la consulta
        $result = $conn->query($sql);

        // Verificar si se encontró un resultado
        if ($result->num_rows == 1) {
            $mensaje = "Inicio de sesión exitoso";
        } else {
            $error = "Correo o contraseña incorrectos";
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

    <link rel="stylesheet" href="./css/stylesI.css">
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
        </nav>
    </header>

    <section class="form-registro">
        <h1>Inicio de Sesión</h1>

        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } elseif (isset($mensaje)) { ?>
            <p><?php echo $mensaje; ?></p>
        <?php } ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input class="control" type="email" name="correo" id="correo" placeholder="Ingrese su correo electrónico" required>
            <input class="control" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" required>

            <p>¡No olvides rellenar todo!</p>

            <input class="boton" type="submit" value="Iniciar sesión">
        </form>

        <p><a href="./hasolvidado.php">¿Has olvidado tu clave?</a></p>
    </section>
</body>
</html>