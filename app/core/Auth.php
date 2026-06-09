<?php

class Auth
{
    public static function verificar()
    {

        if(!isset($_SESSION['usuario'])){

            header('Location: /login');
            exit;
        }
    }

    public static function admin()
    {
        self::verificar();

        if($_SESSION['rol'] !== 'admin'){

            header('Location: /dashboard');
            exit;
        }
    }
}