<?php

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('public/home');
        CharacterManager::getCharacterPictureForHome();
    }
}