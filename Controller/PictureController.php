<?php

use App\Model\Entity\Character_image;

class PictureController extends AbstractController
{

    public function index()
    {
        $this->render('public/picture');
        if (isset($_GET['id'])) {
            $id = htmlentities($_GET['id']);
            if (isset($_SESSION['user'])) {
                Mail_validateManager::getMailValidate();
            }
            Character_imageManager::getImage($id, 99999999);
        }
    }

    public function updateDescription() {
        if ($this->getPost('updateDescription')) {
            $description = htmlentities($_POST['description']);
            $view = htmlentities($_POST['visibility']);
            $id = htmlentities($_POST['id']);

            $newDescription = new Character_image();
            $newDescription
                ->setDescription($description)
                ->setViewFk($view)
            ;

            Character_imageManager::updatePictureDescription($newDescription, $id);


        }
    }
}