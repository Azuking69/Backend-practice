<?php
    // 예외(Exception) 클라스 만들기
    class HttpException extends Exception {
        // 생성자
        public function __construct(public int $status, string $message) {
            // 기존 구조를 부모에 맡긴다
            parent::__construct($message);
        }
    }
>