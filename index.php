<?php
session_start();
$hash = '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9';
$uri = trim($_SERVER['REQUEST_URI'], '/');

// 1. Обработка /gen (только POST)
if ($uri === 'gen') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
    echo rand(0, 255);
    exit;
}

// 2. Обработка секретной панели /asidhbuywqbuys/
if ($uri === 'asidhbuywqbuys') {
    // Проверка логина
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pass'])) {
        if (hash('sha256', $_POST['pass']) === $hash) {
            $_SESSION['auth'] = true;
        }
    }

    // Если не авторизован - показываем логин
    if (!($_SESSION['auth'] ?? false)) {
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><style>
            body { background: #121212; color: #fff; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            form { background: #1e1e1e; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
            input { padding: 12px; border-radius: 5px; border: 1px solid #333; background: #2c2c2c; color: #fff; width: 200px; }
            button { padding: 12px 20px; background: #4caf50; border: none; color: white; border-radius: 5px; cursor: pointer; margin-left: 10px; }
        </style></head><body>
            <form method="post">
                <input type="password" name="pass" placeholder="Password" required>
                <button type="submit">Войти</button>
            </form>
        </body></html>';
        exit;
    }

    // Если авторизован - показываем панель
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><style>
        body { background: #121212; color: #fff; font-family: sans-serif; padding: 20px; }
        #screenCanvas { background: #000; border: 1px solid #444; width: 100%; max-width: 960px; display: block; margin: 0 auto; }
        h1 { text-align: center; }
    </style></head><body>
        <h1>Live Screen Feed</h1>
        <canvas id="screenCanvas" width="1280" height="720"></canvas>
        <script>
            const canvas = document.getElementById("screenCanvas");
            const ctx = canvas.getContext("2d");
            const ws = new WebSocket("ws://192.168.0.144:8080");
            ws.binaryType = "blob";

            ws.onmessage = (e) => {
                const img = new Image();
                img.onload = () => {
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    URL.revokeObjectURL(img.src);
                };
                img.src = URL.createObjectURL(e.data);
            };
            ws.onclose = () => console.log("WebSocket отключен");
        </script>
    </body></html>';
    exit;
}
?>