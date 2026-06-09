<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once 'app/core/Router.php';
require_once __DIR__ . '/app/controllers/CitaController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/DashboardController.php';
require_once 'app/controllers/PacienteController.php';
require_once __DIR__ . '/app/controllers/UsuarioController.php';
require_once __DIR__ . '/app/controllers/PerfilController.php';
require_once __DIR__ . '/app/controllers/MisCitasController.php';

$router = new Router();

$router->get('/', function () {
    return "Bienvenido al sistema médico";
});

$router->get('/mi-perfil', function(){

    $controller =
    new PerfilController();

    $controller->index();

});

$router->get('/login', function () {

    $controller = new AuthController();

    return $controller->login();
});

$router->post('/login', function () {

    $controller = new AuthController();

    return $controller->autenticar();
});

$router->get('/logout', function() {

    $controller = new AuthController();

    $controller->logout();

});

$router->get('/dashboard', function () {

    $controller = new DashboardController();

    return $controller->index();
});

$router->get('/pacientes', function () {

    $controller = new PacienteController();

    return $controller->index();
});

$router->post('/pacientes/guardar', function () {

    $controller = new PacienteController();

    return $controller->guardar();
});

$router->get('/pacientes/eliminar', function () {

    $controller = new PacienteController();

    return $controller->eliminar();
});

$router->get('/pacientes/editar', function () {

    $controller = new PacienteController();

    return $controller->editar();
});

$router->post('/pacientes/actualizar', function () {

    $controller = new PacienteController();

    return $controller->actualizar();
});

$router->get('/citas', function(){

    $controller = new CitaController();

    $controller->index();
});

$router->post('/citas/guardar', function(){

    $controller = new CitaController();

    $controller->guardar();
});

$router->get('/register', function(){

    $controller = new AuthController();

    $controller->register();

});

$router->post('/register', function(){

    $controller = new AuthController();

    $controller->guardarRegistro();

});


$router->get('/usuarios', function(){

    $controller =
    new UsuarioController();

    $controller->index();

});


$router->get('/usuarios/editar', function(){

    $controller =
    new UsuarioController();

    $controller->editar();

});

$router->post('/usuarios/actualizar', function(){

    $controller =
    new UsuarioController();

    $controller->actualizar();

});

$router->post('/mi-perfil/guardar', function(){

    $controller =
    new PerfilController();

    $controller->guardar();

});

$router->post('/mi-perfil/actualizar', function(){

    $controller =
    new PerfilController();

    $controller->actualizar();

});

$router->get('/mis-citas', function(){

    $controller =
    new MisCitasController();

    $controller->index();

});

$router->post('/mis-citas/guardar', function(){

    $controller =
    new MisCitasController();

    $controller->guardar();

});

$router->get('/citas/aprobar', function(){

    $controller =
    new CitaController();

    $controller->aprobar();

});

$router->get('/citas/rechazar', function(){

    $controller =
    new CitaController();

    $controller->rechazar();

});

$router->get('/forgot-password', function(){

    $controller =
    new AuthController();

    $controller->forgot();

});

$router->post('/forgot-password', function(){

    $controller =
    new AuthController();

    $controller->enviarRecuperacion();

});

$router->get('/reset-password', function(){

    $controller =
    new AuthController();

    $controller->resetPassword();

});

$router->post('/reset-password', function(){

    $controller =
    new AuthController();

    $controller->actualizarPassword();

});

$router->dispatch();