<?php

use App\Model\Entity\Character;
use App\Model\Entity\User;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/profil');

        if (empty($_GET['id'])) {
            $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
        else {
            $idUser = htmlentities($_GET['id']);
            CharacterManager::getCharacter($idUser);
            if (isset($_SESSION['user'])){
                if ($_GET['id'] === $_SESSION['user']['id']){
                    $id = $_GET['id'];
                    UserManager::getDataUser($id);
                }
            }
        }
    }

    public function updateProfil() {
        if ($this->getPost('changeUsername')) {
            $username = trim(htmlentities($_POST['username']));
            $id = htmlentities($_SESSION['user']['id']);
            $alert = [];
            if (empty($username)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (strlen($username) <= 2 || strlen($username) >= 255) {
                $alert[] = '<div class="alert-error">Le nom d\'utilisateur doit contenir entre 2 et 255 caractères !</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&id='.$id);
            }
            else {
                $user = new User();
                $user
                    ->setUsername($username)
                    ;
                UserManager::getUsernameExist($username);
            }
        }
        if ($this->getPost('changeMail')){
            $id = htmlentities($_SESSION['user']['id']);
            $mail = trim(htmlentities(($_POST['mail'])));
            $alert = [];

            if (empty($mail)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $alert[] = '<div class="alert-error">L\'adresse e-mail n\'est pas valide !</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&id='.$id);
            }
            else {
                $user = new User();
                $user
                    ->setMail($mail)
                    ;
                UserManager::getMailExist($mail);
            }
        }
        if ($this->getPost('changePassword')) {
            $password = ($_POST['password']);
            $passwordRepeat = trim(strip_tags($_POST['password-repeat']));
            $alert = [];

            if (empty($password)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($passwordRepeat)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (strlen($password) <= 5 || strlen($password) >= 255) {
                $alert[] = '<div class="alert-error">Le mot de passe doit contenir entre 5 et 255 caractères !</div>';
            }

            if ($password !== $passwordRepeat) {
                $alert[] = '<div class="alert-error">Les mots de passe ne correspondent pas !</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&id='.$id);
            }
            else {
                $user = new User();
                $user
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ;
            }
        }
    }

    public function character()
    {
        $this->render('user/add-character');

        if ($this->getPost('add')) {
            $name = preg_replace('#[^a-zA-Z]#', '', $_POST['username']);
            $server = preg_replace('#[^a-zA-Z]#', '', $_POST['serveur']);
            $classe = htmlentities($_POST['classe']);
            $userFk = htmlentities($_POST['user-fk']);
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

            if (strlen($server) <= 3 || strlen($server) >= 50) {
                $alert[] = '<div class="alert-error">Les nom de votre serveur doit contenir entre 2 et 50 charactères</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&a=add-character');
            }

            else {
                $character = new Character();

                $character
                    ->setUserFk($userFk)
                    ->setCharacterName(ucfirst($name))
                    ->setClasse($classe)
                    ->setServer($server)
                ;

                CharacterManager::addCharacter($character);
            }


        }
    }



}