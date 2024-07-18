<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estudiantes_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$estudiante = null; 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM estudiantes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $estudiante = $result->fetch_assoc(); 
    } else {
        echo "Estudiante no encontrado.";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $nota = $_POST['nota'];
    $materia = $_POST['materia'];

    $sql = "UPDATE estudiantes SET nombre='$nombre', apellido='$apellido', email='$email', nota='$nota', materia='$materia' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Estudiante actualizado exitosamente. <a href='read.php'>Ver Estudiantes</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Estudiante</title>
</head>
<body>
    <h2>Editar Estudiante</h2>
    <?php if ($estudiante): ?>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $estudiante['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $estudiante['nombre']; ?>" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $estudiante['apellido']; ?>" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $estudiante['email']; ?>" required><br><br>
        
        <label for="nota">Nota:</label>
        <input type="number" id="nota" name="nota" value="<?php echo $estudiante['nota']; ?>" required><br><br>
        
        <label for="materia">Materia:</label>
        <select id="materia" name="materia" required>
            <option value="Matemáticas" <?php if ($estudiante['materia'] == 'Matemáticas') echo 'selected'; ?>>Matemáticas</option>
            <option value="Historia" <?php if ($estudiante['materia'] == 'Historia') echo 'selected'; ?>>Historia</option>
            <option value="Ciencia" <?php if ($estudiante['materia'] == 'Ciencia') echo 'selected'; ?>>Ciencia</option>
            <option value="Literatura" <?php if ($estudiante['materia'] == 'Literatura') echo 'selected'; ?>>Literatura</option>
        </select><br><br>
        
        <input type="submit" value="Actualizar Estudiante">
    </form>
    <?php else: ?>
    <p>Estudiante no encontrado. <a href="read.php">Volver a la lista</a></p>
    <?php endif; ?>
</body>
</html>