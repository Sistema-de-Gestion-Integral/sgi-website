<?php
if (isset($_REQUEST['humidity'])) {
    echo ($_REQUEST['humidity'] . "%");
}
// Verificar si se recibieron los datos POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibieron las variables temperature y humidity
    if (isset($_POST["temperature"]) && isset($_POST["humidity"])) {
        // Obtener los valores de las variables
        $temperature = $_POST["temperature"];
        $humidity = $_POST["humidity"];

        // Puedes realizar cualquier acción con estos datos, como almacenarlos en una base de datos o imprimirlos
        echo "Temperatura: " . $temperature . "°C, Humedad: " . $humidity . "%";
    } else {
        // Si alguna variable no se recibió, mostrar un mensaje de error
        echo "Error: No se recibieron los datos correctamente.";
    }
} else {
    // Si no se recibió una solicitud POST, mostrar un mensaje de error
    echo "Error: Método de solicitud no permitido.";
}
