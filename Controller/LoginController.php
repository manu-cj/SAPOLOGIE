<?php

class LoginController extends AbstractController
{

    public function index()
    {
        $this->render('log/login');
        if ($this->getPost('send')) {

            $mail = trim(strip_tags(($_POST['mail'])));
            $password = htmlentities($_POST['password']);
            $alert = [];
            if (empty($mail)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($password)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=login');
            }
            else {
                UserManager::ConnectUser($mail, $password);
            }
        }

    }
}