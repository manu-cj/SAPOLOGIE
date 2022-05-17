<?php
class ContactController extends AbstractController
{

    public function index()
    {
        $this->render('public/contact');
        if ($this->getPost('send')){
            $allowedTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'br', 'hr', 'b', 'font', 'i', 'a', 'ul', 'ol', 'li',
                'table', 'th', 'tr', 'td', 'thead', 'tbody', 'tfoot', 'span', 'div', 'style', 'strong'
            ];
            $mail = htmlentities($_POST['mail']);
            $content = strip_tags($_POST['message'], $allowedTags);
            $titre = htmlentities($_POST['sujet']);

            $alert = [];

            if (empty($mail)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }
            if (empty($content)) {
                $alert[] = '<div class="alert-error">Un des champs est vide</div>';
            }

            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $alert[] = '<div class="alert-error">L\'adresse e-mail n\'est pas valide !</div>';
            }

            if (strlen($content) <= 2) {
                $alert[] = '<div class="alert-error">Le message doit contenir minimum 2 caractères !</div>';
            }

            if (strlen($titre) <= 2 || strlen($titre) >= 255) {
                $alert[] = '<div class="alert-error">Le sujet doit contenir entre 2 et 255 caractères !</div>';
            }

            if (count($alert) > 0) {
                $_SESSION['alert'] = $alert;
                header('LOCATION: ?c=contact');
            }

            else {
                $destinataire = 'blog@world-of-sapologie.com';
                $sujet = $titre;
                $message = $content;

                $header = 'From: '.$mail;
                $header .= 'Reply-To: '.$mail . "\n";
                $header .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
                $header .= 'Content-Transfer-Encoding: 8bit';
                if (mail($destinataire, $sujet, $message, $header)) {
                    $alert[] = '<div class="alert-succes">Votre message a bien été envoyé </div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=contact');
                    }
                } else // Non envoyé
                {
                    $alert[]  = '<div class="alert-error">Votre message n\'a pas pu être envoyé</div>';
                    if (count($alert) > 0) {
                        $_SESSION['alert'] = $alert;
                        header('LOCATION: ?c=contact');
                    }
                }
            }
        }
    }
}