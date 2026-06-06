<?php
require 'auth.php';
checkAuth();
# echo "Секретные данные доступны только авторизованным.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
</head>
<body>
    <h1>Добро пожаловать в DashBoard!</h1>
    <p>Здесь ты можешь увидеть секретные данные, доступные только авторизованным пользователям.</p>
</body>
</html>