<?php
session_start();
$correct_hash = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855"; // sha256 от пароля

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (hash('sha256', $_POST['password']) === $correct_hash) {
        $_SESSION['loggedin'] = true;
        header('Location: /zoqbexowgs/dashboard');
        exit;
    }
}
?>
<form method="post"><input type="password" name="password"><button>Войти</button></form>