<?php
require 'auth.php';
require 'monitor.php';
checkAuth();

$status = getMinecraftStatus('192.168.0.71', 25565); // Укажи IP твоего сервера
?>

<h1>Мониторинг сервера</h1>
<?php if ($status['online'] !== false): ?>
    <p>Статус: Онлайн</p>
    <p>Игроки: <?php echo $status['players']['online']; ?> / <?php echo $status['players']['max']; ?></p>
    <p>Версия: <?php echo $status['version']['name']; ?></p>
<?php else: ?>
    <p style="color:red;">Сервер офлайн</p>
<?php endif; ?>