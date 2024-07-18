<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estudiantes_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    $materia = $_POST['materia'];

    $sql = "INSERT INTO estudiantes (nombre, apellido, email, nota, materia) VALUES ('$nombre', '$apellido', '$email', '$nota', '$materia')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo estudiante agregado exitosamente. <a href='read.php'>Ver Estudiantes</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>