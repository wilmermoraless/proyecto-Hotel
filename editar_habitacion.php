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

// Obtener el ID de la habitación a editar
$id = $_POST['id'];

// Obtener los detalles de la habitación
$sql = "SELECT * FROM habitaciones WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$habitacion = $result->fetch_assoc();

if (!$habitacion) {
    echo "Habitación no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Habitación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Habitación</h1>
        <form action="actualizar_habitacion.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $habitacion['id']; ?>">
            <div class="mb-3">
                <label for="numero" class="form-label">Número de Habitación:</label>
                <input type="number" class="form-control" id="numero" name="numero" value="<?php echo $habitacion['numero']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Habitación:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $habitacion['tipo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $habitacion['precio']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="disponible" class="form-label">Disponible:</label>
                <select class="form-select" id="disponible" name="disponible" required>
                    <option value="1" <?php echo $habitacion['disponible'] ? 'selected' : ''; ?>>Sí</option>
                    <option value="0" <?php echo !$habitacion['disponible'] ? 'selected' : ''; ?>>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar Habitación</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>