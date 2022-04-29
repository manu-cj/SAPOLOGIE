<?php

class LoginController extends AbstractController
{

    public function index()
    {
        $this->render('log/login');
        if ($this->getPost('send')) {
            $mail = trim(strip_tags(($_POST['mail'])));
            $password = ($_POST['password']);
            UserManager::ConnectUser($mail, $password);
        }
    }
}