<?php
    // 회원가입 클라스
    class SignupRequest {
        // 메소드 만들기
        // __construct: new를 하면 바로 작동하는 메소드
        // array $input: 배열 변수 정의
        public function __construct(private array $input) {}

        // 검증 메소드 만들기
        public function validated(): array {
            // trim: 공백을 빼는 친구
            // ??: 혹시 없으면 뒤에 있는 걸 사용
            $email = trim((string)($this -> input['email'] ?? ''));
            $password = (string)($this -> input['password'] ?? '');
            $name = trim((string)($this -> input['name'] ?? ''));

            // 이메일 확인
            // ===: 뒤에이라면 안돼
            // FILTER_VALIDATE_EMAIL: PHP에 처음부터 준비된 판단 기준
            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // throw: 오류가 있으면 다시 입력시키는 친구
                throw new HttpException(422, 'email が不正です');
            }
            if (strlen($password) < 8) {
                throw new HttpException(422, 'password は8文字以上にしてください');
            }
            if ($name === '') {
                throw new HttpException(422, 'name は必須です');
            }

            return ['email' => $email, 'password' => $password, 'name' => $name];
        }
    }
