<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login');
    }

    public function autenticar()
    {
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $usuarioModel = new Usuario();

        $usuario = $usuarioModel->loginUsuario($correo);

        if($usuario){

            if(password_verify($password, $usuario['password'])){

                session_start();

                session_start();

$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario'] = $usuario['nombre'];
$_SESSION['rol'] = $usuario['rol'];

header('Location: /dashboard');
exit;

            }else{

                $_SESSION['error'] =
                'Contraseña incorrecta';

                header('Location: /login');
                exit;
            }

        }else{

            $_SESSION['error'] = 
            'Usuario no encontrado';
            header('Location: /login');
            exit;
        }
        }

        public function logout()
    {
        session_unset();

        session_destroy();

        header('Location: /login');

    exit;
    }

    public function register()
    {
        $this->view('auth/register');
    }

    public function guardarRegistro()
    {

        header('Content-Type: application/json');

        $nombre =
        $_POST['nombre'];

        $correo =
        $_POST['correo'];

        $password =
        $_POST['password'];

        $captcha =
        $_POST['g-recaptcha-response'];

        if(
            empty($nombre) ||
            empty($correo) ||
            empty($password)
        ){

            echo json_encode([
                'success' => false,
                'message' => 'Todos los campos son obligatorios'
            ]);

            exit;
        }

        if(empty($captcha)){

            echo json_encode([
                'success' => false,
                'message' => 'Confirma el captcha'
            ]);

            exit;
        }

        $usuarioModel =
        new Usuario();

       try{

            $resultado =
            $usuarioModel->registrar(
                $nombre,
                $correo,
                $password
            );

        }catch(PDOException $e){

            echo json_encode([
                'success' => false,
                'message' => 'El correo ya está registrado'
            ]);

            exit;
        }

        if($resultado){

            echo json_encode([
                'success' => true,
                'message' => 'Usuario registrado correctamente'
            ]);

        }else{

            echo json_encode([
                'success' => false,
                'message' => 'Error al registrar usuario'
            ]);
        }

        exit;
    }

    public function forgot()
    {
        $this->view('auth/forgot');
    }

    public function enviarRecuperacion()
    {
        header('Content-Type: application/json');

        $correo = $_POST['correo'];

        if(empty($correo)){

            echo json_encode([
                'success' => false,
                'message' => 'ingresa un correo valido'
            ]);

            exit;
        }

        $token =
        bin2hex(random_bytes(32));

        $expiracion =
        date(
            'Y-m-d H:i:s',
            strtotime('+1 hour')
        );

        require_once __DIR__ . '/../models/PasswordReset.php';

        $resetModel =
        new PasswordReset();

        $resetModel->guardarToken(
            $correo,
            $token,
            $expiracion
        );

        $link =
        "http://medical_system.test/reset-password?token=$token";

        $mail =
        new PHPMailer(true);

        try{

            $mail->isSMTP();

            $mail->Host =
            'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'njara0328@gmail.com';
            $mail->Password = 'ocoi mtbi eeif pjdv';
            $mail->SMTPSecure = 'tls';  
            $mail->Port = 587;
            $mail->setFrom('njara0328@gmail.com', 'Sistema Médico');   
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body = "Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$link'>$link</a>";
            $mail->send();
            echo json_encode([
                'success' => true,
                'message' => 'Enlace de restablecimiento enviado al correo'
            ]);
        }catch(Exception $e){

            echo json_encode([
                'success' => false,
                'message' => 'Error al enviar el correo de restablecimiento'
            ]);
        }
        exit;
    }

    public function resetPassword()
    {
        $this->view('auth/reset');
    }

    public function actualizarPassword()
    {
        header('Content-Type: application/json');

        $token =
        $_POST['token'];


       $password =
    password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
);

        require_once __DIR__ . '/../models/PasswordReset.php';

        $resetModel =
        new PasswordReset();

        $reset =
        $resetModel->buscarToken($token);

        if(!$reset){

            echo json_encode([
                'success' => false,
                'message' => 'Token inválido'
            ]);

            exit;
        }
        
        if(
            strtotime($reset['expiracion'])
            < time()
        ){

            echo json_encode([
                'success' => false,
                'message' => 'El enlace expiró'
            ]);

            exit;
        }

        $usuarioModel =
        new Usuario();

        $usuarioModel->actualizarPassword(
            $reset['correo'],
            $password
        );

        $resetModel->eliminarToken($token);

        echo json_encode([
            'success' => true,
            'message' => 'Contraseña actualizada'
        ]);

    exit;
}

    
}

