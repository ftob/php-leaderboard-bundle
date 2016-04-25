<?php
if (preg_match('/^\/leaderboard/', $_SERVER["REQUEST_URI"])) {
    $response = [
        'status' => 'OK',
        'leaderboard' => [
            [
                'place' => 1,
                'id' => 1,
                'score' => 212312313123,
                'name' => 'TestName',
                'avatar' => 'TestAvatar.jpg',

            ],
            [
                "place" => 2,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 3,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 4,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 5,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 6,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 7,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 8,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 9,
                "score" => 1000000,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ],
            [
                "place" => 10,
                "score" => 100012310,
                "id" => 123456,
                "name" => "Vasya Pupkin",
                "avatar" => "http://.../avatar.jpg"
            ]
        ]
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
} else if (preg_match('/^\/stop/', $_SERVER["REQUEST_URI"])) {
    exit('stop');
} else {
    echo "<p>Welcome to Tests</p>";
}
