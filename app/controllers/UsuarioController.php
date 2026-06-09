<?php

require_once __DIR__ . '/../core/Controller.php';

require_once __DIR__ . '/../core/Auth.php';

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller
{
    public function index()
    {
        Auth::verificar();

        if($_SESSION['rol'] !== 'admin'){

            header('Location: /dashboard');

            exit;
        }

        $usuarioModel = new Usuario();

        $usuarios =
        $usuarioModel->obtenerUsuarios();

        $view =
        __DIR__ . '/../views/usuarios/index.php';

        require_once
        __DIR__ . '/../views/layouts/app.php';
    }

public function editar()
{
    Auth::verificar();

    if($_SESSION['rol'] !== 'admin'){

        header('Location: /dashboard');

        exit;
    }

    $id = $_GET['id'];

    $usuarioModel = new Usuario();

    $usuario =
    $usuarioModel->obtenerUsuario($id);

    $view =
    __DIR__ . '/../views/usuarios/editar.php';

    require_once
    __DIR__ . '/../views/layouts/app.php';
}

public function actualizar()
{
    Auth::verificar();

    if($_SESSION['rol'] !== 'admin'){

        header('Location: /dashboard');

        exit;
    }

    $id = $_POST['id'];

    $nombre = $_POST['nombre'];

    $correo = $_POST['correo'];

    $rol = $_POST['rol'];

    $usuarioModel = new Usuario();

    $resultado =
    $usuarioModel->actualizarUsuario(
        $id,
        $nombre,
        $correo,
        $rol
    );

    if($resultado){

        $_SESSION['success'] =
        'Usuario actualizado correctamente';

    }else{

        $_SESSION['error'] =
        'Error al actualizar usuario';
    }

    header('Location: /usuarios');

    exit;
}

}