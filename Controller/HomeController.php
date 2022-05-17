<?php

class HomeController extends AbstractController
{

    public function index()
    {
        $this->render('public/home');


        Character_imageManager::getCharacterPictureForHome();
        if (isset($_SESSION['user'])) {
            BanniManager::getBann();
            BanniManager::getBannMail();
            Mail_validateManager::getMailValidate();

        }

        if (isset($_GET['getRole'])) {
            User_roleManager::getUserRole();

        }

        if (!isset($_SESSION['role'])) {
            if (isset($_SESSION['user'])) {
                User_roleManager::addRole();
            }
        }

    }
}