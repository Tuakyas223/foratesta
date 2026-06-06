<?php
function getMinecraftStatus($ip, $port = 25565) {
    $socket = @fsockopen($ip, $port, $errno, $errstr, 2);
    if (!$socket) return ['online' => false];

    // Handshake
    $data = "\x00\x00" . pack('c', strlen($ip)) . $ip . pack('n', $port) . "\x01";
    fwrite($socket, pack('c', strlen($data)) . $data . "\x01\x00");
    
    $response = fread($socket, 2048);
    fclose($socket);

    // Парсинг JSON из ответа (пропуск заголовков)
    $json = substr($response, strpos($response, '{'));
    return json_decode($json, true);
}