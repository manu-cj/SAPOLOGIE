<?php


use App\Model\Entity\Character;

class CharacterManager
{

public static function addCharacter(Character $character) {
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

public static function getCharacter() {
    $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_character WHERE user_fk = :user_fk");

    $select->bindValue(':user_fk', $_SESSION['user']['id']);
    if ($select->execute()) {
        $datas = $select->fetchAll();
        foreach ($datas as $data) {
            ?>
            <a href="?c=character&a=character-name&n=<?=$data['character_name']?>"><h1 class="character-name"><?=$data['character_name']?></h1></a>
<?php
        }
    }
}

}