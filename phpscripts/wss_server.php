<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;
use React\Socket\Server as ReactServer;
use React\Socket\SecureServer as ReactSecureServer;
use React\EventLoop\Factory as LoopFactory;

$loop = LoopFactory::create();
$webSock = new ReactServer('0.0.0.0:8080', $loop);

// Configuración del servidor seguro usando el archivo .pem
$webSock = new ReactSecureServer($webSock, $loop, [
    'local_cert' => __DIR__ . '/certificate.pem',
    'local_pk' => __DIR__ . '/certificate.pem',
    'allow_self_signed' => false,
    'verify_peer' => true
]);

$webServer = new IoServer(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    $webSock,
    $loop
);

$webServer->run();
