<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "formulario_db";
$port       = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: mostrar_datos.php");
    exit;
}

$id = $_GET['id'];

//Actualizar registro
if (isset($_POST['update'])) {
    $nombre = $_POST['nombre'];
    $email  = $_POST['email'];
    $edad   = $_POST['edad'];

    $stmt = $conn->prepare("UPDATE usuarios SET nombre=?, email=?, edad=? WHERE id=?");
    $stmt->bind_param("ssii", $nombre, $email, $edad, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: mostrar_datos.php");
    exit;
}

// Obtener datos actuales
$result = $conn->query("SELECT * FROM usuarios WHERE id=$id");
$row = $result->fetch_assoc();
?>


<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            padding: 5px 10px;
            color: blue;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
        }

        a:hover {
            opacity: 0.8;
        }

        a.edit {
            background-color: #2196F3;
        }

        a.delete {
            background-color: #f44336;
        }

        a.add {
            background-color: #4CAF50;
            margin-top: 10px;
            display: inline-block;
        }

        /* Formulario */
        form {
            background-color: #fff;
            padding: 20px;
            width: 300px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            opacity: 0.9;
        }
    </style>

<h2>Editar Usuario</h2>
<form method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= $row['nombre'] ?>" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
    <label>Edad:</label><br>
    <input type="number" name="edad" value="<?= $row['edad'] ?>" required><br><br>
    <input type="submit" name="update" value="Actualizar">
</form>
