<?php

require_once __DIR__ . '/../core/Database.php';

class Paciente extends Database
{
    public function __construct()
    {
        $this->connection = $this->connect();
    }

    public function obtenerPacientes()
    {
        $sql = "SELECT * FROM pacientes ORDER BY id DESC";

        $query = $this->connection->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function guardarPaciente($nombre, $edad, $telefono, $correo)
    {
    $sql = "INSERT INTO pacientes
            (nombre, edad, telefono, correo)
            VALUES
            (:nombre, :edad, :telefono, :correo)";

    $query = $this->connection->prepare($sql);

    return $query->execute([
        ':nombre' => $nombre,
        ':edad' => $edad,
        ':telefono' => $telefono,
        ':correo' => $correo
    ]);
    }
    public function eliminarPaciente($id)
    {
    $sql = "DELETE FROM pacientes WHERE id = :id";

    $query = $this->connection->prepare($sql);

    return $query->execute([
        ':id' => $id
    ]);
    }
    public function obtenerPaciente($id)
    {
    $sql = "SELECT * FROM pacientes WHERE id = :id";

    $query = $this->connection->prepare($sql);

    $query->execute([
        ':id' => $id
    ]);

    return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarPaciente($id, $nombre, $edad, $telefono, $correo)
    {
    $sql = "UPDATE pacientes
            SET
                nombre = :nombre,
                edad = :edad,
                telefono = :telefono,
                correo = :correo
            WHERE id = :id";

    $query = $this->connection->prepare($sql);

    return $query->execute([
        ':id' => $id,
        ':nombre' => $nombre,
        ':edad' => $edad,
        ':telefono' => $telefono,
        ':correo' => $correo
    ]);
    }
    public function totalPacientes()
    {
    $sql = "SELECT COUNT(*) as total FROM pacientes";

    $stmt = $this->connection->prepare($sql);

    $stmt->execute();

    return $stmt->fetch()['total'];
    }

public function obtenerPerfil(
    $usuario_id
){
    $sql = "
        SELECT *
        FROM pacientes
        WHERE usuario_id = :usuario_id
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute([
        ':usuario_id' => $usuario_id
    ]);

    return $stmt->fetch();
}

public function crearPerfil(
    $nombre,
    $edad,
    $peso,
    $estatura,
    $historial,
    $usuario_id
){
    $sql = "
        INSERT INTO pacientes(
            nombre,
            edad,
            peso,
            estatura,
            historial,
            usuario_id
        )
        VALUES(
            :nombre,
            :edad,
            :peso,
            :estatura,
            :historial,
            :usuario_id
        )
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':nombre' => $nombre,
        ':edad' => $edad,
        ':peso' => $peso,
        ':estatura' => $estatura,
        ':historial' => $historial,
        ':usuario_id' => $usuario_id
    ]);
}

public function actualizarPerfil(
    $usuario_id,
    $edad,
    $telefono,
    $correo,
    $peso,
    $estatura,
    $historial
){
    $sql = "
        UPDATE pacientes
        SET
            edad = :edad,
            telefono = :telefono,
            correo = :correo,
            peso = :peso,
            estatura = :estatura,
            historial = :historial
        WHERE usuario_id = :usuario_id
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':edad' => $edad,
        ':telefono' => $telefono,
        ':correo' => $correo,
        ':peso' => $peso,
        ':estatura' => $estatura,
        ':historial' => $historial,
        ':usuario_id' => $usuario_id
    ]);
}



}