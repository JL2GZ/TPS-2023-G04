<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Archivo PDF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <br>
    <div class="container">
        <h2 style="text-align: center;">Ver CARNET (PDF)</h2>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="ver_pdf.php" method="GET">
                    <div class="mb-3">
                        <label for="numero_usuario" class="form-label">Número de Usuario</label>
                        <input type="text" class="form-control" id="numero_usuario" name="numero_usuario" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Ver y Descargar PDF</button>
                </form>
            </div>
        </div>
        <br>

        <?php
        if (isset($_GET['numero_usuario'])) {
            $numero_usuario = $_GET['numero_usuario'];

            require_once "../includes/db.php";
            $consulta = $conn->prepare("SELECT * FROM adjuntar WHERE nombre = :nombre");
            $consulta->bindParam(':nombre', $numero_usuario);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $archivo = $resultado['archivo'];
        ?>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h3>Información del archivo:</h3>
                        <p><strong>Nombre de Usuario:</strong> <?php echo $resultado['nombre']; ?></p>
                        <p><strong>Archivo PDF:</strong> <?php echo $archivo; ?></p>
                        <a href="../includes/download.php?id=<?php echo $resultado['id']; ?>" class="btn btn-success">
                            <i class="fas fa-download"></i> Descargar PDF
                        </a>
                    </div>
                </div>
        <?php
            } else {
                echo "<p class='text-center'>No se encontró ningún archivo asociado al número de usuario proporcionado.</p>";
            }
        }
        ?>

    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
