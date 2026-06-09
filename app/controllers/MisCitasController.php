<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../core/Auth.php';

require_once __DIR__ . '/../models/Cita.php';

require_once __DIR__ . '/../models/Usuario.php';

class MisCitasController extends Controller
{
    public function index()
    {
        Auth::verificar();

        $usuario =
        $_SESSION['usuario'];

        $usuarioModel =
        new Usuario();

        $datosUsuario =
        $usuarioModel->obtenerPorNombre(
            $usuario
        );

        $citaModel =
        new Cita();

        $citas =
        $citaModel->obtenerMisCitas(
            $datosUsuario['id']
        );

        $view =
        __DIR__ .
        '/../views/mis-citas/index.php';

        require_once
        __DIR__ .
        '/../views/layouts/app.php';
    }

public function guardar()
{
    Auth::verificar();

    $usuario =
    $_SESSION['usuario'];

    $usuarioModel =
    new Usuario();

    $datosUsuario =
    $usuarioModel->obtenerPorNombre(
        $usuario
    );

    $especialidad =
    $_POST['especialidad'];

    $motivo =
    $_POST['motivo'];

    $fecha =
    $_POST['fecha'];

    $hora =
    $_POST['hora'];

    $pacienteModel =
    new Paciente();

    $perfil =
    $pacienteModel->obtenerPerfil(
        $datosUsuario['id']
    );

    $paciente_id =
    $perfil['id'];

    $citaModel =
    new Cita();

    $resultado =
    $citaModel->crearCita(
        $paciente_id,
        $especialidad,
        $motivo,
        $fecha,
        $hora,
        $datosUsuario['id']
    );

    if($resultado){

        $_SESSION['success'] =
        'Cita registrada correctamente';

    }else{

        $_SESSION['error'] =
        'Error al registrar cita';
    }

    header('Location: /mis-citas');

    exit;
}

}