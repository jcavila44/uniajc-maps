<?php
class SQLite extends Connection
{
    private $connection;
    private $arrayValues;
    private $query;

    function __construct()
    {
        $this->connection = new Connection();
        $this->connection = $this->connection->connect();
    }
}