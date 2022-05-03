<?php


use App\Model\Entity\Comment;

class CommentManager
{

    public static function addComment(Comment $comment) {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_comment (user_fk, content, date, character_image_fk) 
                                                    VALUES (:user_fk, :content, :date, :character_image_fk)");

        date_default_timezone_set('Europe/Brussels');
        $date = date('y-m-d H:i:s');

        $insert->bindValue(':user_fk', $comment->getUserFk());
        $insert->bindValue(':content', $comment->getContent());
        $insert->bindValue(':date', $date);
        $insert->bindValue(':character_image_fk', $comment->getCharacterImageFk());

        if ($insert->execute()) {
            if ($insert->execute()) {
                $alert = [];
                $alert[] = '<div class="alert-succes">Commentaire ajouté !</div>';
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=character&a=comment&id='.$comment->getCharacterImageFk());
                }
            } else {
                $alert = [];
                $alert[] = '<div class="alert-error">Une erreur c\est produite lors de l\'envoi du commentaire !</div>';
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=character&a=comment&id='.$comment->getCharacterImageFk());
                }
            }
        }
    }
}