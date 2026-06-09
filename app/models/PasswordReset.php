<?php

require_once __DIR__ . '/../core/Database.php';

class PasswordReset extends Database
{
    public function __construct()
    {
        $this->connection =
        $this->connect();
    }

    public function guardarToken(
        $correo,
        $token,
        $expiracion
    ){

        $sql = "
            INSERT INTO password_resets(
                correo,
                token,
                expiracion
            )
            VALUES(
                :correo,
                :token,
                :expiracion
            )
        ";

        $stmt =
        $this->connection->prepare($sql);

        return $stmt->execute([
            ':correo' => $correo,
            ':token' => $token,
            ':expiracion' => $expiracion
        ]);
    }


    public function buscarToken($token)
    {
        $sql = "
            SELECT *
            FROM password_resets
            WHERE token = :token
        ";

        $stmt =
        $this->connection->prepare($sql);

        $stmt->execute([
            ':token' => $token
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function eliminarToken($token)
{
    $sql = "
        DELETE FROM password_resets
        WHERE token = :token
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':token' => $token
    ]);
}

}