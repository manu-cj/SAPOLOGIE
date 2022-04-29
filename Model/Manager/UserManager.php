<?php


use App\Model\Entity\User;

class UserManager extends User
{


    public static function addUser(User $user) {

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
        }
        else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\est produite lors de l\'inscription !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=register');
            }
        }
    }
}