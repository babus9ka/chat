<?php


namespace App;


class Rooms extends Connect
{
    public static function create($name){

        if ($name === ""){
            return false;
        }

        $SQL = "INSERT INTO `rooms` (`id`, `title`) VALUES (NULL, '$name')";
        $room = mysqli_query(self::db(), $SQL);
        return $room ? true : false;
    }

    public static function addMember($name,$room_id){
        if($name === "" || $room_id === ""){
            return false;
        }
        $SQL = "INSERT INTO `members` (`id`, `name`, `room_id`) VALUES (NULL, '$name', '$room_id')";

        $connect = self::db();

        $member = mysqli_query($connect, $SQL);


        return $member ? mysqli_insert_id($connect) : false;

    }

    public static function chekMemberRoom($room_id, $member_id){





        $room = mysqli_fetch_assoc(mysqli_query(self::db(), "SELECT * FROM `rooms` WHERE `id` = $room_id"));

        if (is_null($room)){
            return false;
        }

        $member = mysqli_fetch_assoc(mysqli_query(self::db(), "SELECT * FROM `members` WHERE `id` = $member_id"));

        if (!$member){
            return false;
        }

        if ((int)$member["room_id"] !== (int)$room["id"] ){
            return false;
        }

        return true;

    }

    public static function get($room_id){
        return mysqli_fetch_assoc(mysqli_query(self::db(), "SELECT * FROM `rooms` WHERE `id` = $room_id"));

    }


}