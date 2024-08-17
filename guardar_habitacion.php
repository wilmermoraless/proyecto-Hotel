<?php
$servername = "localhost"; // O "127.0.0.1"
$username = "root"; // Nombre de usuario de MySQL
$password = ""; // Contraseña de MySQL (por defecto en XAMPP suele ser vacío)
$dbname = "hotel_reservation";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$disponible = $_POST['disponible'];

// Preparar la consulta SQL para insertar los datos
$sql = "INSERT INTO habitaciones (numero, tipo, precio, disponible) VALUES (?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdi", $numero, $tipo, $precio, $disponible);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo "Habitación agregada exitosamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>