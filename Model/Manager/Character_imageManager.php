<?php


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
                            <form method="post" action="?c=delete">
                                <input type="text" name="filename" value="<?=$data['image']?>" style="display: none">
                                <input type="submit" name="deletePicture" value="❌" title="Supprimer">
                            </form>
                            <div><h3><?= $data2['username'] ?></h3></div>
                            <div class="description"><?= $data['description'] ?></div>
                            <br>
                            <img class="gallerieImage" src="<?= $filename ?> " alt="<?= $data['image'] ?>"
                                 style="max-width: 1200px; max-height: 900px">
                            <?php
                            if (isset($_SESSION['user'])) {
                                ?>
                                <form method="post" action="?c=character&a=comment&id=<?= $data['character_fk'] ?>">
                                    <input type="number" name="userFk" value="<?= $_SESSION['user']['id'] ?>"
                                           style="display: none">
                                    <input type="number" name="characterImageFk" value="<?= $data['id'] ?>"
                                           style="display: none">
                                    <input type="text" name="comment" placeholder="Ecrire un commentaire"
                                           style="display: inline">
                                    <input type="submit" name="send" value="▶">
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <br>
                        <?php
                        CommentManager::getLastComment($data['id'], $limit);
                    }
                }
            }
        }
    }

    public static function getCharacterPictureForHome()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE view_fk = 2");


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
                            <form method="post" action="?c=delete">
                                <input type="text" name="filename" value="<?=$data['image']?>" style="display: none">
                                <input type="submit" name="deletePicture" value="❌" title="Supprimer">
                            </form>
                            <div><h3><?= $data2['username'] ?></h3></div>
                            <div class="description"><?= $data['description'] ?></div>
                            <br>
                            <a href="?c=picture&id=<?= $data['id'] ?>"><img class="gallerieImage"
                                                                            src="<?= $filename ?> "
                                                                            alt="<?= $data['image'] ?>"
                                                                            style="max-width: 400px; max-height: 500px"></a>
                            <?php
                            if (isset($_SESSION['user'])) {
                                ?>
                                <form method="post"
                                      action="?c=character&a=comment&id=<?= $data['character_fk'] ?>">
                                    <input type="number" name="userFk"
                                           value="<?= $_SESSION['user']['id'] ?>" style="display: none">
                                    <input type="number" name="characterImageFk" value="<?= $data['id'] ?>"
                                           style="display: none">
                                    <input type="text" name="comment" placeholder="Ecrire un commentaire"
                                           style="display: inline">
                                    <input type="submit" name="send" value="▶">
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <br>
                        <?php
                        CommentManager::getLastComment($data['id'], 5);


                    }
                }
            }
        }
    }

    public static function getCharacterPicture(int $characterFK, $limit)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE character_fk = :character_fk");

        $select->bindValue(':character_fk', $characterFK);

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
                        ?> <div class="pictureCharacter">
                            <form method="post" action="?c=delete">
                                <input type="text" name="filename" value="<?=$data['image']?>" style="display: none">
                                <input type="submit" name="deletePicture" value="❌" title="Supprimer">
                            </form>
                            <div><h3><?=$data2['username']?></h3></div>
                            <div class="description"><?=$data['description'] ?></div>
                            <br>
                            <a href="?c=picture&id=<?= $data['id'] ?>"><img class="gallerieImage"
                                                                            src="<?= $filename ?> "
                                                                            alt="<?= $data['image'] ?>"
                                                                            style="max-width: 400px; max-height: 500px"></a>
                            <?php
                            if (isset($_SESSION['user'])) {
                                ?>
                                <form method="post" action="?c=character&a=comment&id=<?=$data['character_fk']?>">
                                    <input type="number" name="userFk" value="<?=$_SESSION['user']['id']?>" style="display: none">
                                    <input type="number" name="characterImageFk" value="<?=$data['id']?>" style="display: none">
                                    <input type="text" name="comment" placeholder="Ecrire un commentaire" style="display: inline">
                                    <input type="submit" name="send" value="▶">
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                        <br>
                        <?php
                        CommentManager::getLastComment($data['id'], $limit);
                    }
                }
            }
        }
    }

    public static function deletePicture($picture) {
        $delete = Connect::getPDO()->prepare("Delete  From aiu12_character_image WHERE image = :image");
        $delete->bindValue(':image', $picture);

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Le photo a été supprimé !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }
}