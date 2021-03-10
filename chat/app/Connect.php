<?php


namespace App;


class Connect
{
    private static $host = "localhost";
    private static $username = "root";
    private static $password = "root";
    private static $database = "chat";

    public static function db(){
        return mysqli_connect(self::$host, self::$username, self::$password, self::$database);
    }

    public static function chek(){

        return !self::db() ? false : true;


    }
}