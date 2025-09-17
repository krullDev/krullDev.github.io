<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "formulario_db";
$port       = 3306;

//Conexion
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

//Borrar registro si se envía delete_id
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM usuarios WHERE id=$id");
    header("Location: mostrar_datos.php");
    exit;
}

//Paginacion
$limit = 5; // registros por página
$page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

//Contar total de registros
$total_result = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
$total_row = $total_result->fetch_assoc();
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

//Consulta con límite
$sql = "SELECT id, nombre, email, edad FROM usuarios LIMIT $start, $limit";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
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

</head>
<body>
<h1>Usuarios Registrados</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['edad'] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a>
                <a href="mostrar_datos.php?delete_id=<?= $row['id'] ?>" 
                   onclick="return confirm('¿Seguro que quieres borrar este registro?')">Borrar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    

    <?php if ($total_pages > 1): ?>
        <div style="margin-top: 20px;">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>
                    <a href="mostrar_datos.php?page=<?= $i ?>"><?= $i ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

<?php else: ?>
    <p>No hay usuarios registrados.</p>
<?php endif; ?>

<br>
<a href="formulario.html">Agregar Nuevo Usuario</a>

</body>
</html>

<?php $conn->close(); ?>