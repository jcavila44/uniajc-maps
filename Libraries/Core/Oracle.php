<?php
class Oracle extends Connection
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
