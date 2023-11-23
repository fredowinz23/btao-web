<?php
class Database
{
    private static $dbName = 'epiz_33433895_esoap' ;
    private static $dbHost = 'sql310.epizy.com' ;
    private static $dbUsername = 'epiz_33433895';
    private static $dbUserPassword = 'i6FN6MNWqOPBwcE';
    private static $port = '3306';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO("mysql:host=".self::$dbHost.";port=".self::$port.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
