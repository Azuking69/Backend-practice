<?php
    // controller에 return하는 메소드
    return function (AuthController $controller) {
        // 정보를 받기
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = rtrim($path, '/');
       
        // 회원가입의 경우
        // POST로 '/auth/signup'까지 오면
        if ($method === 'POST' && $path === '/auth/signup') {
            $controller -> signup();
            exit;
        }

        // 로그인의 경우
        // POST로 '/auth/login'까지 오면
        if ($method === 'POST' && $path === '/auth/login') {
            $controller -> login();
            exit;
        }

        if ($method === 'GET' && $path === '/me') {
            $controller->me();
            exit;
        }

        // 어느 if에 안 맞으면 오류
        JsonResponse::error(404, 'Not Found');
    };
