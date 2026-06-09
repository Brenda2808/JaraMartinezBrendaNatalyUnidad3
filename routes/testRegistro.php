<?php

require_once '../app/models/Usuario.php';

$usuario = new Usuario();

$resultado = $usuario->registrar(
    'Administrador',
    'admin@medical.com',
    'admin123'
);

if($resultado){
    echo "Usuario registrado correctamente";
}else{
    echo "Error al registrar";
}