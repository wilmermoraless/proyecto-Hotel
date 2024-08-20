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

// Obtener todas las habitaciones de la base de datos
$sql = "SELECT * FROM habitaciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Habitaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-light text-bg-danger fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bolder ml-4 nombre" href="#">
               
               Hotels 
              </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            
            <ul class="navbar-nav me-auto mb-  2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active  fw-bolder " aria-current="page" href="index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold" href="habitacion.html">habitaciones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold" href="ind.php">Agregar</a>
              </li>
              
              <!-- <li class="nav-item">
                <a class="nav-link fw-bold" href="logos.html">logos</a>
              </li> -->
             
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-bg-success text-bg-success"   type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar una nueva habitación</h1>
        <form action="guardar_habitacion.php" method="POST" id="roomForm" class="mb-5">
            <!-- Formulario para agregar habitación -->
            <div class="mb-3">
                <label for="numero" class="form-label">Número de Habitación:</label>
                <input type="number" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de Habitación:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" required>
            </div>
            <div class="mb-3">
                <label for="disponible" class="form-label">Disponible:</label>
                <select class="form-select" id="disponible" name="disponible" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Habitación</button>
        </form>

        <h2>Lista de Habitaciones</h2>
        <div id="cardContainer" class="row">
            <?php
            // Mostrar todas las habitaciones
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card mb-4 col-md-4">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Habitación ' . $row["numero"] . '</h5>';
                    echo '<p class="card-text">Tipo: ' . $row["tipo"] . '</p>';
                    echo '<p class="card-text">Precio: $' . $row["precio"] . '</p>';
                    echo '<p class="card-text">Disponible: ' . ($row["disponible"] ? "Sí" : "No") . '</p>';
                    
                    // Formulario de edición
                    echo '<form action="editar_habitacion.php" method="POST" class="mb-2">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn btn-warning">Editar</button>';
                    echo '</form>';
                    
                    // Formulario de eliminación
                    echo '<form action="eliminar_habitacion.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar esta habitación?\');">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn btn-danger">Eliminar</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay habitaciones disponibles.</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>