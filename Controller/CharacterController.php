<?php

use App\Model\Entity\Character_image;

class CharacterController extends AbstractController
{


    public function index()
    {
        $this->render('public/character');
        if (isset($_GET['id'])) {
            CharacterManager::getCharacterId(htmlentities($_GET['id']));
            CharacterManager::getCharacterPicture(htmlentities($_GET['id']));
        }


    }

    public function addPicture() {
        if ($this->getPost('upload')) {
            $picture = htmlentities($_SESSION['picture']);
            $id = htmlentities($_POST['characterId']);

            $visibility = htmlentities($_POST['visibility']);



            $alert = [];
            if (empty($picture)) {
                $alert[] = '<div class="alert-error">Aucun fichier sélectionner</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=character&id='.$id);
            }



        }
    }

}





























