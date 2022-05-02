<?php

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/profil');
    }

    public function updateProfil() {
        $this->render('user/update-profil');
    }

    public function character()
    {
        $this->render('user/add-character');

        if ($this->getPost('add')) {
            $name = preg_replace('#[^a-zA-Z]#', '', $_POST['username']);
            $server = preg_replace('#[^a-zA-Z]#', '', $_POST['serveur']);
            $classe = htmlentities($_POST['classe']);

            $name = htmlspecialchars($name);
            echo $name;
            $alert = [];
            if (strlen($name) <= 2 || strlen($name) >= 12) {
                $alert[] = '<div class="alert-error">Les nom de votre personnage doit contenir entre 2 et 12 charactères</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&a=add-character');
            }


        }
    }

    public function characterName() {
        $this->render('user/character-name');
    }


}