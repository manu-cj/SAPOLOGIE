<?php

class VerificationController extends AbstractController {

    public function index()
    {
        $this->render('public/verification');
        if ($this->getPost('verifMail')) {
            $mail =$_SESSION['user']['mail'];
            Mail_validateManager::updateCode($mail);
            $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
            header('Location: ' . $referer);
        }
        if (!isset($_GET['mail'])) {
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