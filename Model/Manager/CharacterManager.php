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

}