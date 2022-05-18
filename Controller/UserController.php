<?php

use App\Model\Entity\Character;
use App\Model\Entity\User;

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/profil');
        if (isset($_SESSION['user'])) {
            Mail_validateManager::getMailValidate();
        }

        if (empty($_GET['id'])) {
            $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        } else {
            $idUser = htmlentities($_GET['id']);
            CharacterManager::getCharacter($idUser);
            if (isset($_SESSION['user'])) {
                if ($_GET['id'] === $_SESSION['user']['id']) {
                    $id = $_GET['id'];
                    UserManager::getDataUser($id);
                }
            }
        }
    }

    public function updateProfil()
    {
        if ($this->getPost('changeUsername')) {
            $username = strtolower(trim(htmlentities($_POST['username'])));
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
                header('LOCATION: ?c=profil&id=' . $id);
            } else {

                $user = new User();
                $user
                    ->setUsername($username);
                UserManager::getUsernameExist($username);
                UserManager::usernameUpdate($user, $id);
            }
        }
        if ($this->getPost('changeMail')) {
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
                header('LOCATION: ?c=profil&id=' . $id);
            } else {
                $destinataire = $_SESSION['user']['mail'];
                $sujet = 'Activer votre compte';
                $message = "<div style='text-align: center; word-break: break-word;'>
                            <h1>Bienvenue sur notre Site</h1>
                             <p>Votre adresse mail vient d'être changé, si vous n'êtes pas à l'origine 
                             de cette demande veuillez nous contacter, dans le cas contraire vous pouvez ignorer ce message</p><br>
                             <p>Assistance de du site world of sapologie.com</p>
                        </div>";

                $header = "From: blog@world-of-sapologie.com";
                $header .= 'Reply-To: blog@world-of-sapologie.com' . "\n";
                $header .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                if (mail($destinataire, $sujet, $message, $header)) {
                    echo 'Votre message a bien été envoyé ';
                } else // Non envoyé
                {
                    echo "Votre message n'a pas pu être envoyé";
                }
            }

            $user = new User();
            $user
                ->setMail($mail);
            UserManager::getMailExist($mail);
            UserManager::mailUpdate($user, $id);
        }


        if ($this->getPost('changePassword')) {
            $password = htmlentities($_POST['password']);
            $newPassword = htmlentities($_POST['newPassword']);
            $passwordRepeat = trim(strip_tags($_POST['password-repeat']));
            $id = htmlentities($_SESSION['user']['id']);
            $alert = [];

            if (empty($password)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
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
                header('LOCATION: ?c=profil&id=' . $id);
            } else {
                $destinataire = $_SESSION['user']['mail'];
                $sujet = 'Activer votre compte';
                $message = "<div style='text-align: center; word-break: break-word;'>
                            <h1>Bienvenue sur notre Site</h1>
                             <p>Votre mot de passe vient d'être changé, si vous n'êtes pas à l'origine 
                             de cette demande veuillez nous contacter, dans le cas contraire vous pouvez ignorer ce message</p><br>
                             <p>Assistance de du site world of sapologie.com</p>
                        </div>";

                $header = "From: blog@world-of-sapologie.com";
                $header .= 'Reply-To: blog@world-of-sapologie.com' . "\n";
                $header .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                if (mail($destinataire, $sujet, $message, $header)) {
                    echo 'Votre message a bien été envoyé ';
                } else // Non envoyé
                {
                    echo "Votre message n'a pas pu être envoyé";
                }
            }

            $user = new User();
            $user
                ->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
            UserManager::passwordUpdate($user, $id, $password);
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
            } else {
                $character = new Character();

                $character
                    ->setUserFk($userFk)
                    ->setCharacterName(ucfirst($name))
                    ->setClasse($classe)
                    ->setServer($server);

                CharacterManager::addCharacter($character);
            }
        }
    }

    public function deleteAccount()
    {
        if (isset($_SESSION['user'])) {
            if ($this->getPost('deleteAccount')) {
                $password = htmlentities($_POST['password']);
                $id = $_SESSION['user']['id'];
                UserManager::deleteAccount($password, $id);
            }
        } else {
            $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
            header('Location: ' . $referer);
        }
    }


}