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

// Obtener los datos del formulario
$id = $_POST['id'];
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$disponible = $_POST['disponible'];

// Preparar la consulta SQL para actualizar los datos
$sql = "UPDATE habitaciones SET numero = ?, tipo = ?, precio = ?, disponible = ? WHERE id = ?";

// Preparar la declaración
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdis", $numero, $tipo, $precio, $disponible, $id);

// Ejecutar la declaración
if ($stmt->execute()) {
    // Redirigir a la página principal después de la actualización
    header("Location: ind.php?msg=actualizado");
    exit();
} else {
    echo "Error al actualizar la habitación: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
