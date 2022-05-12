<?php

class VerificationController extends AbstractController {

    public function index()
    {
        $this->render('public/verification');
        if ($this->getPost('verifMail')) {

        }
        if (!isset($_GET['username'])) {
            header('LOCATION: ?c=home');
        }
        if (!isset($_GET['code'])) {
            header('LOCATION: ?c=home');
        }
        else {
            Mail_validateManager::VerifMailLink();
        }

    }
}