Eliminar_habitacion.php

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID de la habitación a eliminar
$id = $_POST['id'];

// Preparar la consulta SQL para eliminar la habitación
$sql = "DELETE FROM habitaciones WHERE id = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Habitación eliminada exitosamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: index.php");
exit();
?>