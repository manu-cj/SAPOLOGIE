<?php

abstract class AbstractController
{
    abstract public function index();

    //function that manages the display of my views
    public function render($page)
    {
        ob_start();
        require __DIR__ . '/../View/' . $page . '.html.php';
    }

    //function that checks that a data is indeed sent with the post method
    public function getPost($name) {
        return isset($_POST[$name]);
    }

//function that checks that Session data is present
    public static function getSession($sessionName) {
        return isset($_SESSION[$sessionName]);
    }

}
