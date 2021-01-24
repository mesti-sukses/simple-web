<?php
    class Telegram
    {
        function sendIdea(){
            $path = "https://api.telegram.org/bot1527520188:AAHmmZ1Exgp9WLFd25NDUR_tHQg-QvQYJ_U";
            $update = json_decode(file_get_contents("php://input"), TRUE);

            $chatId = $update["message"]["chat"]["id"];
            $message = $update["message"]["text"];
            file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Ini dari bot kita");
        }
    }
    
?>