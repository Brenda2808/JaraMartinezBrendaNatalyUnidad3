<?php

require_once __DIR__ . '/../core/Database.php';

class Cita extends Database
{
        public function __construct()
    {
        $this->connection = $this->connect();
    }
    public function obtenerCitas()
    {
        $sql = "
            SELECT 
                citas.*,
                pacientes.nombre AS paciente_nombre
            FROM citas
            INNER JOIN pacientes
            ON citas.paciente_id = pacientes.id
            ORDER BY citas.id DESC
        ";

        $query = $this->connection->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarCita(
        $paciente_id,
        $fecha,
        $hora,
        $motivo
    )
    {
        $sql = "
            INSERT INTO citas
            (
                paciente_id,
                fecha,
                hora,
                motivo
            )
            VALUES
            (
                :paciente_id,
                :fecha,
                :hora,
                :motivo
            )
        ";

        $query = $this->connection->prepare($sql);

        return $query->execute([
            ':paciente_id' => $paciente_id,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':motivo' => $motivo
        ]);
    }

public function totalCitas()
{
    $sql = "
        SELECT COUNT(*) as total
        FROM citas
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute();

    return $stmt->fetch()['total'];
}

public function citasPendientes()
{
    $sql = "
        SELECT COUNT(*) as total
        FROM citas
        WHERE estado = 'Pendiente'
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute();

    return $stmt->fetch()['total'];
}

public function obtenerMisCitas(
    $usuario_id
){
    $sql = "
        SELECT *
        FROM citas
        WHERE usuario_id = :usuario_id
        ORDER BY id DESC
    ";

    $stmt =
    $this->connection->prepare($sql);

    $stmt->execute([
        ':usuario_id' => $usuario_id
    ]);

    return $stmt->fetchAll();
}

public function crearCita(
    $paciente_id,
    $especialidad,
    $motivo,
    $fecha,
    $hora,
    $usuario_id
){
    $sql = "
        INSERT INTO citas(
            paciente_id,
            especialidad,
            motivo,
            fecha,
            hora,
            usuario_id,
            estado
        )
        VALUES(
            :paciente_id,
            :especialidad,
            :motivo,
            :fecha,
            :hora,
            :usuario_id,
            'Pendiente'
        )
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':paciente_id' => $paciente_id,
        ':especialidad' => $especialidad,
        ':motivo' => $motivo,
        ':fecha' => $fecha,
        ':hora' => $hora,
        ':usuario_id' => $usuario_id
    ]);
}

public function actualizarEstado(
    $id,
    $estado
){
    $sql = "
        UPDATE citas
        SET estado = :estado
        WHERE id = :id
    ";

    $stmt =
    $this->connection->prepare($sql);

    return $stmt->execute([
        ':estado' => $estado,
        ':id' => $id
    ]);
}

}