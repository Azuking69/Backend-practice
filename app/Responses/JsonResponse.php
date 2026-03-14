<?php
    // JSON현식의 HTTP response 클라스 정의
    // -> API 대답을 동일
    class JsonResponse {
        // 대답 3개 만들기
        // ok method 만들기
        // 전하는 데이테 : array $data
        public static function ok(array $data): void {
            // 내용: HTTP 설정
            // 데이터를 그대로 툴림
            self::send(200, $data);
        }

        // 성공할 때 created method 만들기
        public static function created(array $data): void {
            self::send(201, $data);
        }

        // 실패할 때 오류 method 만들기
        public static function error(int $status, string $message): void {
            self::send($status, ['error' => ['message' => $message]]);
        }



        // 보낼 때 send method 만들기
        private static function send(int $status, array $payload): void {
            // HTTP staitus code 설정
            http_response_code($status);
            // 대답이 JSON이란 전달
            header('Content-Type: application/json; charset=utf-8');
            // 배열 -> 문자열으로 변환
            echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        }
    }