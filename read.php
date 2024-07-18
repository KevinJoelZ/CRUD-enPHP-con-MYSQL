<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estudiantes_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, apellido, email, nota, materia FROM estudiantes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-icons a {
            text-decoration: none;
            color: black;
            margin: 0 5px;
        }

        .action-icons a:hover {
            color: #007bff;
        }
        
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Lista de Estudiantes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Nota</th>
            <th>Materia</th>
            <th>Acciones</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["nombre"]. "</td>
                        <td>" . $row["apellido"]. "</td>
                        <td>" . $row["email"]. "</td>
                        <td>" . $row["nota"]. "</td>
                        <td>" . $row["materia"]. "</td>
                        <td class='action-icons'>
                            <a href='edit.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a>
                            <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este registro?\");'><i class='fas fa-trash'></i></a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay estudiantes registrados</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">Agregar Estudiante</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>