<?php

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
}