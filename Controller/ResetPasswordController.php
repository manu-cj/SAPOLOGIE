<?php

use App\Model\Entity\User;

class ResetPasswordController extends AbstractController
{

    public function index()
    {
        $this->render('log/resetPassword');
        if ($this->getPost('changePassword')) {

            $newPassword = htmlentities($_POST['newPassword']);
            $passwordRepeat = trim(strip_tags($_POST['password-repeat']));
            $mail = htmlentities($_SESSION['mail']);
            $alert = [];

            if (empty($newPassword)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($passwordRepeat)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (strlen($newPassword) <= 5 || strlen($newPassword) >= 255) {
                $alert[] = '<div class="alert-error">Le mot de passe doit contenir entre 5 et 255 caractères !</div>';
            }

            if ($newPassword !== $passwordRepeat) {
                $alert[] = '<div class="alert-error">Les mots de passe ne correspondent pas !</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            } else {
                $user = new User();
                $user
                    ->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                UserManager::passwordUpdateWithMail($user, $mail);
            }
        }
    }
}