<?php
    $path = "https://api.telegram.org/bot1527520188:AAHmmZ1Exgp9WLFd25NDUR_tHQg-QvQYJ_U";
    $update = json_decode(file_get_contents("php://input"), TRUE);

    $chatId = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    echo "Test";

    $db = new PDO('sqlite:data.db');
    $ideModel = $db->query('SELECT * FROM idea');
    $ideData = array();
    while ($row = $ideModel->fetchObject()) {
        array_push($ideData, $row);
    }
    $ide_1 = rand(0, count($ideData)-1);
    $firstIdea = $ideData[$ide_1];
    // print_r($firstIdea);

    if(strpos($message, "/today") === 0){
        file_get_contents(
            $path.
            "/sendmessage?chat_id=".
            $chatId.
            "&text=".
            $firstIdea->content
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