<?php

class VerificationController extends AbstractController {

    public function index()
    {
        $this->render('public/verification');
        if ($this->getPost('verifMail')) {
            Mail_validateManager::updateCode();
            $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
            header('Location: ' . $referer);
        }
        if (!isset($_GET['username'])) {
            $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
            header('Location: ' . $referer);
        }
        if (!isset($_GET['code'])) {
            $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
            header('Location: ' . $referer);
        }
        else {
            Mail_validateManager::VerifMailLink();
        }

    }
}