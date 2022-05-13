<?php

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('public/home');


        Character_imageManager::getCharacterPictureForHome();
        if  (isset($_SESSION['user'])) {
            Mail_validateManager::getMailValidate();
            User_roleManager::getUserRole();
        }

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