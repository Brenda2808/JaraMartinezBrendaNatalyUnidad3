
<?php

require_once __DIR__ . '/../core/Database.php';

class Mensaje extends Database
{
    private $connection;

    public function __construct()
    {
        $this->connection =
        $this->connect();
    }

    public function enviar(
        $remitente_id,
        $destinatario_id,
        $mensaje
    ){
        $sql = "
            INSERT INTO mensajes(
                remitente_id,
                destinatario_id,
                mensaje
            )
            VALUES(
                :remitente_id,
                :destinatario_id,
                :mensaje
            )
        ";

        $stmt =
        $this->connection->prepare($sql);

        return $stmt->execute([
            ':remitente_id' => $remitente_id,
            ':destinatario_id' => $destinatario_id,
            ':mensaje' => $mensaje
        ]);
    }

    public function obtenerConversacion(
        $usuario1,
        $usuario2
    ){
        $sql = "
            SELECT *
            FROM mensajes
            WHERE
            (
                remitente_id = :usuario1
                AND destinatario_id = :usuario2
            )
            OR
            (
                remitente_id = :usuario2
                AND destinatario_id = :usuario1
            )
            ORDER BY fecha ASC
        ";

        $stmt =
        $this->connection->prepare($sql);

        $stmt->execute([
            ':usuario1' => $usuario1,
            ':usuario2' => $usuario2
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}