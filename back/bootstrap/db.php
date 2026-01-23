<?php
    // DB설계
    $dsn = 'mysql: host = localhost; dbname=example; charset = utf8mb4';
    $user = 'db_user';
    $pass = 'db_pass';

    // PDO설계
    $pdo = new PDO(
        $dsn,
        $user,
        $pass,
        [
            PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
            PDO:: ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC,
        ]
    );
