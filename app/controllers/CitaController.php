<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';

require_once __DIR__ . '/../models/Cita.php';
require_once __DIR__ . '/../models/Paciente.php';

class CitaController extends Controller
{
    public function index()
    {
        Auth::verificar();

        $citaModel = new Cita();

        $pacienteModel = new Paciente();

        $citas = $citaModel->obtenerCitas();

        $pacientes = $pacienteModel->obtenerPacientes();

        $view = __DIR__ . '/../views/citas/index.php';

        require_once __DIR__ . '/../views/layouts/app.php';
    }

    public function guardar()
    {
        Auth::verificar();

        header('Content-Type: application/json');

        $paciente_id = $_POST['paciente_id'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $motivo = $_POST['motivo'];

        if(
            empty($paciente_id) ||
            empty($fecha) ||
            empty($hora)
        ){

            echo json_encode([
                'success' => false,
                'message' => 'Campos obligatorios incompletos'
            ]);

            exit;
        }

        $citaModel = new Cita();

        $resultado = $citaModel->guardarCita(
            $paciente_id,
            $fecha,
            $hora,
            $motivo
        );

        if($resultado){

            echo json_encode([
                'success' => true,
                'message' => 'Cita registrada correctamente',
                'cita' => [
                'paciente_id' => $paciente_id,
                'fecha' => $fecha,
                'hora' => $hora,
                'motivo' => $motivo,
                'estado' => 'Pendiente'
            ]
        ]);

        }else{

            echo json_encode([
                'success' => false,
                'message' => 'Error al registrar cita'
            ]);
        }

        exit;
    }

    public function aprobar()
{
    Auth::verificar();

    $id = $_GET['id'];

    $citaModel = new Cita();

    $citaModel->actualizarEstado(
        $id,
        'Aprobada'
    );

    $_SESSION['success'] =
    'Cita aprobada correctamente';

    header('Location: /citas');
    exit;
}

public function rechazar()
{
    Auth::verificar();

    $id = $_GET['id'];

    $citaModel = new Cita();

    $citaModel->actualizarEstado(
        $id,
        'Rechazada'
    );

    $_SESSION['success'] =
    'Cita rechazada correctamente';

    header('Location: /citas');
    exit;
}


}