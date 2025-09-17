<?php
// Conectar a la base de datos
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "formulario_db";
$port       = 3306; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = trim($_POST['nombre']);
$email  = trim($_POST['email']);
$edad   = trim($_POST['edad']);

// Validación
$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
}

if (empty($email)) {
    $errores[] = "El email es obligatorio.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El email no tiene un formato válido.";
}

if (empty($edad)) {
    $errores[] = "La edad es obligatoria.";
} elseif (!is_numeric($edad) || (int)$edad <= 0) {
    $errores[] = "La edad debe ser un número positivo.";
}

// Si hay errores, mostrar y detener
if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo "<p><a href='formulario.html'>Volver al formulario</a></p>";
    exit;
}

// Insertar datos usando prepared statement
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, edad) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $nombre, $email, $edad);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Registro exitoso.</p>";
    echo "<p><a href='mostrar_datos.php'>Ver usuarios</a></p>";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar conexiones
$stmt->close();
$conn->close();
?>
