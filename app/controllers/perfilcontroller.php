<?php

require_once __DIR__ . '/../core/Controller.php';

require_once __DIR__ . '/../core/Auth.php';

require_once __DIR__ . '/../models/Paciente.php';

require_once __DIR__ . '/../models/Usuario.php';

class PerfilController extends Controller
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

        $pacienteModel =
        new Paciente();

        $perfil =
        $pacienteModel->obtenerPerfil(
            $datosUsuario['id']
        );

        $view =
        __DIR__ .
        '/../views/perfil/index.php';

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

    $nombre =
    $datosUsuario['nombre'];

    $edad =
    $_POST['edad'];

    $peso =
    $_POST['peso'];

    $estatura =
    $_POST['estatura'];

    $historial =
    $_POST['historial'];

    $pacienteModel =
    new Paciente();

    $resultado =
    $pacienteModel->crearPerfil(
        $nombre,
        $edad,
        $peso,
        $estatura,
        $historial,
        $datosUsuario['id']
    );

    if($resultado){

        $_SESSION['success'] =
        'Perfil creado correctamente';

    }else{

        $_SESSION['error'] =
        'Error al crear perfil';
    }

    header('Location: /mi-perfil');

    exit;
}


public function actualizar()
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

    $edad =
    $_POST['edad'];

    $telefono =
    $_POST['telefono'];

    $correo =
    $_POST['correo'];

    $peso =
    $_POST['peso'];

    $estatura =
    $_POST['estatura'];

    $historial =
    $_POST['historial'];

    if(!preg_match('/^[0-9]{10}$/', $telefono)){

        $_SESSION['error'] =
        'El teléfono debe tener 10 dígitos';

        header('Location: /mi-perfil');

        exit;
    }

    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){

        $_SESSION['error'] =
        'Correo inválido';

        header('Location: /mi-perfil');

        exit;
    }

    $pacienteModel =
    new Paciente();

    $resultado =
    $pacienteModel->actualizarPerfil(
        $datosUsuario['id'],
        $edad,
        $telefono,
        $correo,
        $peso,
        $estatura,
        $historial
    );

    if($resultado){

        $_SESSION['success'] =
        'Perfil actualizado correctamente';

    }else{

        $_SESSION['error'] =
        'Error al actualizar perfil';
    }

    header('Location: /mi-perfil');

    exit;
}

}