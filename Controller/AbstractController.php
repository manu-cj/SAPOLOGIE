<?php

abstract class AbstractController
{
    abstract public function index();

    public function render($page)
    {
        ob_start();
        require __DIR__ . '/../View/' . $page . '.html.php';
    }

    public function getPost($name) {
        return isset($_POST[$name]);
    }

    public static function getSession($sessionName) {
        return isset($_SESSION[$sessionName]);
    }

    public static function getRole($nameRole) {
        return $_SESSION['role']['role'] === $nameRole;
    }

    public static function sendMail($destinataire, $sujet, $message, $entete) {
        return mail($destinataire, $sujet, $message, $entete);
    }
}
