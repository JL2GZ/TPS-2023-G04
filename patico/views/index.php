<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <br>

    <div class="container">
        <div class="col-sm-12">
            <h2 style="text-align: center;">Archivos PDF</h2>
            <br>
            <div>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#agregar"> Agregar </button>
            </div>
            <br>
            <br>
            <br>

            <div class="container">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tarjeta Identidad</th>
                        <th>Archivo</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "../includes/db.php";
                    $consulta = $conn->query("SELECT * FROM adjuntar");
                    while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <tr>
                            <td><?php echo $fila['id']; ?></td>
                            <td><?php echo $fila['nombre']; ?></td>
                            <td><?php echo $fila['archivo']; ?></td>
                            <td>
                                <a href="../includes/delete.php?id=<?php echo $fila['id']; ?>" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
            </div>
        </div>
    </div>

    <style>
        a {
            text-decoration: none;
        }

        .s {
            padding-top: 50px;
            text-align: center;
        }
    </style>

    <?php include "agregar.php"; ?>

</body>

</html>