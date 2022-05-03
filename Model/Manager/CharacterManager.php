<?php


use App\Model\Entity\Character;
use App\Model\Entity\Character_image;

class CharacterManager
{

    public static function addCharacter(Character $character)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_character (user_fk, character_name, classe, server_name)
                                                VALUES (:user_fk, :character_name, :classe, :server_name)");

        $insert->bindValue(':user_fk', $character->getUserFk());
        $insert->bindValue(':character_name', $character->getCharacterName());
        $insert->bindValue(':classe', $character->getClasse());
        $insert->bindValue(':server_name', $character->getServer());
        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-suces">Votre personnage a été ajouté</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil');
            }
        }
    }

    public static function getCharacter()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE user_fk = :user_fk");

        $select->bindValue(':user_fk', $_SESSION['user']['id']);
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                ?>
                <br>
                <div class="character <?= $data['classe'] ?>">
                    <form action="?c=character&id=<?= $data['id'] ?>" method="post" style="display: inline">
                        <input type="number" name="idArticle" value="<?= $data['id'] ?>" style="display: none">
                        <input type="submit" name="delete" class="submit" value="❌"
                               style="display: inline; border: none; cursor: pointer"
                               title="Supprimer le personnage" ">
                    </form>
                    <a href="?c=character&id=<?= $data['id'] ?>" style="display: inline"><h1
                                class="character-name"><?= $data['character_name'] ?></h1></a>

                    <h3 class="classe"><?= $data['classe'] ?></h3>
                    <h3 class="classe">Serveur : <?= $data['server_name'] ?></h3>
                </div>
                <?php
            }
        }
    }

    public static function getCharacterId($characterId)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE id = :id");

        $select->bindValue(':id', $characterId);

        if ($select->execute()) {

            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if (isset($_SESSION['user'])) {
                    ?>
                    <div class="character <?= $data['classe'] ?>">
                        <h1 class="name"><?= $data['character_name'] ?></h1>
                        <h3 class="classe"><?= $data['classe'] ?></h3>
                        <h3 class="server"><?= $data['server_name'] ?></h3>
                    </div>
                    <?php
                    if ($data['user_fk'] === $_SESSION['user']['id']) {
                        ?>
                        <form method="post" action="?c=character&a=add-picture&id=<?= $characterId ?>"
                              enctype="multipart/form-data">
                            <input type="file" name="characterImage">
                            <br>
                            <br>
                            <label for="description">Description :</label>
                            <br>
                            <textarea name="description" cols="45" rows="10"></textarea>
                            <br>
                            <label for="visibility">Visibilité :</label>
                            <br>
                            <br>
                            <select name="visibility">
                                <optgroup label="Public">
                                    <option name="public" value="2"> Ajouter la publication dans le fil d'actualité
                                    </option>
                                </optgroup>
                                <optgroup label="Profil">
                                    <option name="profil" value="3"> Ne pas ajouter la publication dans le fil
                                        d'actualité
                                    </option>
                                </optgroup>
                            </select>
                            <br>
                            <br>
                            <input type="number" name="characterId" value="<?= $characterId ?>" style="display: none">
                            <input type="submit" name="upload">

                        </form>
                        <br>
                        <?php
                    }
                }
            }
        }
    }

    public static function addPicture(Character_image $character_image)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_character_image (image, character_fk, user_fk, view_fk, description) 
                                                    VALUES (:image, :character_fk, :user_fk, :view_fk, :description) ");

        $insert->bindValue(':image', $character_image->getImage());
        $insert->bindValue(':character_fk', $character_image->getCharacterFk());
        $insert->bindValue(':user_fk', $character_image->getUserFk());
        $insert->bindValue(':view_fk', $character_image->getViewFk());
        $insert->bindValue(':description', $character_image->getDescription());

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-suces">Votre personnage a été ajouté</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $character_image->getCharacterFk());
            }
        }
    }

    public static function getCharacterPicture(int $characterFK)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character_image WHERE character_fk = :character_fk");

        $select->bindValue(':character_fk', $characterFK);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                $files = glob('uploads/' . $data['image']);
                foreach ($files as $filename) {
                    echo '<div class="pictureCharacter">
<form method="post" action="?c=realisations">
<input type="text" name="filename" value="' . $filename . '" style="display: none">
<input type="submit" name="deletePicture" value="❌" title="Supprimer">
</form>
<div class="description">' . $data['description'] . '</div>
<img class="gallerieImage" src="' . $filename . ' "  alt="' . $data['image'] . '" </img></div>';
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
                        echo '<div class="pictureCharacter">
<form method="post" action="?c=realisations">
<input type="text" name="filename" value="' . $filename . '" style="display: none">
<input type="submit" name="deletePicture" value="❌" title="Supprimer">
</form>
<div><h3>'.$data2['username'].'</h3></div>
<div class="description">' . $data['description'] . '</div>
<img class="gallerieImage" src="' . $filename . ' "  alt="' . $data['image'] . '" </img></div>';
                    }
                }

            }
        }
    }

    public static function getNameCharacter($name)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE character_name = :character_name");

        $select->bindValue(':character_name', $name);
        if ($select->execute()) {
            $datas = $select->fetchAll();
            ?>
            <div class="all-character">

                <?php
                foreach ($datas as $data) {
                    ?>
                    <a href="?c=character&id=<?= $data['id'] ?>">
                        <div class="character <?= $data['classe'] ?>">
                            <h1 class="name"><?= $data['character_name'] ?></h1>
                            <h3 class="classe"><?= $data['classe'] ?></h3>
                            <h3 class="server"><?= $data['server_name'] ?></h3>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        if ($select->rowCount() === 0) {
            echo '<h2>Aucun sapologue ne porte ce nom ici !</h2>';
        }


    }
}