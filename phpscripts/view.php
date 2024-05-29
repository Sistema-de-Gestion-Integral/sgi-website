<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de sensores</title>
</head>

<body>
    <div id="table-div">
        <?php
        include "functions.php";
        display_table();
        ?>
    </div>
    <script>
        function fetchData(callback) {
            // Crear un objeto XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud
            xhr.open('GET', 'tabler.php', true);

            // Configurar el manejo de la respuesta
            xhr.onload = function() {
                // Verificar si la solicitud se completó correctamente
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Parsear la respuesta JSON
                    var responseData = JSON.parse(xhr.responseText);
                    // Llamar al callback con los datos obtenidos
                    callback(responseData);
                } else {
                    // Manejar errores
                    console.error('Error al hacer la solicitud:', xhr.statusText);
                }
            };

            // Manejar errores de conexión
            xhr.onerror = function() {
                console.error('Error de conexión.');
            };

            // Enviar la solicitud
            xhr.send();
        }

        // Función para registrar la cantidad de autos
        function log_cars(data) {
            for (var i = 0; i < data.length; i++) {
                document.getElementsByClassName("count-container")[i].innerHTML = data[i].cars_quantity_semaphore;
            }
        }

        // Llamar a la función fetchData y pasar log_cars como callback
        setInterval(function() {
            fetchData(log_cars);
        }, 2000); // 5000 milisegundos (5 segundos)
    </script>
</body>

</html>