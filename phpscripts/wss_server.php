<?php
require_once __DIR__ . '/vendor/autoload.php'; // Asegúrate de que el autoloader de Composer esté incluido

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class Chat implements MessageComponentInterface
{
    public function onOpen(ConnectionInterface $conn)
    {
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "New message: $msg\n";
        foreach ($from->WebSocket->connections as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

$loop = \React\EventLoop\Factory::create();
$webSock = new \React\Socket\Server('0.0.0.0:8080', $loop);

$webSock = new \React\Socket\SecureServer($webSock, $loop, [
    'local_cert' => __DIR__ . '/certificate.pem', // Ruta a tu archivo .pem
    'local_pk' => __DIR__ . '/certificate.pem',   // Ruta a tu archivo .pem (clave privada)
    'allow_self_signed' => true,
    'verify_peer' => false
]);

$webServer = new IoServer(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    $webSock
);

echo "Server running on wss://localhost:8080\n";

$loop->run();
