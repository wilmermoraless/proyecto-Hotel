<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'hotel_reservation';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario (datos del cliente)
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

// Insertar datos en la tabla 'clientes'
$sql_cliente = "INSERT INTO clientes (nombre, apellido, email, telefono) VALUES ('$nombre', '$apellido', '$email', '$telefono')";

if ($conn->query($sql_cliente) === TRUE) {
    // Obtener el ID del cliente recién insertado
    $cliente_id = $conn->insert_id;
    
    // Recibir datos del formulario (datos de la reserva)
    $habitacion_id = $_POST['habitacion_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $estado = $_POST['estado'];
    
    // Insertar datos en la tabla 'reservas'
    $sql_reserva = "INSERT INTO reservas (cliente_id, habitacion_id, fecha_inicio, fecha_fin, estado) VALUES ('$cliente_id', '$habitacion_id', '$fecha_inicio', '$fecha_fin', '$estado')";
    
    if ($conn->query($sql_reserva) === TRUE) {
        echo "Cliente y reserva registrados exitosamente";
    } else {
        echo "Error al registrar la reserva: " . $conn->error;
    }
} else {
    echo "Error al registrar el cliente: " . $conn->error;
}

$conn->close();
?>