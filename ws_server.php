<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require __DIR__ . '/vendor/autoload.php';

class ScreenStream implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Сервер готов к работе...\n"; // Добавили
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "!!! Новое соединение: {$conn->resourceId}\n"; // Добавили
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "--- Отключение: {$conn->resourceId}\n"; // Добавили
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Ошибка: {$e->getMessage()}\n"; // Добавили
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(new WsServer(new ScreenStream())),
    8080
);

$server->run();