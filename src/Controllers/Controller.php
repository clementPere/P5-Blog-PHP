<?php

namespace App\Controllers;

class Controller
{

    public function getVue(string $vueName, array $data = null)
    {
        ob_start();
        require_once('src/Views/' . $vueName . 'View.php');
    }
}
