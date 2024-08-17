<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_reservation"; // Asegúrate de que este nombre coincida con el de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del formulario
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$precio = $_POST['precio'];
$disponible = $_POST['disponible'];

// Validar los datos del formulario (opcional pero recomendado)
if (empty($numero) || empty($tipo) || empty($precio) || !isset($disponible)) {
    die("Todos los campos son obligatorios.");
}

// Preparar la consulta para evitar inyección SQL
$stmt = $conn->prepare("INSERT INTO habitaciones (numero, tipo, precio, disponible) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdi", $numero, $tipo, $precio, $disponible);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Habitación agregada correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la conexión y la sentencia
$stmt->close();
$conn->close();
?>