<?php
if (isset($_GET['id'])) {
    require_once "db.php"; // Incluimos el archivo para establecer la conexión

    $id = $_GET['id'];
    $consulta = $conn->prepare("SELECT archivo FROM adjuntar WHERE id = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $archivo = $resultado['archivo'];
        $ruta = "../files/" . $archivo;

        // Descargar el archivo
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($ruta) . "\"");
        readfile($ruta);
        exit;
    } else {
        echo "<script language='JavaScript'>
            alert('Archivo no encontrado');
            location.assign('../views/index.php');
            </script>";
    }
} else {
    echo "<script language='JavaScript'>
        alert('ID de archivo no especificado');
        location.assign('../views/index.php');
        </script>";
}
?>