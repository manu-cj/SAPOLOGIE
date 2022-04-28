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
            case 'character-name':
                $control->characterName();
                break;
            case 'update-profil':
                $control->updateProfil();
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
