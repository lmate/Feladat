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
                die("The page is not functional at the momment please try again later! ". get_class($err));
            }
        }
        return self::$con;
    }
}
?>