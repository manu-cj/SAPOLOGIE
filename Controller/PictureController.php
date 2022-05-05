<?php

use App\Model\Entity\Character_image;

class PictureController extends AbstractController
{

    public function index()
    {
        $this->render('public/picture');
        if (isset($_GET['id'])) {
            $id = htmlentities($_GET['id']);
            Character_imageManager::getImage($id, 99999999);
        }
    }

    public function updateDescription() {
        if ($this->getPost('updateDescription')) {
            $description = htmlentities($_POST['description']);
            $id = htmlentities($_POST['id']);

            $newDescription = new Character_image();
            $newDescription
                ->setDescription($description)
            ;

            Character_imageManager::updatePictureDescription($newDescription, $id);


        }
    }
}