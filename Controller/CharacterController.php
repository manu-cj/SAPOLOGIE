<?php

use App\Model\Entity\Character_image;
use App\Model\Entity\Comment;

class CharacterController extends AbstractController
{
    public function index()
    {
        $this->render('public/character');
        if (isset($_GET['id'])) {
            CharacterManager::getCharacterId(htmlentities($_GET['id']));
            Character_imageManager::getCharacterPicture(htmlentities($_GET['id']), 9999999);
        }
    }

    public function addPicture() {
        if ($this->getPost('upload')) {
            $picture = htmlentities($_SESSION['picture']);
            $id = htmlentities($_POST['characterId']);
            $description = nl2br(htmlentities($_POST['description']));
            $visibility = htmlentities($_POST['visibility']);

            $alert = [];
            if (empty($picture)) {
                $alert[] = '<div class="alert-error">Aucun fichier sélectionner</div>';
            }
            if (empty($description)) {
                $description = '';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id='.$id);
            }

            else {
                $pictureData = new Character_image();

                $pictureData
                    ->setImage($picture)
                    ->setCharacterFk($id)
                    ->setUserFk($_SESSION['user']['id'])
                    ->setViewFk($visibility)
                    ->setDescription($description)
                ;

                CharacterManager::addPicture($pictureData);
            }
        }
    }

    public function comment() {
        if ($this->getPost('send')){
            $userFk = htmlentities($_POST['userFk']);
            $idPublication = $_GET['id'];
            $characterFk = $_POST['characterImageFk'];
            $comment = nl2br(htmlentities($_POST['comment']));

            if (empty($_GET['id'])) {
                $alert[] = '<div class="alert-error">Imposible de se rendre sur la page</div>';
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    header('LOCATION: ?c=home');
                }
            }

            $alert = [];
            if (empty($userFk)) {
                $alert[] = '<div class="alert-error">Une erreur est survenue</div>';
            }
            if (empty($comment)) {
                $alert[] = '<div class="alert-error">Il manque un champs</div>';
            }

            if (strlen($comment) < 1 || strlen($comment) >= 255) {
                $alert[] = '<div class="alert-error">Votre commentaire doit contenir en 1 et 255 caractères</div>';
            }
            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id='.$idPublication);
            }

            else {
                $addComment = new Comment();

                $addComment
                    ->setUserFk($userFk)
                    ->setCharacterImageFk($characterFk)
                    ->setContent($comment)
                ;
                CommentManager::addComment($addComment, $idPublication);
            }
        }
    }
}





























