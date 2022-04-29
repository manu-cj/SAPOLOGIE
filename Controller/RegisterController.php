<?php

use App\Model\Entity\User;

class RegisterController extends AbstractController
{
    public function index()
    {
        $this->render('register/register');
        if ($this->getPost('send')) {

            $username = trim(htmlentities($_POST['username']));
            $mail = trim(htmlentities(($_POST['mail'])));
            $password = ($_POST['password']);
            $passwordRepeat = trim(strip_tags($_POST['password-repeat']));
            $alert = [];
            if (empty($username)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($mail)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($password)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($passwordRepeat)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (strlen($username) <= 2 || strlen($username) >= 255) {
                $alert[] = '<div class="alert-error">Le nom d\'utilisateur doit contenir entre 2 et 255 caractères !</div>';
            }
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $alert[] = '<div class="alert-error">L\'adresse e-mail n\'est pas valide !</div>';
            }

            if (strlen($password) <= 5 || strlen($password) >= 255) {
                $alert[] = '<div class="alert-error">Le mot de passe doit contenir entre 5 et 255 caractères !</div>';
            }

            if ($password !== $passwordRepeat) {
                $alert[] = '<div class="alert-error">Les mots de passe ne correspondent pas !</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=register');
            }
            else {
                $user = new User();
                $user
                    ->setUsername($username)
                    ->setMail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                    ;
                UserManager::getMailExist($mail);
                UserManager::getUsernameExist($username);
                UserManager::addUser($user);
            }
        }
    }
}