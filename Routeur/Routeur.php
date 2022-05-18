<?php

class Routeur
{

//Router which is responsible for making the link between the view and the controllers, the switch is used to trigger a function corresponding to the second url parameter

    public static function route(string $controller, ?string $action = null) {
        $control = new $controller();
        $control->index();
        switch ($action) {
            case 'add-character':
                $control->character();
                break;
            case 'add-picture':
                $control->addPicture();
                break;
            case 'update-profil':
                $control->updateProfil();
                break;
            case 'comment':
                $control->comment();
                break;
            case 'update-picture-description':
                $control->updateDescription();
                break;
            case 'update-character':
                $control->updateCharacter();
                break;
            case 'delete-profil':
                $control->deleteAccount();
                break;
            case 'mention-legales':
                $control->mention();
                break;
            case 'politique':
                $control->politique();
                break;

        }
    }

//Function that secures URL parameters
    public static function secureUrl(?string $param): ?string
    {
        if(null === $param) {
            return null;
        }

        $param = strip_tags($param);
        $param =  trim($param);
        return strtolower($param);
    }
}
