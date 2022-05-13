<?php

class AdminController extends AbstractController
{

    public function index()
    {
        $this->render('private/admin');
        UserManager::getAllUser();
        BanniManager::getBannUser();
        if ($this->getPost('bannUser')) {
            $username = htmlentities($_POST['username']);
            $mail = htmlentities($_POST['mail']);
            $userFk = strip_tags($_POST['userFk']);

            $alert = [];
            if (empty($username)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($mail)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($userFk)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }

            else {
                BanniManager::getUserFkBann($userFk);
                BanniManager::getMailBann($mail);
                BanniManager::addBann($userFk, $mail, $username);
            }
        }
        if ($this->getPost('disBannUser')) {
            $username = htmlentities($_POST['username']);
            $id = strip_tags($_POST['id']);

            $alert = [];
            if (empty($username)) {
                $alert[] = '<div class="alert-error">Un des champs est vide </div>';
            }
            if (empty($id)) {
                $alert[] = '<div class="alert-error">Un des champs est vide </div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }
            else {
                    BanniManager::disbannUser($id, $username);
            }
        }
    }


}
