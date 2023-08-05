<?php
require_once "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = $conn->prepare("SELECT archivo FROM adjuntar WHERE id = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        $nombre_archivo = $resultado['archivo'];
        unlink("../files/" . $nombre_archivo); // Elimina el archivo físicamente del servidor
        $stmt = $conn->prepare("DELETE FROM adjuntar WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script language='JavaScript'>
            alert('Archivo eliminado');
            location.assign('../views/index.php');
            </script>";
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