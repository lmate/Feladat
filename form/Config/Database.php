<?php

class Database
{
    private static $con = null;

    private function __construct() {}

    public static function GetCon()
    {
        if(is_null(self::$con)) 
        {
            try 
            {
                self::$con = new PDO("mysql:host=localhost;dbname=cegalapitas;charset=utf8", "root", ""); //FZQHGJveyNEV9k4z
            } 
            catch (PDOException $err) 
            {
                $this->JsonError("connectionError", "Nem elérhető az adatbázis kérlek próbáld meg később!");
            }
        }
        return self::$con;
    }

    private function JsonError($msg1, $msg2) // Error handler
    {
        die(json_encode(array("error" => $msg1, "errorMessage" => $msg2)));
    }
}
?>