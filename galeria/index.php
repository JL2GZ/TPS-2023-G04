<!DOCTYPE html>
<html>
<head>
    <title>Galería de Estudiantes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Galería de Estudiantes</h1>

        <!-- Formulario para agregar un nuevo estudiante -->
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="n_identificacion">Número de Identificación del Estudiante:</label>
                <input type="text" class="form-control" name="n_identificacion" id="n_identificacion" required>
            </div>
            <div class="form-group">
                <label for="imagen">Adjuntar imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" required accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
        </form>

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

        if (isset($_POST["submit"])) {
            $n_identificacion = $_POST["n_identificacion"];

            // Verificar si se ha subido una imagen
            if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
                $imagen_tmp = $_FILES["imagen"]["tmp_name"];
                $nombre_imagen = $_FILES["imagen"]["name"];
                $ruta_destino = "tarjeta/" . $nombre_imagen;

                // Verificar la existencia del directorio de destino
                if (!is_dir("tarjeta")) {
                    mkdir("tarjeta", 0777, true);
                }

                // Mover la imagen al directorio deseado
                if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
                    // Insertar los datos en la base de datos
                    $sql = "INSERT INTO estudiantes (imagen, n_identificacion) VALUES ('$ruta_destino', '$n_identificacion')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Registro guardado exitosamente.";
                    } else {
                        echo "Error al guardar el registro: " . $conn->error;
                    }
                } else {
                    echo "Error al mover la imagen.";
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
                echo "<h2>Registros existentes:</h2>";
                echo "<div id='registrosContainer'>"; // Contenedor para los registros
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $n_identificacion = $row['n_identificacion'];
                    $imagen = $row['imagen'];

                    echo "<div>";
                    echo "<h3>Número de Identificación: " . $n_identificacion . "</h3>";
                    echo "<img src='$imagen' alt='Imagen del estudiante' style='width: 200px; height: 200px;' class='img-thumbnail'>";
                    echo "<a href='descargar_imagen.php?id=$id'>Descargar imagen</a>"; // Enlace para descargar la imagen
                    echo "<button onclick=\"eliminarRegistro($id)\">Eliminar</button>";
                    echo "<button onclick=\"editarRegistro($id, '$n_identificacion')\">Editar</button>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No hay registros existentes.</p>";
            }
        } else {
            echo "Error al consultar la base de datos: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>

    <script>
        // Función para cargar los registros existentes al cargar la página
        function cargarRegistros() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = xhr.responseText;
                    document.getElementById('registrosContainer').innerHTML = response;
                }
            };
            xhr.open('GET', 'upload.php', true);
            xhr.send();
        }

        // Función para registrar automáticamente el número de identificación y la imagen al hacer clic en el botón "Guardar"
        function registrarEstudiante() {
            var btnGuardar = document.getElementById('btnGuardar');
            btnGuardar.disabled = true; // Deshabilitar el botón para evitar envíos repetidos

            var form = document.getElementById('registroForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        document.getElementById('registrosContainer').innerHTML = response;
                    } else {
                        alert('Error al guardar el registro: ' + xhr.status);
                    }

                    btnGuardar.disabled = false; // Reactivar el botón después de recibir la respuesta
                }
            };

            xhr.open('POST', 'upload.php', true);
            xhr.send(formData);
        }

        // Función para eliminar un registro
        function eliminarRegistro(id) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = xhr.responseText;
                    document.getElementById('registrosContainer').innerHTML = response;
                }
            };
            xhr.open('GET', 'delete.php?id=' + id, true);
            xhr.send();
        }

        // Función para editar un registro
        function editarRegistro(id, n_identificacion) {
            var nuevoIdentificacion = prompt("Ingrese el nuevo número de identificación:", n_identificacion);

            if (nuevoIdentificacion !== null && nuevoIdentificacion.trim() !== "") {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        var response = xhr.responseText;
                        document.getElementById('registrosContainer').innerHTML = response;
                    }
                };
                xhr.open('POST', 'editar.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + id + '&n_identificacion=' + nuevoIdentificacion);
            }
        }

        // Cargar los registros existentes al cargar la página
        cargarRegistros();
    </script> 
</body>
</html>
