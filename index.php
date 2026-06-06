<?php
session_start();
$uri = trim($_SERVER['REQUEST_URI'], '/');
$hash = '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9';

if ($uri === 'gen') {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
    echo rand(0, 255);
    exit;
}

if ($uri === 'asidhbuywqbuys') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && hash('sha256', $_POST['pass'] ?? '') === $hash) {
        $_SESSION['auth'] = true;
    }

    if (!($_SESSION['auth'] ?? false)) {
        echo '<!DOCTYPE html><html><head><style>
            body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #1a1a1a; color: #fff; margin: 0; }
            form { background: #333; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
            input { padding: 10px; border: none; border-radius: 4px; margin-right: 10px; width: 200px; }
            button { padding: 10px 20px; background: #007bff; border: none; color: white; border-radius: 4px; cursor: pointer; }
            button:hover { background: #0056b3; }
        </style></head><body>
            <form method="post">
                <input type="password" name="pass" placeholder="Password" required>
                <button type="submit">Войти</button>
            </form>
        </body></html>';
        exit;
    }

    echo '<!DOCTYPE html><html><head><style>
        body { font-family: sans-serif; padding: 50px; background: #f4f4f4; text-align: center; }
        .container { background: white; padding: 40px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    </style></head><body>
        <div class="container">
            <h1>Доступ разрешен</h1>
            <p>Это секретная панель.</p>
        </div>
    </body></html>';
    exit;
}
?>