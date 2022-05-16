<?php
class ForgotPasswordController extends AbstractController
{

    public function index()
    {
        $this->render('log/forgot-password');
        if (isset($_GET['verification'])) {
            if ($this->getPost('forgot-password')) {
                $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
                $captcha = htmlentities($_POST['captcha']);
                $alert = [];
                if (empty($mail)) {
                    $alert[] = '<div class="alert-error">Un des champs est vide</div>';
                }
                if (empty($captcha)) {
                    $alert[] = '<div class="alert-error">Un des champs est vide</div>';
                }
                if ($captcha != $_SESSION['captcha']) {
                    $alert[] = '<div class="alert-error">Le captcha est incorrect</div>';
                }
                if (count($alert) > 0) {
                    $_SESSION['alert'] = $alert;
                    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
                    header('Location: ' . $referer);
                } else {
                    $forgotPassword = (new DateTime())->format('YmdHis') . uniqid();
                    Mail_validateManager::ForgotPassword($mail, $forgotPassword);
                }
            }
        }

        if (isset($_GET['code'])) {
            $code = htmlentities($_GET['code']);
            $mail = htmlentities($_GET['mail']);
            Mail_validateManager::verifCodeForgotPassword($mail, $code);
        }
    }
}
