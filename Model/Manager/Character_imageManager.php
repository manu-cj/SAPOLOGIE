<?php


use App\Model\Entity\Character_image;

class Character_imageManager
{
    public static function getImage(int $id, int $limit)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image where id = :id");

        $select->bindValue(':id', $id);
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $select2 = Connect::getPDO()->prepare("SELECT * FROM aiu12_user where id = :id");
                $select2->bindValue(':id', $data['user_fk']);
                $select2->execute();
                $datas2 = $select2->fetchAll();
                foreach ($datas2 as $data2) {
                    $files = glob('uploads/' . $data['image']);
                    foreach ($files as $filename) {
                        ?>
                        <div class="pictureCharacter">
                            <?php
                            if (isset($_SESSION['user'])) {
                                if ($_SESSION['user']['id'] === $data['user_fk'] or $_SESSION['role'] === 'admin') {
                                    ?>
                                    <div id="button">
                                        <p style="display: inline" id="update"><i class="fas fa-cog"></i></p>
                                        <input type="submit" name="deleteChoice" value="❌" title="Supprimer"
                                               style="display: inline; border: none; background-color: rgba(0, 139, 129, 0)">

                                        <form method="post" action="?c=delete" style="display: none" id="deletePicture">
                                            <input type="text" name="filename" value="<?= $data['image'] ?>"
                                                   style="display: none">
                                            <label for="deletePicture">Voulez vous supprimer cette publication ?</label>
                                            <input type="submit" name="deletePicture" value="Oui" title="Supprimer">
                                        </form>
                                        <input type="submit" name="notDeletePicture" value="Non" title="Supprimer"
                                               style="display: none; height: 30px">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <a href="?c=profil&id=<?= $data2['id'] ?> " style="width: 100%">
                                <h3><?= $data2['username'] ?></h3></a>
                            <div class="description" style="display: inline"><?= $data['description'] ?></div>
                            <?php
                            if (isset($_SESSION['user'])) {
                                if ($_SESSION['user']['id'] === $data['user_fk'] or $_SESSION['role'] === 'admin') {
                                    ?>
                                    <div class="formDerscription">
                                        <button id="previous" style="display: none; width: 8%" title="Précédent">⇦
                                        </button>
                                        <br>
                                        <form method="post"
                                              action="?c=picture&id=<?= $id ?>&a=update-picture-description"
                                              style="display: none" class="updateDescription">
                                            <select name="visibility">
                                                <optgroup label="Public">
                                                    <option name="public" value="2"> Ajouter la publication dans le fil
                                                        d'actualité
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Profil">
                                                    <option name="profil" value="3"> Ne pas ajouter la publication dans
                                                        le
                                                        fil
                                                        d'actualité
                                                    </option>
                                                </optgroup>
                                            </select>
                                            <br>
                                            <textarea name="description" cols="45"
                                                      rows="10"><?= $data['description'] ?></textarea>
                                            <input type="number" name="id" value="<?= $data['id'] ?>"
                                                   style="display: none">
                                            <input type="submit" name="updateDescription" value="▶">
                                        </form>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <br>
                            <img class="gallerieImage" src="<?= $filename ?> " alt="image du personnage"
                                 title="image du personnage" ?>

                            <?php
                            if (isset($_SESSION['user'])) {
                                if (isset($_SESSION['mailValidate'])) {
                                    if ($_SESSION['mailValidate'] === '1') {

                                        if ($_SESSION['banni'] === '0') {

                                            ?>
                                            <div id="comment">
                                                <form method="post"
                                                      action="?c=character&a=comment&id=<?= $data['character_fk'] ?>">
                                                    <input type="number" name="userFk"
                                                           value="<?= $_SESSION['user']['id'] ?>"
                                                           style="display: none">
                                                    <input type="number" name="characterImageFk"
                                                           value="<?= $data['id'] ?>"
                                                           style="display: none">
                                                    <input type="text" name="comment"
                                                           placeholder="Ecrire un commentaire"
                                                           style="display: inline">
                                                    <input type="submit" name="send" value="▶"
                                                           style=" border: none; background-color: rgba(0, 139, 129, 0); color: beige">
                                                </form>
                                            </div>
                                            <br>
                                            <?php
                                        }
                                    }
                                    if ($_SESSION['mailValidate'] === '0') {
                                        ?>
                                        <h4>Veuillez vérifier l'adresse mail de votre compte pour écrire un
                                            commentaire</h4>
                                        <?php
                                    }
                                }
                                if ($_SESSION['banni'] === '1') {
                                    ?>
                                    <h4>Vous avez été bannis par un Admin, vous n'avez pas le droit d'écrire un
                                        commentaire !</h4>
                                    <?php
                                }
                            } else {
                                ?>
                                <h4>Veuillez vous connecter pour écrire un commentaire</h4>
                                <?php
                            } ?> </div>
                        <?php
                        CommentManager::getLastComment($data['id'], $limit);
                        ?>
                        <br>
                        <?php
                    }
                }
            }
        }
    }

    public static function getCharacterPictureForHome()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE view_fk = 2 ORDER BY id DESC");


        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $select2 = Connect::getPDO()->prepare("SELECT * FROM aiu12_user where id = :id");
                $select2->bindValue(':id', $data['user_fk']);
                $select2->execute();
                $datas2 = $select2->fetchAll();
                foreach ($datas2 as $data2) {
                    $files = glob('uploads/' . $data['image']);
                    foreach ($files as $filename) {
                        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
                        $type = finfo_file($finfo, $filename) . "\n";
                        if (strpos($type, 'image/') === 0) {
                            ?>
                            <div class="pictureCharacter">
                                <a href="?c=profil&id=<?= $data2['id'] ?>" style="width: 100%">
                                    <h3><?= ucfirst($data2['username']) ?></h3></a>
                                <div class="description" style="display: inline"><?= $data['description'] ?></div>
                                <br>
                                <br>
                                <?php
                                if (isset($_SESSION['user'])) {
                                if ($_SESSION['user'] === $data['user_fk']) {
                                ?>
                                <form method="post" action="?c=delete">
                                    <input type="text" name="filename" value="<?= $data['image'] ?>"
                                           style="display: none">
                                    <input type="submit" name="deletePicture" value="❌" title="Supprimer"
                                           style=" border: none; background-color: rgba(0, 139, 129, 0)">
                                </form>
                                <?php
                                }
                                }
                                ?>
                                <a href="?c=picture&id=<?= $data['id'] ?>"><img class="gallerieImage"
                                                                                src="<?= $filename ?> "
                                                                                alt="image du personnage"
                                                                                title="image du personnage">
                                </a>
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        if (isset($_SESSION['mailValidate'])) {
                                            if ($_SESSION['mailValidate'] === '1') {

                                                if ($_SESSION['banni'] === '0') {

                                                    ?>
                                                    <div id="comment">
                                                        <form method="post"
                                                              action="?c=character&a=comment&id=<?= $data['character_fk'] ?>">
                                                            <input type="number" name="userFk"
                                                                   value="<?= $_SESSION['user']['id'] ?>"
                                                                   style="display: none">
                                                            <input type="number" name="characterImageFk"
                                                                   value="<?= $data['id'] ?>"
                                                                   style="display: none">
                                                            <input type="text" name="comment"
                                                                   placeholder="Ecrire un commentaire"
                                                                   style="display: inline">
                                                            <input type="submit" name="send" value="▶"
                                                                   style=" border: none; background-color: rgba(0, 139, 129, 0); color: beige">
                                                        </form>
                                                    </div>
                                                    <br>
                                                    <?php
                                                }
                                            }
                                            if ($_SESSION['mailValidate'] === '0') {
                                                ?>
                                                <h4>Veuillez vérifier l'adresse mail de votre compte pour écrire un
                                                    commentaire</h4>
                                                <?php
                                            }
                                        }
                                        if ($_SESSION['banni'] === '1') {
                                            ?>
                                            <h4>Vous avez été bannis par un Admin, vous n'avez pas le droit d'écrire un
                                                commentaire !</h4>
                                            <?php
                                        }
                                    } else {
                                    ?>
                                    <h4>Veuillez vous connecter pour écrire un commentaire</h4>
                                <?php
                                } ?></div>
                            <?php
                            CommentManager::getLastComment($data['id'], 1);
                            ?>
                            <br>
                            <?php
                        } else {
                            self::deletePicture($data['image']);
                            unlink($filename);

                        }
                        finfo_close($finfo);

                    }
                }
            }
        }
    }

    public static function getCharacterPicture(int $characterFK, $limit)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE character_fk = :character_fk order by id DESC ");

        $select->bindValue(':character_fk', $characterFK);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $select2 = Connect::getPDO()->prepare("SELECT * FROM aiu12_user where id = :id ");
                $select2->bindValue(':id', $data['user_fk']);
                $select2->execute();
                $datas2 = $select2->fetchAll();
                foreach ($datas2 as $data2) {

                    $files = glob('uploads/' . $data['image']);
                    foreach ($files as $filename) {
                        $finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
                        $type = finfo_file($finfo, $filename) . "\n";
                        if (strpos($type, 'image/') === 0) {
                            ?>
                            <div class="pictureCharacter">
                                <h3 style="display: none"><?= ucfirst($data2['username']) ?></h3>
                                <div class="description" style="display: inline"><?= $data['description'] ?></div>
                                <br>
                                <br>
                                <?php
                                if (isset($_SESSION['user'])) {
                                    if ($_SESSION['user'] === $data['user_fk']) {
                                        ?>
                                        <form method="post" action="?c=delete">
                                            <input type="text" name="filename" value="<?= $data['image'] ?>"
                                                   style="display: none">
                                            <input type="submit" name="deletePicture" value="❌" title="Supprimer">
                                        </form>
                                        <?php
                                    }
                                }

                                ?>
                                <a href="?c=picture&id=<?= $data['id'] ?>"><img class="gallerieImage"
                                                                                src="<?= $filename ?> "
                                                                                alt="image du personnage"
                                                                                title="image du personnage"
                                    ></a>
                                <?php

                                ?>

                                <?php
                                if (isset($_SESSION['user'])) {
                                    if (isset($_SESSION['mailValidate'])) {
                                        if ($_SESSION['mailValidate'] === '1') {

                                            if ($_SESSION['banni'] === '0') {

                                                ?>
                                                <div id="comment">
                                                    <form method="post"
                                                          action="?c=character&a=comment&id=<?= $data['character_fk'] ?>">
                                                        <input type="number" name="userFk"
                                                               value="<?= $_SESSION['user']['id'] ?>"
                                                               style="display: none">
                                                        <input type="number" name="characterImageFk"
                                                               value="<?= $data['id'] ?>"
                                                               style="display: none">
                                                        <input type="text" name="comment"
                                                               placeholder="Ecrire un commentaire"
                                                               style="display: inline">
                                                        <input type="submit" name="send" value="▶"
                                                               style=" border: none; background-color: rgba(0, 139, 129, 0); color: beige">
                                                    </form>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                        }
                                        if ($_SESSION['mailValidate'] === '0') {
                                            ?>
                                            <h4>Veuillez vérifier l'adresse mail de votre compte pour écrire un
                                                commentaire</h4>
                                            <?php
                                        }
                                    }
                                    if ($_SESSION['banni'] === '1') {
                                        ?>
                                        <h4>Vous avez été bannis par un Admin, vous n'avez pas le droit d'écrire un
                                            commentaire !</h4>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h4>Veuillez vous connecter pour écrire un commentaire</h4>
                                    <?php
                                } ?> </div>
                            <?php
                            CommentManager::getLastComment($data['id'], $limit);
                            ?>
                            <br>
                            <?php
                        } else {
                            self::deletePicture($data['image']);
                            unlink($filename);

                        }
                        finfo_close($finfo);
                    }
                }
            }


        }
    }

    public static function deletePicture($picture)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE image = :image");
        $select->bindValue(':image', $picture);
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if (isset($_SESSION['user'])) {
                    if ($data['user_fk'] === $_SESSION['user']['id'] or $_SESSION['role'] === 'admin') {
                        $delete = Connect::getPDO()->prepare("Delete  From aiu12_character_image WHERE image = :image");
                        $delete->bindValue(':image', $picture);

                        if ($delete->execute()) {
                            unlink('uploads/' . $picture);
                            $alert = [];
                            $alert[] = '<div class="alert-succes">Le photo a été supprimé !</div>';
                            if (count($alert) > 0) {
                                $_SESSION['alert'] = $alert;
                                header('LOCATION: ?c=home');
                            }
                        }
                    } else {
                        $alert = [];
                        $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
                        if (count($alert) > 0) {
                            $_SESSION['alert'] = $alert;
                            header('Location: ' . $referer);
                        }
                    }

                } else {
                    $alert = [];
                    $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('Location: ' . $referer);
                    }
                }
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('Location: ' . $referer);
            }
        }

    }

    public
    static function updatePictureDescription(Character_image $description, int $id)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE id = :id");
        $select->bindValue(':id', $id);
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if (isset($_SESSION['user'])) {
                    if ($data['user_fk'] === $_SESSION['user']['id'] or $_SESSION['role'] === 'admin') {
                        $update = Connect::getPDO()->prepare("UPDATE aiu12_character_image SET description = :description, view_fk = :view_fk WHERE id = :id");
                        $update->bindValue(':description', $description->getDescription());
                        $update->bindValue(':view_fk', $description->getViewFk());
                        $update->bindValue(':id', $id);

                        if ($update->execute()) {
                            $alert = [];
                            $alert[] = '<div class="alert-succes">Description mise à jour !</div>';
                            if (count($alert) > 0) {
                                $_SESSION['alert'] = $alert;
                                header('LOCATION: ?c=picture&id=' . $id);
                            }
                        }
                    } else {
                        $alert = [];
                        $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
                        if (count($alert) > 0) {
                            $_SESSION['alert'] = $alert;
                            header('Location: ' . $referer);
                        }
                    }
                } else {
                    $alert = [];
                    $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('Location: ' . $referer);
                    }
                }
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('Location: ' . $referer);
            }
        }
    }
}