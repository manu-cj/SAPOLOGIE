<?php


class Mail_validateManager
{

    public static function addMailValidate($mail)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_user (validate, mail, validation_mail) VALUES (:validate, :mail, :verification_mail)");

        $pass = (new DateTime())->format('YmdHis') . uniqid();


        $insert->bindValue(':validate', 0);
        $insert->bindValue(':mail', $mail);
        $insert->bindValue(':verification_mail', $pass);

        if ($insert->execute()) {
            $destinataire = $mail;
            $sujet = 'Activer votre compte';
            $message = "<div style='text-align: center; word-break: break-word;'>
                            <h1>Bienvenue sur notre Site</h1>
                            <p>Pour activer votre compte, veuillez cliquer sur le bouton ci dessous</p><br>

                            <a href='world-of-sapologie.com/?c=verification&mail=$mail&code=$pass' style='padding: 15px; background-color: #00c0c0; color: white; font-size: 0.8em; border-radius: 10px; text-decoration-line: none'>Activer mon compte</a>
                            <br>
                            <br>
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

    }

    public static function VerifMailLink()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE mail = :mail");
        $select->bindValue(':mail', $_GET['mail']);
        $alert = [];
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if ($_GET['code'] === $data['validation_mail']) {
                    $update = Connect::getPDO()->prepare("UPDATE aiu12_user SET validate = :validate WHERE mail = :mail");
                    $update->bindValue('mail', $_GET['mail']);
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
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE mail = :mail");

        $get->bindValue(':mail', $_SESSION['user']['mail']);

        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                $_SESSION['mailValidate'] = $data['validate'];
            }
        }
    }

    public static function updateCode($mail)
    {
        $update = Connect::getPDO()->prepare("UPDATE aiu12_user SET validation_mail = :validation_mail WHERE mail = :mail");
        $update->bindValue(':mail', $mail);

        $pass = (new DateTime())->format('YmdHis') . uniqid();

        $update->bindValue(':validation_mail', $pass);
        if ($update->execute()) {
            $destinataire = $mail;
            $sujet = 'Activer votre compte';
            $message = "<div style='text-align: center; word-break: break-word;'>
                            <h1>Bienvenue sur notre Site</h1>
                             <p>Pour activer votre compte, veuillez cliquer sur le bouton ci dessous</p><br>

                              <a href='world-of-sapologie.com/?c=verification&mail=$mail&code=$pass' style='padding: 15px; background-color: #00c0c0; color: white; font-size: 0.9em; border-radius: 10px; text-decoration-line: none'>Activer mon compte</a>
                              <br>
                              <br>
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
    }

    public static function ForgotPassword($mail, $forgotPassword)
    {
        $insert = Connect::getPDO()->prepare("UPDATE aiu12_user SET forgot_password_code = :forgot_password_code WHERE mail = :mail");
        $insert->bindValue('mail', $mail);
        $insert->bindValue(':forgot_password_code', $forgotPassword);
        if ($insert->execute()) {
            $destinataire = $mail;
            $sujet = 'réinisialiser le mot de passe';

            $message = "<div style='text-align: center; word-break: break-word;'>
                            <h1>Bienvenue sur notre Site</h1>
                            <p>Pour réinitialiser votre mot de passe, veuillez cliquer sur le bouton ci dessous</p><br>

                            <a href='world-of-sapologie.com/?c=forgot-password&mail=$mail&code=$forgotPassword' style='padding: 15px; background-color: #00c0c0; color: white; font-size: 0.9em; border-radius: 10px; text-decoration-line: none'>Réinitialiser le mot de passe</a>
                            <br>
                            <br>
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
            $alert = [];
            $alert[] = '<div class="alert-succes">Un mail de vérification vous a été envoyé</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }
        }
    }

    public static function verifCodeForgotPassword($mail, $code)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE mail = :mail");
        $select->bindValue(':mail', $mail);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if ($code === $data['forgot_password_code']) {
                    $_SESSION['mail'] = $mail;
                    header('LOCATION: ?c=reset-password');
                } else {
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