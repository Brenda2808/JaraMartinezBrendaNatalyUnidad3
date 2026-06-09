<?php

class Database
{
    private $host = 'localhost';
    private $port = '5432';
    private $dbname = 'medical_system';
    private $user = 'postgres';
    private $password = 'brenda';

    protected $connection;

    public function connect()
    {
        try {

            $this->connection = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->dbname",
                $this->user,
                $this->password
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $this->connection;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());
        }
    }
}