<?php


class Mail_validateManager
{

    public static function addMailValidate($userFk)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_mail_validate (validate, user_fk, code) VALUES (:validate, :user_fk, :code)");

        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $pass = implode($pass);

        $insert->bindValue(':validate', 0);
        $insert->bindValue(':user_fk', $userFk);
        $insert->bindValue(':code', $pass);

        $insert->execute();
    }

    public static function VerifMailLink()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_mail_validate WHERE user_fk = :user_fk");
        $select->bindValue(':user_fk', $_GET['username']);
        $alert = [];
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if ($_GET['code'] === $data['code']) {
                    $update = Connect::getPDO()->prepare("UPDATE aiu12_mail_validate SET validate = :validate");
                    $update->bindValue(':validate', 1);
                    if ($update->execute()) {
                        $alert[] = '<div class="alert-succes">Votre adresse mail a été vérifié avec succés</div>';
                        if (count($alert) > 0) {
                            $_SESSION['alert'] = $alert;
                            header('Location: ?c=home');
                        }
                    } else {
                        $alert[] = '<div class="alert-error">Une erreur c\'est produite lors de la vérification</div>';
                        if (count($alert) > 0) {
                            $_SESSION['alert'] = $alert;
                            header('Location: ?c=home');
                        }
                    }
                } else {
                    $alert[] = '<div class="alert-error">Le lien a expiré ou n\'est pas valable</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('Location: ?c=home');
                    }
                }
            }
        }
    }
}