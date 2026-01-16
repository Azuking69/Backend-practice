<!-- 파일 설정 -->
<?php
    // 설정된 데이터를 돌리는 파일
    return[
        // JWT서명에 쓰는 비밀키
        'jwt_secret' => 'CHANGE_ME_TO_RANDOM_LONG_SECRET',
        // Token의 사용 기한
        'jwt_exp_seconds' => 60 * 60,
    ];