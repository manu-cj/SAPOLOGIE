<?php


use App\Model\Entity\User;

class UserManager extends User
{


    public static function addUser(User $user)
    {

        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_user (username, mail, password, date) 
                                                    VALUES (:username, :mail, :password, :date)");

        date_default_timezone_set('Europe/Brussels');
        $date = date('y-m-d H:i:s');

        $insert->bindValue(':username', $user->getUsername());
        $insert->bindValue(':mail', $user->getMail());
        $insert->bindValue(':password', $user->getPassword());
        $insert->bindValue(':date', $date);
        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Inscription réussi !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\est produite lors de l\'inscription !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=register');
            }
        }
    }

    public static function ConnectUser(string $mail, string $password)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE mail = :mail");
        $select->bindValue(':mail', $mail);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            $alert = [];
            foreach ($datas as $data) {
                if (password_verify($password, $data['password'])) {
                    $_SESSION['user'] = $data;
                    $alert[] = '<div class="alert-error">Vous êtes connecté, Bonjour ' . $data['username'] . ' !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=home');
                    }
                }
                else {
                    $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=login');
                    }
                }
            }
        } else {
            $alert[] = '<div class="alert-error">Adresse e-mail ou mot de passe invalide !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=login');
            }
        }
    }

    public static function getMailExist(string $mail)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE mail = :mail");
        $get->bindValue(':mail', $mail);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'adresse e-mail est déjà utilisé !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=register');
                    }
                }
            }
        }

    }

    public static function getUsernameExist(string $username)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE username = :username");
        $get->bindValue(':username', $username);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['username'] === $username) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">Le nom d\'utilisateur est déjà utilisé !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=register');
                    }
                }
            }
        }
    }
}