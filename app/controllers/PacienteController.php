<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Paciente.php';

class PacienteController extends Controller
{
    public function index()
    {
        Auth::verificar();

        $pacienteModel = new Paciente();

        $pacientes = $pacienteModel->obtenerPacientes();

        $view = __DIR__ . '/../views/pacientes/index.php';

        require_once __DIR__ . '/../views/layouts/app.php';
    }
    public function guardar()
{
    Auth::verificar();

    header('Content-Type: application/json');

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    if(
        empty($nombre) ||
        empty($edad)
    ){

        echo json_encode([
            'success' => false,
            'message' => 'Nombre y edad obligatorios'
        ]);

        exit;
    }

    $pacienteModel = new Paciente();

    $resultado = $pacienteModel->guardarPaciente(
        $nombre,
        $edad,
        $telefono,
        $correo
    );

    if($resultado){

        echo json_encode([
            'success' => true,
            'message' => 'Paciente guardado correctamente',
            'paciente' => [
                'nombre' => $nombre,
                'edad' => $edad,
                'telefono' => $telefono,
                'correo' => $correo
            ]
        ]);

    }else{

        echo json_encode([
            'success' => false,
            'message' => 'Error al guardar'
        ]);
    }

    exit;
}

    public function eliminar()
{
    Auth::admin();

    $id = $_GET['id'];

    $pacienteModel = new Paciente();

    $resultado = $pacienteModel->eliminarPaciente($id);

    if($resultado){

        header('Location: /pacientes');
        exit;

    }else{

        echo "Error al eliminar";
    }
    }
    public function editar()
    {
    Auth::admin();

    $id = $_GET['id'];

    $pacienteModel = new Paciente();

    $paciente = $pacienteModel->obtenerPaciente($id);

    $view = __DIR__ . '/../views/pacientes/editar.php';

    require_once __DIR__ . '/../views/layouts/app.php';
    }
    public function actualizar()
    {
    Auth::admin();

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $pacienteModel = new Paciente();

    $resultado = $pacienteModel->actualizarPaciente(
        $id,
        $nombre,
        $edad,
        $telefono,
        $correo
    );

    if($resultado){
        $_SESSION['success'] = 'Paciente actualizado correctamente';
        header('Location: /pacientes');
        exit;

    }else{

        echo "Error al actualizar";
    }
    }
}