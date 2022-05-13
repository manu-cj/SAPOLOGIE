<?php

class BanniManager
{
    public static function addBann(int $userFk, string $mail, string $username) {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_bannis (user_fk, mail, banni, username) 
                                                    VALUES (:user_fk, :mail, :banni, :username)");

        $insert->bindValue(':user_fk', $userFk);
        $insert->bindValue(':mail', $mail);
        $insert->bindValue(':banni', 1);
        $insert->bindValue(':username', $username);

        if ($insert->execute());
        $alert = [];
        $alert[] = '<div class="alert-succes">Vous avait banni '.ucfirst($username).' !</div>';
        if (count($alert) > 0) {
            $_SESSION['alert'] = $alert;
            header('LOCATION: ?c=espace-admin');
        }
    }

    public static function getUserFkBann(int $userFk)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_bannis WHERE user_fk = :user_fk");
        $get->bindValue(':user_fk', $userFk);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['user_fk'] === $userFk) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'utilisateur est déjà banni !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                        header('Location: ' . $referer);
                    }
                }
            }
        }
    }

    public static function getMailBann(string $mail)
    {
        $get = Connect::getPDO()->prepare("SELECT * FROM aiu12_bannis WHERE mail = :mail");
        $get->bindValue(':mail', $mail);
        if ($get->execute()) {
            $datas = $get->fetchAll();
            foreach ($datas as $data) {
                if ($data['mail'] === $mail) {
                    $alert = [];
                    $alert[] = '<div class="alert-error">L\'adresse e-mail est déjà banni !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                        header('Location: ' . $referer);
                    }
                }
            }
        }
    }

    public static function getBannUser() {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_bannis ORDER BY username ASC");

        if ($select->execute()) {
            $datas = $select->fetchAll();
            ?>
                <br>
            <div class="bannList">
                <h2>Liste des utilisateurs bannis</h2>
                <?php
                foreach ($datas as $data) {
                    ?>
                    <table>
                        <tbody>
                        <tr>
                            <th>Nom</th>
                        </tr>
                        <tr>
                            <td><?=ucfirst($data['username']) ?></td>
                        </tbody>
                    </table>
                    <div class="userInteraction">
                        <form action="?c=espace-admin" method="post" style="display: inline">
                            <input type="text" name="username" value="<?= $data['username'] ?>" style="display: none">
                            <input type="text" name="id" value="<?= $data['id'] ?>" style="display: none">
                            <input type="submit" name="disBannUser" class="submit" value="Débannir <?= $data['username'] ?>" alt="Débannir"
                                   title="Débannir">
                        </form>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            if ($select->rowCount() === 0) {
                echo 'aucun utilisateur banni';
            }
        }
    }


    public static function disbannUser($id, $username) {
        $delete = Connect::getPDO()->prepare("DELETE FROM aiu12_bannis WHERE id = :id");

        $delete->bindValue(':id', $id);

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-error">Vous avez débanni '.$username .' !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }
        }
    }

    public static function getBann() {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_bannis WHERE user_fk = :user_fk");
        $select->bindValue(":user_fk", $_SESSION['user']['id']);

        if ($select->execute()) {
            $datas = $select->fetchAll();

            foreach ($datas as $data) {
                if ($data['banni'] === '1') {
                    $_SESSION['banni'] = $data['banni'];
                }
            }
        }
    }

    public static function getBannMail() {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_bannis WHERE mail = :mail");
        $select->bindValue(":mail", $_SESSION['user']['mail']);

        if ($select->execute()) {
            $datas = $select->fetchAll();

            foreach ($datas as $data) {
                if ($data['banni'] === '1') {
                    $_SESSION['banni'] = $data['banni'];
                }
            }
        }
    }
}