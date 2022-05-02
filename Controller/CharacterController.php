<?php

use App\Model\Entity\Character_image;

class CharacterController extends AbstractController
{


    public function index()
    {
        $this->render('public/character');
        if (isset($_GET['id'])) {
            CharacterManager::getCharacterId($_GET['id']);
        }


    }

    public function addPicture() {
        if ($this->getPost('upload')) {
            $picture = htmlentities($_SESSION['picture']);
            $id = htmlentities($_POST['characterId']);

            echo $picture;
            $alert = [];
            if (empty($picture)) {
                $alert[] = '<div class="alert-error">Aucun fichier sélectionner</div>';
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
                ;

                CharacterManager::addPicture($pictureData);
            }

        }
    }

}





























