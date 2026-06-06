<?php
require 'auth.php';
checkAuth();

echo "Секретные данные доступны только авторизованным.";
?>
<a href="logout.php">Выйти</a>