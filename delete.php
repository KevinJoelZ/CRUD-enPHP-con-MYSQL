<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estudiantes_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM estudiantes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Estudiante eliminado exitosamente. <a href='read.php'>Ver Estudiantes</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>