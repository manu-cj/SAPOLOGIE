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
            ?>
            <div class="all-character">
                <?php
                foreach ($datas as $data) {
                    ?>
                    <br>
                    <div class="character <?= $data['classe'] ?>">

                        <a href="?c=character&id=<?= $data['id'] ?>" style="display: inline">
                            <h1
                                    class="character-name" style="display: inline"><?= $data['character_name'] ?></h1>
                            <h3 class="classe"><?= $data['classe'] ?></h3>
                            <h3 class="classe">Serveur : <?= $data['server_name'] ?></h3>
                        </a>
                    </div>

                    <?php

                }

                ?>
            </div>

            <?php
            if (isset($_SESSION['user'])) {
                if ($_GET['id'] === $_SESSION['user']['id']) {
                    $validate = $_SESSION['mailValidate'];
                    if ($validate === '1') {
                        if ($_SESSION['banni'] === '0') {
                            ?>
                            <a href="?c=profil&a=add-character&id=<?= $_SESSION['user']['id'] ?>" id="addCharacter">Ajouter
                                un
                                personnage</a>
                            <?php
                        } else {
                            ?>
                            <h4>Vous avez été banni par un Admin vous ne pouvez pas créer de personnage !</h4>
                            <?php
                        }
                    } else {
                        ?>
                        <h4>Veuillez vérifier l'adresse mail de votre compte pour créer un personnage !</h4>
                        <?php

                    }
                }
            }
            if ($select->rowCount() === 0) {
                echo '<br>aucun personnage';
            }
        }
    }

    public static function getAllCharacter()
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character");


        if ($select->execute()) {
            $datas = $select->fetchAll();
            ?>
            <div class="all-character">
                <?php
                foreach ($datas as $data) {
                    ?>
                    <br>
                    <div class="character <?= $data['classe'] ?>">
                        <a href="?c=character&id=<?= $data['id'] ?>" style="display: inline">
                            <h1
                                    class="character-name" style="display: inline"><?= $data['character_name'] ?></h1>

                            <h3 class="classe"><?= $data['classe'] ?></h3>
                            <h3 class="classe">Serveur : <?= $data['server_name'] ?></h3>
                        </a>
                    </div>

                    <?php
                }
                ?>
            </div>
            <?php
            if ($select->rowCount() === 0) {
                echo 'aucun resultat';
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
                    <a href="https://worldofwarcraft.com/fr-fr/character/<?= $data['server_name'] ?>/<?= $data['character_name'] ?>"
                       target="_blank" style="display: inline" title="Armurerie" alt="Armurerie"><i
                                class="fas fa-external-link-alt"></i></a>
                    <?php
                    $validate = $_SESSION['mailValidate'];
                    if ($validate === '0') {
                        ?>
                        <h4>Veuillez vérifier votre adresse mail pour modifier votre personnage !</h4>
                        <?php

                    }
                    if ($_SESSION['banni'] === '1') {
                        ?>
                        <h4>Vous avez été banni par un Admin vous ne pouvez pas modifier votre personnage !</h4>
                        <?php
                    }

                    if ($validate === '1') {
                        if ($_SESSION['banni'] === '0') {
                            ?>
                            <p style="display: inline" id="updateCharacter"><i class="fas fa-cog"
                                                                               title="Modifier le personnage"></i></p>
                            <p id="previous" style="display: none"> ⇦</p>
                            <form action="?c=character&a=update-character&id=<?= $data['id'] ?>" method="post"
                                  id="formUpdateCharacter" style="display: none">
                                <table>
                                    <tr>
                                        <td><label for="name">Nom du personnage :</label></td>
                                        <td><input type="text" name="name" id="name"
                                                   value="<?= $data['character_name'] ?>"
                                                   required></td>
                                    </tr>

                                    <tr>
                                        <td><label for="serveur">Nom du serveur :</label></td>
                                        <td><input type="text" name="serveur" id="serveur"
                                                   value="<?= $data['server_name'] ?>"
                                                   required></td>
                                    </tr>
                                    <input type="text" name="id" value="<?= $data['id'] ?>" style="display: none">

                                </table>
                                <input type="submit" name="update" value=" ↻" title="actualiser">
                            </form>
                            <?php
                        }
                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['id'] === $data['user_fk'] or $_SESSION['role'] === 'admin') {
                                $_SESSION['id'] = $data['id']
                                ?>
                                <input type="submit" name="deleteChoiceCharacter" value="❌" title="Supprimer"
                                       style="display: inline; border: none; background-color: rgba(0, 139, 129, 0)">
                                <form method="post" action="?c=delete" class="deleteCharacter" style="display: none">

                                    <p class="Ask">Voulez vous vraiment supprimer ce personnage ?</p>
                                    <input type="submit" name="deleteCharacter" value="Oui" title="Supprimer">
                                </form>
                                <input type="submit" name="notDeleteCharacter" value="Non" title="Ne pas supprimer"
                                       style="display: none">
                                <?php
                            }
                        }
                        ?>
                        <?php
                    }
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
                        $validate = $_SESSION['mailValidate'];
                        if ($validate === '0') {
                            ?>
                            <h4>Veuillez vérifier votre adresse mail pour ajouter d'images de votre personnage !</h4>
                            <?php
                        }
                        if ($_SESSION['banni'] === '1') {
                            ?>
                            <h4>Vous avez été banni vous ne pouvez pas ajouter d'images de votre personnage !</h4>
                            <?php
                        }
                        if ($validate === '1') {
                            if ($_SESSION['banni'] === '0') {
                                ?>
                                <div style="margin-bottom: 150px">
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
                                                <option name="public" value="2"> Ajouter la publication dans le fil
                                                    d'actualité
                                                </option>
                                            </optgroup>
                                            <optgroup label="Profil">
                                                <option name="profil" value="3"> Ne pas ajouter la publication dans le
                                                    fil
                                                    d'actualité
                                                </option>
                                            </optgroup>
                                        </select>
                                        <br>
                                        <br>
                                        <input type="number" name="characterId" value="<?= $characterId ?>"
                                               style="display: none">
                                        <input type="submit" name="upload">
                                    </form>
                                </div>
                                <br>
                                <?php
                            }
                        }
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
            $id = $character_image->getCharacterFk();
            $_SESSION['picture'] = '';
            $alert[] = '<div class="alert-succes">Votre personnage a été ajouté</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $id);
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
                    <div class="character <?= $data['classe'] ?>">
                        <a href="?c=character&id=<?= $data['id'] ?>">
                            <h1 class="name"><?= $data['character_name'] ?></h1>
                            <h3 class="classe"><?= $data['classe'] ?></h3>
                            <h3 class="server"><?= $data['server_name'] ?></h3>
                        </a>
                    </div>
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
                foreach ($datas

                         as $data) {
                    ?>
                    <div class="character <?= $data['classe'] ?>">
                        <a href="?c=character&id=<?= $data['id'] ?>">
                            <h1 class="name"><?= $data['character_name'] ?></h1>
                            <h3 class="classe"><?= $data['classe'] ?></h3>
                            <h3 class="server"><?= $data['server_name'] ?></h3>
                        </a>
                    </div>
                    </a>

                    <?php
                }
                ?>
            </div>
            </div>
            <?php
            if ($select->rowCount() === 0) {
                echo 'aucun resultat';
            }
        }
    }

    public static function deleteCharacter($id)
    {
        $delete = Connect::getPDO()->prepare("Delete  From aiu12_character WHERE id = :id");
        $delete->bindValue(':id', $id);

        if ($delete->execute()) {
            $alert = [];
            $_SESSION['id'] = '';
            $alert[] = '<div class="alert-succes">Le personnage a été supprimé !</div>';
            if (count($alert) > 0) {
                $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                header('Location: ' . $referer);
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\'est produite !</div>';
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