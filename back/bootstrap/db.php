<?php
    // Docker용 DB설계
    $host = getenv('DB_HOST') ?: 'db';
    $db   = getenv('DB_NAME') ?: 'example';
    $user = getenv('DB_USER') ?: 'db_user';
    $pass = getenv('DB_PASS') ?: 'db_pass';

    $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

    // PDO설계
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
