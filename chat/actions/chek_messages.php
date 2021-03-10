<?php

    require_once '../vendor/autoload.php';




    $room_id = $_POST["room_id"];
    $member_id = $_POST["member_id"];

    $messages = mysqli_query(\App\Connect::db(), "SELECT * FROM `messages` WHERE `room_id` = $room_id");

    $messagesList =[];
    while ($message = mysqli_fetch_assoc($messages)) {
        $messagesList[] = $message;
    }


    $html = "";


foreach ($messagesList as $item) {
        $message_member_id = $item["member_id"];
        $user = mysqli_fetch_assoc(mysqli_query(\App\Connect::db(), "SELECT * FROM `members` WHERE `id` = $message_member_id"));
        $owner = $item["member_id"] == $member_id ? "owner" : "";
        $not_owner = $item["member_id"] == $member_id ? "owner_main" : "not_owner";
        $name = $user["name"];
        $body = $item["body"];
        $html .= '<div class=" message_box ' . $owner .  '">
                <div>
                    <p><b>' . $name . '</b></p>
                    <div class=" body_message ' . $not_owner . '"><p>' . $body . '</p></div>
                </div>
            </div>';
    }
echo $html;