<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Usuario.php';

class DashboardController extends Controller
{
    public function index()
    {
        Auth::verificar();

        $pacienteModel = new Paciente();

        $usuarioModel = new Usuario();

        $totalPacientes =
        $pacienteModel->totalPacientes();

        $totalUsuarios =
        $usuarioModel->totalUsuarios();

        $view =
        __DIR__ . '/../views/dashboard/index.php';

        require_once
        __DIR__ . '/../views/layouts/app.php';
    }
}