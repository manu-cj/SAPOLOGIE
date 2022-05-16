<?php


class Mail_validateManager
{

    public static function addMailValidate($mail)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_mail_validate (validate, mail, code) VALUES (:validate, :mail, :code)");

        $pass = (new DateTime())->format('YmdHis') . uniqid();


        $insert->bindValue(':validate', 0);
        $insert->bindValue(':mail', $mail);
        $insert->bindValue(':code', $pass);

        if ($insert->execute()) {
            AbstractController::sendMail('$mail', 'Activer votre compte', 'Bienvenue sur notre Site,
Pour activer votre compte, veuillez cliquer sur le lien ci dessous world-of-sapologie.com/?c=verification&mail='.$mail .'&code='.$pass, 'FROM: blog@world-of-sapologie.com');
        }

    }

    public static function VerifMailLink()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_mail_validate WHERE mail = :mail");
        $select->bindValue(':mail', $_GET['mail']);
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

    public static function getMailValidate()
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_mail_validate WHERE mail = :mail");

        $get->bindValue(':mail', $_SESSION['user']['mail']);

        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['mailValidate'] = $data['validate'];
            }
        }
    }

    public static function updateCode($mail) {
        $update =Connect::getPDO()->prepare("UPDATE aiu12_mail_validate SET code = :code WHERE mail = :mail");
        $update->bindValue(':mail', $mail);

        $pass = (new DateTime())->format('YmdHis') . uniqid();

        $update->bindValue(':code', $pass);
       if ($update->execute()) {
           AbstractController::sendMail('$mail', 'Activer votre compte', 'Pour activer votre compte, veuillez cliquer sur le lien ci dessous world-of-sapologie.com/?c=verification&mail='.$mail .'&code='.$pass, 'FROM: blog@world-of-sapologie.com');
       }
    }

    public static function ForgotPassword($mail, $forgotPassword) {
        $insert = Connect::getPDO()->prepare("UPDATE aiu12_mail_validate SET forgot_password = :forgot_password WHERE mail = :mail");
        $insert->bindValue('mail', $mail);
        $insert->bindValue(':forgot_password', $forgotPassword);
        if ($insert->execute()) {
            mail('$mail', 'Activer votre compte', 'Bienvenue sur notre Site,
Pour activer votre compte, veuillez cliquer sur le lien ci dessous world-of-sapologie.com/?c=verification&mail='.$mail .'&code='.$forgotPassword, 'FROM: blog@world-of-sapologie.com');
            $alert = [];
            $alert[] = '<div class="alert-succes">Un mail de vérification vous a été envoyé</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }
        }
    }

    public static function verifCodeForgotPassword($mail, $code) {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_mail_validate WHERE mail = :mail");
        $select->bindValue(':mail', $mail);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if ($code === $data['forgot_password']) {
                    $_SESSION['mail'] = $mail;
                    header('LOCATION: ?c=reset-password');
                }
                else {
                    $alert = [];
                    $alert[] = '<div class="alert-error">Ce lien n\'est pas valide</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                        header('Location: ' . $referer);
                    }
                }
            }
        }
    }
}