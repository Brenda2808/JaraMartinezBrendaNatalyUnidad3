<?php

require_once __DIR__ . '/../core/Database.php';

class Usuario extends Database
{

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    public function registrar($nombre, $correo, $password)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios(nombre, correo, password)
                VALUES(:nombre, :correo, :password)";

        $query = $this->connection->prepare($sql);

        return $query->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':password' => $hash
        ]);
    }
    public function loginUsuario($correo)
    {
    $sql = "SELECT * FROM usuarios WHERE correo = :correo";

    $query = $this->connection->prepare($sql);

    $query->execute([
        ':correo' => $correo
    ]);

    return $query->fetch(PDO::FETCH_ASSOC);
    }

public function totalUsuarios()
{
    $sql = "
        SELECT COUNT(*) as total
        FROM usuarios
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute();

    return $stmt->fetch()['total'];
}


    public function obtenerUsuarios()
    {
        $sql = "
            SELECT *
            FROM usuarios
            ORDER BY id DESC
        ";

        $stmt =
        $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

public function obtenerUsuario($id)
{
    $sql = "
        SELECT *
        FROM usuarios
        WHERE id = :id
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch();
}

public function actualizarUsuario(
    $id,
    $nombre,
    $correo,
    $rol
){
    $sql = "
        UPDATE usuarios
        SET
            nombre = :nombre,
            correo = :correo,
            rol = :rol
        WHERE id = :id
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':id' => $id,
        ':nombre' => $nombre,
        ':correo' => $correo,
        ':rol' => $rol
    ]);
}


public function obtenerPorNombre(
    $nombre
){
    $sql = "
        SELECT *
        FROM usuarios
        WHERE nombre = :nombre
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute([
        ':nombre' => $nombre
    ]);

    return $stmt->fetch();
}

public function actualizarPassword(
    $correo,
    $password
){

    $sql = "
        UPDATE usuarios
        SET password = :password
        WHERE correo = :correo
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':password' => $password,
        ':correo' => $correo
    ]);
}


}