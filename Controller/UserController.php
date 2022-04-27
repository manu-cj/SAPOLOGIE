<?php

class UserController extends AbstractController
{

    public function index()
    {
        $this->render('user/profil');
    }

    public function updateProfil() {
        $this->render('user/update-profil');
    }

    public function character()
    {
        $this->render('user/character');
    }
}