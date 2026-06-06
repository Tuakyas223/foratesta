<?php
if (trim($_SERVER['REQUEST_URI'], '/') === 'gen') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
    echo rand(0, 255);
    exit;
}
?>