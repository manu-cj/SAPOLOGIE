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
            $alert[] = '<div class="alert-succes">Votre personnage a été ajouté</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=profil&id=' . $character->getUserFk());
            }
        }
    }

    public static function getCharacter(int $idUser)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE user_fk = :user_fk");

        $select->bindValue(':user_fk', $idUser);
        if ($select->execute()) {
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                ?>
                <br>

                <form method="post" action="?c=delete" style="display: inline">
                    <input type="text" name="idCharacter" value="<?= $data['id'] ?>" style="display: none">
                    <input type="submit" name="deleteCharacter" value="🗑️" title="Supprimer">
                </form>
                <a href="?c=character&id=<?= $data['id'] ?>" style="display: inline">
                    <div class="character <?= $data['classe'] ?>">
                        <h1
                                class="character-name" style="display: inline"><?= $data['character_name'] ?></h1>

                        <h3 class="classe"><?= $data['classe'] ?></h3>
                        <h3 class="classe">Serveur : <?= $data['server_name'] ?></h3>

                    </div>
                </a>

                <?php
            }

        }
    }

    public static function getCharacterId($characterId)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE id = :id");

        $select->bindValue(':id', $characterId);

        if ($select->execute()) {
            ?>


            <?php
            $datas = $select->fetchAll();
            foreach ($datas as $data) {
                if (isset($_SESSION['user'])) {
                    ?>
                    <button style="display: inline" id="updateCharacter">📝</button>
                    <button id="previous" style="display: none"> ⇦</button>
                    <form action="?c=character&a=update-character&id=<?= $data['id'] ?>" method="post"
                          id="formUpdateCharacter" style="display: none">
                        <table>
                            <tr>
                                <td><label for="name">Nom du personnage :</label></td>
                                <td><input type="text" name="name" id="name" value="<?= $data['character_name'] ?>"
                                           required></td>
                            </tr>

                            <tr>
                                <td><label for="serveur">Nom du serveur :</label></td>
                                <td><input type="text" name="serveur" id="serveur" value="<?= $data['server_name'] ?>"
                                           required></td>
                            </tr>
                            <input type="text" name="id" value="<?= $data['id'] ?>" style="display: none">

                        </table>
                        <input type="submit" name="update" value=" ↻" title="actualiser">
                    </form>
                    <?php
                }
                ?>
                <div class="character <?= $data['classe'] ?>">
                    <h1 class="name"><?= $data['character_name'] ?></h1>
                    <h3 class="classe"><?= $data['classe'] ?></h3>
                    <h3 class="server"><?= $data['server_name'] ?></h3>
                </div>
                <?php
                if (isset($_SESSION['user'])) {
                    if ($data['user_fk'] === $_SESSION['user']['id']) {
                        ?>
                        <h1 id="sendPicture">Ajouter une image ⬇</h1>
                        <h1 id="hidden" style="display: none">Cacher ⬆ </h1>
                        <form method="post" action="?c=character&a=add-picture&id=<?= $characterId ?>"
                              enctype="multipart/form-data" id="addPicture" style="display: none">
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
            $alert[] = '<div class="alert-succes">Votre personnage a été ajouté</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $character_image->getCharacterFk());
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
            CharacterManager::getClasseCharacter($name);
        }
    }

    public static function getClasseCharacter($name)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE classe = :classe");

        $select->bindValue(':classe', $name);
        if ($select->execute()) {
            $datas = $select->fetchAll();
            ?>
            <div class="all-classe">

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
    }

    public static function deleteCharacter($id)
    {
        $delete = Connect::getPDO()->prepare("Delete  From aiu12_character WHERE id = :id");
        $delete->bindValue(':id', $id);

        if ($delete->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Le personnage a été supprimé !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-succes">Une erreur c\'est produite !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=home');
            }
        }
    }

    public static function updateCharacter(Character $character, $id)
    {
        $update = Connect::getPDO()->prepare("UPDATE aiu12_character SET character_name = :character_name, server_name = :server_name
                                                    WHERE id = :id");
        $update->bindValue(':character_name', $character->getCharacterName());
        $update->bindValue(':server_name', $character->getServer());
        $update->bindValue(':id', $id);
        if ($update->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Le personnage a été mis à jour !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $id);
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-succes">Une erreur c\'est produite !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $id);
            }
        }
    }
}