<?php


class SearchController extends AbstractController
{

    public function index()
    {
        $this->render('public/search');
        if (isset($_POST['search'])) {
            $search = str_replace(" ", '-',$_POST['searchBar']);
            header("Location:?c=search&result=".$search."");
        }
        if (isset($_GET['result'])) {
            if ($_GET['result'] !== '') {
                $result = htmlentities($_GET['result']);
                CharacterManager::getNameCharacter($result);
                CharacterManager::getClasseCharacter($result);
            }
            else {
                echo '<br><div class="alert error">Vous n\'avez pas rempli le champs recherche !</div>';
            }
            if ($_GET['result'] === 'all-character'){
                CharacterManager::getAllCharacter();
            }

        }
    }
}