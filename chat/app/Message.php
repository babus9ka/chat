<?php


namespace App;


class Message extends Connect
{
    public static function send($room_id, $member_id, $body){



            if ($body === ""){
                return false;
            }

            $SQL = "INSERT INTO `messages` (`id`, `room_id`, `member_id`, `body`) VALUES (NULL, $room_id, $member_id, '$body')";

            $message = mysqli_query(self::db(), $SQL);

            return $message ? true : false;

    }
}