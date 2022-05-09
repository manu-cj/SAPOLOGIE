<?php

class AdminController extends AbstractController
{

    public function index()
    {
        $this->render('private/admin');
        UserManager::getAllUser();
    }
}
