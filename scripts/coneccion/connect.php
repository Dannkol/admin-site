<?php


    abstract class connect extends credenciales{
        
        protected static $conx;

        protected static $driver = "mysql";
        protected static $port = 3306;

        public static function getConnection(){
            try {
                $dns = self::$driver.":host=".self::$host.";port=".self::$port.";dbname=".self::$dbname.";user=".self::$user.";password=".self::$password;
                self::$conx = new \PDO($dns);
                self::$conx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new \Exception('Error de conexión a la base de datos: ' . $e->getMessage());
            }

            return self::$conx;
        }
    }
