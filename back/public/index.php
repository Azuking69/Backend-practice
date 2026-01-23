<?php
    // DB접속하는 파일 읽기
    require __DIR__ . '/../bootstrap/db.php';
    // 설정된 배열을 넣기
    $config = require __DIR__ . '/../bootstrap/config.php';

    require __DIR__ . '/../app/Exceptions/HttpException.php';
    require __DIR__ . '/../app/Responses/JsonResponse.php';
    require __DIR__ . '/../app/Requests/SignupRequest.php';
    require __DIR__ . '/../app/Requests/LoginRequest.php';
    require __DIR__ . '/../app/Repositories/UserRepository.php';
    require __DIR__ . '/../app/Services/AuthService.php';
    require __DIR__ . '/../app/Controllers/AuthController.php';

    try {
        // 오르바른 처리
        $users = new UserRepository($pdo);
        $service = new AuthService($users, $config);
        $controller = new AuthController($service);

        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($method === 'POST' && $path === '/auth/signup') { $controller -> signup(); exit; }
        if ($method === 'POST' && $path === '/auth/login')  { $controller -> login();  exit; }

        // 어느 길에 맞지 않으면 오류
        JsonResponse:: error(404, 'Not Found');
    } catch (HttpException $e) {
        JsonResponse:: error($e -> status, $e -> getMessage());
    } catch (Throwable $e) {
        JsonResponse:: error(500, 'Server Error');
    }
