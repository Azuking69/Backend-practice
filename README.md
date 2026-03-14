# 🚀 Backend-Project

🇯🇵：会員登録とログイン機能を実装しながら、バックエンド構造を学習するためのPHP REST API練習プロジェクト。
    Docker環境でPHPとMySQLを使用し、JWT認証ベースのログインシステムを実装する。
   
🇬🇧：A practice project to learn backend architecture by implementing user signup and login with a PHP REST API.  
    Uses PHP and MySQL in a Docker environment and implements a JWT-based authentication system.

🇰🇷：회원가입과 로그인 기능을 구현하면서 백엔드 구조를 학습하기 위한 PHP REST API 연습 프로젝트.
    Docker 환경에서 PHP와 MySQL을 사용하여 JWT 기반 인증 시스템을 구현한다.

---

# 🎯 プロジェクト目的 / Project Purpose / 프로젝트 목적

🇯🇵：バックエンド開発でよく使われる **Controller → Service → Repository 構造** を理解する。  

🇬🇧：The goal is to understand the common backend architecture **Controller → Service → Repository**.  

🇰🇷：백엔드 개발에서 자주 사용하는 **Controller → Service → Repository 구조**를 이해하는 것이다.

## システムの流れ / System Flow / 시스템 흐름

```
Client
  ↓
Routes
  ↓
Controller
  ↓
Service
  ↓
Repository
  ↓
Database
```

---

# ✨ 主な機能 / Features / 주요 기능

| 日本語 | English | 한국어 |
|------|------|------|
| 会員登録 | User registration | 회원가입 |
| ログイン | User login | 로그인 |
| JWT発行 | JWT token generation | JWT 발급 |
| REST API | REST API implementation | REST API |
| JSONレスポンス | JSON response handling | JSON 응답 |

---

# 🧰 使用技術 / Tech Stack / 사용 기술

| 技術 | 内容 |
|-----|-----|
| Language | PHP 8.3 |
| Web Server | Apache |
| Database | MySQL 8.0 |
| Container | Docker |
| Routing | AltoRouter |
| Authentication | JWT (custom implementation) |

---

# 🏗 システム構造 / System Architecture / 시스템 구조

```
Client Request
      ↓
Routes
      ↓
Controller
      ↓
Service
      ↓
Repository
      ↓
Database
```

## 各レイヤーの役割 / Layer Responsibilities / 레이어 역할

| Layer | 日本語 | English | 한국어 |
|------|------|------|------|
| Routes | URLを確認しControllerを呼び出す | Routes requests to controllers | URL 확인 후 Controller 호출 |
| Controller | リクエストを受け取りServiceを呼ぶ | Receives request and calls Service | 요청을 받아 Service 실행 |
| Service | ビジネスロジック処理 | Business logic layer | 비즈니스 로직 처리 |
| Repository | DBアクセス | Database access layer | 데이터베이스 접근 |
| Database | データ保存 | Data storage | 데이터 저장 |

---

# 📁 プロジェクト構造 / Project Structure / 프로젝트 구조

```
BACKEND-PROJECT
│
├─ .docker
│   ├─ initdb
│   │   └─ 001_create_users.sql
│   └─ apache.conf
│
├─ app
│   ├─ Controllers
│   │   └─ AuthController.php
│   ├─ Services
│   │   └─ AuthService.php
│   ├─ Repositories
│   │   └─ UserRepository.php
│   ├─ Requests
│   │   ├─ LoginRequest.php
│   │   └─ SignupRequest.php
│   ├─ Responses
│   │   └─ JsonResponse.php
│   └─ Exceptions
│       └─ HttpException.php
│
├─ bootstrap
│   ├─ config.php
│   └─ db.php
│
├─ routes
│   └─ Routes.php
│
├─ public
│   ├─ index.php
│   └─ .htaccess
│
├─ .env
├─ docker-compose.yml
└─ Dockerfile
```

---

# 🔑 API Endpoint

## 👶 会員登録 / Signup / 회원가입

POST /auth/signup

### Request

```json
{
  "email": "test@example.com",
  "password": "password123",
  "name": "Azuki"
}
```

### Response

```json
{
  "user": {
    "id": 1,
    "email": "test@example.com",
    "name": "Azuki"
  },
  "access_token": "jwt_token",
  "token_type": "Bearer"
}
```

---

## 🔐 ログイン / Login / 로그인

POST /auth/login

### Request

```json
{
  "email": "test@example.com",
  "password": "password123"
}
```

### Response

```json
{
  "user": {
    "id": 1,
    "email": "test@example.com",
    "name": "Azuki"
  },
  "access_token": "jwt_token",
  "token_type": "Bearer"
}
```

---

# 🐳 実行方法 / Run / 실행 방법

## Docker起動 / Start Docker / Docker 실행

```
docker compose up -d
```

## サーバ起動 / Start server / 서버 실행

```
php -S 0.0.0.0:8000 -t public public/index.php
```

## アクセス / Access / 접속

```
http://localhost:8000
```

---

# 📚 学習ポイント / Learning Points / 학습 포인트

🇯🇵：このプロジェクトで次を学習できる。  
🇬🇧：This project helps learning the following concepts.  
🇰🇷：이 프로젝트를 통해 다음을 학습할 수 있다.

- Backend Layer Architecture  
- REST API Design  
- JWT Authentication  
- Docker Development Environment  
- PHP Namespace Structure  
- Repository Pattern
