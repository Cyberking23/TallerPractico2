<?php

class Conexion
{
    private static $host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = 'root';
    private static $db_port = '3306';
    private static $db_name = 'desafio_dss2';
    private static $pdo;

    // Método para inicializar la conexión
    public static function init()
    {
        if (!self::$pdo) {
            try {
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$db_port . ";dbname=" . self::$db_name . ";charset=utf8";
                self::$pdo = new PDO($dsn, self::$db_user, self::$db_pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }
    }

    // Método para ejecutar una consulta y devolver el resultado
    public static function query($sql)
    {
        self::init(); // Asegurarse de que la conexión esté inicializada
        try {
            $query = self::$pdo->query($sql);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    // Método para ejecutar una consulta y devolver un array asociativo
    public static function query_array_assoc($sql)
    {
        self::init(); // Asegurarse de que la conexión esté inicializada
        try {
            $stmt = self::$pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }
}
