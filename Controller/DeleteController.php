<?php

class DeleteController extends AbstractController
{

    public function index()
    {
        $this->render('public/delete');
        if ($this->getPost('deletePicture')){
            $picture = htmlentities($_POST['filename']);
            if (file_exists('uploads/'.$picture)) {
                unlink('uploads/'.$picture);
                Character_imageManager::deletePicture($picture);
            }
        }
    }
}