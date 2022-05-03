<?php


use App\Model\Entity\Comment;

class CommentManager
{

    public static function addComment(Comment $comment, int $characterFk)
    {
        $insert = Connect::getPDO()->prepare("INSERT INTO aiu12_comment (user_fk, content, date, character_image_fk) 
                                                    VALUES (:user_fk, :content, :date, :character_image_fk)");

        date_default_timezone_set('Europe/Brussels');
        $date = date('y-m-d H:i:s');

        $insert->bindValue(':user_fk', $comment->getUserFk());
        $insert->bindValue(':content', $comment->getContent());
        $insert->bindValue(':date', $date);
        $insert->bindValue(':character_image_fk', $comment->getCharacterImageFk());

        if ($insert->execute()) {
            $alert = [];
            $alert[] = '<div class="alert-succes">Commentaire ajouté !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $characterFk);
            }
        } else {
            $alert = [];
            $alert[] = '<div class="alert-error">Une erreur c\est produite lors de l\'envoi du commentaire !</div>';
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id=' . $characterFk);
            }
        }
    }

    public static function getComment(int $id)
    {
        $select = Connect::getPDO()->prepare("SELECT * FROM aiu12_comment where character_image_fk = :id");

        $select->bindValue(":id", $id);

        if ($select->execute()) {
            $datas = $select->fetchAll();
            ?>
            <div class="allDataComment">
            <?php
            foreach ($datas as $data) {
                $select2 = Connect::getPDO()->prepare("SELECT * FROM aiu12_user where id = :id");
                $select2->bindValue(':id', $data['user_fk']);
                $select2->execute();
                $datas2 = $select2->fetchAll();
                foreach ($datas2 as $data2) {
                    ?>
                    <div class="CommentAuthor" style="display: inline"><b><?= $data2['username'] ?>
                            :</b> <?= date('d-m-y à H:i:s', strtotime($data['date'])) ?></div>
                    <br>
                    <div class="comment"><?= $data['content'] ?></div>
                    <br>
                    </div>
                    <?php

                }
            }
        }
    }
}