<?php
    // login 기능 만들기
    class LoginRequest {
        // method 만들기
        public function __construct(private array $input) {}

        // 검증 method 만들기
        // 내용은 Signup랑 비슷해게 만든다
        public function validated(): array {
            $email = trim((string)($this -> input['email'] ?? ''));
            $password = (string)($this -> input['password'] ?? '');

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new HttpException(422, 'email が不正です');
            }
            if ($password === '') {
                throw new HttpException(422, 'password は必須です');
            }

            return ['email' => $email, 'password' => $password];
        }
    }
?>