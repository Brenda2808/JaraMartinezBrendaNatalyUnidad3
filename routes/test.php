<?php

require_once '../app/core/Database.php';

$database = new Database();

$connection = $database->connect();

echo "Conexión exitosa con PostgreSQL";