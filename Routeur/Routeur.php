<?php

class Routeur
{
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
        }
    }


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
