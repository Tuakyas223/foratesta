<?php
session_start();
$correct_hash = "b859b76445e2a714c6de6977db64df2b59fa69304e8c02dffcfd08f4c844ebd7"; // sha256 от пароля notanadmin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (hash('sha256', $_POST['password']) === $correct_hash) {
        $_SESSION['loggedin'] = true;
        header('Location: /zoqbexowgs/dashboard');
        exit;
    }
}
?>
<form method="post"><input type="password" name="password"><button>Войти</button></form>