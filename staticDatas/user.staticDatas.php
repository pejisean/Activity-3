<?php
return [
    [
        'id' => 1,
        'username' => 'alice',
        'email' => 'alice@example.com',
        'password_hash' => password_hash('password123', PASSWORD_DEFAULT),
        'created_at' => '2025-01-01 10:00:00+00',
        'updated_at' => '2025-01-01 10:00:00+00',
    ],
    [
        'id' => 2,
        'username' => 'bob',
        'email' => 'bob@example.com',
        'password_hash' => password_hash('secret456', PASSWORD_DEFAULT),
        'created_at' => '2025-01-02 11:00:00+00',
        'updated_at' => '2025-01-02 11:00:00+00',
    ],
];
