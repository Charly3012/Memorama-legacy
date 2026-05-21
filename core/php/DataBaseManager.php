<?php

/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 07/02/2016
 * Time: 07:55 PM
 */

define('SERVER', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB', 'memorama');

class DataBaseManager {

    private $mysqli;
    private static $_instance = null;

    private function __construct() {

        @$this->mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DB);

        if ($this->mysqli->connect_errno) {
            error_log("Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error);
            
            die("<h1>Servicio temporalmente no disponible</h1><p>Estamos experimentando problemas técnicos. Por favor, intente más tarde.</p>");
        }

        if (!$this->mysqli->set_charset('utf8')) {
            error_log("Error cargando el conjunto de caracteres utf8: " . $this->mysqli->error);
            die("<h1>Error de configuración del sistema</h1>");
        }
    }

    public function __destruct() {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new DataBaseManager();
        }
        return self::$_instance;
    }

    final public function __clone() {
        throw new Exception('Only one instance is allowed');
    }

    public function insertQuery($query) {
        return $this->mysqli->query($query);
    }

    public function realizeQuery($query) {
        if ($result = $this->mysqli->query($query)) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free(); 
            return $data;
        } else {
            return null;
        }
    }

    public function close() {
        if ($this->mysqli) {
            $this->mysqli->close();
        }
    }
}