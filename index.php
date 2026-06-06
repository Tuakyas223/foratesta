<?php
session_start();
$password_hash = '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9';
$uri = trim($_SERVER['REQUEST_URI'], '/');

if ($uri === 'gen') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
    echo rand(0, 255);
    exit;
}

if ($uri === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (hash('sha256', $_POST['pass'] ?? '') === $password_hash) {
            $_SESSION['auth'] = true;
            header('Location: /asidhbuywqbuys/');
            exit;
        }
    }
    echo '<form method="post"><input type="password" name="pass"><button type="submit">Login</button></form>';
    exit;
}

if ($uri === 'asidhbuywqbuys') {
    if (!($_SESSION['auth'] ?? false)) {
        header('Location: /login');
        exit;
    }
    echo 'Секретная зона';
    exit;
}
?>