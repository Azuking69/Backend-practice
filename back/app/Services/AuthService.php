<?php
    // Repository에 명령
    class AuthService {
        // // __construct: new를 하면 바로 작동하는 메소드
        public function __construct(
            // $user: DB당담
            private UserRepository $users,
            // $config: jwt_secret/유호기한
            private array $config
        ) {}

        // 회원가입 method 만들기
        public function signup(string $email, string $password, string $name): array {
        // ->: this에 있는 users 변수에 있는 method에 이메일이 등록됐으면 오류
        if ($this -> users -> findByEmail($email)) {
                throw new HttpException(409, 'この email は既に使われています');
            }
            // 원래 PW가 모르는 현식으로 바꾸고 저장
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // DB에 저장
            $user = $this -> users ->create($email, $hash, $name);
            // 검사하는 token(JWT) 만들기
            $token = $this -> issueJwt($user['id']);
            // 오는 내용
            return [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ];
        }

        // login 메소드
        public function login(string $email, string $password): array {
            $user = $this -> users -> findByEmail($email);
            // user없을 때 / 비밀번호 불일치 시 오류
            if (!$user || !password_verify($password, $user['password_hash'])) {
                throw new HttpException(401, 'email または password が違います');
            }
            // 오는 내용
            $publicUser = [
                'id' => (int)$user['id'],
                'email' => $user['email'],
                'name' => $user['name']
            ];
            // 검사하는 token(JWT) 만들기
            $token = $this -> issueJwt((int) $user['id']);
            return [
                'user' => $publicUser,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ];
        }

        // JWTからユーザーIDを取り出す
        public function getUserFromToken(string $authHeader): array {
            // Authorization: Bearer xxx.yyy.zzz
            if (!str_starts_with($authHeader, 'Bearer ')) {
                throw new HttpException(401, 'トークンが不正です');
            }

            $token = substr($authHeader, 7);
            $parts = explode('.', $token);

            if (count($parts) !== 3) {
                throw new HttpException(401, 'トークン形式が不正です');
            }

            [$h, $p, $s] = $parts;

            // 署名チェック
            $expected = $this->b64url(
                hash_hmac(
                    'sha256',
                    $h . '.' . $p,
                    $this -> config['jwt_secret'],
                    true
                )
            );

            if (!hash_equals($expected, $s)) {
                throw new HttpException(401, '署名が不正です');
            }

            $payload = json_decode(base64_decode(strtr($p, '-_', '+/')), true);

            if (!$payload || $payload['exp'] < time()) {
                throw new HttpException(401, 'トークンの有効期限切れ');
            }

            $user = $this -> users -> findById((int)$payload['sub']);
            if (!$user) {
                throw new HttpException(401, 'ユーザーが存在しません');
            }
            return $user;
        }


        private function issueJwt(int $userId): string {
            // 지금 시간 받기
            $now = time();
            // 누구 것인지 언제 만든지 언제까지 유호인지 정리
            $payload = [
                'sub' => $userId,
                'iat' => $now,
                'exp' => $now + (int)$this->config['jwt_exp_seconds'],
            ];
            // 비밀키로 서명
            $header = ['alg' => 'HS256', 'typ' => 'JWT'];
            
            $h = $this -> b64url(json_encode($header, JSON_UNESCAPED_UNICODE));
            $p = $this -> b64url(json_encode($payload, JSON_UNESCAPED_UNICODE));
            $sig = hash_hmac(
                'sha256',
                $h . '.' . $p,
                $this -> config['jwt_secret'],
                true
            );
            $s = $this -> b64url($sig);

            return $h . '.' . $p . '.' . $s;
        }
        // JWT용 URL를 안전한 분자애 변환
        private function b64url(string $binOrText): string {
            $b64 = base64_encode($binOrText);
            return rtrim(strtr($b64, '+/', '-_'), '=');
        }
}
