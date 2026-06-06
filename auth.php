<?php
session_start();
function checkAuth() {
    if (!isset($_SESSION['loggedin'])) {
        header('Location: /zoqbexowgs/login');
        exit;
    }
}