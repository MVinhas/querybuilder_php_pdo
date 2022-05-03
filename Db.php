<?php
use PDO;
use PDOException;

class Db
{
    public static function initialize()
    {
        try {
            return new PDO(
                'mysql:host=localhost;dbname=db',
                'user',
                'password'
            );
        } catch (PDOException $e) {
            die("Could not connect to the database: $e");
        }
    }

}