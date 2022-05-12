<?php

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('public/home');
        Mail_validateManager::getMailValidate();
        Character_imageManager::getCharacterPictureForHome();
        User_roleManager::getUserRole();

        if (isset($_GET['getRole'])) {
            User_roleManager::getUserRole();
            header('Location: ?c=home');
        }
        if (!isset($_SESSION['role'])) {
            if (isset($_SESSION['user'])) {
                User_roleManager::addRole();
            }
        }

    }
}