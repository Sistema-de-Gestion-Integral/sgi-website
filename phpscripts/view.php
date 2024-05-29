<?php
include "connection.php";

// Hacer la consulta a la tabla esp32_sensors
$sql = "SELECT * FROM `esp32_sensors`";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Construir la tabla HTML
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre del Sensor</th><th>Temperatura (°C)</th><th>Humedad (%)</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_sensor"] . "</td>";
        echo "<td>" . $row["name_sensor"] . "</td>";
        echo "<td>" . $row["temp_sensor"] . "</td>";
        echo "<td>" . $row["humidity_sensor"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Cerrar la conexión
$connection->close();
?>
