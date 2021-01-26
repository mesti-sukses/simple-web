<?php
    $myfile = fopen("assets/weekly_news.txt", "r") or die("Unable to open file!");
    $message = fread($myfile,filesize("assets/weekly_news.txt"));
    fclose($myfile);

    // echo $message;
    $path = "https://api.telegram.org/bot1527520188:AAHmmZ1Exgp9WLFd25NDUR_tHQg-QvQYJ_U";
    $mysqli = new mysqli("localhost:3306","mestisuk","t3mar1fanS","mestisuk_telegram");
    // $mysqli = new mysqli("localhost:3306","root","root","telegram");
    $sql = "SELECT * FROM user";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            // echo $row['chat_id'];
            file_get_contents(
                $path.
                "/sendmessage?chat_id=".
                $row['chat_id'].
                "&text=".
                urlencode($message)
            );
        }
    } else {
        echo "0 results";
    }
    $mysqli->close();
    
?>