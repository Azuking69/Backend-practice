<?php
    // DB랑 얘기하는 클라스
    class UserRepository {
        // __construct: new를 하면 바로 작동하는 메소드
        // PDO: DB을 사용하기 위해 밖에서 받고 저장하는 역할
        public function __construct(private PDO $pdo) {}

        // 사용자가 있는지 확인하는 메소드
        public function findByEmail(string $email): ?array {
            // prepare: SQL의 현식 구현
            $stmt = $this -> pdo  -> prepare(
                // :email: 이따가 값을 넣는 곳
                'SELECT id, email, name, password_hash FROM users WHERE email = :email LIMIT 1'
            );
            $stmt -> execute([':email' => $email]);
            // SQL의 결과에서 1줄 호출
            // 호출 시 "OO => XX" 처럼 내용을 나누기 때문에 'OO'라고 쓸 수 있다
            $row = $stmt -> fetch(PDO:: FETCH_ASSOC);
            // $row가 있으면 그걸 툴린다
            // $row가 없으면 null를 툴린다(?:: 왼쪽이 안되면 오른쪽)
            return $row ?: null;
        }

        // password_hash를 톨리지 않는다
        public function findById(int $id): ?array {
            $stmt = $this->pdo->prepare('SELECT id, email, name FROM users WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        }


        // DB에 사용자 정보를 저장
        // DB가 결정한 ID를 받기
        // 밖에 나가도 되는 정보만 톨린다
        // $passwordHash: 안호화 된 비밀번호
        public function create(string $email, string $passwordHash, string $name): array {
            // 이따가 넣는 정보의 변수만 만들기
            $stmt = $this -> pdo -> prepare(
                'INSERT INTO users (email, password_hash, name) VALUES (:email, :ph, :name)'
            );
            // 아까 했던 곳에 정보 넣기
            $stmt->execute([
                ':email' => $email, 
                ':ph' => $passwordHash, 
                ':name' => $name
            ]);
            // 지금 만드는 사람의 ID 받기
            $id = (int) $this -> pdo -> lastInsertId();
            // 밖에 나가도 되는 정보만 톨린다
            return [
                'id' => $id, 
                'email' => $email, 
                'name' => $name
            ];
        }
    }