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
                } else {
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

    public static function getDataUser(int $id)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_user WHERE id = :id");
        $get->bindValue(':id', $id);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            ?>
            <h1 class="showUserData">Information du compte 🔽</h1>
            <h1 class="hideUserData" style="display: none">Information du compte 🔼</h1>
                <?php
                foreach ($datas as $data) {
                    ?>
                        <div class="userData" style="display: none">
                    <h3 class="usernameData" style="display: inline">Nom d'utilisateur :<?= $data['username'] ?></h3>
                            <button class="changeUsernameButton">📝</button>
                            <br>
                            <form action="?c=profil&a=update-profil" method="post" id="formUsername" style="display: none">
                                <table>
                                    <tr>
                                        <td><label for="username">Nom d'utilisateur :</label></td>
                                        <td><input type="text" name="username" id="username" value="<?=$data['username']?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" name="changeUsername" value="Confirmer" required></td>
                                    </tr>
                                </table>
                            </form>
                    <h3 class="mailData" style="display: inline">Adresse e-mail :<?= $data['mail'] ?></h3>
                            <button class="changeMailButton">📝</button>
                            <br>
                            <form action="?c=profil&a=update-profil" method="post" id="formMail" style="display: none">
                                <table>
                                    <tr>
                                        <td><label for="mail">Adresse e-mail :</label></td>
                                        <td><input type="email" name="mail" id="mail" value="<?=$data['mail']?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" name="changeMail" value="Confirmer" required></td>
                                    </tr>
                                </table>
                            </form>
                    <h3 class="passwordData" style="display: inline">Mot de passe : *********</h3>
                            <button class="changePasswordButton">📝</button>
                            <form action="?c=profil&a=update-profil" method="post" id="formPassword" style="display: none">
                                <table>
                                    <tr>
                                        <td><label for="password">Mot de passe :</label></td>
                                        <td><input type="password" name="password" id="password" value="<?=$data['mail']?>" required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="password-repeat">Password-repeat :</label></td>
                                        <td><input type="password" name="password-repeat" id="password-repeat" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" name="changePassword" value="Confirmer" required></td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                    <?php
                }
                ?>
            <?php
        }
    }
}