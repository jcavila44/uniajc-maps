<?php
class MySQL extends Connection
{
    private $connection;
    private $arrayValues;
    private $query;

    function __construct()
    {
        $this->connection = new Connection();
        $this->connection = $this->connection->connect();
    }

    public function Insert(string $query, array $arrayValues){
        $this->query = $query;
        $this->arrayValues = $arrayValues;

        $insert = $this->connection->prepare($this->query);

        $responseInsert = $insert->execute($this->arrayValues);
        if ($responseInsert) {
            $lastInsert = $this->connection->lastInsertId();
        }else{
            $lastInsert = 0;
        }
        return $lastInsert;
    }

    public function Update(string $query, array $arrayValues){
        $this->query = $query;
        $this->arrayValues = $arrayValues;

        $update = $this->connection->prepare($this->query);
        $responseUpdate = $update->execute($this->arrayValues);
        return $responseUpdate;
    }


    public function Delete(string $query){
        $this->query = $query;
        $delete = $this->connection->prepare($this->query);
        $responseDelete = $delete->execute();
        return $responseDelete;
    }

    public function Select(string $query){
        $this->query = $query;
        $result = $this->connection->prepare($this->query);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function SelectAll(string $query){
        $this->query = $query;
        $result = $this->connection->prepare($this->query);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

}
