<?php
var_dump($_POST);
var_dump($_REQUEST_METHOD);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos enviados en el cuerpo de la solicitud POST
    $temperature = isset($_POST['temperature']) ? $_POST['temperature'] : 'No data';
    $humidity = isset($_POST['humidity']) ? $_POST['humidity'] : 'No data';

    // Imprimir los datos (o hacer algo con ellos)
    echo "Temperature: " . htmlspecialchars($temperature) . " °C<br>";
    echo "Humidity: " . htmlspecialchars($humidity) . " %<br>";
} else {
    echo "No POST data received.";
}