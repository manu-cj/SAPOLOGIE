<?php

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('public/home');
        Character_imageManager::getCharacterPictureForHome();
    }
}