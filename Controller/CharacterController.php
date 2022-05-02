<?php

class CharacterController extends AbstractController
{


    public function index()
    {
        $this->render('public/character');
        if (isset($_GET['id'])) {
            CharacterManager::getCharacterId($_GET['id']);
        }


    }

    public function addPicture() {

    }

}





























