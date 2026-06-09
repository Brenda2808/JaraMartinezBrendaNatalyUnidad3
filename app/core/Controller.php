<?php

class Controller
{
    public function view($path)
    {
        require_once "app/views/$path.php";
    }
}