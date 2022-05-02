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
            echo $server;
            $alert = [];

            if (empty($name)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($server)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($classe)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }

            if (strlen($name) <= 2 || strlen($name) >= 12) {
                $alert[] = '<div class="alert-error">Les nom de votre personnage doit contenir entre 2 et 12 charactères</div>';
            }
            if ($classe === 'default') {
                $alert[] = '<div class="alert-error">Veuillez sélectionner la classe de votre personnage</div>';
            }
            echo $classe;
            if (strlen($server) <= 3 || strlen($server) >= 50) {
                $alert[] = '<div class="alert-error">Les nom de votre serveur doit contenir entre 2 et 50 charactères</div>';
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