<?php
class Connection
{
    private $connect;
    function __construct()
    {
        $cadenaConexion = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_CHARSET;
        try {
            $this->connect = new PDO($cadenaConexion, DB_USER, DB_PASSWORD);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->connect = 'Error de la conexion';
            echo "Error: " . $e->getMessage();
        }
    }
    public function connect()
    {
        return $this->connect;
    }
}
