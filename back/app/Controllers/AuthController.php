<?php
  // 입구 / 출구 당담
  class AuthController {
      // AuthService에 일을 맡긴다
      public function __construct(private AuthService $service) {}

      public function signup(): void {
          // HTTP 안을 읽기
          $input = json_decode(file_get_contents('php://input'), true) ?? [];
          // 입력 확인
          $data = (new SignupRequest($input)) -> validated();
          // result 변수에 3개 내용을 가져오기
          $result = $this -> service -> signup(
              $data['email'],
              $data['password'],
              $data['name']
          );
          // JSON으로 result를 톨린다
          // JsonResponse에서 created 메소드를 불다
          JsonResponse:: created($result);
      }
      // 로그인 메소드 만들기
      public function login(): void {
          // json_decode: JSON문장을 읽기
          // php://: PHP에서 사용할 수 있도록 배열으로 변환
          $input = json_decode(file_get_contents('php://input'), true) ?? [];
          // LoginRequest가 맞는지 판단
          $data = (new LoginRequest($input)) -> validated();
          // 로그인 처리는 Service가 판단
          $result = $this -> service -> login(
              $data['email'],
              $data['password']
          );
          JsonResponse:: ok($result);
      }

    // Header를 읽기
      public function me(): void {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        $user = $this -> service -> getUserFromToken($authHeader);
        JsonResponse::ok($user);
    }

  }
