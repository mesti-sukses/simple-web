<?php
    $path = "https://api.telegram.org/bot1527520188:AAHmmZ1Exgp9WLFd25NDUR_tHQg-QvQYJ_U";
    $update = json_decode(file_get_contents("php://input"), TRUE);

    $chatId = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];

    $db = new SQLite3('data.db');
    $ideData = $db->exec('SELECT * FROM idea');
    $ide_1 = rand(0, count($ideData)-1);
    $firstIdea = $ideData[$ide_1];

    if(strpos($message, "/today") === 0){
        file_get_contents(
            $path.
            "/sendmessage?chat_id=".
            $chatId.
            "&text=".
            $firstIdea['content']
        );
    } else {
        file_get_contents(
            $path.
            "/sendmessage?chat_id=".
            $chatId.
            "&text=".
            "Perintah salah, coba lagi"
        );
    }
?>